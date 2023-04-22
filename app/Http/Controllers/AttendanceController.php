<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{

    public function index()
    {
        $attendances = Attendance::with('user')->whereDay('login_time', now()->day)->paginate(config('const.perPage'));
        $count = 1;
        foreach ($attendances as $attendance) {
            $hour_worked = floor(abs(strtotime($attendance->logout_time) - strtotime($attendance->login_time)) / (60 * 60));
            if ($hour_worked > 12) {
                $hour_worked = 8;
            }
            if (empty($attendance->logout_time)) {
                $hour_worked = 4;
            }
            $attendance->update(['hour_worked' => $hour_worked]);
        }

        return view('admin.attendances.index', compact('attendances', 'count'));
    }
}
