<?php

use App\Http\Controllers\ClinicController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\MedicationController;
use App\Http\Controllers\MedicationTypeController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScheduleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('frontend.index');
});

Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/patients', [PatientController::class, 'store'])->name('patient.store');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin
Route::resource('doctor', DoctorController::class);
Route::resource('clinic', ClinicController::class);
Route::resource('employee', EmployeeController::class);
Route::resource('schedule', ScheduleController::class);
Route::resource('medication-types', MedicationTypeController::class);
Route::resource('medication', MedicationController::class);

// Route::middleware(['auth', 'admin'])->group(function () {
//     Route::resource('doctor', DoctorController::class);
// });
require __DIR__.'/auth.php';
