<?php
return [

    'task/checked' => ['task/checked', 'auth'],
    'task/show/([0-9]+)' => ['task/show/$1', 'auth'],
    'task/edit/([0-9]+)' => ['task/edit/$1', 'auth'],
    'task/update/([0-9]+)' => ['task/update/$1', 'auth'],
    'task/delete/([0-9]+)' => ['task/delete/$1', 'auth'],
    'task/create' => ['task/create', 'auth'],
    'task/store' => ['task/store', 'auth'],
    'task' => ['task/index', 'auth'],

    'login/login' => ['login/login'],
    'login/logout' => ['login/logout'],
    'login' => ['login/index'],

    'home' => ['home/index'],
    '' => ['home/index'],


];