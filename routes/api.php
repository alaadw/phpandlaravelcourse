<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\AuthController;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
//Route::get('/article/{id}', [ArticleController::class, 'show']);
// articles without resources
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/article/{id}', [ArticleController::class, 'show']);
});
Route::get('/articles', [ArticleController::class, 'index']);
Route::get('/me', function (Request $request) {
    dd('entered');
   // return $request->user();
})->middleware('auth:sanctum');
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/articles', [ArticleController::class, 'store']);
    Route::put('/article/{id}', [ArticleController::class, 'update']);
    Route::delete('/article/{id}', [ArticleController::class, 'destroy']);
});

