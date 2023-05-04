<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Bill;
use App\Models\Medical;
use App\Models\Service;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\DiagnosisItem;
use App\Models\MedicalDevice;
use App\Models\DoctorDepartment;
use App\Models\PrescriptionItem;
use App\Models\RequestDeviceItem;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function reportServices(Request $request)
    {
        // lấy danh sách dịch vụ trong phòng khám
        $diagnosisItems = DiagnosisItem::all();

        if ($request['start_date'] != null && $request['end_date'] != null) {
            $diagnosisItems = DiagnosisItem::whereBetween('created_at', [$request['start_date'], $request['end_date']])->get();
        } else if($request['start_date'] != null) {
            $diagnosisItems = DiagnosisItem::whereDate('created_at', '>=' ,$request['start_date'])->get();
        } else if($request['end_date'] != null) {
            $diagnosisItems = DiagnosisItem::whereDate('created_at', '<=' ,$request['end_date'])->get();
        }

        $services = Service::all();
        $countMoney = 0;
        foreach ($services as $service) {
            $countMoney += $service->all_price * $diagnosisItems->where('service_id', $service->id)->count();
        }
        $now = now();
        return view('admin.reports.report_services', compact('services','diagnosisItems', 'countMoney', 'now'));
    }

    public function reportMedicals(Request $request)
    {
        // lấy danh sách dịch vụ trong phòng khám
        $prescriptionItems = PrescriptionItem::all();

        if ($request['start_date'] != null && $request['end_date'] != null) {
            $prescriptionItems = $prescriptionItems->whereBetween('created_at', [$request['start_date'], $request['end_date']]);
        } else if($request['start_date'] != null) {
            $prescriptionItems =$prescriptionItems->whereDate('created_at', '>=' ,$request['start_date']);
        } else if($request['end_date'] != null) {
            $prescriptionItems =$prescriptionItems->whereDate('created_at', '<=' ,$request['end_date']);
        }

        $medicals = Medical::all();
        $countMoney = 0;
        foreach ($medicals as $medical) {
            $countMoney += $prescriptionItems->where('medical_id', $medical->id)->sum('amount') * $medical->export_price;
        }
        $now = now();
        return view('admin.reports.report_medicals', compact('medicals','prescriptionItems', 'countMoney', 'now'));
    }
    public function reportDevices(Request $request) {
        $deviceItems = RequestDeviceItem::all();

        if ($request['start_date'] != null && $request['end_date'] != null) {
            $deviceItems = RequestDeviceItem::whereBetween('created_at', [$request['start_date'], $request['end_date']])->get();
        } else if($request['start_date'] != null) {
            $deviceItems = RequestDeviceItem::whereDate('created_at', '>=' ,$request['start_date'])->get();
        } else if($request['end_date'] != null) {
            $deviceItems = RequestDeviceItem::whereDate('created_at', '<=' ,$request['end_date'])->get();
        }

        $devices = MedicalDevice::all();
        return view('admin.reports.report_devices', compact('devices','deviceItems'));
    }
}
