<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UnitsController;
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

Route::middleware(['log.api', 'throttle:api-login'])->group(function () {
    Route::post('login', [AuthController::class, 'login']);
});

Route::middleware(['log.api', 'auth:sanctum', 'throttle:api'])->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
});

Route::middleware(['log.api', 'auth:sanctum', 'ability:units:read', 'throttle:api'])->group(function () {
    Route::get('units', [UnitsController::class, 'index']);
    Route::get('units/{id}', [UnitsController::class, 'show']);
    Route::get('unit-types', [UnitsController::class, 'unitTypes']);
});
