<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Doctor;
use App\Models\Salary;
use App\Models\Diagnosis;
use App\Models\Attendance;
use App\Models\Prescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SalaryController extends Controller
{
    public function index()
    {
        $attendances = Attendance::select('user_id', DB::raw('YEAR(logout_time) as year'), DB::raw('MONTH(logout_time) as month'), DB::raw('COUNT(*) as days_worked'))
            ->groupBy('user_id', DB::raw('YEAR(logout_time)'), DB::raw('MONTH(logout_time)'))
            ->paginate(config('const.perPage'));

        $dataSalaries = array_map(function ($attendance) {
            $user = User::where('id', $attendance['user_id'])->first();
            $roleUser = $user->role;
            $doctor = Doctor::where('email', $user->email)->first();
            if ($doctor) {
                $countDiagnosis = Diagnosis::where('doctor_id', $doctor->id)->count();
                $countPrescriptions = Prescription::where(function ($query) use ($doctor) {
                    $query->where('diagnosis_id',  Diagnosis::where('doctor_id', $doctor->id)->first()?->id);
                })->count();
                $countExamination =  $countDiagnosis * 20000 + $countPrescriptions * 10000;
            }

            return [
                'user_id' => $attendance['user_id'],
                'day_worked' => $attendance['days_worked'],
                'salary' => ($roleUser == 2)
                    ? (8000000 * $attendance['days_worked'] / 30)
                    : (5000000 * $attendance['days_worked'] / 30),
                'allowance' => $attendance['days_worked'] * 50000
                    + (($roleUser == 2) ? 500000 : 300000)
                    + (($roleUser == 2) ? $countExamination : 0)
            ];
        }, $attendances->toArray()['data']);
        Salary::insert($dataSalaries);

        $salaries = Salary::paginate(config('const.perPage'));
        $count = 1;
        return view('admin.salaries.index', compact('salaries', 'count'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Salary $salary
     * @return \Illuminate\Http\Response
     */
    public function payment(Salary $salary)
    {
        $salary->update([
            'status' => Salary::STATUS_PAYMENT
        ]);
        return redirect()->route('salaries.index')
            ->with('success', 'Hóa đơn đã được thanh toán thành công.');
    }
}
