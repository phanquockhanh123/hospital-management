<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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
            $countBillMoney = Bill::select(DB::raw('sum(bills.total_money) as total_money'))->get();

            $medicalDevices = MedicalDevice::whereBetween('expired_date', [now(), now()->addDays(60)])->get();

            $appointmentTodays = Appointment::WhereDate('end_time', $today)->get();
            $bookAppointmentTodays = BookAppointment::WhereBetWeen('experted_time', [now()->subDay(), now()->addDays(10)])->get();

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
                'countBillMoney',
                'dataTable',
                'pie3DChartData',
                'now',
                'dataDeviceTable',
                'dataBill'
            ));
        } else if (Auth::user()->role == 1 || Auth::user()->role == 2) {
            $today = now()->toDateString();
            $users = User::all();
            $messages = Message::where(function ($query) {
                $query->where('to', Auth::user()->id)->where('is_read', 0)->orderByDesc('created_at');
            })->get();
            $appointmentTodays = Appointment::WhereDate('end_time', $today)->orderByDesc('created_at')->get();
            $bookAppointmentTodays = BookAppointment::WhereBetWeen('experted_time', [now()->subDay(), now()->addDays(10)])
                ->orderByDesc('created_at')->get();

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

            return view('admin.home', compact(
                'messages',
                'appointmentTodays',
                'bookAppointmentTodays',
                'users',
                'dataTable',
                'pie3DChartData',
                'now',
                'dataDeviceTable',
                'dataBill'
            ));
        } else {
            return redirect()->back();
        }
    }
}
