<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PostApiController;
use App\Http\Controllers\API\LoginController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::apiResource('/posts', PostApiController::class);
Route::post('/login',[LoginController::class,'login']);

Route::middleware(['throttle:api','auth:sanctum'])->group( function () {
    Route::apiResource('/posts', PostApiController::class);
});
