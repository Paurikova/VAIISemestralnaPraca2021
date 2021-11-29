<?php

namespace App\Controllers;

use App\Auth;
use App\Core\Responses\Response;
use App\Models\News;
use App\Models\Reading;

class ReadingController extends AControllerRedirect
{

    public function index()
    {
        //nope
    }

    public function reading()
    {
        if (!Auth::isLogged()) {
            $this->redirect('home');
        }
        try {
            $news = News::getAll();
        } catch (\Exception $e) {
            $this->redirect('reading','reading',['error' => $e->getMessage()]);
        }
        return $this->html(
            [
                'error' => $this->request()->getValue('error'),
                'news' => $news
            ]
        );
    }

    public function addReading(){
        if (!Auth::isLogged()) {
            $this->redirect('home');
        }
        try {
            $date = $this->request()->getValue('date');
            $time = $this->request()->getValue('time');
            if (Reading::controlDate($date) and Reading::controlTime($time)) {
                $date = explode("-",$date);
                $year = $date[0];
                $month = $date[1];
                $day = $date[2];
                $time = explode(":", $time);
                $hours = $time[0];
                $minutes = $time[1];
                if (Reading::correctDate($day, $month, $year) and Reading::correctTime($minutes, $hours)) {
                    $totalTime = $hours * 60 + $minutes;
                    $reading = Reading::getAll('userID = ? and month = ? and year = ?', [$_SESSION['userID'], $month, $year]);
                    if (count($reading) == 1) {
                        $totalTime += $reading[0]->getTime();
                        $reading[0]->setTime($totalTime);
                        try {
                            $reading[0]->save();
                        } catch (\Exception $e) {
                            $this->redirect('reading', ['error' => $e->getMessage()]);
                        }
                    } else if (count($reading) == 0) {
                        $newReading = new Reading();
                        $newReading->setUserID($_SESSION['userID']);
                        $newReading->setMonth($month);
                        $newReading->setYear($year);
                        $newReading->setTime($totalTime);
                        $newReading->save();
                    } else {
                        $this->redirect('reading','reading', ['error' => 'Incorrect data!']);
                    }
                } else {
                    $this->redirect('reading','reading', ['error' => 'Incorrect data!']);
                }
            } else {
                $this->redirect('reading', 'reading', ['error' => 'Incorrect data!']);
            }
            $this->redirect('reading','reading');
        } catch (\Exception $e) {
            $this->redirect('reading', ['error' => $e->getMessage()]);
        }
    }
}