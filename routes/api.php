<?php

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/users', [ApiController::class, 'createUser']);
Route::get('/users/{id}', [ApiController::class, 'getUser']);
Route::post('/users/{id}/posts', [ApiController::class, 'createUserPost']);
Route::get('/users/{id}/posts', [ApiController::class, 'getUserPosts']);
Route::post('/posts/{id}/comments', [ApiController::class, 'createPostComment']);

Route::get('/users', [ApiController::class, 'getUsers']);
Route::get('/posts', [ApiController::class, 'getPublicPosts']);

Route::delete('posts/{id}', [ApiController::class, 'deletePost']);
Route::delete('comments/{id}', [ApiController::class, 'deleteComment']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
