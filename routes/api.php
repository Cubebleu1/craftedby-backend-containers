<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SpecialtyController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Users routes
Route::get('/users', [UsersController::class, 'index'])->middleware('auth:sanctum');
Route::get('/users/{id}', [UsersController::class, 'show'])->middleware('auth:sanctum');
Route::patch('/users/{id}', [UsersController::class, 'update'])->middleware('auth:sanctum');
//Route::put('/users/{id}', [UsersController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/users/{id}', [UsersController::class, 'destroy'])->middleware('auth:sanctum');
Route::post('/users', [UsersController::class, 'store']);

//Products routes
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);
Route::post('/products', [ProductController::class, 'store'])->middleware('auth:sanctum');
Route::put('/products/{id}', [ProductController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->middleware('auth:sanctum');

//Categories routes
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{id}', [CategoryController::class, 'show']);
Route::post('/categories', [CategoryController::class, 'store'])->middleware('auth:sanctum');
Route::put('/categories/{id}', [CategoryController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->middleware('auth:sanctum');

//Reviews routes
Route::get('/reviews', [ReviewController::class, 'index']);
Route::get('/reviews/{id}', [ReviewController::class, 'show']);
Route::post('/reviews', [ReviewController::class, 'store'])->middleware('auth:sanctum');
Route::put('/reviews/{id}', [ReviewController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/reviews/{id}', [ReviewController::class, 'destroy'])->middleware('auth:sanctum');

//Businesses routes
Route::get('/businesses', [BusinessController::class, 'index']);
Route::get('/businesses/{id}', [BusinessController::class, 'show']);
Route::post('/businesses', [BusinessController::class, 'store'])->middleware('auth:sanctum');
Route::put('/businesses/{id}', [BusinessController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/businesses/{id}', [BusinessController::class, 'destroy'])->middleware('auth:sanctum');

//Orders routes
Route::get('/orders', [OrderController::class, 'index'])->middleware('auth:sanctum');
Route::get('/orders/{id}', [OrderController::class, 'show'])->middleware('auth:sanctum');
Route::post('/orders', [OrderController::class, 'store']);
Route::put('/orders/{id}', [OrderController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/orders/{id}', [OrderController::class, 'destroy'])->middleware('auth:sanctum');

//Specialities
Route::get('/specialties', [SpecialtyController::class, 'index']);

//Themes
Route::get('/themes', [ThemeController::class, 'index']);

//Materials
Route::get('/materials', [MaterialController::class, 'index']);

//Auth routes
Route::post('/login', [AuthController::class, 'login']);
Route::get('/current-user', [AuthController::class, 'currentUser']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post('/password/reset-link', [ResetPasswordController::class, 'sendResetLinkEmail']);
Route::post('/password/reset', [ResetPasswordController::class, 'reset']);

//Stripe payment
Route::post('/payment/initiate', [StripeController::class, 'initiatePayment']);
Route::post('/payment/complete', [StripeController::class, 'completePayment']);
Route::post('/payment/failure', [StripeController::class, 'failPayment']);
