<?php

namespace App;
use App\Models\User;

class Auth
{
    public static function login($mail, $password) {
        $allUsers = User::getAll();
        foreach ( $allUsers as $user)
        {
            if ($mail ==  $user->getMail() && $password == $user->getPassword()) {
                $_SESSION['userID'] = $user->getUserID();
                return true;
            }
        }
        return false;
    }

    public static function logout()
    {
        unset($_SESSION['userID']);
        session_destroy();
    }

    public static function isLogged()
    {
        return isset($_SESSION['userID']);
    }

    public function getName()
    {
        return(Auth::isLogged() ? $_SESSION['name'] . ' ' . $_SESSION['surname'] : "");
    }

    public static function isRegistered($mail) : bool {
        try {
            $users = User::getAll('mail = ?', [$mail]);
            return count($users) > 0;
        } catch (\Exception $e) {
            return false;
        }
    }
}