<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->group(function (){
   Route::post('/signUp', [UserController::class, 'register']);
   Route::post('/signIn', [UserController::class, 'login']);
});
Route::middleware(['auth:sanctum', 'ability:user,admin'])->group(function (){
    Route::get('/send-code', [TestController::class, 'sendCode']);
    Route::post('/verify-code', [TestController::class, 'identification']);
    Route::prefix('/categories')
        ->group(function (){
            Route::get('/', [CategoryController::class, 'index']);
            Route::get('/{id}', [CategoryController::class, 'show']);
        });
    Route::prefix('/collection')
        ->group(function (){
            Route::get('/', [CollectionController::class, 'index']);
            Route::get('/{id}', [CollectionController::class, 'show'])->name('collection.show');
        });
    Route::prefix('/question')
        ->group(function (){
            Route::get('/', [QuestionController::class, 'index']);
            Route::get('/{id}', [QuestionController::class, 'show']);
        });
    Route::prefix('/answers')
        ->group(function (){
            Route::get('/', [AnswerController::class, 'index']);
            Route::get('/{id}', [AnswerController::class, 'show']);
        });
});
Route::middleware(['auth:sanctum', 'ability:admin'])->group(function (){
    Route::get('/', [UserController::class, 'getMe']);
    Route::prefix('/categories')
        ->group(function (){
            Route::post('/', [CategoryController::class, 'store']);
            Route::put('/{id}', [CategoryController::class, 'update']);
            Route::delete('/{id}', [CategoryController::class, 'destroy']);
        });
    Route::prefix('/collection')
        ->group(function (){
            Route::post('/', [CollectionController::class, 'store']);
            Route::put('/{id}', [CollectionController::class, 'update']);
            Route::delete('/{id}', [CollectionController::class, 'destroy']);
        });
    Route::prefix('/question')
        ->group(function (){
            Route::post('/', [QuestionController::class, 'store']);
            Route::put('/{id}', [QuestionController::class, 'update']);
            Route::delete('/{id}', [QuestionController::class, 'destroy']);
        });
    Route::prefix('/answers')
        ->group(function (){
            Route::post('/', [AnswerController::class, 'store']);
            Route::put('/{id}', [AnswerController::class, 'update']);
            Route::delete('/{id}', [AnswerController::class, 'destroy']);
        });
});
