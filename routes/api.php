<?php

use App\Http\Controllers\Api\CompanyApiController;
use App\Http\Controllers\Api\EmployeeApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('companies', CompanyApiController::class)->names('api.companies');
Route::apiResource('employees', EmployeeApiController::class)->names('api.employees');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});