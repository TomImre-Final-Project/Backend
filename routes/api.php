<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\DishController;
use App\Http\Controllers\OrderItemController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->put('/user/profile', [UserController::class, 'updateProfile']);

Route::get('/restaurants', [RestaurantController::class, 'index']);
Route::get('/restaurants/{restaurantId}/dishes', [DishController::class, 'getByRestaurant']);
Route::post('/orders', [OrderController::class, 'store']);
Route::post('/order-items', [OrderItemController::class, 'store']);

// Admin Routes
Route::middleware(['auth:sanctum', 'check.role:admin'])->prefix('admin')->group(function () {
    Route::get('/users', [UserController::class, 'listUsers']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::put('/restaurants/{id}', [RestaurantController::class, 'update']);
});

// Customer Routes
Route::middleware(['auth:sanctum', 'check.role:customer'])->prefix('customer')->group(function () {
    Route::get('/profile', [UserController::class, 'profile']);
    Route::post('/order', [OrderController::class, 'placeOrder']);
});

// Courier Routes
Route::middleware(['auth:sanctum', 'check.role:courier'])->prefix('courier')->group(function () {
    //Route::get('/deliveries', [CourierController::class, 'listDeliveries']);
    //Route::post('/pickup/{id}', [CourierController::class, 'pickupOrder']);
});

// Restaurant Manager Routes
Route::middleware(['auth:sanctum', 'check.role:restaurant_manager'])->prefix('restaurantmanager')->group(function () {
    //Route::post('/menu', [RestaurantManagerController::class, 'addMenuItem']);
});
