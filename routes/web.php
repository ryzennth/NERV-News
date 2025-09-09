<?php

use Illuminate\Support\Facades\Route;

// Authentication routes (Laravel Breeze)
require __DIR__.'/auth.php';

// Fallback route
Route::fallback(function () {
    return view('errors.404');
});