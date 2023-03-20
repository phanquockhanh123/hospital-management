<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Http\Request;
use App\Models\RequestDevice;
use App\Models\MedicalDevice;
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

        $search = $request->input('search');

        if ($search) {
            $request_devices = RequestDevice::where('id', 'LIKE', '%' . $search . '%')
                ->orderByDesc('created_at')->paginate(config('const.perPage'));
        } else {
            $request_devices = RequestDevice::orderByDesc('created_at')->paginate(config('const.perPage'));
        }
        $requestDeviceReturns = RequestDevice::where('return_time' , '<=', now())->get();

        foreach($requestDeviceReturns as $requestDeviceReturn)
        {
            $requestDeviceReturn->medicalDevice->update([
                'quantity' =>$requestDeviceReturn->medicalDevice->quantity + $requestDeviceReturn->quantity,
                'status' => RequestDevice::STATUS_RETURNED
            ]);

        }
        
        return view('admin.request_devices.index', compact('request_devices'));
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
            'medical_device_id' => 'required|exists:medical_devices,id,deleted_at,NULL',
            'patient_id'  => 'required|exists:patients,id,deleted_at,NULL',
            'quantity' => 'required|integer',
            'borrow_time' => 'required',
            'return_time'=> 'required',
            'description' => 'nullable|string|max:255',
        ]);

        $doctor =  Doctor::where('email', Auth::user()->email)->first();
        $validatedData['status'] = RequestDevice::STATUS_BORROWING;
        $validatedData['doctor_id'] =$doctor->id;
        $requestDevice = RequestDevice::create($validatedData);
        $medicalDevice = $requestDevice->medicalDevice;
        // Catch error quantity in db less than $params 
        // if($medicalDevice->quantity < $validatedData['quantity']) {

        // }
        $medicalDevice->update([
            'quantity' => $medicalDevice->quantity - $validatedData['quantity'],
        ]);

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

        return view('admin.request_devices.show', compact('request_device'));
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
        return view('admin.request_devices.edit', compact('request_device', 'patients', 'medicalDevices'));
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
            'medical_device_id' => 'required|exists:medical_devices,id,deleted_at,NULL',
            'patient_id'  => 'required|exists:patients,id,deleted_at,NULL',
            'quantity' => 'required|integer',
            'borrow_time' => 'required',
            'return_time'=> 'required',
            'description' => 'nullable|string|max:255',
        ]);
        $validatedData['status'] = RequestDevice::STATUS_BORROWING;
        $validatedData['doctor_id'] = Doctor::where('email', Auth::user()->email)->first()->id;
        $request_device->update($validatedData);

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
