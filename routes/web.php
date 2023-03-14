<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\MedicalDeviceController;
use App\Http\Controllers\DoctorDepartmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;

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
// Auth::routes(['verify' => true]);
Route::get('/home', [AuthController::class, 'redirect'])->middleware(
    'auth',
    'verified'
);
// toroutes();
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




Route::middleware(['auth:sanctum'])->group(function () {
    Route::controller(AuthController::class)->middleware([config('const.auth.low'), 'auth', 'verified'])->group(function () {
        Route::get('/home', 'redirect')->name('admin.home');
    });


    //-----------------------------------Doctor Departments ----------------------------------------------------------------
    Route::controller(DoctorDepartmentController::class)->group(function () {
        Route::middleware([config('const.auth.high')])->group(function () {
            Route::get('/doctor_departments', [DoctorDepartmentController::class, 'index'])->name('doctor_departments.index');
            Route::get('/doctor_departments/create', [DoctorDepartmentController::class, 'create'])->name('doctor_departments.create');
            Route::post('/doctor_departments', [DoctorDepartmentController::class, 'store'])->name('doctor_departments.store');
            Route::get('/doctor_departments/{doctor_department}', [DoctorDepartmentController::class, 'show'])->name('doctor_departments.show');
            Route::get('/doctor_departments/{doctor_department}/edit', [DoctorDepartmentController::class, 'edit'])->name('doctor_departments.edit');
            Route::put('/doctor_departments/{doctor_department}', [DoctorDepartmentController::class, 'update'])->name('doctor_departments.update');
            Route::delete('/doctor_departments/{doctor_department}', [DoctorDepartmentController::class, 'destroy'])->name('doctor_departments.destroy');
        });
    });

    //-----------------------------------Doctors ----------------------------------------------------------------
    Route::controller(DoctorController::class)->group(function () {
        Route::middleware([config('const.auth.high')])->group(function () {
            Route::get('/doctors', [DoctorController::class, 'index'])->name('doctors.index');
            Route::get('/doctors/create', [DoctorController::class, 'create'])->name('doctors.create');
            Route::post('/doctors', [DoctorController::class, 'store'])->name('doctors.store');
            Route::get('/doctors/{doctor}', [DoctorController::class, 'show'])->name('doctors.show');
            Route::get('/doctors/{doctor}/edit', [DoctorController::class, 'edit'])->name('doctors.edit');
            Route::put('/doctors/{doctor}', [DoctorController::class, 'update'])->name('doctors.update');
            Route::delete('/doctors/{doctor}', [DoctorController::class, 'destroy'])->name('doctors.destroy');
        });
    });


    //-----------------------------------Patients ----------------------------------------------------------------
    Route::controller(PatientController::class)->group(function () {
        Route::middleware([config('const.auth.low')])->group(function () {
            Route::get('/patients', [PatientController::class, 'index'])->name('patients.index');
            Route::get('/patients/create', [PatientController::class, 'create'])->name('patients.create')
                ->withoutMiddleware(['const.auth.mid']);
            Route::post('/patients', [PatientController::class, 'store'])->name('patients.store')
                ->withoutMiddleware(['const.auth.mid']);
            Route::get('/patients/{patient}', [PatientController::class, 'show'])->name('patients.show')
                ->withoutMiddleware(['const.auth.mid']);
            Route::get('/patients/{patient}/edit', [PatientController::class, 'edit'])->name('patients.edit')
                ->withoutMiddleware(['const.auth.mid']);
            Route::put('/patients/{patient}', [PatientController::class, 'update'])->name('patients.update')
                ->withoutMiddleware(['const.auth.mid']);
        });

        Route::middleware([config('const.auth.high')])->group(function () {
            Route::delete('/patients/{patient}', [PatientController::class, 'destroy'])->name('patients.destroy');
        });
    });

    //-----------------------------------Appointments ----------------------------------------------------------------
    Route::controller(AppointmentController::class)->group(function () {
        Route::middleware([config('const.auth.low')])->group(function () {
            Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
            Route::get('/appointments/create', [AppointmentController::class, 'create'])->name('appointments.create');
            Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
            Route::get('/appointments/{appointment}', [AppointmentController::class, 'show'])->name('appointments.show');
            Route::get('/appointments/{appointment}/edit', [AppointmentController::class, 'edit'])->name('appointments.edit');
            Route::put('/appointments/{appointment}', [AppointmentController::class, 'update'])->name('appointments.update');
            Route::delete('/appointments/{appointment}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');
            Route::get('/appointments_calendar', [AppointmentController::class, 'calendar'])->name('appointments.calendar');
        });

        Route::middleware([config('const.auth.mid')])->group(function () {
            Route::get('/accepted_appointment/{appointment}', [AppointmentController::class, 'acceptedAppointment'])->name('appointments.accepted');
            Route::get('/denied_appointment/{appointment}', [AppointmentController::class, 'deniedAppointment'])->name('appointments.denied');
        });
    });


    //-----------------------------------User ----------------------------------------------------------------
    Route::controller(UserController::class)->group(function () {
        Route::middleware([config('const.auth.high')])->group(function () {
            Route::get('/users', [UserController::class, 'index'])->name('users.index');
            Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
            Route::post('/users', [UserController::class, 'store'])->name('users.store');
            Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
            Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
            Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
            Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
        });
    });

    //-----------------------------------Medical Devices ----------------------------------------------------------------
    Route::controller(MedicalDeviceController::class)->group(function () {
        Route::middleware([config('const.auth.high')])->group(function () {
            Route::get('/medical_devices', [MedicalDeviceController::class, 'index'])->name('medical_devices.index');
            Route::get('/medical_devices/create', [MedicalDeviceController::class, 'create'])->name('medical_devices.create');
            Route::post('/medical_devices', [MedicalDeviceController::class, 'store'])->name('medical_devices.store');
            Route::get('/medical_devices/{medical_device}', [MedicalDeviceController::class, 'show'])->name('medical_devices.show');
            Route::get('/medical_devices/{medical_device}/edit', [MedicalDeviceController::class, 'edit'])->name('medical_devices.edit');
            Route::put('/medical_devices/{medical_device}', [MedicalDeviceController::class, 'update'])->name('medical_devices.update');
            Route::delete('/medical_devices/{medical_device}', [MedicalDeviceController::class, 'destroy'])->name('medical_devices.destroy');
        });
    });

    //-----------------------------------News ----------------------------------------------------------------
    Route::controller(MedicalDeviceController::class)->group(function () {
        Route::middleware([config('const.auth.high')])->group(function () {
            Route::get('/news', [NewsController::class, 'index'])->name('news.index');
            Route::get('/news/create', [NewsController::class, 'create'])->name('news.create');
            Route::post('/news', [NewsController::class, 'store'])->name('news.store');
            Route::get('/news/{new}', [NewsController::class, 'show'])->name('news.show');
            Route::get('/news/{new}/edit', [NewsController::class, 'edit'])->name('news.edit');
            Route::put('/news/{new}', [NewsController::class, 'update'])->name('news.update');
            Route::delete('/news/{new}', [NewsController::class, 'destroy'])->name('news.destroy');
        });
    });

    //--------------------------------Chats ------------------------------------------------------------------------------------------------
    Route::controller(ChatController::class)->group(function () {
        Route::middleware([config('const.auth.low')])->group(function () {
            Route::get('/chats', 'index')->name('chats.index');
            Route::get('/message/{id}', 'getMessage')->name('message');
            Route::get('/infor/{id}', 'getInfor')->name('getInfor');
            Route::post('/message', 'sendMessage')->name('sendMessage');
        });
    });
});


// -----------------------------------Meetings ----------------------------------------------------------------
Route::get('/meetings', [MeetingController::class, 'createLink'])->name('meetings.createLink');
