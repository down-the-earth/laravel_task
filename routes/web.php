<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Usercontroller;
use App\Http\Middleware\ValidUser;
use App\Http\Controllers\LoginController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/register', function () {
    return view('register');
});

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::resource('registeruser', Usercontroller::class)->middleware(ValidUser::class);
Route::get('/post', function () {
    return view('post');
})->name('post')->middleware(ValidUser::class);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout')->middleware(ValidUser::class);
