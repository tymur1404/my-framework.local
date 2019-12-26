<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Custom framework </title>

    <!-- Bootstrap -->
    <link href="/web/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <!-- NProgress -->
</head>

<body>

<!-- Классы navbar и navbar-default (базовые классы меню) -->
<nav class="navbar navbar-default">
    <!-- Контейнер (определяет ширину Navbar) -->
    <div class="container-fluid">
        <!-- Заголовок -->
        <div class="navbar-header">
            <!-- Кнопка «Гамбургер» отображается только в мобильном виде (предназначена для открытия основного содержимого Navbar) -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-main">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!-- Бренд или название сайта (отображается в левой части меню) -->
            <?php if(isLogin()){ ?>
                <a class="navbar-brand" href="/task/">Админка</a>
                <a class="navbar-brand" href="/login/logout">Выйти</a>
            <?php } else{?>
                <a class="navbar-brand" href="/login/">Войти</a>
            <?php } ?>
        </div>
        <!-- Основная часть меню (может содержать ссылки, формы и другие элементы) -->
        <div class="collapse navbar-collapse" id="navbar-main">
            <!-- Содержимое основной части -->
        </div>
    </div>
</nav>

