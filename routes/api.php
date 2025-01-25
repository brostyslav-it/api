<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Route;

Route::apiResource('customers', CustomerController::class);
Route::apiResource('invoices', InvoiceController::class);
Route::post('/invoices/bulk', [InvoiceController::class, 'bulkStore']);
