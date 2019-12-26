<?php
/**
 * Created by PhpStorm.
 * User: timur
 * Date: 24.12.19
 * Time: 19:38
 */

namespace app;


trait Validator
{
    public static function validateName()
    {
        if (!isset($_POST["name"]) ||
            empty($_POST["name"])) {
            session("name_error", "Поле 'Имя' должно быть заполнено");
            return false;
        } else {
            $name = self::test_input($_POST["name"]);

            if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
                session("name_error", "Разрешены только буквы и пробелы");
                return false;
            }
            return $name;
        }
    }

    public static function validateEmail()
    {
        if (!isset($_POST["email"]) ||
            empty($_POST["email"]) ) {

            session("email_error", "Поле 'Почта' должно быть заполнено");
            return false;
        } else {
            $email = self::test_input($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                session("email_error", "Не верный формат для поля 'Почты' ");
                return false;
            }
            return $email;
        }
    }

    public static function validatePassword()
    {
        if (!isset($_POST["password"]) ||
            empty($_POST["password"]) ) {
            session("password_error", "Поле 'Пароль' должно быть заполнено");
            return false;
        }
        return $_POST["password"];
    }

    public static function validateDescription()
    {
        if (!isset($_POST["description"]) ||
            empty($_POST["description"]) ) {

            session("description_error", "Поле 'Описание' должно быть заполнено");
            return false;
        } else {
            $desc = self::test_input($_POST["description"]);
            if (empty($desc)) {
                session("description_error", "Не верный формат для поля 'Описание' ");
                return false;
            }
            return $desc;
        }
    }

    public static function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);

        return $data;
    }

}