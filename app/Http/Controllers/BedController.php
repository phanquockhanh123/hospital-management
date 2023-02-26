<?php

namespace App\Http\Controllers;

use App\Models\Bed;
use Illuminate\Http\Request;
use App\Models\DoctorDepartment;

class BedController extends Controller
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
            $beds = Bed::where('name', 'LIKE', '%' . $search . '%')
                ->orderByDesc('created_at')->paginate(config('const.perPage'));
        } else {
            $beds = Bed::orderByDesc('created_at')->paginate(config('const.perPage'));
        }
        $doctorDepartment = DoctorDepartment::orderByDesc('id')->get();
        return view('admin.beds.index', compact('beds', 'doctorDepartment'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $doctorDepartment = DoctorDepartment::orderByDesc('id')->get();
        return view('admin.beds.create', compact('doctorDepartment'));
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
            'bed_type' => 'required',
            'notes' => 'nullable',
            'department_id' => 'required',
            'charge' => 'nullable',
            
        ]);
        $validatedData['bed_code'] = Bed::generateNextCode();
        Bed::create($validatedData);

        return redirect()->route('beds.index')
            ->with('success', 'Giường bệnh đã được tạo thành công.');
    }

    /**
     * Display the specified resource.
     *
     * @param  Bed $bed
     * @return \Illuminate\Http\Response
     */
    public function show(Bed $bed)
    {
        return view('admin.beds.show', compact('bed'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Bed $bed
     * @return \Illuminate\Http\Response
     */
    public function edit(Bed $bed)
    {
        $doctorDepartment = DoctorDepartment::orderByDesc('id')->get();
        return view('admin.beds.edit', compact('bed','doctorDepartment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Bed $bed
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bed $bed)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'bed_type' => 'required',
            'notes' => 'nullable',
            'department_id' => 'required',
            'charge' => 'nullable',
            
        ]);
        $bed->update($validatedData);

        return redirect()->route('beds.index')
            ->with('success', 'Thông tin giường bệnh đã được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Bed $bed
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bed $bed)
    {
        $bed->delete();

        return redirect()->route('beds.index')
            ->with('success', 'Giường bệnh đã được xoá thành công.');
    }
}
