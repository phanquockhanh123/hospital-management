<?php

namespace App\Http\Controllers;

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
        $doctor = Doctor::where('email', Auth::user()->email)->first();
        $countDiagnosis = Diagnosis::where('doctor_id', $doctor->id)->count();
        $countPrescriptions = Prescription::where(function ($query) use ($doctor) {
            $query->where('diagnosis_id',  Diagnosis::where('doctor_id', $doctor->id)->first()?->id);
        })->count();
        $countExamination =  $countDiagnosis * 20000 + $countPrescriptions * 10000;
        $dataSalaries = array_map(function ($attendance) use ($countExamination) {
            return [
                'user_id' => Auth::user()->id,
                'day_worked' => $attendance['days_worked'],
                'salary' => (Auth::user()->role == 2)
                    ? (8000000 * $attendance['days_worked'] / 30)
                    : (5000000 * $attendance['days_worked'] / 30),
                'allowance' => $attendance['days_worked'] * 50000
                    + ((Auth::user()->role == 2) ? 500000 : 300000)
                    + ((Auth::user()->role == 2) ? $countExamination : 0),
                'total_salary' => $attendance['days_worked'] * 50000 + (Auth::user()->role == 2) ? 6000000 : 3000000
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
