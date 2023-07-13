<?php

use App\Http\Controllers\Api\V1\PatientController;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\DiagnosisController;
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

Route::prefix('v1')->group(function () {
    Route::post('login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('me', [AuthController::class, 'me']);

        Route::get('denver-test', [DiagnosisController::class, 'denverTest']);

        Route::get('user', [AuthController::class, 'index']);

        Route::get('logout', [AuthController::class, 'logout']);

        Route::post('register', [AuthController::class, 'register']);

        Route::post('user/{user}', [AuthController::class, 'update']);

        Route::post('newpassword/{user}', [AuthController::class, 'updatePassword']);

        Route::delete('user/{user}', [AuthController::class, 'delete']);

        Route::apiResource('patient', PatientController::class);
    });
});
