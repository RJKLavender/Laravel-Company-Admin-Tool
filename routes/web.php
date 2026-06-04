<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CompanyController; 
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

// Guest Routes (Login handling)
Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return redirect()->route('login');
    });

    Route::get('login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login']); 
});

// Authenticated Dashboard & Directory Views
Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    Route::resource('companies', CompanyController::class);
    Route::resource('employees', EmployeeController::class);
});

Route::get('/php-test', function () {
    echo 'Active php.ini: ' . php_ini_loaded_file() . '<br>';
    echo 'upload_max_filesize: ' . ini_get('upload_max_filesize') . '<br>';
    echo 'upload_tmp_dir: ' . ini_get('upload_tmp_dir') . '<br>';
});