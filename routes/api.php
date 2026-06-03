<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\TreatmentsController;

Route::apiResource('customers', CustomersController::class);
Route::apiResource('treatments', TreatmentsController::class);
