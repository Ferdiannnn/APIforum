<?php

use App\Http\Controllers\ReactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/users', [UserController::class, 'index'])->middleware('auth:sanctum');
Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'register']); // Assuming you have a register method in UserController

Route::get('/posts', [PostController::class, 'index'])->middleware('auth:sanctum');
Route::get('/post/{id}', [PostController::class, 'show'])->middleware('auth:sanctum');
Route::post('/posts', [PostController::class, 'store'])->middleware('auth:sanctum');
Route::put('/post/{id}', [PostController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/post/{id}', [PostController::class, 'destroy'])->middleware('auth:sanctum');


Route::post('/post/{postId}/comments', [CommentController::class, 'store'])->middleware('auth:sanctum');
Route::delete('/post/{postId}/comments/{commentId}', [CommentController::class, 'destroy'])->middleware('auth:sanctum');
Route::post('/post/{postId}/comments/{commentId}', [CommentController::class, 'reply'])->middleware('auth:sanctum');
Route::put('/post/{postId}/comments/{commentId}', [CommentController::class, 'update'])->middleware('auth:sanctum');

Route::get('/posts/like', [ReactionController::class, 'index'])->middleware('auth:sanctum');
Route::get('/posts/{id}/like', [ReactionController::class, 'show'])->middleware('auth:sanctum');
Route::post('/posts/{id}/like', [ReactionController::class, 'store'])->middleware('auth:sanctum');
Route::put('/posts/{id}/like', [ReactionController::class, 'update'])->middleware('auth:sanctum');


Route::get('/me', [UserController::class, 'me'])->middleware('auth:sanctum');