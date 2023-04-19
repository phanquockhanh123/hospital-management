<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Mail\MailBookAppoiment;
use App\Models\DoctorDepartment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailDeniedBookAppoiment;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $doctors = Doctor::orderByDesc('created_at')->get();
        $patients = Patient::orderByDesc('created_at')->get();
        $doctorDepartments = DoctorDepartment::all();
        $appointments = Appointment::with('patient', 'doctor', 'doctorDepartment');

        if($request['doctor_id'] != null) {
            $appointments->where('doctor_id', $request['doctor_id']);
        }
        if($request['patient_id'] != null) {
            $appointments->where('patient_id', $request['patient_id']);
        }


        if($request['doctor_department_id'] != null) {
            $appointments->where('doctor_department_id', $request['doctor_department_id']);
        }
        
        $appointments = $appointments->orderByDesc('updated_at')->orderByDesc('id')->paginate(config('const.perPage'));
        $count = 1;
        
        return view('admin.appointments.index', compact('appointments', 'count', 'doctors', 'patients', 'doctorDepartments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $appointments = Appointment::where('end_time', '<=' , now())->get();
        $doctorIds = array_map(function ($appointment) { 
            return $appointment['doctor_id'];
        }, $appointments->toArray());

        $doctors = Doctor::whereIn('id', $doctorIds)->get();
        $patients = Patient::orderByDesc('created_at')->get();
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
            'doctor_id' => 'nullable|integer|exists:doctors,id,deleted_at,NULL',
            'patient_id' => 'nullable|integer|exists:patients,id,deleted_at,NULL',
            'doctor_department_id' => 'nullable|integer|exists:doctor_departments,id,deleted_at,NULL',
            'start_time' => [
                'required',
                // 'before_or_equal:end_time',
                // 'date_format:' . config('const.format.date_appointment')
            ],
            'end_time' => [
                'nullable',
                // 'after_or_equal:start_date',
                // 'date_format:' . config('const.format.date_appointment')
            ],
            'description' => 'nullable|string|max:1000',
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
            'doctor_id' => 'nullable|integer|exists:doctors,id,deleted_at,NULL',
            'patient_id' => 'nullable|integer|exists:patients,id,deleted_at,NULL',
            'doctor_department_id' => 'nullable|integer|exists:doctor_departments,id,deleted_at,NULL',
            'start_time' => [
                'required',
                // 'before_or_equal:end_time',
                // 'date_format:' . config('const.format.datetime')
            ],
            'end_time' => [
                'nullable',
                // 'after_or_equal:start_date',
                // 'date_format:' . config('const.format.datetime')
            ],
            'description' => 'nullable|string|max:1000',
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
        $doctors = Doctor::all();
        $patients = Patient::all();
        $doctorDepartments = DoctorDepartment::all();
        $bookings = Appointment::where('status', Appointment::STATUS_ACCEPTED)->get();
        $events = array();
        foreach ($bookings as $booking) {
            $events[] = [
                'id'   => $booking->id,
                'title' => $booking->title,
                'start' => $booking->start_time,
                'end' => $booking->end_time,
                'description' => $booking->description
            ];
        }

        return view('admin.appointments.calendar', compact('events', 'doctors', 'patients','doctorDepartments'));
    }

    public function storeCalendar(Request $request)
    {
        $validateData = $request->validate([
            'title' => 'nullable',
            'doctor_id' => 'nullable|integer|exists:doctors,id,deleted_at,NULL',
            'patient_id' => 'nullable|integer|exists:patients,id,deleted_at,NULL',
            'doctor_department_id' => 'nullable|integer|exists:doctor_departments,id,deleted_at,NULL',
            'start_time' => 'required',
            'end_time' => 'required',
            'description' => 'nullable|string|max:1000',
        ]);
        $validateData['status'] = Appointment::STATUS_ACCEPTED;

        $booking = Appointment::create($validateData);
        return response()->json([
            'id' => $booking->id,
            'title' => $booking->title,
            'start_time' => $booking->start_time,
            'end_time' => $booking->end_time,
            'doctor_id' => $booking->doctor_id,
            'patient_id' => $booking->patient_id,
            'doctor_department_id' => $booking->doctor_department_id,
            'description' => $booking->description,
        ]);
    }

    public function updateCalendar(Request $request, $id)
    {
        $booking = Book::find($id);
        if (!$booking) {
            return response()->json([
                'error' => 'Unable to locate the event'
            ], 404);
        }
        $booking->update([
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);
        return response()->json('Event updated');
    }
    public function destroyCalendar($id)
    {
        $booking = Book::find($id);
        if (!$booking) {
            return response()->json([
                'error' => 'Unable to locate the event'
            ], 404);
        }
        $booking->delete();
        return $id;
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
        $patient = $appointment->patient;
        $doctor = $appointment->doctor;
        $doctorDepartment = $appointment->doctorDepartment;
        Mail::send(new MailBookAppoiment($appointment, $patient, $doctor, $doctorDepartment));
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
        $patient = $appointment->patient;
        $doctor = $appointment->doctor;
        $doctorDepartment = $appointment->doctorDepartment;
        Mail::send(new MailDeniedBookAppoiment($appointment, $patient, $doctor, $doctorDepartment));
        return redirect()->route('appointments.index')
            ->with('success', 'Từ chối cuộc hẹn thành công !');
    }

    public function getAppointmentByDoctor()
    {
        $doctor = Doctor::where('email', Auth::user()->email)->first();
        if($doctor) {
            $appointments = Appointment::where('doctor_id', $doctor->id)
            ->orderByDesc('created_at')->paginate(config('const.perPage'));
        }else {
            $appointments = [];
        }
        $count=1;
        return view('admin.appointments.index', compact('appointments', 'count'));
    }
}
