<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\Emailcontroller;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Usercontroller;
use App\Http\Middleware\ValidUser;
use App\Jobs\EmailJob;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::redirect('/', '/login');
Route::get('/register', function () {
    return view('register');
});

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');


Route::resource('profile', Usercontroller::class)->names('profile');

Route::middleware([ValidUser::class])->prefix('/task')->group(function () {
    // Route::get('/posts', function () {
    //     return view('post');
    // })->name('posts');


    Route::get('/logout', [LoginController::class, 'logout'])->name('logout')->middleware(ValidUser::class);
    Route::view('/post/addpost', 'add_post')->name('add_post');
    Route::resource('/post', PostController::class)->names('post');
    Route::get('/mypost', [LoginController::class, 'mypost'])->name('mypost');
    Route::resource('comment', CommentController::class)->names('comment');
    Route::get('/send-email', [Emailcontroller::class, 'sendEmail'])->name('send.email');

    Route::get('/emails',function(){
        // Artisan::call('send:emails');
        // return 'Emails sent successfully!';
        EmailJob::dispatch();
        Artisan::call('queue:work --stop-when-empty');
        return 'Email job dispatched successfully!';
    });

    Route::prefix('/api')->group(function () {

        Route::get('/users', function () {
            try{
                $response = Http::get('https://jsonplaceholder.typicode.com/users');
                    if ($response->successful()) {
                        return $response->json();
                    } else {
                        return response()->json(['error' => 'Failed to fetch data from API'], $response->status());
                    }
                
            }catch(\Exception $e){
                return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
            }
            
        });

    });
});
