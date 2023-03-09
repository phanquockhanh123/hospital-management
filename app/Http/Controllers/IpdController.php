<?php

namespace App\Http\Controllers;

use App\Models\Bed;
use App\Models\Ipd;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Http\Request;

class IpdController extends Controller
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
                $ipds = Ipd::where('patient_id', $patient->id)
                    ->orderByDesc('created_at')->paginate(config('const.perPage'));
            }
        } else {
            $ipds = Ipd::orderByDesc('created_at')->paginate(config('const.perPage'));
        }
        return view('admin.ipds.index', compact('ipds'));
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
        return view('admin.ipds.create', compact('doctors', 'patients', 'beds'));
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
            'patient_id' => 'required',
            'doctor_id' => 'required',
            'bed_id' => 'required',
            'blood_group' => 'nullable',
            'height' => 'nullable',
            'weight' => 'nullable',
            'blood_pressure' => 'nullable',
            'addmission_date' => 'nullable',
            'symptoms' => 'nullable',
            'notes' => 'nullable',
            'patient_status' => 'required'
        ]);
        $validatedData['is_old_patient'] = Ipd::PATIENT_NEW;
        // check  new/old patient
        if (Patient::findOrFail($validatedData['patient_id'])
            ->created_at->addYear()->lt(now())
        ) {
            $validatedData['is_old_patient'] = Ipd::PATIENT_OLD;
        }
        $validatedData['ipd_code'] = Ipd::generateNextCode();

        Ipd::create($validatedData);

        return redirect()->route('ipds.index')
            ->with('success', 'Bệnh nhân nhập/xuất đã được tạo thành công.');
    }

    /**
     * Display the specified resource.
     *
     * @param  Ipd $ipd
     * @return \Illuminate\Http\Response
     */
    public function show(Ipd $ipd)
    {
        return view('admin.ipds.show', compact('ipd'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Ipd $ipd
     * @return \Illuminate\Http\Response
     */
    public function edit(Ipd $ipd)
    {
        $doctors = Doctor::all();
        $patients = Patient::all();
        $beds = Bed::all();
        return view('admin.ipds.edit', compact('ipd', 'doctors', 'patients', 'beds'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Ipd $ipd
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ipd $ipd)
    {
        $validatedData = $request->validate([
            'patient_id' => 'required',
            'doctor_id' => 'required',
            'bed_id' => 'required',
            'blood_group' => 'nullable',
            'height' => 'nullable',
            'weight' => 'nullable',
            'blood_pressure' => 'nullable',
            'addmission_date' => 'nullable',
            'symptoms' => 'nullable',
            'notes' => 'nullable',
            'patient_status' => 'required'
        ]);

        $ipd->update($validatedData);

        return redirect()->route('ipds.index')
            ->with('success', 'Bệnh nhân nhập/xuất đã được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Ipd $ipd
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ipd $ipd)
    {
        $ipd->delete();

        return redirect()->route('ipds.index')
            ->with('success', 'Bệnh nhân nhập/xuất đã được xoá thành công.');
    }
}
