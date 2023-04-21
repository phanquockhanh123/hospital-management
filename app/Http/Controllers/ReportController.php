<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Bill;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\MedicalDevice;
use App\Models\DoctorDepartment;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {

        // Số lượng thiết bị đã được kiểm định
        $devices_kiemdinh = MedicalDevice::where('status', 2)->count();

        // Số lượng thiết bị chưa được kiểm định
        $devices_chuakiemdinh = MedicalDevice::where('status', 1)->count();

        // Số lần sử dụng các thiết bị theo phòng ban

        // Số lượng bệnh nhân theo từng phòng ban

        $currentMonth = Carbon::now()->format('m'); // Lấy tháng hiện tại
        $currentYear = Carbon::now()->format('Y'); // Lấy năm hiện tại
        $appointmentByDeparments = Appointment::with('doctorDepartment')->whereBetween('end_time', ["$currentYear-$currentMonth-01", "$currentYear-$currentMonth-31"])
            ->select('doctor_department_id', DB::raw('count(*) as total_visits'))->groupBy('doctor_department_id')->get();

        $pie3DChartData = "";
        foreach ($appointmentByDeparments as $appointmentByDeparment) {
            $pie3DChartData .= "[
                '" . $appointmentByDeparment->doctorDepartment->name . "',
                " . $appointmentByDeparment->total_visits . "],";
        }
        $now = now();
        $pie3DChartData = rtrim($pie3DChartData, ",");


        // Thống kê tồng tiên thu được từ hóa đơn theo phòng ban
        $billByDeparments = Bill::join('diagnosis', 'bills.diagnosis_id', '=', 'diagnosis.id')
            ->join('doctors', 'diagnosis.patient_id', '=', 'doctors.id')
            ->join('doctor_departments', 'doctors.doctor_department_id', '=', 'doctor_departments.id')
            ->select('doctor_departments.name as department_name', DB::raw('sum(bills.total_money) as total_money'))
            ->groupBy('doctor_departments.id')
            ->get();
        $count =1;
        return view('admin.reports.index', compact('devices_kiemdinh', 'devices_chuakiemdinh', 'pie3DChartData', 'count', 'now', 'billByDeparments'));
    }
}
