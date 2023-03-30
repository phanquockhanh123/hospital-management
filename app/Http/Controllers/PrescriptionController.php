<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Patient;
use PDF;
use App\Models\Prescription;
use Illuminate\Http\Request;
use App\Models\PrescriptionItem;


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
            'medical_name' => 'required|array',
            'dosage' => 'required|array',
            'dosage_note' => 'required|array',
            'unit' => 'required|array',
            'amount' => 'required|array',
            'note' => 'nullable|string|max:1000',
        ]);
        $prescription = Prescription::create([
            'doctor_id' => $request->doctor_id,
            'patient_id' => $request->patient_id,
            'main_disease' => $request->main_disease,
            'side_disease' => $request->side_disease,
            'note' => $request->note,
        ]);
        
        $data = [
            "medical_name" => array_values($validatedData['medical_name']),
            "dosage" => array_values($validatedData['dosage']),
            "dosage_note" => array_values($validatedData['dosage_note']),
            "unit" => array_values($validatedData['unit']),
            "amount" => array_values($validatedData['amount']),
        ];
        
        $newArrays = array();
        foreach ($data as $key => $values) {
            $i = 0;
            foreach ($values as $value) {
                $newArrays[$i][$key] = $value;
                $i++;
            }
        }
        $prescriptionItemData = array_map(function ($preItem) use ($prescription) {
            $preItem['prescription_id'] = $prescription->id;
            return $preItem;
        }, $newArrays);
        PrescriptionItem::insert($prescriptionItemData);

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
        $preItem = PrescriptionItem::where('prescription_id', $prescription->id)->get()->toArray();
        return view('admin.prescriptions.show', compact('prescription', 'preItem'));
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
        $preItem = PrescriptionItem::where('prescription_id', $prescription->id)->get()->toArray();
        return view('admin.prescriptions.edit', compact('prescription', 'doctors', 'patients', 'preItem'));
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
            'medical_name' => 'required|array',
            'dosage' => 'required|array',
            'dosage_note' => 'required|array',
            'unit' => 'required|array',
            'amount' => 'required|array',
            'note' => 'nullable|string|max:1000',
        ]);
        $prescription->update([
            'doctor_id' => $request->doctor_id,
            'patient_id' => $request->patient_id,
            'main_disease' => $request->main_disease,
            'side_disease' => $request->side_disease,
            'note' => $request->note,
        ]);
        
        $data = [
            "medical_name" => array_values($validatedData['medical_name']),
            "dosage" => array_values($validatedData['dosage']),
            "dosage_note" => array_values($validatedData['dosage_note']),
            "unit" => array_values($validatedData['unit']),
            "amount" => array_values($validatedData['amount']),
        ];
        $prescriptionItem = PrescriptionItem::where('prescription_id', $prescription->id)->delete();

        $newArrays = array();
        foreach ($data as $key => $values) {
            $i = 0;
            foreach ($values as $value) {
                $newArrays[$i][$key] = $value;
                $i++;
            }
        }
        $prescriptionItemData = array_map(function ($preItem) use ($prescription) {
            $preItem['prescription_id'] = $prescription->id;
            return $preItem;
        }, $newArrays);
        PrescriptionItem::insert($prescriptionItemData);
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

    /**
     * render pdf a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function renderPdf(Request $request, Prescription $prescription)
    {
        $prescription = Prescription::with('patient', 'doctor')->first();
        $preItem = PrescriptionItem::where('prescription_id', $prescription->id)->get()->toArray();
        
        $pdf = \PDF::loadView('pdf.prescription', compact('prescription', 'preItem'), []);
        $pdf->setPaper('a4', 'portrait', 'UTF-8');
        return $pdf->stream('prescription.pdf');
    }

}
