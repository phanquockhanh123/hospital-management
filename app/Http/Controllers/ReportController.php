<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MedicalDevice;

class ReportController extends Controller
{
    public function index() {

        // Số lượng thiết bị đã được kiểm định
        $devices_kiemdinh = MedicalDevice::where('status', 2)->count();

        // Số lượng thiết bị chưa được kiểm định
        $devices_chuakiemdinh = MedicalDevice::where('status',1)->count();

        // Số lần sử dụng các thiết bị theo phòng ban 

        
        return view('admin.reports.index', compact('devices_kiemdinh', 'devices_chuakiemdinh'));
    }
}
