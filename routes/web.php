<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Usercontroller;
use App\Http\Middleware\ValidUser;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/register', function () {
    return view('register');
});

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');



Route::resource('registeruser', Usercontroller::class)->name('*', 'registeruser.');
Route::middleware([ValidUser::class])->group(function () {
    // Route::get('/posts', function () {
    //     return view('post');
    // })->name('posts');


    Route::get('/logout', [LoginController::class, 'logout'])->name('logout')->middleware(ValidUser::class);
    Route::view('/post/addpost', 'add_post')->name('add_post');
    Route::resource('/post', PostController::class)->name('*', 'post.');
    Route::get('/mypost', [LoginController::class, 'mypost'])->name('mypost');
});
