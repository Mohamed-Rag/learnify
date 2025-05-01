<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/cat', [CategoryController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'show']);
Route::post('/cat', [CategoryController::class, 'store']);
Route::put('/users/{id}', [UserController::class, 'update']);
// Route::post('/learn/public/register', [ RegisterController::class, 'create']);
