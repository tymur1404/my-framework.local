<?php

namespace models;

use app\Model;
use app\Validator;

class Task extends Model
{
    use Validator;
    //fields
    const ID = 'id';
    const NAME = 'name';
    const EMAIL = 'email';
    const DESCRIPTION = 'description';
    const COMPLETED = 'completed';

    public static $folder = 'task';


    public static function getEmptyFields()
    {
        return [self::ID => NULL,
            self::NAME => NULL,
            self::EMAIL => NULL,
            self::DESCRIPTION => NULL,
            self::COMPLETED => NULL];
    }

    public static function table()
    {
        return 'tasks';
    }

    public function checkCompleted()
    {
        $post = $_POST;
        if (isset($post[self::ID]) &&
            isset($post[self::COMPLETED])) {
            array_walk($post, function (&$e) { // note the reference (&)
                $e = static::test_input($e);
            });
            return $post;
        }

        return false;
    }

    public function checkFields()
    {

        $name = static::validateName();
        $email = static::validateEmail();
        $description = static::validateDescription();

        if ($name &&
            $email &&
            $description ) {

            return ['name' => $name,
                    'email' => $email,
                    'description' => $description];
        }
        return false;
    }

    public function update($values, $id)
    {
        $taskOld = $this->getItemByID($id);
        $descriptionOld = $taskOld['description'];
        parent::update($values, $id);
        $taskNew = $this->getItemByID($id);
        $descriptionNew = $taskNew['description'];
        if($descriptionNew != $descriptionOld){
            $admin_edited = ['edited' => 'Отредактировано администратором'];
            parent::update($admin_edited, $id);
        }
    }

}