<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;

// Authentication routes (Laravel Breeze)
require __DIR__.'/auth.php';

// Fallback route
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'appName' => config('app.name'),
    ]);
});
Route::fallback(function () {
    return view('errors.404');
});