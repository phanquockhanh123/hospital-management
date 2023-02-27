<?php

use App\Http\Controllers\AddmissionPatientController;
use App\Http\Controllers\AppointmentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BedController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\DoctorDepartmentController;
use App\Http\Controllers\PatientController;
use App\Models\AddmissionPatient;

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

Route::get('/', [HomeController::class, 'index']);

Route::get('/home', [HomeController::class, 'redirect']);

Route::get('/chat', function () {
    return view('user.chat');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

//-----------------------------------Doctor Departments ----------------------------------------------------------------

Route::get('/doctor_departments', [DoctorDepartmentController::class, 'index'])->name('doctor_departments.index');
Route::get('/doctor_departments/create', [DoctorDepartmentController::class, 'create'])->name('doctor_departments.create');
Route::post('/doctor_departments', [DoctorDepartmentController::class, 'store'])->name('doctor_departments.store');
Route::get('/doctor_departments/{doctor_department}', [DoctorDepartmentController::class, 'show'])->name('doctor_departments.show');
Route::get('/doctor_departments/{doctor_department}/edit', [DoctorDepartmentController::class, 'edit'])->name('doctor_departments.edit');
Route::put('/doctor_departments/{doctor_department}', [DoctorDepartmentController::class, 'update'])->name('doctor_departments.update');
Route::delete('/doctor_departments/{doctor_department}', [DoctorDepartmentController::class, 'destroy'])->name('doctor_departments.destroy');

//-----------------------------------Beds ----------------------------------------------------------------
Route::get('/beds', [BedController::class, 'index'])->name('beds.index');
Route::get('/beds/create', [BedController::class, 'create'])->name('beds.create');
Route::post('/beds', [BedController::class, 'store'])->name('beds.store');
Route::get('/beds/{bed}', [BedController::class, 'show'])->name('beds.show');
Route::get('/beds/{bed}/edit', [BedController::class, 'edit'])->name('beds.edit');
Route::put('/beds/{bed}', [BedController::class, 'update'])->name('beds.update');
Route::delete('/beds/{bed}', [BedController::class, 'destroy'])->name('beds.destroy');


//-----------------------------------Doctors ----------------------------------------------------------------
Route::get('/doctors', [DoctorController::class, 'index'])->name('doctors.index');
Route::get('/doctors/create', [DoctorController::class, 'create'])->name('doctors.create');
Route::post('/doctors', [DoctorController::class, 'store'])->name('doctors.store');
Route::get('/doctors/{doctor}', [DoctorController::class, 'show'])->name('doctors.show');
Route::get('/doctors/{doctor}/edit', [DoctorController::class, 'edit'])->name('doctors.edit');
Route::put('/doctors/{doctor}', [DoctorController::class, 'update'])->name('doctors.update');
Route::delete('/doctors/{doctor}', [DoctorController::class, 'destroy'])->name('doctors.destroy');


//-----------------------------------Patients ----------------------------------------------------------------
Route::get('/patients', [PatientController::class, 'index'])->name('patients.index');
Route::get('/patients/create', [PatientController::class, 'create'])->name('patients.create');
Route::post('/patients', [PatientController::class, 'store'])->name('patients.store');
Route::get('/patients/{patient}', [PatientController::class, 'show'])->name('patients.show');
Route::get('/patients/{patient}/edit', [PatientController::class, 'edit'])->name('patients.edit');
Route::put('/patients/{patient}', [PatientController::class, 'update'])->name('patients.update');
Route::delete('/patients/{patient}', [PatientController::class, 'destroy'])->name('patients.destroy');

//-----------------------------------Addmission Patients ----------------------------------------------------------------
Route::get('/addmission_patients', [AddmissionPatientController::class, 'index'])->name('addmission_patients.index');
Route::get('/addmission_patients/create', [AddmissionPatientController::class, 'create'])->name('addmission_patients.create');
Route::post('/addmission_patients', [AddmissionPatientController::class, 'store'])->name('addmission_patients.store');
Route::get('/addmission_patients/{addmission_patient}', [AddmissionPatientController::class, 'show'])->name('addmission_patients.show');
Route::get('/addmission_patients/{addmission_patient}/edit', [AddmissionPatientController::class, 'edit'])->name('addmission_patients.edit');
Route::put('/addmission_patients/{addmission_patient}', [AddmissionPatientController::class, 'update'])->name('addmission_patients.update');
Route::delete('/addmission_patients/{addmission_patient}', [AddmissionPatientController::class, 'destroy'])->name('addmission_patients.destroy');

//-----------------------------------Appointments ----------------------------------------------------------------
Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
Route::get('/appointments/create', [AppointmentController::class, 'create'])->name('appointments.create');
Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
Route::get('/appointments/{appointment}', [AppointmentController::class, 'show'])->name('appointments.show');
Route::get('/appointments/{appointment}/edit', [AppointmentController::class, 'edit'])->name('appointments.edit');
Route::put('/appointments/{appointment}', [AppointmentController::class, 'update'])->name('appointments.update');
Route::delete('/appointments/{appointment}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');






