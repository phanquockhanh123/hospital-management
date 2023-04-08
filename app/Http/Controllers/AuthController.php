<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Message;
use App\Models\Patient;
use App\Models\Diagnosis;
use App\Models\Appointment;
use App\Models\Prescription;
use App\Models\MedicalDevice;
use App\Models\BookAppointment;
use App\Models\DoctorDepartment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Mail\Events\MessageSent;

class AuthController extends Controller
{
    public function redirect()
    {
        if (Auth::user()->role == 3) {
            $messages = Message::where(function ($query) {
                $query->where('to', Auth::user()->id)->where('is_read', 0)->orderByDesc('created_at');
            })->get();
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
            $appointmentTodays = Appointment::WhereDate('end_time', $today)->get();
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
                'medicalDevices',
                'messages'
            ));
        } else if(Auth::user()->role == 1 || Auth::user()->role == 2) {
            $today = now()->toDateString();
            $messages = Message::where(function ($query) {
                $query->where('to', Auth::user()->id)->where('is_read', 0)->orderByDesc('created_at');
            })->get();
            $appointmentTodays = Appointment::WhereDate('end_time', $today)->get();
            $bookAppointmentTodays = BookAppointment::WhereBetWeen('experted_time',[now()->subDay(), now()->addDays(10)])->get();
            
            return view('admin.home', compact('messages', 'appointmentTodays', 'bookAppointmentTodays'));
        } else {
            return redirect()->back();
        }
    }
}
