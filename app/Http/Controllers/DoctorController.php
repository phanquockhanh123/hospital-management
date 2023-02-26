<?php

namespace App\Http\Controllers;

use App\Models\Bed;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
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
            $doctors = Doctor::where('name', 'LIKE', '%' . $search . '%')
                ->orderByDesc('created_at')->paginate(config('const.perPage'));
        } else {
            $doctors = Doctor::orderByDesc('created_at')->paginate(config('const.perPage'));
        }

        return view('admin.doctors.index', compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $beds = Bed::all();
        return view('admin.doctors.create', compact('beds'));
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
            'name' => 'required',
            'doctor_department_id' => 'required',
            'blood_group' => 'required',
            'email' => 'required',
            'designation' => 'required',
            'phone' => 'required',
            'academic_level' => 'required',
            'date_of_birth' => 'required',
            'gender' => 'required',
            'status' => 'required',
            'profile' => 'required',
            'address' => 'required',
            'identity_number' => 'required',
            'identity_card_date' => 'required',
            'identity_card_place' => 'required',
            'start_work_date' => 'required',
            'specialist' => 'required',
        ]);

         // Lưu tệp
        if ($request->hasFile('profile')) {
            $profile = $request->file('profile');
            $filename = time() . '_' . $profile->getClientOriginalName();
            $path = $profile->storeAs('public/assets/img/doctors/', $filename);
            $validatedData['profile'] = $path;
        }

        $validatedData['status'] = Doctor::STATUS_ACTIVE;

        Doctor::create($validatedData);

        return redirect()->route('doctors.index')
            ->with('success', 'Thêm mới bác sĩ đã được tạo thành công.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Doctor $doctor)
    {
        return view('admin.doctors.show', compact('doctor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Doctor $doctor)
    {
        return view('admin.doctors.edit', compact('doctor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Doctor $doctor)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'doctor_department_id' => 'required',
            'blood_group' => 'required',
            'email' => 'required',
            'designation' => 'required',
            'phone' => 'required',
            'academic_level' => 'required',
            'date_of_birth' => 'required',
            'gender' => 'required',
            'status' => 'required',
            'profile' => 'required',
            'address' => 'required',
            'identity_number' => 'required',
            'identity_card_date' => 'required',
            'identity_card_place' => 'required',
            'start_work_date' => 'required',
            'specialist' => 'required',
        ]);

        $doctor->update($validatedData);

        return redirect()->route('doctors.index')
            ->with('success', 'Thông tin bác sĩ đã được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doctor $doctor)
    {
        $doctor->delete();

        return redirect()->route('doctors.index')
            ->with('success', 'Bác sĩ đã được xoá thành công.');
    }
}
