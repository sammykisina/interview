<?php

declare(strict_types=1);

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\MakeGeminiRequestController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->as('api:auth:')->group(function (): void {
    Route::controller(AuthController::class)->group(function (): void {
        Route::post('/register', 'register')->name('register');
        Route::post('/login', 'login')->name('login');
    });
});


/**
 * AI API Routes
 */

Route::middleware('auth:sanctum', 'throttle:60,1')->group(function (): void {
    Route::prefix('gemini')->as('gemini:')->group(function (): void {
        Route::post('/', MakeGeminiRequestController::class)->name('make-gemini-request');
    });
});
