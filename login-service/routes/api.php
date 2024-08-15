<?php

use App\Http\Controllers\GetRecentLoginLogsController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::post('login', LoginController::class);
Route::middleware('auth:sanctum')->get('logs', GetRecentLoginLogsController::class);
