<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeesController;
use Illuminate\Support\Facades\Auth;
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
//Route::middleware(['auth'])->group(function() {
    Route::get('/logout', function () {
        Auth::logout();
        return redirect('/');
    });
//});

    Route::get('/dashboard', [EmployeesController::class, 'index']);
    Route::resource('/employee', EmployeesController::class);
//    Route::get('/setdepartments', [\App\Http\Controllers\TestController::class, 'setDepartments']);
//    Route::get('/employees/{employee}', [EmployeesController::class, 'show']);
//    Route::get('/employees/edit/{employee}', [EmployeesController::class, 'edit']);

Route::middleware(['guest'])->group(function() {
   Route::get('/', [\App\Http\Controllers\WelcomeController::class, 'index']);
   Route::get('/login', [AuthController::class, 'login'] )->name('login');
   Route::post('/login', [AuthController::class, 'authenticate'] )->name('authenticate');
});


