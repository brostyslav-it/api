<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Route;

Route::apiResource('customers', CustomerController::class)->middleware('auth:sanctum');
Route::apiResource('invoices', InvoiceController::class)->middleware('auth:sanctum');
