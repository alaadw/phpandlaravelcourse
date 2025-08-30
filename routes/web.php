<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LanguageController;

//route of language
Route::get('/language/{locale}',[LanguageController::class,'switchLanguage'])->name('language.switch');

// Authentication routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
//example to use 
//Route::get('/index', [ArticleController::class, 'index'])->middleware('auth')->name('articles.index');
//routes of articles without login cannot enter
Route::middleware('auth:article')->group(function () {
   Route::resource('articles', ArticleController::class);
});

 