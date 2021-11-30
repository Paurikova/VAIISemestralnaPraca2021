<?php

namespace App\Controllers;

use App\Core\Responses\Response;
use App\Auth;

class GameController extends AControllerRedirect
{

    public function index()
    {
        if (Auth::isLogged()) {
            $this->redirect('pin','pin');
        } else {
            $this->redirect('news','news');
        }
    }

    public function game() {
        if (!Auth::isLogged()) {
            $this->redirect('news','news');
        }
        return $this->html(
            []
        );
    }
}