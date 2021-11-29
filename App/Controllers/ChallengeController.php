<?php

namespace App\Controllers;

use App\Auth;
use App\Core\Responses\Response;
use App\Models\Challenge;
use App\Models\MyChallenge;
use App\Models\News;
use App\Models\Pin;

class ChallengeController extends AControllerRedirect
{

    public function index()
    {
        //nope
    }

    public function challenge()
    {
        if (!Auth::isLogged()) {
            $this->redirect('home');
        }
        try {
            $news = News::getAll();
            $mychallenges = MyChallenge::getAll('userID = ?', [$_SESSION['userID']]);
            $challenges = Challenge::getAll();
        } catch (\Exception $e) {
            $this->redirect('challenge','challenge',['error' => $e->getMessage()]);
        }
        return $this->html(
            [
                'error' => $this->request()->getValue('error'),
                'mychallenges' => $mychallenges,
                'challenges' => $challenges,
                'news' => $news
            ]
        );
    }

    public function newChallenge() {
        if (!Auth::isLogged()) {
            $this->redirect('home');
        }

        try {
            $news = News::getAll();
            $mychallenges = MyChallenge::getAll('userID = ?', [$_SESSION['userID']]);
            $challenges = Challenge::getAll();
            return $this->html(
                [
                    'mychallenges' => $mychallenges,
                    'challenges' => $challenges,
                    'news' => $news
                ]
            );
        } catch (\Exception $e) {
            $this->redirect('challenge','challenge',['error' => $e->getMessage()]);
        }
    }

    public function addChallenge() {
        if (!Auth::isLogged()) {
            $this->redirect('home');
        }

        $newChallenge = new MyChallenge();
        $newChallenge->setUserID($_SESSION['userID']);
        $newChallenge->setChallengeID($this->request()->getValue('challengeID'));
        try {
            $newChallenge->save();
        } catch (\Exception $e) {
            $this->redirect('challenge','challenge',['error' => $e->getMessage()]);
        }
        $this->redirect('challenge','challenge');
    }

    public function deleteChallenge() {
        try {
            $challenge = MyChallenge::getAll('challengeID = ?', [$this->request()->getValue('deletedChallenge')]);
            $mychallenge = $challenge[0];
            if ($mychallenge != null) {
                $mychallenge->delete();
            }
        } catch (\Exception $e) {
            $this->redirect('challenge','challenge',['error' => 'Challenge was not deleted!']);
        }
        $this->redirect('challenge','challenge');
    }
}