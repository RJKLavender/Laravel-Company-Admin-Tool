<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AuthController;

Route::resource('companies', CompanyController::class);
Route::resource('employees', EmployeeController::class);

// Only authenticated users can access these routes
Route::middleware('auth')->group(function () {

Route::get('/', function () {
    return view('welcome');
});

     Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    Route::resource('companies', CompanyController::class);
    Route::resource('employees', EmployeeController::class);
});

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login']); 
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
