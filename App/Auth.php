<?php 


namespace App;

use Exception;

class Auth {


    public static function check()
    {
        if(session_status() === PHP_SESSION_NONE) {
                session_start();
        }
        if(!isset($_SESSION['auth'])){
                return false;
        }else {
            return true;
        }
    }

    public static function auth()
    {
        if(session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if(!isset($_SESSION['auth'])){
            header('Location: /home');
        }
    }
    


}