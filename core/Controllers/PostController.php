<?php

namespace Controllers;

use Models\Post;

class PostController extends BaseController
{
    public function create()
    {
        return view('posts/create');
    }

    public function createPost()
    {
        # Если пользователь не авторизован!
        if(!has_session('id'))
            return redirect('/');

        # Default значение переменной $errors
        $errors = [];

        # Проверка на существование
        if(!isset($_POST['name'])) $errors['name'][] = 'Поле не существует!';
        if(!isset($_POST['keywords'])) $errors['keywords'][] = 'Поле не существует!';
        if(!isset($_POST['description'])) $errors['description'][] = 'Поле не существует!';

        # Проверка на заполненность
        if(empty($_POST['name'])) $errors['name'][] = 'Поле не заполнено!';
        if(empty($_POST['keywords'])) $errors['keywords'][] = 'Поле не заполнено!';
        if(empty($_POST['description'])) $errors['description'][] = 'Поле не заполнено!';

        # Если существуют ошибки, отправляем их на клиента
        if($errors != [])
            return view('posts/create', compact('errors'));

        # Помещаем массив суперглобальной переменной $_POST в переменную $inputs
        $inputs = $_POST;
        # Добавляем не достающий элемент пользовательского ID которому он принадлежит
        $inputs['user_id'] = session('id');
        # Добавляем не достающий элемент сегодняшней даты и времени
        $inputs['created_at'] = date('d-m-Y H:i:s');

        # Создаем новый пост
        $post = new Post();
        $post->create($inputs);

        # Отправляем представление posts/create со значением выполнения операции успешно
        return view('posts/create', ['success' => true]);
    }
}