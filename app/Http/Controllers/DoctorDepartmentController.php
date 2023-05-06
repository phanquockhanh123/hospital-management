<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\DoctorDepartment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DoctorDepartmentController extends Controller
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
            $doctorDepartments = DoctorDepartment::where('name', 'LIKE', '%' . $search . '%')
                ->orderByDesc('created_at')->paginate(config('const.perPage'));
        } else {
            $doctorDepartments = DoctorDepartment::orderByDesc('created_at')->paginate(config('const.perPage'));
        }

        $appointment = Appointment::whereBetween('end_time', [now(), now()->addHours(1)])->first();
        if ($appointment) {
            DoctorDepartment::where('id', $appointment->doctor_department_id)->update([
                'status' => DoctorDepartment::STATUS_BUSY,
                'description' => 'Phòng sẽ kết thúc trong ' . $appointment->end_time->diffForHumans()
            ]);
        }
        return view('admin.doctor_departments.index', compact('doctorDepartments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('admin.doctor_departments.create');
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
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
        ]);
        $validatedData['status'] = DoctorDepartment::STATUS_FREE;

        DB::beginTransaction();
        try {
            DoctorDepartment::create($validatedData);
            DB::commit();
        } catch (\Exception $error) {
            DB::rollback();
            Log::error($error);
            return [Response::HTTP_INTERNAL_SERVER_ERROR, ['message' => [trans('messages.MsgErr006')]]];
        }

        return redirect()->route('doctor_departments.index')
            ->with('success', 'Phòng ban đã được tạo thành công.');
    }

    /**
     * Display the specified resource.
     *
     * @param  DoctorDepartment $doctorDepartment
     * @return \Illuminate\Http\Response
     */
    public function show(DoctorDepartment $doctorDepartment)
    {
        return view('admin.doctor_departments.show', compact('doctorDepartment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  DoctorDepartment $doctorDepartment
     * @return \Illuminate\Http\Response
     */
    public function edit(DoctorDepartment $doctorDepartment)
    {
        return view('admin.doctor_departments.edit', compact('doctorDepartment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  DoctorDepartment $doctorDepartment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DoctorDepartment $doctorDepartment)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
        ]);
        $validatedData['status'] = DoctorDepartment::STATUS_FREE;

        DB::beginTransaction();
        try {
            $doctorDepartment->update($validatedData);
            DB::commit();
        } catch (\Exception $error) {
            DB::rollback();
            Log::error($error);
            return [Response::HTTP_INTERNAL_SERVER_ERROR, ['message' => [trans('messages.MsgErr006')]]];
        }


        return redirect()->route('doctor_departments.index')
            ->with('success', 'Thông tin phòng ban đã được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  DoctorDepartment $doctorDepartment
     * @return \Illuminate\Http\Response
     */
    public function destroy(DoctorDepartment $doctorDepartment)
    {
        DB::beginTransaction();
        try {
            $doctorDepartment->delete();
            DB::commit();
        } catch (\Exception $error) {
            DB::rollback();
            Log::error($error);
            return [Response::HTTP_INTERNAL_SERVER_ERROR, ['message' => [trans('messages.MsgErr006')]]];
        }

        return redirect()->route('doctor_departments.index')
            ->with('success', 'Phòng ban đã được xoá thành công.');
    }
}
