<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Http\Request;
use App\Models\RequestDevice;
use App\Models\MedicalDevice;
use App\Models\RequestDeviceItem;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\DataCollector\RequestDataCollector;

class RequestDeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $doctors = Doctor::orderByDesc('created_at')->get();
        $patients = Patient::orderByDesc('created_at')->get();
       
        // Search
        $request_devices = RequestDevice::with('patient', 'doctor');

        if($request['patient_id'] != null) {
            $request_devices->where('patient_id', $request['patient_id']);
        }

        if($request['status'] != null) {
            $request_devices->where('status', $request['status']);
        }

        $request_devices = $request_devices->orderByDesc('updated_at')->orderByDesc('id')->paginate(config('const.perPage'));
        // Update status borrow medical devices
        // $requestDeviceReturns = RequestDevice::where('doctor_id', Auth::user()->doctor->id)->where('return_time' , '<=', now())->get();

        // foreach($requestDeviceReturns ?? [] as $requestDeviceReturn)
        // {

        //     $requestDeviceReturn->update([
        //         'quantity' =>$requestDeviceReturn->medicalDevice->quantity + $requestDeviceReturn->quantity,
        //         'status' => RequestDevice::STATUS_RETURNED
        //     ]);

        // }
        $count =1;
        return view('admin.request_devices.index', compact('request_devices', 'count', 'doctors', 'patients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $patients = Patient::orderByDesc('id')->get();
        $medicalDevices = MedicalDevice::where('quantity', '>', 0)
            ->where('status', MedicalDevice::STATUS_CENSORED)
            ->where('expired_date', '>=', now())->orderByDesc('id')->get();
        return view('admin.request_devices.create', compact('patients', 'medicalDevices'));
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
            'patient_id' => 'nullable|integer|exists:patients,id,deleted_at,NULL',
            'borrow_time' => 'nullable',
            'return_time' => 'nullable',
            'medical_device_id' => 'required|array',
            'quantity' => 'required|array',
            'description' => 'nullable|array',
        ]);
        $validatedData['status'] = RequestDevice::STATUS_BORROWING;
        $validatedData['doctor_id'] = Auth::user()->doctor->id;

        $requestDevice = RequestDevice::create($validatedData);

        $data = [
            "medical_device_id" => array_values($validatedData['medical_device_id']),
            "quantity" => array_values($validatedData['quantity']),
            "description" => array_values($validatedData['description']),
        ];

        $newArrays = array();
        foreach ($data as $key => $values) {
            $i = 0;
            foreach ($values as $value) {
                $newArrays[$i][$key] = $value;
                $i++;
            }
        }

        $requestDeviceItemData = array_map(function ($requestItem) use ($requestDevice) {
            $requestItem['request_device_id'] = $requestDevice->id;
            $requestItem['created_at'] = now();
            $requestItem['updated_at'] = now();
            return $requestItem;
        }, $newArrays);
        RequestDeviceItem::insert($requestDeviceItemData);

        

        return redirect()->route('request_devices.index')
            ->with('success', 'Yêu câu mượn y tế đã được tạo thành công.');
    }

    /**
     * Display the specified resource.
     *
     * @param  RequestDevice $request_device
     * @return \Illuminate\Http\Response
     */
    public function show(RequestDevice $request_device)
    {
        $medicalDevices = MedicalDevice::where('quantity', '>', 0)
            ->where('status', MedicalDevice::STATUS_CENSORED)->orderByDesc('id')->get();
        $requestDeviceItem = RequestDeviceItem::where('request_device_id', $request_device->id)->get()->toArray();
        return view('admin.request_devices.show', compact('request_device', 'medicalDevices', 'requestDeviceItem'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  RequestDevice $request_device
     * @return \Illuminate\Http\Response
     */
    public function edit(RequestDevice $request_device)
    {
        $patients = Patient::orderByDesc('id')->get();
        $medicalDevices = MedicalDevice::where('quantity', '>', 0)
            ->where('status', MedicalDevice::STATUS_CENSORED)->orderByDesc('id')->get();
        $requestDeviceItem = RequestDeviceItem::where('request_device_id', $request_device->id)->get()->toArray();
        return view('admin.request_devices.edit', compact('request_device', 'patients', 'medicalDevices', 'requestDeviceItem'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  RequestDevice $request_device
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RequestDevice $request_device)
    {
        $validatedData = $request->validate([
            'patient_id' => 'nullable|integer|exists:patients,id,deleted_at,NULL',
            'borrow_time' => 'nullable',
            'return_time' => 'nullable',
            'medical_device_id' => 'required|array',
            'quantity' => 'required|array',
            'description' => 'nullable|array',
        ]);
        $validatedData['doctor_id'] = Auth::user()->doctor->id;

        $request_device->update([
            'doctor_id' => $validatedData['doctor_id'],
            'patient_id' => $validatedData['patient_id'],
            'borrow_time' => $validatedData['borrow_time'],
            'return_time' => $validatedData['return_time'],
        ]);

        $data = [
            "medical_device_id" => array_values($validatedData['medical_device_id']),
            "quantity" => array_values($validatedData['quantity']),
            "description" => array_values($validatedData['description']),
        ];

        RequestDeviceItem::where('request_device_id', $request_device->id)->delete();
        $newArrays = array();
        foreach ($data as $key => $values) {
            $i = 0;
            foreach ($values as $value) {
                $newArrays[$i][$key] = $value;
                $i++;
            }
        }

        $requestDeviceItemData = array_map(function ($requestItem) use ($request_device) {
            $requestItem['request_device_id'] = $request_device->id;
            $requestItem['created_at'] = now();
            $requestItem['updated_at'] = now();
            return $requestItem;
        }, $newArrays);

        RequestDeviceItem::insert($requestDeviceItemData);

        return redirect()->route('request_devices.index')
            ->with('success', 'Yêu cầu mượn thiết bị đã được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  RequestDevice $request_device
     * @return \Illuminate\Http\Response
     */
    public function destroy(RequestDevice $request_device)
    {
        $request_device->delete();

        return redirect()->route('request_devices.index')
            ->with('success', 'Yêu cầu mượn thiết bị đã được xoá thành công.');
    }

}
