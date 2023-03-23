<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\MedicalDeviceController;
use App\Http\Controllers\DoctorDepartmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookAppointmentController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\RequestDeviceController;
use App\Http\Controllers\ZoomController;

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
        Route::middleware([config('const.auth.low')])->group(function () {
            Route::get('/doctor_departments', [DoctorDepartmentController::class, 'index'])->name('doctor_departments.index');
        });
        Route::middleware([config('const.auth.high')])->group(function () {
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
        Route::middleware([config('const.auth.low')])->group(function () {
            Route::get('/doctors', 'index')->name('doctors.index');
        });
        Route::middleware([config('const.auth.high')])->group(function () {
            Route::get('/doctors/create', 'create')->name('doctors.create');
            Route::post('/doctors', 'store')->name('doctors.store');
            Route::get('/doctors/{doctor}', 'show')->name('doctors.show');
            Route::get('/doctors/{doctor}/edit', 'edit')->name('doctors.edit');
            Route::put('/doctors/{doctor}', 'update')->name('doctors.update');
            Route::delete('/doctors/{doctor}', 'destroy')->name('doctors.destroy');
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
            Route::post('/calendar', [AppointmentController::class, 'storeCalendar'])->name('calendar.store');
            Route::patch('/calendar/update/{id}', [AppointmentController::class, 'updateCalendar'])->name('calendar.update');
            Route::delete('/calendar/destroy/{id}', [AppointmentController::class, 'destroyCalendar'])->name('calendar.destroy');
        });

        Route::middleware([config('const.auth.mid')])->group(function () {
            Route::get('/schedules', [AppointmentController::class, 'getAppointmentByDoctor'])->name('appointments.get-appointment-by-doctor');
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

    //-----------------------------------Request Devices ----------------------------------------------------------------
    Route::controller(MedicalDeviceController::class)->group(function () {
        Route::middleware([config('const.auth.mid')])->group(function () {
            Route::get('/medical_devices', 'index')->name('medical_devices.index');
        });
        Route::middleware([config('const.auth.high')])->group(function () {
            Route::get('/medical_devices/create', 'create')->name('medical_devices.create');
            Route::post('/medical_devices', 'store')->name('medical_devices.store');
            Route::get('/medical_devices/{medical_device}', 'show')->name('medical_devices.show');
            Route::get('/medical_devices/{medical_device}/edit', 'edit')->name('medical_devices.edit');
            Route::put('/medical_devices/{medical_device}', 'update')->name('medical_devices.update');
            Route::delete('/medical_devices/{medical_device}', 'destroy')->name('medical_devices.destroy');
        });
    });

    //-----------------------------------Medical Devices ----------------------------------------------------------------
    Route::controller(RequestDeviceController::class)->group(function () {
        Route::middleware([config('const.auth.mid')])->group(function () {
            Route::get('/request_devices', 'index')->name('request_devices.index');
            Route::get('/request_devices/create', 'create')->name('request_devices.create')->withoutMiddleware(config('const.auth.high'));
            Route::post('/request_devices', 'store')->name('request_devices.store')->withoutMiddleware(config('const.auth.high'));
            Route::get('/request_devices/{request_device}', 'show')->name('request_devices.show')->withoutMiddleware(config('const.auth.high'));
            Route::get('/request_devices/{request_device}/edit', 'edit')->name('request_devices.edit')->withoutMiddleware(config('const.auth.high'));
            Route::put('/request_devices/{request_device}', 'update')->name('request_devices.update')->withoutMiddleware(config('const.auth.high'));
            Route::delete('/request_devices/{request_device}', 'destroy')->name('request_devices.destroy')->withoutMiddleware(config('const.auth.high'));
        });
    });

    //-----------------------------------Prescriptions----------------------------------------------------------------
    Route::controller(PrescriptionController::class)->group(function () {
        Route::middleware([config('const.auth.mid')])->group(function () {
            Route::get('/prescriptions', 'index')->name('prescriptions.index');
            Route::get('/prescriptions/create', 'create')->name('prescriptions.create');
            Route::post('/prescriptions', 'store')->name('prescriptions.store');
            Route::get('/prescriptions/{prescription}', 'show')->name('prescriptions.show');
            Route::get('/prescriptions/{prescription}/edit', 'edit')->name('prescriptions.edit');
            Route::put('/prescriptions/{prescription}', 'update')->name('prescriptions.update');
            Route::delete('/prescriptions/{prescription}', 'destroy')->name('prescriptions.destroy');
        });
    });

    //-----------------------------------Files ----------------------------------------------------------------
    Route::controller(DocumentController::class)->group(function () {
        Route::middleware([config('const.auth.mid')])->group(function () {
            Route::get('/documents', 'index')->name('documents.index');
            Route::get('/documents/create', 'create')->name('documents.create');
            Route::post('/documents', 'store')->name('documents.store');
            Route::get('/documents/{document}', 'show')->name('documents.show');
            Route::get('/documents/{document}/edit', 'edit')->name('documents.edit');
            Route::put('/documents/{document}', 'update')->name('documents.update');
            Route::delete('/documents/{document}', 'destroy')->name('documents.destroy');
        });
    });

    //-----------------------------------News ----------------------------------------------------------------
    Route::controller(NewsController::class)->group(function () {
        Route::middleware([config('const.auth.high')])->group(function () {
            Route::get('/news', [NewsController::class, 'index'])->name('news.index');
            Route::get('/news/create', [NewsController::class, 'create'])->name('news.create');
            Route::post('/news', [NewsController::class, 'store'])->name('news.store');
            Route::get('/news/{new}', [NewsController::class, 'show'])->name('news.show');
            Route::get('/news/{new}/edit', [NewsController::class, 'edit'])->name('news.edit');
            Route::put('/news/{new}', [NewsController::class, 'update'])->name('news.update');
            Route::delete('/news/{new}', [NewsController::class, 'destroy'])->name('news.destroy');

            Route::get('/bills', [NewsController::class, 'index2'])->name('admin.get-bill-list');
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

    //--------------------------------Meeting ------------------------------------------------------------------------------------------------
    Route::controller(ZoomController::class)->group(function () {
        Route::middleware([config('const.auth.low')])->group(function () {
            Route::get('meetings', 'index')->name('meetings.index');
            Route::get('join-meeting/{meeting}', 'join_meeting')->name('meeting.join');
            Route::get('leave-meeting', 'leave_meeting')->name('meeting.leave');
        });
        Route::middleware([config('const.auth.high')])->group(function () {
            Route::get('start-meeting/{meeting}', 'start_meeting')->name('meeting.start');
            Route::get('create-new-meeting', 'create')->name('meeting.create');
            Route::post('create-new-meeting', 'store')->name('meeting.store');
            Route::delete('delete-meeting/{meeting}', 'destroy')->name('meeting.destroy');
        });
    });

    //-----------------------------------Book Appointments ----------------------------------------------------------------
    Route::controller(BookAppointmentController::class)->group(function () {
        Route::middleware([config('const.auth.low')])->group(function () {
            Route::get('/book_appointments', 'index')->name('book_appointments.index');
            Route::get('/accepted_book_appointment/{book_appointment}', 'acceptedBookAppointment')->name('book_appointments.accepted');
            Route::get('/denied_book_appointment/{book_appointment}', 'deniedBookAppointment')->name('book_appointments.denied');
        });
    });
});



// ------------------------------------User site ------------------------------------------------------------
Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home.index');
    Route::get('/about', 'aboutUs')->name('home.about');
    Route::get('/blog', 'blog')->name('home.blog');
    Route::get('/book_appointment_user', 'bookAppointmentUser')->name('home.book-appointment-user');
    Route::post('/user/appointments', 'storeAppointment')->name('user.appointments-store');

});
