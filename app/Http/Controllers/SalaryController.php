<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Doctor;
use App\Models\Salary;
use App\Models\Diagnosis;
use App\Models\Attendance;
use App\Models\Prescription;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class SalaryController extends Controller
{
    public function index()
    {
        $countExamination = 0;
        $attendances = Attendance::select('user_id', DB::raw('sum(hour_worked)/8 as day_worked'))
            ->whereMonth('logout_time', now()->month)
            ->groupBy('user_id')
            ->paginate(config('const.perPage'));
        foreach ($attendances as $attendance) {
            $user = User::where('id', $attendance->user_id)->first();
            $roleUser = $user->role;
            $doctor = Doctor::where('email', $user->email)->first();
            if ($doctor) {
                $countDiagnosis = Diagnosis::where('doctor_id', $doctor->id)->count();
                $countPrescriptions = Prescription::where(function ($query) use ($doctor) {
                    $query->where('diagnosis_id',  Diagnosis::where('doctor_id', $doctor->id)->first()?->id);
                })->count();
                $countExamination =  $countDiagnosis * 20000 + $countPrescriptions * 10000;
            }
            $salaryUser = ($roleUser == 2)
                ? floor((8000000 * $attendance->day_worked / 30))
                : floor((5000000 * $attendance->day_worked / 30));

            $allowance = $attendance['days_worked'] * 50000
                + (($roleUser == 2) ? 500000 : 300000)
                + (($roleUser == 2) ? $countExamination : 0);

            $salary = Salary::where('user_id', $attendance->user_id)->first();
            DB::beginTransaction();
            try {
                if ($salary) {
                    $salary->update([
                        'day_worked' => $attendance->day_worked ?? 0,
                        'salary' => $salaryUser,
                        'allowance' => $allowance
                    ]);
                } else {
                    Salary::create([
                        'user_id' => $attendance->user_id,
                        'day_worked' => $attendance->day_worked ?? 0,
                        'salary' => $salaryUser,
                        'allowance' => $allowance,
                        'status' => Salary::STATUS_NO_PAYMENT
                    ]);
                }
                DB::commit();
            } catch (\Exception $error) {
                DB::rollback();
                Log::error($error);
                return [Response::HTTP_INTERNAL_SERVER_ERROR, ['message' => [trans('messages.MsgErr006')]]];
            }
        }
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
        DB::beginTransaction();
        try {
            $salary->update([
                'status' => Salary::STATUS_PAYMENT
            ]);
            DB::commit();
        } catch (\Exception $error) {
            DB::rollback();
            Log::error($error);
            return [Response::HTTP_INTERNAL_SERVER_ERROR, ['message' => [trans('messages.MsgErr006')]]];
        }

        return redirect()->route('salaries.index')
            ->with('success', 'Hóa đơn đã được thanh toán thành công.');
    }
}
