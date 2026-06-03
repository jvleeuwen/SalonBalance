<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\TreatmentsController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/customers', CustomersController::class);
Route::resource('/treatments', TreatmentsController::class);