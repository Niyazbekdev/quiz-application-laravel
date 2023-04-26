<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('/users')
    ->controller(UserController::class)
    ->group(function (){
        Route::post('/register', 'register');
        Route::get('/', 'getMe')->middleware('auth:sanctum');
        Route::post('/login', 'login');
    });

Route::prefix('/categories')
    ->controller(CategoryController::class)
    ->group(function (){
        Route::get('/', 'index');
        Route::get('/{id}', 'show');
        Route::post('/', 'store');
        Route::put('/{id}', 'update');
        Route::delete('/{id}', 'destroy');
    });
