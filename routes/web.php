<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClinicProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\DoctorScheduleController;
use App\Http\Controllers\PatientController;
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

Route::get('/',[AuthController::class, 'login']);
Route::get('/login',[AuthController::class, 'login'])->name('login');
Route::get('/register',[AuthController::class, 'register'])->name('register');

Route::middleware(['auth'])->group(function () {
    Route::get('home',[DashboardController::class, 'index'])->name('home');
    Route::resource('user', UserController::class);
    Route::resource('doctor', DoctorController::class);
    Route::resource('specialistcode', SpecialistCodeController::class);
    Route::resource('permission', PermissionController::class);
    Route::resource('rolepermission', RolePermissionController::class);
    Route::resource('clinicprofile', ClinicProfileController::class);
    Route::prefix('scheduledoctor')
        ->controller(DoctorScheduleController::class)
        ->name('scheduledoctor.')
        ->group(function () {
            Route::resource('/', DoctorScheduleController::class)->parameters(['' => 'scheduledoctor']);
            Route::get('get/schedules', 'getSchedule')->name('getSchedule');
        });
    Route::resource('patient', PatientController::class);
});
