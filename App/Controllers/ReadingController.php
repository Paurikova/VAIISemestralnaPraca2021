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
        if (Auth::isLogged()) {
            $this->redirect('pin','pin');
        } else {
            $this->redirect('news','news');
        }
    }

    public function reading()
    {
        if (!Auth::isLogged()) {
            $this->redirect('news','news');
        }
        try {
            $news = News::getAll();
            $year = date("Y");
            $January = Reading::getAll('userID = ? and month = ? and year = ?',[$_SESSION['userID'],'1',$year]);
            $February = Reading::getAll('userID = ? and month = ? and year = ?',[$_SESSION['userID'],'2',$year]);
            $March = Reading::getAll('userID = ? and month = ? and year = ?',[$_SESSION['userID'],'3',$year]);
            $April = Reading::getAll('userID = ? and month = ? and year = ?',[$_SESSION['userID'],'4',$year]);
            $May = Reading::getAll('userID = ? and month = ? and year = ?',[$_SESSION['userID'],'5',$year]);
            $June = Reading::getAll('userID = ? and month = ? and year = ?',[$_SESSION['userID'],'6',$year]);
            $July = Reading::getAll('userID = ? and month = ? and year = ?',[$_SESSION['userID'],'7',$year]);
            $August = Reading::getAll('userID = ? and month = ? and year = ?',[$_SESSION['userID'],'8',$year]);
            $September = Reading::getAll('userID = ? and month = ? and year = ?',[$_SESSION['userID'],'9',$year]);
            $October = Reading::getAll('userID = ? and month = ? and year = ?',[$_SESSION['userID'],'10',$year]);
            $November = Reading::getAll('userID = ? and month = ? and year = ?',[$_SESSION['userID'],'11',$year]);
            $December = Reading::getAll('userID = ? and month = ? and year = ?',[$_SESSION['userID'],'12',$year]);
        } catch (\Exception $e) {
            $this->redirect('reading','reading',['error' => $e->getMessage()]);
        }
        return $this->html(
            [
                'January' => $January,
                'February' => $February,
                'March' => $March,
                'April' => $April,
                'May' => $May,
                'June' => $June,
                'July' => $July,
                'August' => $August,
                'September' => $September,
                'October' => $October,
                'November' => $November,
                'December' => $December,
                'error' => $this->request()->getValue('error'),
                'news' => $news
            ]
        );
    }

    public function addReading(){
        if (!Auth::isLogged()) {
            $this->redirect('news','news');
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