<?php

namespace App\Http\Controllers;

use App\Models\BookAppointment;
use Illuminate\Http\Request;

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
        return view('receptionist.book_appointments.index', compact('book_appointments'));
    }


}
