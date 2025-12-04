<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
})->name('home');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::get('/reset-password', function () {
    return view('reset-password');
})->name('reset-password');

Route::get('/posts/{id}',function(){
    return view('post');
})->name('post.show');
