<?php

namespace Controllers;

use Models\User;

class UserController extends BaseController
{
    public function register()
    {
        return view('register');
    }

    public function registerPost()
    {
        $errors = [];
        if (!isset($_POST['name'])) $errors['name'] = ['Нет поля name'];
        if (!isset($_POST['login'])) $errors['login'] = ['Нет поля login'];
        if (!isset($_POST['password'])) $errors['password'] = ['Нет поля password'];
        if (!isset($_POST['password_confirmed'])) $errors['password_confirmed'] = ['Нет поля password_confirmed'];

        if (empty($_POST['name'])) $errors['name'][] = 'Поля name не заполнено!';
        if (empty($_POST['login'])) $errors['login'][] = 'Поля login не заполнено!';
        if (empty($_POST['password'])) $errors['password'][] = 'Поля password не заполнено!';
        if (empty($_POST['password_confirmed'])) $errors['password_confirmed'][] = 'Поля password_confirmed не заполнено!';

        if($_POST['password'] != $_POST['password_confirmed']) $errors['password'][] = 'Пароли не совпали!';

        if ($errors != [])
            return view('register', $errors);

        unset($_POST['password_confirmed']);
        $user = new User();
        $findUser = $user->create($_POST);
        return var_dump($findUser);
    }
}