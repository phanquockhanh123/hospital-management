<?php

namespace App\Http\Controllers;

use App\Models\BedType;
use Illuminate\Http\Request;

class BedTypeController extends Controller
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
            $bedTypes = BedType::where('name', 'LIKE', '%' . $search . '%')
                ->orderByDesc('created_at')->paginate(config('const.perPage'));
        } else {
            $bedTypes = BedType::orderByDesc('created_at')->paginate(config('const.perPage'));
        }

        return view('admin.bed_types.index', compact('bedTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.bed_types.create');
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
            'description' => 'nullable',
        ]);

        BedType::create($validatedData);

        return redirect()->route('bed_types.index')
            ->with('success', 'Loại giường đã được tạo thành công.');
    }

    /**
     * Display the specified resource.
     *
     * @param  $bedType
     * @return \Illuminate\Http\Response
     */
    public function show(BedType $bedType)
    {
        return view('admin.bed_types.show', compact('bedType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $bedType
     * @return \Illuminate\Http\Response
     */
    public function edit(BedType $bedType)
    {
        return view('admin.bed_types.edit', compact('bedType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param   $bedType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BedType $bedType)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
        ]);

        $bedType->update($validatedData);

        return redirect()->route('bed_types.index')
            ->with('success', 'Thông tin loại giường bệnh đã được cập nhật thành công.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param   $bedType
     * @return \Illuminate\Http\Response
     */
    public function destroy(BedType $bedType)
    {
        $bedType->delete();

        return redirect()->route('bed_types.index')
            ->with('success', 'Loại giường bệnh đã được xoá thành công.');
    }
}
