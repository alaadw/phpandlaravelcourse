<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
 

/*Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
Route::get('/articles/{id}', [ArticleController::class, 'show'])->name('articles.show');

Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
*/
Route::resource('articles', ArticleController::class);