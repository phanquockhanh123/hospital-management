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

        // Chuyển đổi dữ liệu thành định dạng cho biểu đồ
        $dataDeviceTable = [
            ['Trạng thái', 'Số lượng'],
            ['Đã kiểm định', $devices_kiemdinh],
            ['Chưa kiểm định', $devices_chuakiemdinh]
        ];

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

        // Lấy danh sách phòng ban từ bảng doctor_departments
        $departments = DoctorDepartment::all();

        $dataBill = [
            ['Phòng ban', 'Thu nhập'],
        ];

        foreach ($departments as $department) {
            // Tìm hóa đơn thuộc phòng ban hiện tại và tính tổng số tiền
            $totalRevenue = Bill::join('diagnosis', 'bills.diagnosis_id', '=', 'diagnosis.id')
                        ->join('doctors', 'diagnosis.doctor_id', '=', 'doctors.id')
                        ->join('doctor_departments', 'doctors.doctor_department_id', '=', 'doctor_departments.id')
                        ->where('doctor_departments.id', $department->id)
                        ->sum('bills.total_money');
        
            // Thêm dữ liệu vào mảng
            $dataBill[] = [$department->name, (float)$totalRevenue];
        }

        // Nếu một phòng ban không có thu nhập, thêm vào mảng dữ liệu với giá trị 0
        foreach ($departments as $department) {
            if (!in_array($department->name, array_column($dataBill, 0))) {
                $dataBill[] = [$department->name, 0];
            }
        }


        // Thống kê số lượt khám đến khám theo từng tháng
        $appointments = DB::table('appointments')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as total'))
            ->whereYear('created_at', '=', now()->year)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy(DB::raw('MONTH(created_at)'))
            ->get();
        $appointmentByMonths = collect(range(1, 12))->map(function ($month) use ($appointments) {
            $result = $appointments->firstWhere('month', $month);
            return [
                'month' => $month,
                'total' => $result ? $result->total : 0,
            ];
        });
        $dataTable = [
            ['Tháng', 'Số lượt khám'],
        ];
        foreach ($appointmentByMonths as $appointmentByMonth) {
            $dataTable[] = [$appointmentByMonth['month'], $appointmentByMonth['total']];
        }
        return view('admin.reports.index', compact('dataTable', 'pie3DChartData', 'now', 'dataDeviceTable', 'dataBill'));
    }
}
