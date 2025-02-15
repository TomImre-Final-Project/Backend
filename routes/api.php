<?php

use App\Http\Controllers\UserController;
use App\Http\Middleware\Admin;
use App\Http\Middleware\Courier;
use App\Http\Middleware\Restaurant_manager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum', Admin::class])
    ->group(function () {
        /*Route::get('/users', [UserController::class, 'index']); // Get all users
        Route::get('/users/{id}', [UserController::class, 'show']); // Get a user by ID
        Route::post('/users', [UserController::class, 'store']); // Create a new user
        Route::put('/users/{id}', [UserController::class, 'update']); // Update a user
        Route::delete('/users/{id}', [UserController::class, 'destroy']); // Delete a user (optional)*/

    });

Route::middleware(['auth:sanctum', Restaurant_manager::class])
    ->group(function () {});

Route::middleware(['auth:sanctum', Courier::class])
    ->group(function () {});
