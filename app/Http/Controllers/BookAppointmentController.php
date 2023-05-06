<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Mail\MailBookAppoiment;
use App\Models\BookAppointment;
use App\Models\DoctorDepartment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailDeniedBookAppoiment;

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
        $data = [
            'name' => $book_appointment->fullname,
            'phone' => $book_appointment->phone,
            'email' => $book_appointment->email,
            'blood_group' => Patient::BLOOD_GROUP_O,
            'identity_number' => Patient::max('identity_number') + 1,
        ];
        $data['patient_code'] = Patient::generateNextCode();
        $patient = Patient::where('email', $book_appointment->email)->first();
        DB::beginTransaction();
        try {
            $book_appointment->update([
                'status' => 2
            ]);
            if (!$patient) {
                $patient = Patient::create($data);
            }   
            DB::commit();
        } catch (\Exception $error) {
            DB::rollback();
            Log::error($error);
            return [Response::HTTP_INTERNAL_SERVER_ERROR, ['message' => [trans('messages.MsgErr006')]]];
        }

        return redirect()->route('appointments.index')
            ->with('success', 'Chấp nhận cuộc hẹn thành công !');
    }
}
