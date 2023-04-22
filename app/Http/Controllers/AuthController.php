<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\News;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Medical;
use App\Models\Message;
use App\Models\Patient;
use App\Models\Service;
use App\Models\Diagnosis;
use App\Models\Appointment;
use App\Models\Prescription;
use App\Models\Receptionist;
use App\Models\MedicalDevice;
use App\Models\BookAppointment;
use App\Models\DoctorDepartment;
use Illuminate\Support\Facades\DB;
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
            $users = User::all();
            $today = now()->toDateString();
            $countUsers = User::where('status', User::STATUS_ACTIVE)->count();
            $countPatients = Patient::count();
            $countDoctors = Doctor::where('status', Doctor::STATUS_ACTIVE)->count();
            $countAppointments = Appointment::where('status', '!=', Appointment::STATUS_DENIED)->count();
            $countPrescriptions = Prescription::count();
            $countMedicalDevices = MedicalDevice::count();
            $countDiagnosises = Diagnosis::count();
            $countDepartments = DoctorDepartment::count();
            $countNews = News::count();
            $countMedicals = Medical::count();
            $countServices = Service::count();
            $countReceptionists = Receptionist::where('status', Receptionist::STATUS_ACTIVE)->count();
            $countBillMoney = Bill::select( DB::raw('sum(bills.total_money) as total_money'))->get();
            
            $medicalDevices = MedicalDevice::whereBetween('expired_date', [now(), now()->addDays(60)])->get();
            
            $appointmentTodays = Appointment::WhereDate('end_time', $today)->get();
            $bookAppointmentTodays = BookAppointment::WhereBetWeen('experted_time',[now()->subDay(), now()->addDays(10)])->get();

            return view('admin.home', compact(
                'countMedicals',
                'countServices',
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
                'messages',
                'bookAppointmentTodays',
                'users',
                'countReceptionists',
                'countBillMoney'
            ));
        } else if(Auth::user()->role == 1 || Auth::user()->role == 2) {
            $today = now()->toDateString();
            $users = User::all();
            $messages = Message::where(function ($query) {
                $query->where('to', Auth::user()->id)->where('is_read', 0)->orderByDesc('created_at');
            })->get();
            $appointmentTodays = Appointment::WhereDate('end_time', $today)->orderByDesc('created_at')->get();
            $bookAppointmentTodays = BookAppointment::WhereBetWeen('experted_time',[now()->subDay(), now()->addDays(10)])
                ->orderByDesc('created_at')->get();
            
            return view('admin.home', compact(
                'messages',
                 'appointmentTodays',
                  'bookAppointmentTodays',
                   'users'));
        } else {
            return redirect()->back();
        }
    }
}
