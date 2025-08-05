<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
Route::get('/', function () {
    return 'ok';
});


Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{id}', [ArticleController::class, 'show'])->name('articles.show');
Route::get('/create', [ArticleController::class, 'create'])->name('articles.create');
Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');