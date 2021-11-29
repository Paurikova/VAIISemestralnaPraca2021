<?php

namespace App\Controllers;

use App\Auth;
use App\Core\Responses\Response;
use App\Models\User;
use const http\Client\Curl\AUTH_ANY;

class AuthController extends AControllerRedirect
{

    /**
     * @inheritDoc
     */
    public function index()
    {
        if (Auth::isLogged()) {
            $this->redirect('pin');
        } else {
            $this->redirect('auth','loginForm');
        }
    }

    public function loginForm()
    {
        if (Auth::isLogged()) {
            $this->redirect('pin');
        }
        return $this->html(
            [
                'success' => $this->request()->getValue('success'),
                'error' => $this->request()->getValue('error')
            ]
        );
    }

    public function login() {
        if (Auth::isLogged()) {
            $this->redirect('pin');
        }

        $mail = $this->request()->getValue('login');
        $password = $this->request()->getValue('password');
        if (User::controlMail($mail) and User::controlIdentification($password)) {
            $logged = Auth::login($mail, $password);
            if ($logged) {
                $this->redirect('pin','pin');
            } else {
                $this->redirect('auth','loginForm',['error' => 'Incorrect data!']);
            }
        } else {
            $this->redirect('auth','loginForm', ['error' => 'Incorrect data!']);
        }
    }

    public function logout() {
        if (!Auth::isLogged()) {
            $this->redirect('home');
        }

        Auth::logout();
        $this->redirect('home');
    }

    public function registrationForm()
    {
        if (Auth::isLogged()) {
            $this->redirect('pin');
        }

        return $this->html(
            [
                'error' => $this->request()->getValue('error')
            ]
        );
    }

    public function registration()
    {
        if (Auth::isLogged()) {
            $this->redirect('pin');
        }

        $mail = $this->request()->getValue('mail');
        $password1 = $this->request()->getValue('password1');
        $password2 = $this->request()->getValue('password2');
        $name =$this->request()->getValue('name');
        $surname = $this->request()->getValue('surname');
        if (User::controlMail($mail)
            and User::controlIdentification($password1) and User::controlIdentification($password2)
            and User::controlIdentification($name) and User::controlIdentification($surname)
            and !Auth::isRegistered($mail) and ($password1 == $password2) ) {
                $user = new User();
                $user->setMail($mail);
                $user->setName($name);
                $user->setSurname($surname);
                $user->setPassword($password1);
                try {
                    $user->save();
                } catch (\Exception $e) {
                    $this->redirect('auth','registrationForm',['error' => $e->getMessage()]);
                }
                $this->redirect('auth', 'loginForm', ['success' => 'Success registration!']);
        } else {
            $this->redirect('auth','registrationForm',['error' => 'Incorrect data!']);
        }
    }
}