<?php

use App\Http\Controllers\Api\AppointmentController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PatientController;
use App\Http\Controllers\Api\ConsultationController;
use App\Http\Controllers\Api\TextBrutController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);

    Route::get('/patients/search', [PatientController::class, 'search']);
    Route::get('/patients', [PatientController::class, 'index']);
    Route::post('/patients', [PatientController::class, 'store']);
    Route::get('/patients/{patient}', [PatientController::class, 'show']);
    Route::put('/patients/{patient}', [PatientController::class, 'update']);
    Route::delete('/patients/{patient}', [PatientController::class, 'destroy']);

    Route::get('/appointments', [AppointmentController::class, 'index']);
    Route::post('/appointments', [AppointmentController::class, 'store']);
    Route::get('/appointments/{appointment}', [AppointmentController::class, 'show']);
    Route::put('/appointments/{appointment}', [AppointmentController::class, 'update']);
    Route::delete('/appointments/{appointment}', [AppointmentController::class, 'destroy']);

    Route::post('/text-bruts', [TextBrutController::class, 'store']);
    Route::get('/text-bruts/{text_brut}', [TextBrutController::class, 'show']);
    Route::put('/text-bruts/{text_brut}', [TextBrutController::class, 'update']);
    Route::post('/text-bruts/{text_brut}/analyze', [TextBrutController::class, 'analyze']);
    Route::post('/text-bruts/{text_brut}/validate', [TextBrutController::class, 'validate']);

    Route::get('/consultations', [ConsultationController::class, 'index']);
    Route::post('/consultations', [ConsultationController::class, 'store']);
    Route::get('/consultations/{consultation}', [ConsultationController::class, 'show']);
    Route::put('/consultations/{consultation}', [ConsultationController::class, 'update']);
    Route::delete('/consultations/{consultation}', [ConsultationController::class, 'destroy']);
});
