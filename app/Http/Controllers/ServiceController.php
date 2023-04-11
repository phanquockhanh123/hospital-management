<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Models\DoctorDepartment;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $services = Service::all();

        if ($search) {
            $services = Service::where('service_code', 'LIKE', '%' . $search . '%')
                ->orderByDesc('created_at')->paginate(config('const.perPage'));
        } else {
            $services = Service::orderByDesc('created_at')->paginate(config('const.perPage'));
        }

        return view('admin.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('admin.services.create');
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
            'service_name' => 'required|string|max:255',
            'all_price' => 'required|integer',
            'discount' => 'required|integer',
            'description' => 'required|string|max:255',
        ]);
        $validatedData['service_code'] = Service::generateNextCode();
        Service::create($validatedData);

        return redirect()->route('services.index')
            ->with('success', 'Dịch vụ khám bệnh đã được tạo thành công.');
    }

    /**
     * Display the specified resource.
     *
     * @param  Service $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {

        return view('admin.services.show', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Service $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Service $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        $validatedData = $request->validate([
            'service_name' => 'required|string|max:255',
            'all_price' => 'required|integer',
            'discount' => 'required|integer',
            'description' => 'required|string|max:255',
        ]);

        $service->update($validatedData);

        return redirect()->route('services.index')
            ->with('success', 'Dịch vụ khám bệnh đã được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Service $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->route('services.index')
            ->with('success', 'Dịch vụ khám bệnh đã được xoá thành công.');
    }
}
