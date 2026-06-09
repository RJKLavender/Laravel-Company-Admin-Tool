<?php

use App\Http\Controllers\Api\CompanyApiController;
use App\Http\Controllers\Api\EmployeeApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//API Resource Controllers for JSONs
Route::apiResource('companies', CompanyApiController::class)->names('api.companies');
Route::apiResource('employees', EmployeeApiController::class)->names('api.employees');

// Returns the JSON requested by the user
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});