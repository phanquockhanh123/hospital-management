<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Doctor;
use App\Models\Medical;
use App\Models\Patient;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $patients = Patient::orderByDesc('created_at')->get();

        $bills = Bill::with('diagnosis', 'diagnosis.patient');

        if ($request['patient_id'] != null) {
            $bills->whereHas('diagnosis', function ($bills) use ($request) {
                $bills->where('patient_id', $request['patient_id']);
            });
        }

        if ($request['created_at'] != null) {
            $bills->whereDate('created_at', $request['created_at']);
        }

        if ($request['status'] != null) {
            $bills->where('status', $request['status']);
        }

        $bills = $bills->orderByDesc('updated_at')->orderByDesc('id')->paginate(config('const.perPage'));
        $count = 1;
        return view('admin.bills.index', compact('bills', 'count', 'patients'));
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
        return view('admin.bills.create', compact('doctors', 'patients'));
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
            'patient_id' => 'required|integer|exists:patients,id,deleted_at,NULL',
            'doctor_id' => 'required|integer|exists:doctors,id,deleted_at,NULL',
            'total_money' => 'required|float',
            'paid_money'  => 'nullable|float',
            'note' => 'nullable|string|max:255',
        ]);
        DB::beginTransaction();
        try {
            Bill::create($validatedData);
            DB::commit();
        } catch (\Exception $error) {
            DB::rollback();
            Log::error($error);
            return [Response::HTTP_INTERNAL_SERVER_ERROR, ['message' => [trans('messages.MsgErr006')]]];
        }

        return redirect()->route('bills.index')
            ->with('success', 'Hóa đơn đã được tạo thành công.');
    }

    /**
     * Display the specified resource.
     *
     * @param  Bill $bill
     * @return \Illuminate\Http\Response
     */
    public function show(Bill $bill)
    {
        $services = Service::all();
        $medicals = Medical::all();
        $diaPre = $bill->diagnosis->diagnosisItems->toArray();
        $preItem = $bill?->prescription?->prescriptionItems->toArray();
        return view('admin.bills.show', compact('bill', 'diaPre', 'services', 'preItem', 'medicals'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Bill $Bill
     * @return \Illuminate\Http\Response
     */
    public function edit(Bill $Bill)
    {
        $doctors = Doctor::all();
        $patients = Patient::all();
        return view('admin.bills.edit', compact('doctors', 'patients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Bill $Bill
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bill $bill)
    {
        $validatedData = $request->validate([
            'patient_id' => 'required|integer|exists:patients,id,deleted_at,NULL',
            'doctor_id' => 'required|integer|exists:doctors,id,deleted_at,NULL',
            'total_money' => 'required|float',
            'paid_money'  => 'nullable|float',
            'note' => 'nullable|string|max:255',
        ]);
        DB::beginTransaction();
        try {   
            $bill->update($validatedData);
            DB::commit();
        } catch (\Exception $error) {
            DB::rollback();
            Log::error($error);
            return [Response::HTTP_INTERNAL_SERVER_ERROR, ['message' => [trans('messages.MsgErr006')]]];
        }

        return redirect()->route('bills.index')
            ->with('success', 'Thông tin hóa đơn đã được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Bill $bill
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bill $bill)
    {
        DB::beginTransaction();
        try {    
            $bill->delete();
            DB::commit();
        } catch (\Exception $error) {
            DB::rollback();
            Log::error($error);
            return [Response::HTTP_INTERNAL_SERVER_ERROR, ['message' => [trans('messages.MsgErr006')]]];
        }

        return redirect()->route('bills.index')
            ->with('success', 'Hóa đơn đã được xoá thành công.');
    }

    /**
     * Display the specified resource.
     *
     * @param  Bill $bill
     * @return \Illuminate\Http\Response
     */
    public function payment(Bill $bill)
    {
        $bill->update([
            'paid_money' => $bill->total_money,
            'status' => Bill::STATUS_PAYMENT
        ]);
        return redirect()->route('bills.index')
            ->with('success', 'Hóa đơn đã được thanh toán thành công.');
    }

    /**
     * render pdf a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function renderPdf(Request $request, Bill $bill)
    {
        $services = Service::all();
        $medicals = Medical::all();
        $diaPre = $bill->diagnosis->diagnosisItems->toArray();
        $preItem = $bill?->prescription?->prescriptionItems->toArray();

        $pdf = \PDF::loadView('pdf.bills', compact('bill', 'diaPre', 'preItem', 'services', 'medicals'), []);
        $pdf->setPaper('a4', 'portrait', 'UTF-8');
        return $pdf->stream('Bills.pdf');
    }
}
