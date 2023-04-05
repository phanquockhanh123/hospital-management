<?php

namespace App\Http\Controllers;

use App\Models\Medical;
use Illuminate\Http\Request;
use App\Models\MedicalDevice;
use App\Models\DoctorDepartment;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class MedicalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $search = $request->input('search');

        $medicals = Medical::all();

        if ($search) {
            $medicals = Medical::where('medical_code', 'LIKE', '%' . $search . '%')
                ->orderByDesc('created_at')->paginate(config('const.perPage'));
        } else {
            $medicals = Medical::orderByDesc('created_at')->paginate(config('const.perPage'));
        }

        return view('admin.medicals.index', compact('medicals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $doctorDepartments = DoctorDepartment::orderByDesc('id')->get();
        return view('admin.medicals.create', compact('doctorDepartments'));
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
            'medical_name' => 'required|string|max:255',
            'unit'  => 'nullable|string|max:255',
            'use' => 'required|string|max:255',
            'quantity' => 'required|integer',
            'import_price' => 'required|integer',
            'export_price' => 'required|integer',
            'amount_day' => 'required|integer',
            'description' => 'required|string|max:255',
        ]);
        $validatedData['medical_code'] = Medical::generateNextCode();
        Medical::create($validatedData);

        return redirect()->route('medicals.index')
            ->with('success', 'Thuốc đã được tạo thành công.');
    }

    /**
     * Display the specified resource.
     *
     * @param  Medical $medical
     * @return \Illuminate\Http\Response
     */
    public function show(Medical $medical)
    {

        return view('admin.medicals.show', compact('medical'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Medical $medical
     * @return \Illuminate\Http\Response
     */
    public function edit(Medical $medical)
    {
        $doctorDepartments = DoctorDepartment::orderByDesc('id')->get();
        return view('admin.medicals.edit', compact('medical', 'doctorDepartments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Medical $medical
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Medical $medical)
    {
        $validatedData = $request->validate([
            'department_id' => 'required|integer|exists:doctor_departments,id,deleted_at,NULL',
            'medical_name' => 'required|string|max:255',
            'unit'  => 'nullable|string|max:255',
            'use' => 'required|string|max:255',
            'quantity' => 'required|integer',
            'import_price' => 'required|integer',
            'export_price' => 'required|integer',
            'amount_day' => 'required|integer',
            'description' => 'required|string|max:255',
        ]);

        $medical->update($validatedData);

        return redirect()->route('medicals.index')
            ->with('success', 'Thông tin thuốc đã được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Medical $medical
     * @return \Illuminate\Http\Response
     */
    public function destroy(Medical $medical)
    {
        $medical->delete();

        return redirect()->route('medicals.index')
            ->with('success', 'Thuốc đã được xoá thành công.');
    }
}
