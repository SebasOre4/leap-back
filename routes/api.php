<?php

use App\Http\Controllers\Api\V1\PatientController;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\DiagnosisController;
use App\Http\Controllers\Api\V1\TreatmentController;
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

        Route::post('diagnose-patient/{patient}', [DiagnosisController::class, 'diagnosePatient']);

        Route::post('discharge-patient/{patient}/{treatment}', [DiagnosisController::class, 'dischargePatient']);

        Route::apiResource('patient', PatientController::class);

        Route::get('current-treatment/{patient}', [TreatmentController::class, 'currentTreatment']);

        Route::put('treatment/{treatment}', [TreatmentController::class, 'updateTreatment']);

        Route::get('treatment-history/{patient}', [TreatmentController::class, 'treatmentHistory']);

        Route::get('dash-graphs', [AuthController::class, 'docDashInfo']);
    });
});