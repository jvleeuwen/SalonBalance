<?php

use App\Http\Controllers\CustomersController;
use App\Http\Controllers\TreatmentsController;
use Illuminate\Support\Facades\Route;

Route::apiResource('customers', CustomersController::class);
Route::apiResource('treatments', TreatmentsController::class);