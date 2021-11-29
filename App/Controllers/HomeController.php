<?php

namespace App\Controllers;

use App\Models\News;
use App\Auth;

/**
 * Class HomeController
 * Example of simple controller
 * @package App\Controllers
 */
class HomeController extends AControllerRedirect
{

    public function index()
    {
        if (!Auth::isLogged()) {
            $this->redirect('news','news');
        } else {
            $this->redirect('pin','pin');
        }
    }
}