<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\DoctorDepartment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
        DB::beginTransaction();
        try {
            Service::create($validatedData);
            DB::commit();
        } catch (\Exception $error) {
            DB::rollback();
            Log::error($error);
            return [Response::HTTP_INTERNAL_SERVER_ERROR, ['message' => [trans('messages.MsgErr006')]]];
        }

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
        DB::beginTransaction();
        try {
            $service->update($validatedData);
            DB::commit();
        } catch (\Exception $error) {
            DB::rollback();
            Log::error($error);
            return [Response::HTTP_INTERNAL_SERVER_ERROR, ['message' => [trans('messages.MsgErr006')]]];
        }

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
        DB::beginTransaction();
        try {
            $service->delete();
            DB::commit();
        } catch (\Exception $error) {
            DB::rollback();
            Log::error($error);
            return [Response::HTTP_INTERNAL_SERVER_ERROR, ['message' => [trans('messages.MsgErr006')]]];
        }

        return redirect()->route('services.index')
            ->with('success', 'Dịch vụ khám bệnh đã được xoá thành công.');
    }
}
