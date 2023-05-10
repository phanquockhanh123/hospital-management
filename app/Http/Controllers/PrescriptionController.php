<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Bill;
use App\Models\Doctor;
use App\Models\Medical;
use App\Models\Patient;
use App\Models\Service;
use App\Models\Diagnosis;
use App\Models\Prescription;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\PrescriptionItem;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;


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
        $medicals = Medical::all();
        return view('admin.prescriptions.create', compact('doctors', 'patients', 'medicals'));
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
            'main_disease' => 'required|string|max:255',
            'side_disease' => 'nullable|string|max:255',
            'medical_id' => 'required|array',
            'dosage' => 'required|array',
            'dosage_note' => 'required|array',
            'unit' => 'required|array',
            'amount' => 'required|array',
            'note' => 'nullable|string|max:1000',
        ]);


        DB::beginTransaction();
        try {
            // Create prescriptions
            $prescription = Prescription::create([
                'main_disease' => $request->main_disease,
                'side_disease' => $request->side_disease,
                'note' => $request->note,
            ]);

            $data = [
                "medical_id" => array_values($validatedData['medical_id']),
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
                $preItem['created_at'] = now();
                $preItem['updated_at'] = now();
                return $preItem;
            }, $newArrays);

            PrescriptionItem::insert($prescriptionItemData);

            // Create Bills
            $totalMoney = 0;
            foreach ($newArrays as $dataItem) {
                $medicalUpdate = Medical::where('id', $dataItem['medical_id'])->first();
                $totalMoney += $medicalUpdate->export_price * $dataItem['amount'];
                // check quantity input with database
                if ($dataItem['amount'] > $medicalUpdate->quantity) {
                    redirect()->back()->with('alert', 'Thuốc trong kho không đủ để cung cấp!');
                }
                $medicalUpdate->update(['quantity' => $medicalUpdate->quantity - $dataItem['amount']]);
            }

            $billData = [
                'prescription_id' => $prescription->id,
                'total_money' => $totalMoney,
            ];
            Bill::create($billData);
            DB::commit();
        } catch (\Exception $error) {
            DB::rollback();
            Log::error($error);
            return [Response::HTTP_INTERNAL_SERVER_ERROR, ['message' => [trans('messages.MsgErr006')]]];
        }

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
        $medicals  = Medical::all();
        $preItem = PrescriptionItem::where('prescription_id', $prescription->id)->get()->toArray();
        return view('admin.prescriptions.show', compact('prescription', 'preItem', 'medicals'));
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
        $medicals = Medical::all();
        $preItem = PrescriptionItem::where('prescription_id', $prescription->id)->get()->toArray();

        return view('admin.prescriptions.edit', compact('prescription', 'doctors', 'patients', 'preItem', 'medicals'));
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
            'medical_id' => 'required|array',
            'dosage' => 'required|array',
            'dosage_note' => 'required|array',
            'unit' => 'required|array',
            'amount' => 'required|array',
            'note' => 'nullable|string|max:1000',
        ]);
        // DB::beginTransaction();
        // try {
        $prescription->update([
            'doctor_id' => $request->doctor_id,
            'patient_id' => $request->patient_id,
            'main_disease' => $request->main_disease,
            'side_disease' => $request->side_disease,
            'note' => $request->note,
        ]);
        $preItemOld = $prescription->prescriptionItems;
        $data = [
            "medical_id" => array_values($validatedData['medical_id']),
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

        // Update Bills
        $prescriptionPrice = 0;
        $diagnosisPrice = 0;

        foreach ($newArrays as $dataItem) {
            $medicalUpdate = Medical::where('id', $dataItem['medical_id'])->first();
            $prescriptionPrice += $medicalUpdate->export_price * $dataItem['amount'];
            // check quantity input with database
            if ($dataItem['amount'] > $medicalUpdate->quantity) {
                return redirect()->back()->with('alert', 'Thuốc trong kho không đủ để cung cấp!');
            }
            $prescriptionAmountOld = $preItemOld->where('medical_id', $dataItem['medical_id'])->first()->amount;
            $medicalUpdate->update(['quantity' => $medicalUpdate->quantity + $prescriptionAmountOld - $dataItem['amount']]);
        }
        foreach ($prescription->diagnosis->diagnosisItems as $diagPre) {
            $diagnosisPrice += $diagPre->service->all_price;
        }

        $billData = [
            'prescription_id' => $prescription->id,
            'total_money' => $prescriptionPrice + $diagnosisPrice,
        ];
        if ($prescription->bill) {
            Bill::where('id', $prescription->bill->id)->update($billData);
        }
        DB::commit();

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
        DB::beginTransaction();
        try {
            $prescription->delete();
            DB::commit();
        } catch (\Exception $error) {
            DB::rollback();
            Log::error($error);
            return [Response::HTTP_INTERNAL_SERVER_ERROR, ['message' => [trans('messages.MsgErr006')]]];
        }

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
        $prescription = Prescription::with('diagnosis')->first();
        $preItem = PrescriptionItem::where('prescription_id', $prescription->id)->get()->toArray();
        $medicals = Medical::all();
        $pdf = \PDF::loadView('pdf.prescription', compact('prescription', 'preItem', 'medicals'), []);
        $pdf->setPaper('a4', 'portrait', 'UTF-8');
        return $pdf->stream('prescription.pdf');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  Diagnosis $diagnosis
     * @return \Illuminate\Http\Response
     */
    public function createPrescription(Diagnosis $diagnosis)
    {
        $doctors = Doctor::all();
        $patients = Patient::all();
        $medicals = Medical::all();
        return view('admin.prescriptions.create-prescription', compact('diagnosis', 'doctors', 'patients', 'medicals'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Diagnosis $diagnosis
     * @return \Illuminate\Http\Response
     */
    public function storePrescription(Request $request, Diagnosis $diagnosis)
    {
        $validatedData = $request->validate([
            'medical_id' => 'required|array',
            'dosage' => 'required|array',
            'dosage_note' => 'required|array',
            'unit' => 'required|array',
            'amount' => 'required|array',
            'note' => 'nullable|string|max:1000',
        ]);
        $client = new Client();
        $medicals = [];
        foreach ($validatedData['medical_id'] as $dataId) {
            $medicals[] = Medical::where('id', $dataId)->first()->medical_name;
        }
        // Search OpenFDA for adverse events associated with each drug
        foreach ($medicals as $key => $drug) {
            try {
                unset($medicals[$key]);
                $url = 'https://api.fda.gov/drug/label.json?search=drug_interactions:"' . urlencode($drug) . '"';
                $response = @file_get_contents($url);
                $data = json_decode($response, true);
                if (isset($data['results'][0]['drug_interactions'][0])) {
                    $interactions = $data['results'][0]['drug_interactions'][0];
                    foreach ($medicals as $medical) {
                        if (stripos($interactions, $medical) !== false) {
                            return redirect()->back()->with('alert', 'Thuốc ' .  $drug . ' có tác dụng phụ với ' . $medical . ' !');
                        }
                    }
                }
            } catch (\GuzzleHttp\Exception\ClientException $e) {
                // Handle other exceptions
                if ($e->getResponse()->getStatusCode() === 404) {
                    // Drug not found, continue with next drug
                    continue;
                }
            }
        }

        // Create prescriptions
        $prescription = Prescription::create([
            'diagnosis_id' => $diagnosis->id,
            'note' => $request->note,
        ]);

        $data = [
            "medical_id" => array_values($validatedData['medical_id']),
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
            $preItem['created_at'] = now();
            $preItem['updated_at'] = now();
            return $preItem;
        }, $newArrays);

        PrescriptionItem::insert($prescriptionItemData);
        $diagnosis->update(['status' => Diagnosis::STATUS_CREATED]);

        // Create Bills
        $totalMoney = 0;
        foreach ($newArrays as $dataItem) {
            $medicalUpdate = Medical::where('id', $dataItem['medical_id'])->first();
            $totalMoney += $medicalUpdate->export_price * $dataItem['amount'];
            // check quantity input with database
            if ($dataItem['amount'] > $medicalUpdate->quantity) {
                return redirect()->back()->with('alert', 'Thuốc trong kho không đủ để cung cấp!');
            }

            $medicalUpdate->update(['quantity' => $medicalUpdate->quantity - $dataItem['amount']]);
        }
        // Update bill

        $bill = Bill::where('diagnosis_id', $diagnosis->id)->first();
        $billData = [
            'prescription_id' => $prescription->id,
            'total_money' => $totalMoney + $bill->total_money,
        ];
        $bill->update($billData);

        return redirect()->route('bills.index')
            ->with('success', 'Đơn thuốc đã được tạo thành công.');
    }
}
