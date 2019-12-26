<?php

function debug($val){
    echo "<pre>";
    var_dump($val);
    echo "</pre>";
}

//dump and die
function dd($val){
    debug($val);
    die();
}

function generateToken(){
    $_SESSION['_csrf'] =md5(time());
    return $_SESSION['_csrf'];
}

function checkCsrf(){
    if(!empty($_POST) &&
        isset($_POST['_csrf']) &&
        isset($_SESSION['_csrf']) &&
        $_POST['_csrf'] == $_SESSION['_csrf']) {

        return true;
    }
    return false;
}

// www.site.com/1st_param/2nd-param/etc
function getUrlParam($numParam ){
    $params = explode('/',$_SERVER['REQUEST_URI']);
    if(isset($params[$numParam])) {
        return $params[$numParam];
    }else{
        return false;
    }
}

function getToken(){
    if(isset($_SESSION['_csrf']) && !empty($_SESSION['_csrf'])){
        return $_SESSION['_csrf'];
    }else{
        $_SESSION['_csrf'] = generateToken();
        return $_SESSION['_csrf'];
    }
}

function redirect($page=NULL,$param=false){

    $param = $param ? '/'.$param : '';
    header('Location: '.$_SERVER["REQUEST_SCHEME"]."://".$_SERVER["HTTP_HOST"].'/'.$page.$param);
}

function isLogin(){
    if(isset($_SESSION['user']) && !empty($_SESSION['user'])){
        return true;
    }else{
        return false;
    }
}

function setOrder(){
    $order = 'asc';
    if (isset($_GET['order']) &&
        ($_GET['order'] === 'asc' || $_GET['order'] === 'desc')) {

        $order  = $_GET['order'];
    }
    return $order;
}

function session($key, $value=false){
    if(!$value) {
        if (isset($_SESSION[$key]) && !empty($_SESSION[$key])) {
            $value = $_SESSION[$key];
            unset($_SESSION[$key]);

            return $value;
        }
        return false;
    } else{
        $_SESSION[$key] = $value;
    }
}
