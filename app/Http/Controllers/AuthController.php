<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function redirect()
    {
        if (Auth::id()) {
            $countUsers = User::where('status', User::STATUS_ACTIVE)->count();
            $countPatients = Patient::count();
            $countDoctors = Doctor::where('status', Doctor::STATUS_ACTIVE)->count();
            $countAppointments = Appointment::where('end_time', '<=', now()->addDay()->format('Y-m-d'))
            ->where('start_time', '>=', now()->subDay()->format('Y-m-d'))->count();

        return view('admin.home', compact('countUsers', 'countPatients', 'countDoctors', 'countAppointments'));
        } else {
            return redirect()->back();
        }
    }

}
