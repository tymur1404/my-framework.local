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
        $pagination = $task->Pagination(3, 'home');
        View::render('home/index', compact('tasks', 'pagination'), 'home');
    }

    public function actionCreate()
    {
        $task =  Task::getEmptyFields();

        View::render('home/create',$task, 'home');
    }

    public function actionStore()
    {
        $task = new Task();
        $id = NULL;
        if (checkCsrf()) {
            $fields = $task->checkFields();
            if($fields) {
                $id = $task->create($fields);
                session('success', 'Создание прошло успешно');
            }
            generateToken();
        }else{
            session('error', 'Ошибка создания задачи');
        }

        if(!is_null($id)) {
            redirect('');
        }else{
            redirect('home/create');
        }
    }

}