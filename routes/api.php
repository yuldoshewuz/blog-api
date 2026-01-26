<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Auth\PasswordResetController;
use App\Http\Controllers\Api\Auth\VerifyEmailController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\PostController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLink']);
Route::post('/reset-password', [PasswordResetController::class, 'reset'])->name('password.reset');

Route::apiResource('categories', CategoryController::class)->only(['index', 'show']);
Route::apiResource('posts', PostController::class)->only(['index', 'show']);
Route::get('posts/{postId}/comments', [CommentController::class, 'index']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);

    Route::post('/email/verification-notification', [VerifyEmailController::class, 'sendNotification']);
    Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, 'verify'])
        ->name('verification.verify');

    Route::middleware('verified')->group(function () {
        Route::put('/user/password-update', [AuthController::class, 'updatePassword']);
        Route::delete('/user/delete', [AuthController::class, 'destroy']);

        Route::post('posts/{postId}/comments', [CommentController::class, 'store']);
        Route::put('comments/{comment}', [CommentController::class, 'update']);
        Route::delete('comments/{comment}', [CommentController::class, 'destroy']);

        Route::middleware('admin')->group(function () {
            Route::get('/users-list', [AuthController::class, 'index']);

            Route::apiResource('categories', CategoryController::class)->except(['index', 'show']);
            Route::apiResource('posts', PostController::class)->except(['index', 'show']);
            Route::get('posts_all', [PostController::class, 'adminIndex']);
        });
    });
});
