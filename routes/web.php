<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::middleware(['auth'])->group(function() {
Route::get('/dashboard', [EmployeesController::class, 'all']);
Route::get('/employees/{id}', [EmployeesController::class, 'show']);
});

Route::middleware(['guest'])->group(function() {
   Route::get('/login', [AuthController::class, 'login'] )->name('login');
   Route::post('/login', [AuthController::class, 'store'] )->name('store');
});


