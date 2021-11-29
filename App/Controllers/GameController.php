<?php

namespace App\Controllers;

use App\Core\Responses\Response;
use App\Auth;

class GameController extends AControllerRedirect
{

    public function index()
    {
        // TODO: Implement index() method.
    }

    public function gameMenu() {
        if (!Auth::isLogged()) {
            $this->redirect('home');
        }
        return $this->html(
            []
        );
    }

    public function newGame() {
        if (!Auth::isLogged()) {
            $this->redirect('home');
        }
        return $this->html(
            []
        );
    }
}