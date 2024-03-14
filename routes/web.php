<?php

use App\Http\Controllers\ClinicProfileController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\SpecialistCodeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('pages.auth.login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('home', function () {
        return view('dashboard-general-dashboard', ['type_menu' => 'dashboard']);
    })->name('home');

    Route::resource('user', UserController::class);
    Route::resource('doctor', DoctorController::class);
    Route::resource('specialistcode', SpecialistCodeController::class);
    Route::resource('permission', PermissionController::class);
    Route::resource('rolepermission', RolePermissionController::class);
    Route::resource('clinicprofile', ClinicProfileController::class);
});
