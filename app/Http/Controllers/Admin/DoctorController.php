<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function getDoctorList() {
        return view('admin.doctors.get-doctor-list');
    }
}
