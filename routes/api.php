<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login',  [AuthController::class, 'login']);
Route::get('/logout',  [AuthController::class, 'logout'])->middleware(['auth:sanctum']);

Route::get('/posts',  [PostController::class, 'index'])->middleware(['auth:sanctum']);
Route::get('/posts/{id}',  [PostController::class, 'show'])->middleware(['auth:sanctum']);
