<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\V1\LoginController;
use App\Http\Controllers\V1\LogoutController;
use App\Http\Controllers\V1\RegisterController;

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
    });
});
