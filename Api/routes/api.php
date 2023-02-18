<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\UserController;
use App\Http\Controllers\V1\CustomerController;
use App\Http\Controllers\V1\Auth\LoginController;
use App\Http\Controllers\V1\Auth\LogoutController;
use App\Http\Controllers\V1\Auth\RegisterController;
use App\Http\Controllers\V1\CategoryController;
use App\Http\Controllers\V1\TagController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::prefix('v1')->group(function () {
    // Auth
    Route::post('/register', RegisterController::class);
    Route::post('/login', LoginController::class);

    Route::middleware('auth:api')->group(function () {
        Route::post('/logout', LogoutController::class);
        // user
        Route::get('/users/{id}', [UserController::class, 'findUserId']);
        Route::get('/users', [UserController::class, 'ListUser']);
        // customer
        Route::get('/customers', [CustomerController::class, 'getAllDataCustomer']);
        Route::get('/customers/{id}', [CustomerController::class, 'getCustomerId']);
        Route::post('/customers', [CustomerController::class, 'store']);
        Route::put('/customers/{id}', [CustomerController::class, 'update']);
        Route::delete('/customers/{id}', [CustomerController::class, 'destroy']);
        // category
        Route::get('/categories', [CategoryController::class, 'getAllDataCategories']);
        Route::get('/categories/{id}', [CategoryController::class, 'getCategoryId']);
        Route::post('/categories', [CategoryController::class, 'store']);
        Route::put('/categories/{id}', [CategoryController::class, 'update']);
        Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);
        // tag
        Route::get('/tags', [TagController::class, 'getAllDataTag']);
        Route::get('/tags/{id}', [TagController::class, 'getTagId']);
        Route::post('/tags', [TagController::class, 'store']);
        Route::put('/tags/{id}', [TagController::class, 'update']);
        Route::delete('/tags/{id}', [TagController::class, 'destroy']);
    });
});
