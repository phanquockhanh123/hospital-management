<?php

namespace App\Http\Controllers;

use App\Mail\MailBookAppoiment;
use App\Models\Patient;
use Illuminate\Http\Request;
use App\Models\BookAppointment;
use Illuminate\Support\Facades\Mail;

class BookAppointmentController extends Controller
{
    public function index(Request $request) {
        $search = $request->input('search');

        if ($search) {
            $book_appointments = BookAppointment::where('id', 'LIKE', '%' . $search . '%')
                ->orderByDesc('created_at')->paginate(config('const.perPage'));
        } else {
            $book_appointments = BookAppointment::orderByDesc('created_at')->paginate(config('const.perPage'));
        }
        return view('admin.book_appointments.index', compact('book_appointments'));
    }

    
    public function showAppointment(BookAppointment $bookAppointment) {
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
        $data =[
            'name' => $book_appointment->fullname,
            'phone' => $book_appointment->phone,
            'email' => $book_appointment->email,
            'blood_group' => Patient::BLOOD_GROUP_O,
            'identity_number' => Patient::max('identity_number')+1,
        ];
        $data['patient_code'] = Patient::generateNextCode();
        Patient::create($data);

        return redirect()->route('patients.index')
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
        return redirect()->route('book_appointments.index')
            ->with('success', 'Từ chối cuộc hẹn thành công !');
    }
}
