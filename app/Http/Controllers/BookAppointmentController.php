<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\BookAppointment;
use App\Models\DoctorDepartment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BookAppointmentController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        if ($search) {
            $book_appointments = BookAppointment::where('fullname', 'LIKE', '%' . $search . '%')
                ->orderByDesc('created_at')->paginate(config('const.perPage'));
        } else {
            $book_appointments = BookAppointment::orderByDesc('created_at')->paginate(config('const.perPage'));
        }
        $count = 1;
        return view('admin.book_appointments.index', compact('book_appointments', 'count'));
    }


    public function showAppointment(BookAppointment $bookAppointment)
    {
        return view('admin.doctors.show', compact('bookAppointment'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  BookAppointment $book_appointment
     * @return \Illuminate\Http\Response
     */
    public function acceptedBookAppointment(BookAppointment $book_appointment)
    {
        $book_appointment->update([
            'status' => 2
        ]);
        $data = [
            'name' => $book_appointment->fullname,
            'phone' => $book_appointment->phone,
            'email' => $book_appointment->email,
            'blood_group' => Patient::BLOOD_GROUP_O,
            'identity_number' => Patient::max('identity_number') + 1,
        ];
        $data['patient_code'] = Patient::generateNextCode();
        $patient =Patient::where('email', $book_appointment->email)->first();
        if(!$patient){
            $patient = Patient::create($data);
        }
        $appointments = Appointment::whereBetWeen('end_time', [$book_appointment->experted_time, $book_appointment->experted_time->addHour()])->get();
        $dataAppointment = array_map(function ($appointment) use ($patient, $book_appointment) {
            return [
                'patient_id' => $patient->id,
                'start_time' => $book_appointment->experted_time,
                'end_time' => $book_appointment->experted_time->addHour(),
                'doctor_id' => $appointment['doctor_id'],
                'doctor_department_id' => DoctorDepartment::pluck('id')->random()
            ];
        }, $appointments->toArray());
        Appointment::insert($dataAppointment);
        return redirect()->route('appointments.index')
            ->with('success', 'Chấp nhận cuộc hẹn thành công !');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  BookAppointment $book_appointment
     * @return \Illuminate\Http\Response
     */
    public function deniedBookAppointment(BookAppointment $book_appointment)
    {
        $book_appointment->update([
            'status' => 0
        ]);
        $data = [
            'name' => $book_appointment->fullname,
            'phone' => $book_appointment->phone,
            'email' => $book_appointment->email,
            'blood_group' => Patient::BLOOD_GROUP_O,
            'identity_number' => Patient::max('identity_number') + 1,
        ];
        $data['patient_code'] = Patient::generateNextCode();
        DB::beginTransaction();
        try {
            $patient =Patient::where('email', $book_appointment->email)->first();
            if(!$patient){
                $patient = Patient::create($data);
            }
            $appointments = Appointment::where('end_time', $book_appointment->experted_time->addHours(3))->get();
            $dataAppointment = array_map(function ($appointment) use ($patient, $book_appointment) {
                return [
                    'patient_id' => $patient->id,
                    'start_time' => $book_appointment->experted_time,
                    'end_time' => $book_appointment->experted_time->addHours(3),
                    'doctor_id' => $appointment['doctor_id'],
                    'doctor_department_id' => DoctorDepartment::pluck('id')->random()
                ];
            }, $appointments->toArray());
            Appointment::insert($dataAppointment);
        } catch (\Exception $error) {
            DB::rollback();
            Log::error($error);
        }
        return redirect()->route('appointments.index')
            ->with('success', 'Từ chối cuộc hẹn thành công !');
    }
}
