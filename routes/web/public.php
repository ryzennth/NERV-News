<?php

use App\Http\Controllers\{
    ArticleController,
    CategoryController,
    CommentController
};
use Illuminate\Support\Facades\Route;

// Homepage & Public Article Access
Route::get('/', [ArticleController::class, 'index'])->name('home');
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/article/{slug}', [ArticleController::class, 'show'])->name('articles.show');

// Categories
Route::get('/category/{category:slug}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');

// Tag-based articles
Route::get('/tag/{tag}', [ArticleController::class, 'byTag'])->name('articles.tag');

// Search
Route::get('/search', [ArticleController::class, 'search'])->name('articles.search');

// Archive
Route::get('/archive/{year}/{month?}', [ArticleController::class, 'archive'])->name('articles.archive');

// Hit tracking (untuk count views)
Route::post('/articles/{article}/hit', [ArticleController::class, 'recordHit'])->name('articles.hit');

// RSS Feed
Route::get('/feed', [ArticleController::class, 'feed'])->name('articles.feed');