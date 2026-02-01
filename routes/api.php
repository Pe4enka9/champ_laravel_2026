<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\WebhookController;
use Illuminate\Support\Facades\Route;

Route::post('/registr', [RegisterController::class, 'register']);
Route::post('/auth', [LoginController::class, 'login']);

Route::post('/payment-webhook', [WebhookController::class, 'handle']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/courses', [CourseController::class, 'index']);
    Route::get('/courses/{course}', [CourseController::class, 'lessons']);
    Route::post('/courses/{course}/buy', [CourseController::class, 'buy']);

    Route::get('/orders', [OrderController::class, 'index']);
    Route::get('/orders/{order}', [OrderController::class, 'cancel']);
});
