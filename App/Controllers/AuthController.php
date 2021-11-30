<?php

namespace App\Controllers;

use App\Auth;
use App\Core\Responses\Response;
use App\Models\MyChallenge;
use App\Models\Pin;
use App\Models\Reading;
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
            $this->redirect('pin','pin');
        } else {
            $this->redirect('auth','loginForm');
        }
    }

    public function loginForm()
    {
        if (Auth::isLogged()) {
            $this->redirect('pin','pin');
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
            $this->redirect('pin','pin');
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
            $this->redirect('news','news');
        }

        Auth::logout();
        $this->redirect('news','news');
    }

    public function registrationForm()
    {
        if (Auth::isLogged()) {
            $this->redirect('pin','pin');
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
            $this->redirect('pin','pin');
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

    public function myAccount() {
        if (!Auth::isLogged()) {
            $this->redirect('news','news');
        }
        try {
            $myAccount = User::getOne($_SESSION['userID']);
        } catch (\Exceptione $e) {
            $this->redirect('pin','pin',['error' => $e->getMessage()]);
        }
        return $this->html(
            [
                'myAccount' => $myAccount,
                'success' => $this->request()->getValue('success'),
                'error' => $this->request()->getValue('error')
            ]
        );
    }

    public function modifyAccount() {
        $modified = false;
        $modification = [];
        if (!Auth::isLogged()) {
            $this->redirect('news','news');
        }
        try {
            $myAccount = User::getOne($_SESSION['userID']);
            $name = $this->request()->getValue('name');
            $surname = $this->request()->getValue('surname');
            $mail = $this->request()->getValue('mail');
            $password1 =  $this->request()->getValue('password1');
            $password2 =  $this->request()->getValue('password2');
            if (User::controlIdentification($name)) {
                $myAccount->setName($name);
                $modification[] = 'name';
                $modified = true;
            }
            if (User::controlIdentification($surname)) {
                $myAccount->setSurname($surname);
                $modification[] = 'username';
                $modified = true;
            }
            if (User::controlMail($mail)) {
                $myAccount->setMail($mail);
                $modification[] = 'mail';
                $modified = true;
            }
            if (User::controlIdentification($password1) and User::controlIdentification($password2 and $password1 == $password2)) {
                $myAccount->setPassword($password1);
                $modification[] = 'password';
                $modified = true;
            }
            if ($modified) {
                $myAccount->save();
                $message = "Account modified:";
                foreach ($modification as $word) {
                    $message = $message . " " . $word;
                }
                $this->redirect('auth', 'myAccount', ['success' => $message]);
            } else {
                $this->redirect('auth', 'myAccount', ['error' => 'Incorrect data']);
            }
        } catch (\Exceptione $e) {
            $this->redirect('pin','pin',['error' => $e->getMessage()]);
        }
    }

    public function deleteAccount() {
        if (!Auth::isLogged()) {
            $this->redirect('news','news');
        }
        try {
            $myAccount = User::getOne($_SESSION['userID']);
            if (Pin::deleteAll() and MyChallenge::deleteAll() and Reading::deleteAll()) {
                Auth::logout();
                $myAccount->delete();
                $this->redirect('auth','loginForm',['success' => 'Account was deleted!']);
            } else {
                $this->redirect('auth','myAccount',['error' => 'Account could not be deleted!']);
            }
        } catch (\Exception $e) {
            $this->redirect('auth','myAccount',['error' => $e->getMessage()]);
        }
    }

}