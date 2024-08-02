<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


Route::get('/', [AuthController::class,'index']);
Route::get('forgot-password', [AuthController::class, 'forgot_password']);
Route::get('register', [AuthController::class, 'register']);
Route::post('register_post', [AuthController::class, 'register_post']);
Route::post('checkemail', [AuthController::class, 'CheckEmail']);
Route::post('login_post', [AuthController::class, 'login_post']);

Route::middleware(['IsAdmin'])->group(function(){
    Route::get('admin/dashboard', function(){
        return 'login';
    });
    Route::get('/users', function(){
    });
});

