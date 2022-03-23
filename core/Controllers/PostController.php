<?php

namespace Controllers;

class PostController extends BaseController
{
    public function create()
    {
        return view('posts/create');
    }

    public function createPost()
    {
        if (!has_session('id'))
            return redirect( '/');

        # Default значение переменной $errors
        $errors = [];

        #Проверка на существование
        if (!isset($_POST['name'])) $errors['name'][] = 'Поле не существует!';
        if (!isset($_POST['keywords'])) $errors['keywords'][] = 'Поле не существует!';
        if (!isset($_POST['description'])) $errors['description'][] = 'Поле не существует!';

        #Проверка на заполненность
        if (empty($_POST['name'])) $errors['name'][] = 'Поле не заполнено!';
        if (empty($_POST['keywords'])) $errors['keywords'][] = 'Поле не заполнено!';
        if (empty($_POST['description'])) $errors['description'][] = 'Поле не заполнено!';

        # Если существуют ошибки, отправляем их на клиента
        if ($errors != [])
            return view('posts/create', compact('errors'));

        $inputs = $_POST;
        $inputs['user_id'] = session('id');
        $inputs['created_at'] = date('d-m-Y H:i:s');


        $post = new Post();
        $post->create($inputs);

        return view('posts/create', ['success' => true]);



    }
}