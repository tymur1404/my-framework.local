<?php

use app\View;
use models\Task;

class HomeController
{
    public function actionIndex($param = 1)
    {
        $param = (int)$param;
        $task = new Task();
        $order = setOrder();

        $tasks = $task->get('', $task::NAME, $order, $param);
        $pagination = $task->Pagination(3,'home');
        View::render('home/index',compact('tasks', 'pagination'), 'home');
    }

}