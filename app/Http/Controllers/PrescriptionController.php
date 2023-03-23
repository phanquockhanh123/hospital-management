<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Prescription;
use Illuminate\Http\Request;


class PrescriptionController extends Controller
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
            $prescriptions = Prescription::where('id', 'LIKE', '%' . $search . '%')
                ->orderByDesc('created_at')->paginate(config('const.perPage'));
        } else {
            $prescriptions = Prescription::orderByDesc('created_at')->paginate(config('const.perPage'));
        }
        $count = 1;
        return view('admin.prescriptions.index', compact('prescriptions', 'count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $doctors = Doctor::all();
        $patients = Patient::all();
        return view('admin.prescriptions.create', compact('doctors', 'patients'));
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
            'doctor_id' => 'nullable|integer|exists:doctors,id,deleted_at,NULL',
            'patient_id' => 'nullable|integer|exists:patients,id,deleted_at,NULL',
            'main_disease' => 'required|string|max:255',
            'side_disease' => 'nullable|string|max:255',
            'medical_name' => 'required|string|max:255',
            'dosage' => 'required|integer|max:255',
            'dosage_note' => 'required|string|max:255',
            'unit' => 'required|string|max:255',
            'amount' => 'required|integer|max:255',
            'note' => 'nullable|string|max:1000',
        ]);

        Prescription::create($validatedData);


        return redirect()->route('prescriptions.index')
            ->with('success', 'Đơn thuốc đã được tạo thành công.');
    }

    /**
     * Display the specified resource.
     *
     * @param  Prescription $prescription
     * @return \Illuminate\Http\Response
     */
    public function show(Prescription $prescription)
    {
        return view('admin.prescriptions.show', compact('prescription'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Prescription $prescription
     * @return \Illuminate\Http\Response
     */
    public function edit(Prescription $prescription)
    {
        $doctors = Doctor::all();
        $patients = Patient::all();
        return view('admin.prescriptions.edit', compact('prescription', 'doctors', 'patients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Prescription $prescription
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prescription $prescription)
    {
        $validatedData = $request->validate([
            'doctor_id' => 'nullable|integer|exists:doctors,id,deleted_at,NULL',
            'patient_id' => 'nullable|integer|exists:patients,id,deleted_at,NULL',
            'main_disease' => 'required|string|max:255',
            'side_disease' => 'nullable|string|max:255',
            'medical_name' => 'required|string|max:255',
            'dosage' => 'required|integer|max:255',
            'dosage_note' => 'required|string|max:255',
            'unit' => 'required|string|max:255',
            'amount' => 'required|integer|max:255',
            'note' => 'nullable|string|max:1000',
        ]);

        $prescription->update($validatedData);

        return redirect()->route('prescriptions.index')
            ->with('success', 'Thông tin đơn thuốc đã được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Prescription $prescription
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prescription $prescription)
    {
        $prescription->delete();

        return redirect()->route('prescriptions.index')
            ->with('success', 'Đơn thuốc đã được xoá thành công.');
    }

}
