<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Diagnosis;
use App\Models\Appointment;
use App\Models\Prescription;
use App\Models\MedicalDevice;
use App\Models\DoctorDepartment;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function redirect()
    {
        if (Auth::id()) {
            $today = now()->toDateString();
            $sixtyYesterday = now()->subDays(60)->toDateString();
            $countUsers = User::where('status', User::STATUS_ACTIVE)->count();
            $countPatients = Patient::count();
            $countDoctors = Doctor::where('status', Doctor::STATUS_ACTIVE)->count();
            $countAppointments = Appointment::where('status', '!=', Appointment::STATUS_DENIED)->count();
            $countPrescriptions = Prescription::count();
            $countMedicalDevices = MedicalDevice::count();
            $countDiagnosises = Diagnosis::count();
            $countDepartments = DoctorDepartment::count();
            $countNews = News::count();
            $appointmentTodays = Appointment::whereDate('start_time', $today)->WhereDate('end_time', $today)->get();
            $medicalDevices = MedicalDevice::whereDate('expired_date', '>=', $sixtyYesterday )->get();
            return view('admin.home', compact(
                'countUsers',
                'countPatients',
                'countDoctors',
                'countAppointments',
                'countPrescriptions',
                'countMedicalDevices',
                'countDiagnosises',
                'countDepartments',
                'countNews',
                'appointmentTodays',
                'medicalDevices'
            ));
        } else {
            return redirect()->back();
        }
    }
}
