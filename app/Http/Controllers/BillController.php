<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Doctor;
use App\Models\Medical;
use App\Models\Patient;
use App\Models\Service;
use Illuminate\Http\Request;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $search = $request->input('search');

        $bills = Bill::all();

        if ($search) {
            $bills = Bill::where('id', 'LIKE', '%' . $search . '%')
                ->orderByDesc('created_at')->paginate(config('const.perPage'));
        } else {
            $bills = Bill::orderByDesc('created_at')->paginate(config('const.perPage'));
        }
        $count = 1;
        return view('admin.bills.index', compact('bills', 'count'));
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
        Bill::create($validatedData);

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
    public function update(Request $request, Bill $Bill)
    {
        $validatedData = $request->validate([
            'patient_id' => 'required|integer|exists:patients,id,deleted_at,NULL',
            'doctor_id' => 'required|integer|exists:doctors,id,deleted_at,NULL',
            'total_money' => 'required|float',
            'paid_money'  => 'nullable|float',
            'note' => 'nullable|string|max:255',
        ]);

        $Bill->update($validatedData);

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
        $bill->delete();

        return redirect()->route('bills.index')
            ->with('success', 'Hóa đơn đã được xoá thành công.');
    }
}
