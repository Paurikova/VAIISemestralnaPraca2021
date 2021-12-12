<?php

namespace App\Controllers;

use App\Auth;
use App\Core\Responses\Response;
use App\Models\News;

class NewsController extends AControllerRedirect
{
    public function index()
    {
        if (Auth::isLogged()) {
            $this->redirect('pin','pin');
        } else {
            $this->redirect('news','news');
        }
    }

    public function news()
    {
        if (Auth::isLogged()) {
            $this->redirect('pin','pin');
        }
        try {
            $news = News::getAll();
        } catch (\Exception $e) {
            $this->redirect('news','news',['error' => $e->getMessage()]);
        }
        return $this->html(
            [
                'error' => $this->request()->getValue('error'),
                'news' => $news
            ]);

    }

    public function new()
    {
        try {
            $new = News::getOne($this->request()->getValue('newID'));
        } catch (\Exception $e) {
            $this->redirect('news','news',['error' => $e->getMessage()]);
        }
        return $this->html(
            [
                'new' => $new
            ]);
    }

    public function getOneNew()
    {
        try {
            $new = News::getOne($this->request()->getValue('newID'));
            return $this->json($new);
        } catch (\Exception $e) {
            $this->redirect('news','news',['error' => $e->getMessage()]);
        }
    }

}