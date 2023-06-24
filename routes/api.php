<?php

use App\Http\Controllers\LineController;
use App\Http\Controllers\PlayerController;
use Illuminate\Support\Facades\Route;

Route::apiResource('lines', LineController::class);
Route::apiResource('players', PlayerController::class);
