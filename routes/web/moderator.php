<?php

use App\Http\Controllers\Moderator\{
    DashboardController as ModeratorDashboardController,
    ArticleReviewController,
    CommentModerationController
};
use Illuminate\Support\Facades\Route;

// Moderator Dashboard
Route::get('/dashboard', [ModeratorDashboardController::class, 'index'])->name('dashboard');

// Article Review & Approval
Route::get('/reviews', [ArticleReviewController::class, 'index'])->name('reviews.index');
Route::get('/reviews/pending', [ArticleReviewController::class, 'pending'])->name('reviews.pending');
Route::get('/reviews/{article}', [ArticleReviewController::class, 'show'])->name('reviews.show');

// Article Actions
Route::post('/articles/{article}/approve', [ArticleReviewController::class, 'approve'])->name('articles.approve');
Route::post('/articles/{article}/reject', [ArticleReviewController::class, 'reject'])->name('articles.reject');
Route::post('/articles/{article}/request-changes', [ArticleReviewController::class, 'requestChanges'])->name('articles.request-changes');

// Comment Moderation
Route::get('/comments', [CommentModerationController::class, 'index'])->name('comments.index');
Route::get('/comments/reported', [CommentModerationController::class, 'reported'])->name('comments.reported');
Route::post('/comments/{comment}/approve', [CommentModerationController::class, 'approve'])->name('comments.approve');
Route::post('/comments/{comment}/reject', [CommentModerationController::class, 'reject'])->name('comments.reject');
Route::delete('/comments/{comment}', [CommentModerationController::class, 'destroy'])->name('comments.destroy');

// Content Statistics
Route::get('/statistics', [ModeratorDashboardController::class, 'statistics'])->name('statistics');
Route::get('/reports', [ModeratorDashboardController::class, 'reports'])->name('reports');