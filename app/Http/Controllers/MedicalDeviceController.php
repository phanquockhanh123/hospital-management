<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MedicalDevice;
use App\Models\DoctorDepartment;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class MedicalDeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $search = $request->input('search');

        $medicalDevices = MedicalDevice::where('expired_date', '<=', now())->get();

        foreach ($medicalDevices as $medicalDevice) {
            $medicalDevice->update(['status' => MedicalDevice::STATUS_WAITING]);
        }

        $doctorDepartments = DoctorDepartment::all();

        $medical_devices = MedicalDevice::with('doctorDepartment');

        if ($request['name'] != null) {
            $medical_devices->where('name', 'LIKE', '%' . $request['name'] . '%');
        }

        if ($request['status'] != null) {
            $medical_devices->where('status', 'LIKE', '%' . $request['status'] . '%');
        }
        if ($request['department_id'] != null) {
            $medical_devices->where('department_id', $request['department_id']);
        }

        $medical_devices = $medical_devices->orderByDesc('updated_at')->orderByDesc('id')->paginate(config('const.perPage'));
        $count = 1;

        return view('admin.medical_devices.index', compact('medical_devices',  'doctorDepartments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $doctorDepartments = DoctorDepartment::orderByDesc('id')->get();
        return view('admin.medical_devices.create', compact('doctorDepartments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'department_id' => 'required|integer|exists:doctor_departments,id,deleted_at,NULL',
            'name' => 'required|string|max:255',
            'description'  => 'nullable|string|max:255',
            'expired_date' => 'required',
            'quantity' => 'required|integer',
            'profile' => 'nullable',
        ]);
        $validatedData['medical_device_code'] = MedicalDevice::generateNextCode();
        $validatedData['status'] = MedicalDevice::STATUS_CENSORED;
        // Lưu ảnh
        if ($request->hasFile('profile')) {
            $profile = $request->file('profile');

            $filename = time() . '_' . $profile->getClientOriginalName();

            $path = $profile->move('imgDevices', $filename);

            $validatedData['profile'] = $path;
            $validatedData['filename'] = $filename;
        }
        MedicalDevice::create($validatedData);

        return redirect()->route('medical_devices.index')
            ->with('success', 'Thiết bị y tế đã được tạo thành công.');
    }

    /**
     * Display the specified resource.
     *
     * @param  MedicalDevice $medical_device
     * @return \Illuminate\Http\Response
     */
    public function show(MedicalDevice $medical_device)
    {

        return view('admin.medical_devices.show', compact('medical_device'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  MedicalDevice $medical_device
     * @return \Illuminate\Http\Response
     */
    public function edit(MedicalDevice $medical_device)
    {
        $doctorDepartments = DoctorDepartment::orderByDesc('id')->get();
        return view('admin.medical_devices.edit', compact('medical_device', 'doctorDepartments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  MedicalDevice $medical_device
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MedicalDevice $medical_device)
    {
        $validatedData = $request->validate([
            'department_id' => 'nullable|integer|exists:doctor_departments,id,deleted_at,NULL',
            'name' => 'nullable|string|max:255',
            'description'  => 'nullable|string|max:255',
            'expired_date' => 'nullable',
            'quantity' => 'nullable|integer',
            'profile' => 'nullable',
        ]);

        // Handle the avatar file upload
        if ($request->profile) {
            $imagePath = "./imgDevices/" . $medical_device->filename;
            // Delete the old profile file, if there is one
            if ($medical_device->profile) {
                Storage::delete($medical_device->profile);
                File::delete($imagePath);
            }

            $profile = $request->file('profile');

            $filename = time() . '_' . $profile->getClientOriginalName();
            // Store the new profile file
            $profilePath = $request->file('profile')->move('imgDevices', $filename);
            $validatedData['profile'] = $profilePath;
            $validatedData['filename'] = $filename;
        }
        $validatedData['status'] = MedicalDevice::STATUS_CENSORED;
        $medical_device->update($validatedData);

        return redirect()->route('medical_devices.index')
            ->with('success', 'Thông tin thiết bị y tế đã được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  MedicalDevice $medical_device
     * @return \Illuminate\Http\Response
     */
    public function destroy(MedicalDevice $medical_device)
    {
        $medical_device->delete();

        return redirect()->route('medical_devices.index')
            ->with('success', 'Giường bệnh đã được xoá thành công.');
    }

    public function requestDevices()
    {
    }
}
