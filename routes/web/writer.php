<?php

use App\Http\Controllers\Writer\{
    ArticleController as WriterArticleController,
    DashboardController as WriterDashboardController,
    StatisticsController
};
use Illuminate\Support\Facades\Route;

// Writer Dashboard
Route::get('/dashboard', [WriterDashboardController::class, 'index'])->name('dashboard');

// Article Management
Route::get('/articles', [WriterArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/create', [WriterArticleController::class, 'create'])->name('articles.create');
Route::post('/articles', [WriterArticleController::class, 'store'])->name('articles.store');
Route::get('/articles/{article}/edit', [WriterArticleController::class, 'edit'])->name('articles.edit');
Route::put('/articles/{article}', [WriterArticleController::class, 'update'])->name('articles.update');
Route::delete('/articles/{article}', [WriterArticleController::class, 'destroy'])->name('articles.destroy');

// Article submission for review
Route::post('/articles/{article}/submit', [WriterArticleController::class, 'submitForReview'])->name('articles.submit');
Route::post('/articles/{article}/withdraw', [WriterArticleController::class, 'withdrawSubmission'])->name('articles.withdraw');

// Draft management
Route::get('/drafts', [WriterArticleController::class, 'drafts'])->name('drafts.index');
Route::get('/pending', [WriterArticleController::class, 'pending'])->name('pending.index');
Route::get('/published', [WriterArticleController::class, 'published'])->name('published.index');

// Statistics & Analytics
Route::get('/statistics', [StatisticsController::class, 'index'])->name('statistics.index');
Route::get('/statistics/{article}', [StatisticsController::class, 'articleStats'])->name('statistics.article');

// Media/Image upload
Route::post('/upload-image', [WriterArticleController::class, 'uploadImage'])->name('upload.image');
Route::delete('/delete-image/{image}', [WriterArticleController::class, 'deleteImage'])->name('delete.image');