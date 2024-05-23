<?php
namespace Core;
use App\models\empleado;
use App\models\User;
class Auth{
    public static function tryLogin($email, $password){
        $user=empleado::findBy(["email"=> $email]);
        if(!empty($user) and password_verify($password, $user[0]->password)){
            static::ensureSessionStarted();
            $_SESSION["email"] = $user[0]->email;
            $_SESSION["name"] = $user[0]->name;
            $_SESSION["id_e"] = $user[0]->id_e;
            return true;
        }
        return false;

    }
    public static function check(){
        static::ensureSessionStarted();
        if(empty($_SESSION["id_e"])){
            return false;
        }
        return true;

    }

    public static function ensureSessionStarted(){
        if(empty(session_id())){
        return session_start();
        }  
    }
    public static function logout(){
        session_start();
        session_destroy();
    }
}
