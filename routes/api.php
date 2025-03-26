<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DishController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Admin;
use App\Http\Middleware\Courier;
use App\Http\Middleware\Customer;
use App\Http\Middleware\Restaurant_manager;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [RegisteredUserController::class, 'store'])
    ->name('register');//kommentezni frontend utan

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->name('login');//kommentezni frontendutan


Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
    
});

Route::middleware(['auth:sanctum', Customer::class])
    ->group(function () {

        Route::get('/users/{id}', [UserController::class, 'show']); // Get a user by ID
        Route::put('/users/{id}', [UserController::class, 'update']); // Update a user
        Route::get('/restaurants', [RestaurantController::class, 'index']);
        Route::get('/restaurants/{id}', [RestaurantController::class, 'show']);
        // Menu & Categories
        Route::get('/categories', [CategoryController::class, 'index']);
        Route::get('/restaurants/{id}/dishes', [DishController::class, 'index']);
        
        // Orders
        Route::post('/orders', [OrderController::class, 'store']);
        Route::get('/orders', [OrderController::class, 'index']);
        Route::get('/orders/{id}', [OrderController::class, 'show']);
        Route::post('/orders/{id}/cancel', [OrderController::class, 'cancel']);

    });

Route::middleware(['auth:sanctum', Admin::class])
    ->group(function () {
        Route::get('/users', [UserController::class, 'index']); // Get all users
        //Route::get('/users/{id}', [UserController::class, 'show']); // Get a user by ID
        //Route::put('/users/{id}', [UserController::class, 'update']); // Update a user
        Route::delete('/users/{id}', [UserController::class, 'destroy']); // Delete a user (optional)
        Route::get('/users', [UserController::class, 'index']);
        Route::delete('/users/{id}', [UserController::class, 'destroy']);
        
        // Restaurant Management
        Route::post('/restaurants', [RestaurantController::class, 'store']);
        Route::delete('/restaurants/{id}', [RestaurantController::class, 'destroy']);
        
        // Category Management
        Route::post('/categories', [CategoryController::class, 'store']);
        Route::put('/categories/{id}', [CategoryController::class, 'update']);
        Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);
    });

Route::middleware(['auth:sanctum', Restaurant_manager::class])
    ->group(function () {
        // Restaurant Management
    Route::put('/restaurants/{id}', [RestaurantController::class, 'update']);
    Route::post('/restaurants/{id}/status', [RestaurantController::class, 'updateStatus']);
    
    // Menu Management
    Route::post('/dishes', [DishController::class, 'store']);
    Route::put('/dishes/{id}', [DishController::class, 'update']);
    Route::delete('/dishes/{id}', [DishController::class, 'destroy']);
    
    // Order Management
    Route::get('/restaurants/orders', [OrderController::class, 'restaurantOrders']);
    Route::put('/orders/{id}/status', [OrderController::class, 'updateStatus']);
    });

Route::middleware(['auth:sanctum', Courier::class])
    ->group(function () {
        Route::get('/courier/available-orders', [OrderController::class, 'availableOrders']);
        Route::post('/orders/{id}/accept', [OrderController::class, 'acceptDelivery']);
        Route::put('/orders/{id}/delivery-status', [OrderController::class, 'updateDeliveryStatus']);
        
    });

