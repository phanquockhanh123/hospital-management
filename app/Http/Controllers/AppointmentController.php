<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\DoctorDepartment;

class AppointmentController extends Controller
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
            $appointments = Appointment::where('id', 'LIKE', '%' . $search . '%')
                ->orderByDesc('created_at')->paginate(config('const.perPage'));
        } else {
            $appointments = Appointment::orderByDesc('created_at')->paginate(config('const.perPage'));
        }
        return view('admin.appointments.index', compact('appointments'));
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
        $doctorDepartments = DoctorDepartment::all();
        return view('admin.appointments.create', compact('doctors', 'patients', 'doctorDepartments'));
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
            'doctor_id' => 'required',
            'patient_id' => 'required',
            'doctor_department_id' => 'required',
            'appointment_date' => 'required',
            'description' => 'nullable',
        ]);

        $validatedData['status'] = Appointment::STATUS_PENDING;
        Appointment::create($validatedData);


        return redirect()->route('appointments.index')
            ->with('success', 'Lịch hẹn đã được tạo thành công.');
    }

    /**
     * Display the specified resource.
     *
     * @param  Appointment $Appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        return view('admin.appointments.show', compact('appointment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Appointment $Appointment
     * @return \Illuminate\Http\Response
     */
    public function edit(Appointment $appointment)
    {
        $doctors = Doctor::all();
        $patients = Patient::all();
        $doctorDepartments = DoctorDepartment::all();
        return view('admin.appointments.edit', compact('appointment', 'doctors', 'patients', 'doctorDepartments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Appointment $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Appointment $appointment)
    {
        $validatedData = $request->validate([
            'doctor_id' => 'required',
            'patient_id' => 'required',
            'doctor_department_id' => 'required',
            'appointment_date' => 'required',
            'description' => 'nullable',
        ]);

        $validatedData['status'] = Appointment::STATUS_PENDING;
        $appointment->update($validatedData);

        return redirect()->route('appointments.index')
            ->with('success', 'Thông tin lịch hẹn đã được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Appointment $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return redirect()->route('appointments.index')
            ->with('success', 'Lịch hẹn đã được xoá thành công.');
    }

    public function calendar()
    {
        $bookings = Book::all();
        $events = array();
        foreach ($bookings as $booking) {
            $events[] = [
                'title' => $booking->title,
                'start' => $booking->start_date,
                'end' => $booking->end_date,
            ];
        }
        
        return view('admin.appointments.calendar', compact('events'));
    }

    public function storeCalendar(Request $request) {
        $request->validate([
            'title' => 'required|string',
        ]);
        $booking = Book::create([
            'title' => $request->title,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return response()->json($booking);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Appointment $appointment
     * @return \Illuminate\Http\Response
     */
    public function acceptedAppointment(Appointment $appointment)
    {
        $appointment->update([
            'status' => 2
        ]);
        return redirect()->route('appointments.index')
            ->with('success', 'Chấp nhận cuộc hẹn thành công !');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  Appointment $appointment
     * @return \Illuminate\Http\Response
     */
    public function deniedAppointment(Appointment $appointment)
    {
        $appointment->update([
            'status' => 0
        ]);
        return redirect()->route('appointments.index')
            ->with('success', 'Từ chối cuộc hẹn thành công !');
    }
}
