<?php

use App\Http\Controllers\ClinicController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\MedicationController;
use App\Http\Controllers\MedicationTypeController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('frontend.index');
});

Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');


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
Route::get('/medication/{id}/edit-stock', [MedicationController::class, 'editstock'])->name('medication.edit_stock');
Route::post('/medication/{id}/add-stock', [MedicationController::class, 'addstock'])->name('medication.add_stock');
Route::resource('patient', PatientController::class);
Route::resource('patient-register', RegisterController::class);
Route::post('/patient-register/checkpreviouspatient', [RegisterController::class, 'checkpreviouspatient'])->name('patient-register.checkpreviouspatient');




Route::post('logout', function () {
    Auth::logout();
    return redirect()->route('login'); // Halaman login setelah logout
})->name('logout');

Route::middleware(['auth', 'is_super_admin'])->group(function () {
    Route::resource('account-manager', UserController::class);
});
require __DIR__ . '/auth.php';
