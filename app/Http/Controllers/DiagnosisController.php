<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Patient;
use PDF;
use App\Models\Diagnosis;
use Illuminate\Http\Request;
use App\Models\DiagnosisItem;


class DiagnosisController extends Controller
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
            $diagnosises = Diagnosis::where('id', 'LIKE', '%' . $search . '%')
                ->orderByDesc('created_at')->paginate(config('const.perPage'));
        } else {
            $diagnosises = Diagnosis::orderByDesc('created_at')->paginate(config('const.perPage'));
        }
        $count = 1;
        return view('admin.diagnosises.index', compact('diagnosises', 'count'));
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
        return view('admin.diagnosises.create', compact('doctors', 'patients'));
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
            'main_diagnosis' => 'required|string|max:255',
            'side_diagnosis' => 'nullable|string|max:255',
            'diagnosis_name' => 'required|array',
            'result' => 'required|array',
            'references_range' => 'nullable|array',
            'unit' => 'required|array',
            'method' => 'required|array',
            'diagnosis_note' => 'nullable|array|max:1000',
            'note ' => 'nullable|string|max:255',
        ]);

        $diagnosis = Diagnosis::create([
            'doctor_id' => $request->doctor_id,
            'patient_id' => $request->patient_id,
            'main_diagnosis' => $request->main_diagnosis,
            'side_diagnosis' => $request->side_diagnosis,
            'note' => $request->note,
        ]);
       
        $data = [
            "diagnosis_name" => array_values($validatedData['diagnosis_name']),
            "result" => array_values($validatedData['result']),
            "references_range" => array_values($validatedData['references_range']),
            "unit" => array_values($validatedData['unit']),
            "method" => array_values($validatedData['method']),
            "diagnosis_note" => array_values($validatedData['diagnosis_note']),
        ];

        $newArrays = array();
        foreach ($data as $key => $values) {
            $i = 0;
            foreach ($values as $value) {
                $newArrays[$i][$key] = $value;
                $i++;
            }
        }

        $diagnosisItemData = array_map(function ($diaPre) use ($diagnosis) {
            $diaPre['diagnosis_id'] = $diagnosis->id;
            return $diaPre;
        }, $newArrays);
        DiagnosisItem::insert($diagnosisItemData);

        return redirect()->route('diagnosises.index')
            ->with('success', 'Xét nghiệm/Chẩn đoán đã được tạo thành công.');
    }

    /**
     * Display the specified resource.
     *
     * @param  Diagnosis $diagnosis
     * @return \Illuminate\Http\Response
     */
    public function show(Diagnosis $diagnosis)
    {
        $diaPre = DiagnosisItem::where('Diagnosis_id', $diagnosis->id)->get()->toArray();
        return view('admin.diagnosises.show', compact('diagnosis', 'diaPre'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Diagnosis $diagnosis
     * @return \Illuminate\Http\Response
     */
    public function edit(Diagnosis $diagnosis)
    {
        $doctors = Doctor::all();
        $patients = Patient::all();
        $diaPre = DiagnosisItem::where('diagnosis_id', $diagnosis->id)->get()->toArray();
        return view('admin.diagnosises.edit', compact('diagnosis', 'doctors', 'patients', 'diaPre'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Diagnosis $diagnosis
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Diagnosis $diagnosis)
    {
        $validatedData = $request->validate([
            'doctor_id' => 'nullable|integer|exists:doctors,id,deleted_at,NULL',
            'patient_id' => 'nullable|integer|exists:patients,id,deleted_at,NULL',
            'main_diagnosis' => 'required|string|max:255',
            'side_diagnosis' => 'nullable|string|max:255',
            'diagnosis_name' => 'required|array',
            'result' => 'required|array',
            'references_range' => 'required|array',
            'unit' => 'required|array',
            'method' => 'required|array',
            'diagnosis_note' => 'nullable|array|max:1000',
            'note ' => 'nullable|string|max:255',
        ]);
        $diagnosis->update([
            'doctor_id' => $request->doctor_id,
            'patient_id' => $request->patient_id,
            'main_diagnosis' => $request->main_diagnosis,
            'side_diagnosis' => $request->side_diagnosis,
            'note' => $request->note,
        ]);
        
        $data = [
            "diagnosis_name" => array_values($validatedData['diagnosis_name']),
            "result" => array_values($validatedData['result']),
            "references_range" => array_values($validatedData['references_range']),
            "unit" => array_values($validatedData['unit']),
            "method" => array_values($validatedData['method']),
            "diagnosis_note" => array_values($validatedData['diagnosis_note']),
        ];
        $diagnosisItem = DiagnosisItem::where('diagnosis_id', $diagnosis->id)->delete();
        $newArrays = array();
        foreach ($data as $key => $values) {
            $i = 0;
            foreach ($values as $value) {
                $newArrays[$i][$key] = $value;
                $i++;
            }
        }
        $diagnosisItemData = array_map(function ($diaPre) use ($diagnosis) {
            $diaPre['Diagnosis_id'] = $diagnosis->id;
            return $diaPre;
        }, $newArrays);
        DiagnosisItem::insert($diagnosisItemData);
        return redirect()->route('diagnosises.index')
            ->with('success', 'Thông tin Xét nghiệm/Chẩn đoán đã được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Diagnosis $diagnosis
     * @return \Illuminate\Http\Response
     */
    public function destroy(Diagnosis $diagnosis)
    {
        $diagnosis->delete();

        return redirect()->route('diagnosises.index')
            ->with('success', 'Xét nghiệm/Chẩn đoán đã được xoá thành công.');
    }

    /**
     * render pdf a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function renderPdf(Request $request, Diagnosis $diagnosis)
    {
        $diagnosis = Diagnosis::with('patient', 'doctor')->first();
        $diaPre = DiagnosisItem::where('diagnosis_id', $diagnosis->id)->get()->toArray();
        
        $pdf = \PDF::loadView('pdf.diagnosises', compact('diagnosis', 'diaPre'), []);
        $pdf->setPaper('a4', 'portrait', 'UTF-8');
        return $pdf->stream('Diagnosis.pdf');
    }

}

