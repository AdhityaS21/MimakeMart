<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [LoginController::class, 'index']);
Route::post('/register', [LoginController::class, 'store']);
Route::get('/logout', [LoginController::class, 'logout']);
Route::apiResource('/categories', CategoriesController::class);
Route::apiResource('/products', ProductsController::class);
Route::apiResource('/roles', RoleController::class);
Route::apiResource('/users', UserController::class);
