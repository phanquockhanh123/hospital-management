<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    
    public function index() {
        $attendances = Attendance::with('user')->whereDay('login_time', now()->day)->paginate(config('const.perPage'));
        $count =1;
        return view('admin.attendances.index', compact('attendances', 'count'));
    }
}
