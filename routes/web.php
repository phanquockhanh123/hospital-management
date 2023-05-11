<?php

use App\Models\User;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ZoomController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\MedicalController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\DiagnosisController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\MedicalDeviceController;
use App\Http\Controllers\RequestDeviceController;
use App\Http\Controllers\BookAppointmentController;
use App\Http\Controllers\DoctorDepartmentController;
use App\Http\Controllers\ReceptionistController;
use App\Http\Controllers\ReportController;

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

            Route::get('/create_account_doctor/{doctor}', 'addAccountDoctor')->name('doctors.add-account-doctor');
        });
    });

    //-----------------------------------Receptionists ----------------------------------------------------------------
    Route::controller(ReceptionistController::class)->group(function () {
        Route::middleware([config('const.auth.low')])->group(function () {
            Route::get('/receptionists', 'index')->name('receptionists.index');
        });
        Route::middleware([config('const.auth.high')])->group(function () {
            Route::get('/receptionists/create', 'create')->name('receptionists.create');
            Route::post('/receptionists', 'store')->name('receptionists.store');
            Route::get('/receptionists/{receptionist}', 'show')->name('receptionists.show');
            Route::get('/receptionists/{receptionist}/edit', 'edit')->name('receptionists.edit');
            Route::put('/receptionists/{receptionist}', 'update')->name('receptionists.update');
            Route::delete('/receptionists/{receptionist}', 'destroy')->name('receptionists.destroy');

            Route::get('/create_account_receptionist/{receptionist}', 'addAccountReceptionist')->name('receptionists.add-account-receptionist');
        });
    });

    //-----------------------------------Patients ----------------------------------------------------------------
    Route::controller(PatientController::class)->group(function () {
        Route::middleware([config('const.auth.low')])->group(function () {
            Route::get('/patients', [PatientController::class, 'index'])->name('patients.index');
            Route::get('/patients/create', [PatientController::class, 'create'])->name('patients.create')
                ->withoutMiddleware(['const.auth.mid', 'const.auth.high']);
            Route::post('/patients', [PatientController::class, 'store'])->name('patients.store')
                ->withoutMiddleware(['const.auth.mid', 'const.auth.high']);
            Route::get('/patients/{patient}', [PatientController::class, 'show'])->name('patients.show')
                ->withoutMiddleware(['const.auth.mid', 'const.auth.high']);
            Route::get('/patients/{patient}/edit', [PatientController::class, 'edit'])->name('patients.edit')
                ->withoutMiddleware(['const.auth.mid', 'const.auth.high']);
            Route::put('/patients/{patient}', [PatientController::class, 'update'])->name('patients.update')
                ->withoutMiddleware(['const.auth.mid', 'const.auth.high']);
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
            Route::get('/schedules', [AppointmentController::class, 'getAppointmentByDoctor'])->name('appointments.get-appointment-by-doctor');
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

    //-----------------------------------Medicals ----------------------------------------------------------------
    Route::controller(MedicalController::class)->group(function () {
        Route::middleware([config('const.auth.high')])->group(function () {
            Route::get('/medicals', 'index')->name('medicals.index');
            Route::get('/medicals/create', 'create')->name('medicals.create');
            Route::post('/medicals', 'store')->name('medicals.store');
            Route::get('/medicals/{medical}', 'show')->name('medicals.show');
            Route::get('/medicals/{medical}/edit', 'edit')->name('medicals.edit');
            Route::put('/medicals/{medical}', 'update')->name('medicals.update');
            Route::delete('/medicals/{medical}', 'destroy')->name('medicals.destroy');
        });
    });

    //-----------------------------------Services ----------------------------------------------------------------
    Route::controller(ServiceController::class)->group(function () {
        Route::middleware([config('const.auth.high')])->group(function () {
            Route::get('/services', 'index')->name('services.index');
            Route::get('/services/create', 'create')->name('services.create');
            Route::post('/services', 'store')->name('services.store');
            Route::get('/services/{service}', 'show')->name('services.show');
            Route::get('/services/{service}/edit', 'edit')->name('services.edit');
            Route::put('/services/{service}', 'update')->name('services.update');
            Route::delete('/services/{service}', 'destroy')->name('services.destroy');
        });
    });

    //-----------------------------------Bills ----------------------------------------------------------------
    Route::controller(BillController::class)->group(function () {
        Route::middleware([config('const.auth.low')])->group(function () {
            Route::get('/bills', 'index')->name('bills.index');
            Route::get('/bills/create', 'create')->name('bills.create');
            Route::post('/bills', 'store')->name('bills.store');
            Route::get('/bills/{bill}', 'show')->name('bills.show');
            Route::get('/bills/{bill}/edit', 'edit')->name('bills.edit');
            Route::put('/bills/{bill}', 'update')->name('bills.update');
            Route::delete('/bills/{bill}', 'destroy')->name('bills.destroy');

            Route::get('/bills/{bill}/payment', 'payment')->name('bills.payment');

            Route::get('/bills/{bill}/pdf', 'renderPdf')->name('bills.pdf');
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

            Route::get('/prescriptions/{prescription}/pdf', 'renderPdf')->name('prescriptions.pdf');

            Route::get('/diagnosises/{diagnosis}/create/prescriptions', 'createPrescription')->name('diagnosises.create-prescription');
            Route::post('/diagnosises/{diagnosis}/prescriptions', 'storePrescription')->name('diagnosises.store-prescription');
        });
    });

    //-----------------------------------Chẩn đoán/Xét nghiệm----------------------------------------------------------------
    Route::controller(DiagnosisController::class)->group(function () {
        Route::middleware([config('const.auth.mid')])->group(function () {
            Route::get('/diagnosises', 'index')->name('diagnosises.index');
            Route::get('/diagnosises/create', 'create')->name('diagnosises.create');
            Route::post('/diagnosises', 'store')->name('diagnosises.store');
            Route::get('/diagnosises/{diagnosis}', 'show')->name('diagnosises.show');
            Route::get('/diagnosises/{diagnosis}/create', 'edit')->name('diagnosises.edit');
            Route::put('/diagnosises/{diagnosis}', 'update')->name('diagnosises.update');
            Route::delete('/diagnosises/{diagnosis}', 'destroy')->name('diagnosises.destroy');

            Route::get('/diagnosises/{diagnosis}/pdf', 'renderPdf')->name('diagnosises.pdf');

            Route::get('/appointments/{appointment}/create/diagnosis', 'createDiagnosis')->name('appointments.create-diagnosis');
            Route::post('/appointments/{appointment}/diagnosis', 'storeDiagnosis')->name('appointments.store-diagnosis');
        });
    });

    //-----------------------------------Chấm công ----------------------------------------------------------------
    Route::controller(AttendanceController::class)->group(function () {
        Route::middleware([config('const.auth.high')])->group(function () {
            Route::get('/attendances', 'index')->name('attendances.index');
        });
    });

    //-----------------------------------Tính lương ----------------------------------------------------------------
    Route::controller(SalaryController::class)->group(function () {
        Route::middleware([config('const.auth.high')])->group(function () {
            Route::get('/salaries', 'index')->name('salaries.index');
            Route::get('/salaries/{salary}/payment', 'payment')->name('salaries.payment');
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

            // Route::get('/bills', [NewsController::class, 'index2'])->name('admin.get-bill-list');

            // Route::post('/upload', [NewsController::class, 'upload'])->name('ckeditor.upload');
        });
    });

    //--------------------------------Chats ------------------------------------------------------------------------------------------------
    Route::controller(ChatController::class)->group(function () {
        Route::middleware([config('const.auth.patient')])->group(function () {
            Route::get('/chats', 'index')->name('chats.index');
            
            Route::get('/message/{id}', 'getMessage')->name('message');
            Route::get('/infor/{id}', 'getInfor')->name('getInfor');
            Route::post('/message', 'sendMessage')->name('sendMessage');
        });
    });

    //--------------------------------Report ------------------------------------------------------------------------------------------------
    Route::controller(ReportController::class)->group(function () {
        Route::middleware([config('const.auth.high')])->group(function () {
            Route::get('/report-services', 'reportServices')->name('reports.report-services');
            Route::get('/report-medicals', 'reportMedicals')->name('reports.report-medicals');
            Route::get('/report-devices', 'reportDevices')->name('reports.report-devices');
        });
    });

    //--------------------------------Meeting ------------------------------------------------------------------------------------------------
    Route::controller(ZoomController::class)->group(function () {
        Route::middleware([config('const.auth.low')])->group(function () {
            Route::get('meetings', 'index')->name('meetings.index');
            Route::get('join-meeting/{meeting}', 'join_meeting')->name('meeting.join');
            Route::get('leave-meeting', 'leave_meeting')->name('meeting.leave');
            Route::get('start-meeting/{meeting}', 'start_meeting')->name('meeting.start');
        });
        Route::middleware([config('const.auth.high')])->group(function () {
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
            //Route::get('/denied_book_appointment/{book_appointment}', 'deniedBookAppointment')->name('book_appointments.denied');
        });
    });


});



// ------------------------------------User site ------------------------------------------------------------
Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home.index');
    Route::get('/about', 'aboutUs')->name('home.about');
    Route::get('/blog', 'blog')->name('home.blog');
    Route::get('/get_log_detail_for_user_site/{blog}', 'getBlogDetailForUserSite')->name('home.get-blog-detail-for-user-site');
    Route::get('/contact', 'contact')->name('home.contact');
    Route::get('/book_appointment_user', 'bookAppointmentUser')->name('home.book-appointment-user');
    Route::post('/user/appointments', 'storeAppointment')->name('user.appointments-store');
    Route::get('/get_doctor_list_for_user_site', 'getDoctorListForUserSite')->name('home.get-doctor-list-for-user-site');
    Route::get('/get_doctor_detail_for_user_site/{doctor}', 'getDoctorDetailForUserSite')->name('home.get-doctor-detail-for-user-site');
    Route::get('/get_info_patient', 'getInfoPatient')->name('user.get-info-patient');
    Route::put('/patients/{patient}/user', 'updateUserPatient')->name('home.update-patient');
});


Route::get('/auth/google', function () {
    return Socialite::driver('google')->redirect();
})->name('home.login-with-google');

Route::get('/auth/google/callback', function () {
    $googleUser = Socialite::driver('google')->user();
    if (User::where('email', $googleUser->email)->whereNull('google_id')->first()) {
        return redirect()->back()->with('alert', 'Email đã tồn tại, vui lòng chọn email khác!');
    }
    if (!Patient::where('email', $googleUser->email)->first()) {
        Patient::create([
            'name' => $googleUser->name,
            'email' => $googleUser->email,
            'patient_code' => Patient::generateNextCode()
        ]);
    }
    $user = User::updateOrCreate([
        'google_id' => $googleUser->id,
    ], [
        'name' => $googleUser->name,
        'email' => $googleUser->email,
        'google_token' => $googleUser->token,
        'google_refresh_token' => $googleUser->refreshToken,
    ]);

    Auth::login($user);
    return redirect('/');
});

Route::get('/auth/google/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('home.logout-with-google');
