<?php

namespace App\Controllers;

use App\Auth;
use App\Config\Configuration;
use App\Core\Responses\Response;
use App\Models\News;
use App\Models\Pin;

class PinController extends AControllerRedirect
{

    public function index()
    {
        if (Auth::isLogged()) {
            $this->redirect('pin','pin');
        } else {
            $this->redirect('news','news');
        }
    }

    public function pin()
    {
        try {
            if (!Auth::isLogged()) {
                $this->redirect('news','news');
            }

            $news = News::getAll();
            $pins = Pin::getAll('userID = ?', [$_SESSION['userID']]);
        } catch (\Exception $e) {
            $this->redirect('pin','pin',['error' => $e->getMessage()]);
        }
        return $this->html(
            [
                'error' => $this->request()->getValue('error'),
                'news' => $news,
                'pins' => $pins
            ]);
    }

    public function newPin() {
        if (!Auth::isLogged()) {
            $this->redirect('news','news');
        }

        return $this->html(
            [
                'error' => $this->request()->getValue('error')
            ]);
    }

    public function addPin() {
        if (!Auth::isLogged()) {
            $this->redirect('news','news');
        }
        $title = $this->request()->getValue('title');
        $text =$this->request()->getValue('text');
        $stars = $this->request()->getValue('stars');
        if (Pin::controlTitle($title) and Pin::controlText($text) and Pin::controlStars($stars)) {
            $newPin = new Pin();
            $newPin->setUserID($_SESSION['userID']);
            $newPin->setTitle($title);
            $newPin->setText($text);
            $newPin->setStars($stars);
            $this->addFile($newPin);
            try {
                $newPin->save();
            } catch (\Exception $e) {
                $this->redirect('pin','newPin',['error' => $e->getMessage()]);
            }
            $this->redirect('pin','pin');
        } else {
            $this->redirect('pin','newPin',['error' => 'Incorrect data!']);
        }
    }

    public function modifyPin() {
        if (!Auth::isLogged()) {
            $this->redirect('news','news');
        }
        try {
            $mypins = Pin::getAll('userID = ?', [$_SESSION['userID']]);
            if (count($mypins) == 0) {
                $this->redirect('pin','newPin',['error' => 'You have not created pins for modification!']);
            }
        } catch (\Exception $e) {
            $this->redirect('pin','pin',['error' => $e->getMessage()]);
        }
        return $this->html(
            [
                'error' => $this->request()->getValue('error'),
                'pins' => $mypins
            ]);
    }

    public function changePin() {
        if (!Auth::isLogged()) {
            $this->redirect('news','news');
        }

        try {
            $changePin = Pin::getOne($this->request()->getValue('idPin'));
            $title = $this->request()->getValue('title');
            $text = $this->request()->getValue('text');
            $stars = $this->request()->getValue('stars');
            if ($changePin != null and Pin::controlTitle($title)) {
                $changePin->setTitle($title);
                if ($text != null and Pin::controlText($text)) {
                    $changePin->setText($this->request()->getValue('text'));
                }
                $this->addFile($changePin);
                if ($stars != null and Pin::controlStars($stars)) {
                    $changePin->setStars($stars);
                }
                $changePin->save();
                $this->redirect('pin','pin');
            } else {
                $this->redirect('pin','modifyPin',['error' => 'Incorrect data']);
            }
        } catch (\Exception $e) {
            $this->redirect('pin','modifyPin',['error' => $e->getMessage()]);
        }
    }

    public function deletePin() {
        if (!Auth::isLogged()) {
            $this->redirect('news','news');
        }
        try {
            $pin = Pin::getOne($this->request()->getValue('deletedPin'));
             if ($pin != null) {
                 $pin->delete();
             }
        } catch (\Exception $e) {
            $this->redirect('pin','pin',['error' => 'Pin was not deleted!']);
        }
        $this->redirect('pin','pin');
    }

    private function addFile($pin)
    {
        if (isset($_FILES['file']) != null and $_FILES['file']['error'] == UPLOAD_ERR_OK) {
            $file = date('Y-a-d-H-i-s') . '_'  . $_SESSION['userID'] . '_' . $_FILES['file']['name'];
            move_uploaded_file($_FILES['file']['tmp_name'], Configuration::UPLOAD_DIR . "$file");
            $pin->setPicture($file);
        }
    }
}