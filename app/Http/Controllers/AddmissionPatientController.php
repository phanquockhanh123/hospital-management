<?php

namespace App\Http\Controllers;

use App\Models\Bed;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Http\Request;
use App\Models\AddmissionPatient;

class AddmissionPatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $patientSearch = Patient::where('name',  'LIKE', '%' . $search . '%')->get();

        if ($patientSearch && $search) {
            foreach ($patientSearch as $patient) {
                $addmissionPatients = AddmissionPatient::where('patient_id', $patient->id)
                    ->orderByDesc('created_at')->paginate(config('const.perPage'));
            }
        } else {
            $addmissionPatients = AddmissionPatient::orderByDesc('created_at')->paginate(config('const.perPage'));
        }
        return view('admin.addmission_patients.index', compact('addmissionPatients'));
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
        $beds = Bed::all();
        return view('admin.addmission_patients.create', compact('doctors', 'patients', 'beds'));
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
            'doctor_id' => 'nullable',
            'patient_id' => 'nullable',
            'bed_id' => 'nullable',
            'addmission_date' => 'required',
            'reason'  => 'nullable',
            'health_condition' => 'nullable',
            'guardian_name' => 'nullable',
            'guardian_relation' => 'nullable',
            'guardian_contact' => 'nullable',
            'guardian_address' => 'nullable',
            'description' => 'nullable',
        ]);
        $validatedData['status'] = AddmissionPatient::STATUS_PENDING;
        AddmissionPatient::create($validatedData);

        return redirect()->route('addmission_patients.index')
            ->with('success', 'Thêm mới bệnh án đã được tạo thành công.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(AddmissionPatient $addmission_patient)
    {
        return view('admin.addmission_patients.show', compact('addmission_patient'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  AddmissionPatient  $addmission_patient
     * @return \Illuminate\Http\Response
     */
    public function edit(AddmissionPatient $addmission_patient)
    {
        $doctors = Doctor::all();
        $patients = Patient::all();
        $beds = Bed::all();
        return view('admin.addmission_patients.edit', compact('addmission_patient', 'doctors', 'patients', 'beds'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  AddmissionPatient  $addmission_patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AddmissionPatient $addmission_patient)
    {
        $validatedData = $request->validate([
            'doctor_id' => 'nullable',
            'patient_id' => 'nullable',
            'bed_id' => 'nullable',
            'addmission_date' => 'required',
            'reason'  => 'nullable',
            'health_condition' => 'nullable',
            'guardian_name' => 'nullable',
            'guardian_relation' => 'nullable',
            'guardian_contact' => 'nullable',
            'guardian_address' => 'nullable',
            'description' => 'nullable',
        ]);
        $addmission_patient->update($validatedData);
        return redirect()->route('addmission_patients.index')
            ->with('success', 'Thông tin bệnh án đã được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  AddmissionPatient  $addmission_patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(AddmissionPatient $addmission_patient)
    {
        $addmission_patient->delete();

        return redirect()->route('addmission_patients.index')
            ->with('success', 'Bệnh án đã được xoá thành công.');
    }
}
