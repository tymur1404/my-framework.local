<?php

use app\View;
use models\User;

class LoginController
{
    public function actionIndex()
    {
        if(isLogin()){
            redirect('');
        }

        View::render('login/index','', 'login');
    }

    public function actionLogin(){
        $user = new User();
        if($user->login()){
            redirect('');
        }else{
            session('login_error', 'Логин и пароль не совпадают');
            redirect('login/index');
        }
    }

    public function actionLogout(){
        unset($_SESSION['user']);
        redirect('');
    }

}