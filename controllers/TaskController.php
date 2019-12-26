<?php

use models\Task;
use app\View;


class TaskController
{

    public function actionIndex($param = 1)
    {
        $param = (int)$param;
        $task = new Task();
        $order = setOrder();

        $tasks = $task->get('', $task::NAME, $order, $param);
        $pagination = $task->Pagination(3);
        View::render('task/index', compact('tasks', 'pagination'));
    }

    public function actionChecked()
    {
        if(checkCsrf()) {
            $task = new Task();
            $fields = $task->checkCompleted();
            if (!empty($fields)) {
                $task->update(['completed' => $fields['completed']], $fields['id']);
                echo json_encode(['message_success' => 'Статус задачи изменен' ], JSON_UNESCAPED_UNICODE);
            }
        }else {
            echo json_encode(['message_error' => 'Ошибка'], JSON_UNESCAPED_UNICODE);
        }
    }

    public function actionShow($id)
    {
        $task = new Task();

        $task = $task->getItemByID($id);
        View::render('task/show', $task);
    }

    public function actionEdit($id)
    {
        $task = new Task();

        $task = $task->getItemByID($id);
        View::render('task/edit', $task);
    }


    public function actionUpdate($id)
    {
        $task = new Task();
        if (checkCsrf()) {
            if ($id != NULL) {
                $fields = $task->checkFields();
                if($fields) {
                    $task->update($fields, $id);
                    session('success', 'Обновление прошло успешно');
                }

            }else{
                session('error', 'Ошибка обновления');
            }
            generateToken();
        }else{
            session('error', 'Ошибка обновления');
        }

        redirect('task/edit', $id);
    }



    public function actionDelete($id)
    {
        $task = new Task();
        if (checkCsrf()) {
            if ($id != NULL) {
                $task->delete( $id);
                session('success', 'Удаление прошло успешно');
            }else{
                session('error', 'Ошибка удаления');
            }
            generateToken();
        }else{
            session('error', 'Ошибка обновления');
        }

        $page = $_POST['page'];
        redirect('task',$page);
    }

    public function actionCreate()
    {
        $task =  Task::getEmptyFields();

        View::render('task/edit',$task);
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
            redirect('task/edit', $id);
        }else{
            redirect('task/create');
        }
    }
}