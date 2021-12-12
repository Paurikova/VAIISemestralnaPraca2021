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
        return $this->html([]);
    }

    public function getTimesInYear() {
        $year = date("Y");
        $minutes = [];
        $January = Reading::getAll('userID = ? and month = ? and year = ?',[$_SESSION['userID'],'1',$year]);
        if ($January == null)
            $minutes[0] = 0;
        else
            $minutes[0] = $January[0]->getTime();
        $February = Reading::getAll('userID = ? and month = ? and year = ?',[$_SESSION['userID'],'2',$year]);
        if ($February == null)
            $minutes[1] = 0;
        else
            $minutes[1] = $February[0]->getTime();
        $March = Reading::getAll('userID = ? and month = ? and year = ?',[$_SESSION['userID'],'3',$year]);
        if ($March == null)
            $minutes[2] = 0;
        else
            $minutes[2] = $March[0]->getTime();
        $April = Reading::getAll('userID = ? and month = ? and year = ?',[$_SESSION['userID'],'4',$year]);
        if ($April == null)
            $minutes[3] = 0;
        else
            $minutes[3] = $April[0]->getTime();
        $May = Reading::getAll('userID = ? and month = ? and year = ?',[$_SESSION['userID'],'5',$year]);
        if ($May == null)
            $minutes[4] = 0;
        else
            $minutes[4] = $May[0]->getTime();
        $June = Reading::getAll('userID = ? and month = ? and year = ?',[$_SESSION['userID'],'6',$year]);
        if ($June == null)
            $minutes[5] = 0;
        else
            $minutes[5] = $June[0]->getTime();
        $July = Reading::getAll('userID = ? and month = ? and year = ?',[$_SESSION['userID'],'7',$year]);
        if ($July == null)
            $minutes[6] = 0;
        else
            $minutes[6] = $July[0]->getTime();
        $August = Reading::getAll('userID = ? and month = ? and year = ?',[$_SESSION['userID'],'8',$year]);
        if ($August == null)
            $minutes[7] = 0;
        else
            $minutes[7] = $August[0]->getTime();
        $September = Reading::getAll('userID = ? and month = ? and year = ?',[$_SESSION['userID'],'9',$year]);
        if ($September == null)
            $minutes[8] = 0;
        else
            $minutes[8] = $September[0]->getTime();
        $October = Reading::getAll('userID = ? and month = ? and year = ?',[$_SESSION['userID'],'10',$year]);
        if ($October == null)
            $minutes[9] = 0;
        else
            $minutes[9] = $October[0]->getTime();
        $November = Reading::getAll('userID = ? and month = ? and year = ?',[$_SESSION['userID'],'11',$year]);
        if ($November == null)
            $minutes[10] = 0;
        else
            $minutes[10] = $November[0]->getTime();
        $December = Reading::getAll('userID = ? and month = ? and year = ?',[$_SESSION['userID'],'12',$year]);
        if ($December == null)
            $minutes[11] = 0;
        else
            $minutes[11] = $December[0]->getTime();
        return $this->json($minutes);
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
                            return $this.json('error');
                        }
                    } else if (count($reading) == 0) {
                        $newReading = new Reading();
                        $newReading->setUserID($_SESSION['userID']);
                        $newReading->setMonth($month);
                        $newReading->setYear($year);
                        $newReading->setTime($totalTime);
                        $newReading->save();
                    } else {
                        return $this->json('error');
                    }
                } else {
                    return $this->json('error');
                }
            } else {
                return $this->json('error');
            }
            return $this->json('Correct data!');
        } catch (\Exception $e) {
            return $this->json('error');
        }
    }
}