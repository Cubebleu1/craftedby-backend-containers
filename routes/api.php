<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BusinessesController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

//UsersController's routes
Route::get('/users', [UsersController::class, 'index'])->middleware('auth:sanctum');
Route::post('/users', [UsersController::class, 'store'])->middleware('auth:sanctum');
Route::get('/users/{id}', [UsersController::class, 'show'])->middleware('auth:sanctum');
Route::put('/users/{id}', [UsersController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/users/{id}', [UsersController::class, 'destroy'])->middleware('auth:sanctum');

//Login and logout functionality
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

//PostsController's routes
Route::get('/products', [ProductsController::class, 'index']);
Route::get('/products/{id}', [ProductsController::class, 'show']);
Route::post('/products', [ProductsController::class, 'store'])->middleware('auth:sanctum');
Route::put('/products/{id}', [ProductsController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/products/{id}', [ProductsController::class, 'destroy'])->middleware('auth:sanctum');

//CategoriesController's routes
Route::get('/categories', [CategoriesController::class, 'index']);
Route::get('/categories/{id}', [CategoriesController::class, 'show']);
Route::post('/categories', [CategoriesController::class, 'store'])->middleware('auth:sanctum');
Route::put('/categories/{id}', [CategoriesController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/categories/{id}', [CategoriesController::class, 'destroy'])->middleware('auth:sanctum');

//ReviewsController's routes
Route::get('/reviews', [ReviewsController::class, 'index']);
Route::get('/reviews/{id}', [ReviewsController::class, 'show']);
Route::post('/reviews', [ReviewsController::class, 'store'])->middleware('auth:sanctum');
Route::put('/reviews/{id}', [ReviewsController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/reviews/{id}', [ReviewsController::class, 'destroy'])->middleware('auth:sanctum');

//BusinessesController's routes
Route::get('/businesses', [BusinessesController::class, 'index']);
Route::get('/businesses/{id}', [BusinessesController::class, 'show']);
Route::post('/businesses', [BusinessesController::class, 'store'])->middleware('auth:sanctum');
Route::put('/businesses/{id}', [BusinessesController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/businesses/{id}', [BusinessesController::class, 'destroy'])->middleware('auth:sanctum');
