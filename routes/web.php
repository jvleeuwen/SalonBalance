<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomersController;

use App\Http\Controllers\TreatmentsController;



Route::resource('/customers', CustomersController::class);

Route::get('/treatments', [TreatmentsController::class, 'index']);
Route::post('/treatments', [TreatmentsController::class, 'store']);