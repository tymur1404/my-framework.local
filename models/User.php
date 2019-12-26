<?php

namespace models;
use app\Model;
use app\Validator;

class User extends Model{

    use Validator;
    public static function table()
    {
        return 'user';
    }

    public function login(){
        $name = static::validateName();
        $password = static::validatePassword();
        if($name && $password){

            $user = $this->getItemBy(" name='$name' LIMIT 1");
            if($user && password_verify($password,$user['password'])){
                foreach ($user as $k => $v) {
                    if($k != 'password') {
                        $_SESSION['user'][$k] = $v;
                    }
                 }
                 return true;
            }
        }
        return false;
    }

    public static function getUserName(){
        return $_SESSION['user']['name'] ?? 'Guest';
    }


}