<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\DishController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\CategoryController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->put('/user/profile', [UserController::class, 'updateProfile']);

Route::get('/restaurants', [RestaurantController::class, 'index']);
Route::get('/restaurants/{restaurantId}/dishes', [DishController::class, 'getByRestaurant']);
Route::post('/orders', [OrderController::class, 'store']);
Route::post('/order-items', [OrderItemController::class, 'store']);
Route::get('/categories', [CategoryController::class, 'index']);

// Admin Routes
Route::middleware(['auth:sanctum', 'check.role:admin'])->prefix('admin')->group(function () {
    Route::get('/users', [UserController::class, 'listUsers']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::put('/restaurants/{id}', [RestaurantController::class, 'update']);
    Route::get('/orders', [OrderController::class, 'listOrders']);
    Route::put('/orders/{id}', [OrderController::class, 'update']);
});

// Customer Routes
Route::middleware(['auth:sanctum', 'check.role:customer'])->prefix('customer')->group(function () {
    Route::get('/profile', [UserController::class, 'profile']);
    Route::post('/order', [OrderController::class, 'placeOrder']);
});

// Courier Routes
Route::middleware(['auth:sanctum', 'check.role:courier'])->prefix('courier')->group(function () {
    Route::get('/deliverable', [OrderController::class, 'getDeliverableOrders']);
    Route::get('/my-deliveries', [OrderController::class, 'getMyDeliveries']);
    Route::post('/accept-order/{id}', [OrderController::class, 'acceptOrder']);
    Route::post('/mark-delivered/{id}', [OrderController::class, 'markAsDelivered']);
});

// Restaurant Manager Routes
Route::middleware(['auth:sanctum', 'check.role:restaurant_manager'])->prefix('restaurantmanager')->group(function () {
    Route::get('/restaurant', [RestaurantController::class, 'getMyRestaurant']);
    Route::put('/restaurant', [RestaurantController::class, 'updateMyRestaurant']);
    Route::get('/orders', [OrderController::class, 'getRestaurantOrders']);
    Route::put('/orders/{id}', [OrderController::class, 'updateOrder']);
    Route::get('/dishes', [DishController::class, 'getMyRestaurantDishes']);
    Route::post('/dishes', [DishController::class, 'store']);
    Route::put('/dishes/{id}', [DishController::class, 'update']);
    Route::delete('/dishes/{id}', [DishController::class, 'destroy']);
});

// Image handling route
Route::get('/image/{path}', function ($path) {
    // Check if it's a placeholder URL
    if (strpos($path, 'http') === 0) {
        return redirect($path);
    }
    
    // Otherwise, serve from storage
    $filePath = storage_path('app/public/' . $path);
    if (file_exists($filePath)) {
        return response()->file($filePath);
    }
    return response()->json(['error' => 'Image not found'], 404);
})->where('path', '.*');
