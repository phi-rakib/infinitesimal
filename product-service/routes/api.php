<?php

use App\Http\Controllers\ProductController;
use App\Http\Middleware\EnsureTokenIsValid;
use Illuminate\Support\Facades\Route;

Route::middleware(EnsureTokenIsValid::class)->group(function () {
    Route::resource('products', ProductController::class);
});
