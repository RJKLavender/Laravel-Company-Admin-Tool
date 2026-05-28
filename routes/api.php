<?php

use App\Http\Controllers\Api\CompanyApiController;
use App\Http\Controllers\Api\EmployeeApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('companies', CompanyApiController::class);
Route::apiResource('employees', EmployeeApiController::class);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
