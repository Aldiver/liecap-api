<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\EntryRecordController;

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
Route::post('/auth/register', [UserController::class, 'createUser']);
Route::post('/auth/login', [UserController::class, 'loginUser']);

// Vehicle Endpoints
Route::get('/vehicles', [VehicleController::class, 'getAllVehicles']);
Route::get('/vehicles/{plateNumber}', [VehicleController::class, 'getVehicle']);

// Entry Record Endpoints
Route::get('/entry-records', [EntryRecordController::class, 'getAllEntries']);