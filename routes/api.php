<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login',  [AuthController::class, 'login']);


// Route::get('/posts',  [PostController::class, 'index'])->middleware(['auth:sanctum']);
// Route::post('/posts',  [PostController::class, 'store'])->middleware(['auth:sanctum']);
// Route::get('/posts/{id}',  [PostController::class, 'show'])->middleware(['auth:sanctum']);

Route::middleware('auth:sanctum')->group(function(){
    // Route::apiResource('/posts', PostController::class);
    Route::get('/posts',  [PostController::class, 'index']);
    Route::post('/posts',  [PostController::class, 'store']);
    Route::post('/posts/{id}',  [PostController::class, 'update'])->middleware('post-owner');
    Route::delete('/posts/{id}',  [PostController::class, 'destroy'])->middleware('post-owner');
    Route::get('/posts/{id}',  [PostController::class, 'show']);

    Route::post('/comment',  [CommentController::class, 'store']);
    Route::get('/comment',  [CommentController::class, 'index']);
    Route::get('/comment/{id}',  [CommentController::class, 'show']);
    Route::post('/comment/{id}',  [CommentController::class, 'update'])->middleware('comment-owner');
    Route::delete('/comment/{id}',  [CommentController::class, 'destroy'])->middleware('comment-owner');

    Route::get('/logout',  [AuthController::class, 'logout']);
    Route::get('/me',  [AuthController::class, 'me']);
});
