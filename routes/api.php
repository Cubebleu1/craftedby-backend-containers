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

//UsersControllers routes
Route::get('/users', [UsersController::class, 'index'])->middleware('auth:sanctum');
Route::post('/users', [UsersController::class, 'store'])->middleware('auth:sanctum');
Route::get('/users/{id}', [UsersController::class, 'show'])->middleware('auth:sanctum');
Route::put('/users/{id}', [UsersController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/users/{id}', [UsersController::class, 'destroy'])->middleware('auth:sanctum');

//Login and logout functionality
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');


Route::apiResource('products', ProductsController::class);

Route::apiResource('categories', CategoriesController::class);

Route::apiResource('reviews', ReviewsController::class);

Route::apiResource('businesses', BusinessesController::class);
