<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


Route::get('/', [AuthController::class,'index']);
Route::get('forgot-password', [AuthController::class, 'forgot_password']);
Route::get('register', [AuthController::class, 'register']);
Route::post('register_post', [AuthController::class, 'register_post']);
Route::post('checkemail', [AuthController::class, 'CheckEmail']);
Route::post('login_post', [AuthController::class, 'login_post']);
Route::post('admin/employees/add', [AuthController::class, 'add_post']);
Route::get('logout', [AuthController::class, 'logout']);

Route::middleware(['IsAdmin'])->group(function(){
    Route::get('admin/dashboard', function(){
        return view('backend.dashboard.list');
    });
    Route::get('admin/employees', function(){
        return view('backend.employees.list');
    });
    Route::post('admin/employees/add', function(){
        return view('backend.employees.add');
    });

    Route::get('/users', function(){
    });
});



