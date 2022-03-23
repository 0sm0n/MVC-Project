<?php

use Controllers\MainController;
use Controllers\PostController;
use Controllers\UserController;

Route::get('/', [MainController::class, 'index']);

Route::get('/register', [UserController::class, 'register']);
Route::post('/register', [UserController::class, 'registerPost']);

Route::get('/login', [UserController::class, 'login']);
Route::post('/login', [UserController::class, 'loginPost']);

Route::get('/posts/create', [PostController::class, 'create']);
Route::post('/posts/create', [PostController::class, 'createPost']);