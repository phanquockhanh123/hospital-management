<?php

namespace App\Http\Controllers;

use App\Models\BookAppointment;
use App\Models\News;
use App\Models\User;
use App\Models\Doctor;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $doctors = Doctor::where('status', 1)->get();
        $news = News::where('status', News::STATUS_SUBMITTED)->orderByDesc('priority_level')->orderByDesc('created_at')->take(3)->get();
        return view('user.home', compact('doctors', 'news'));
    }

    public function getDoctor() {
        $doctors = Doctor::where('status', 1)->get();
        return view('user.doctor', compact('doctors'));
    }

    public function aboutUs() {
        return view('user.aboutUs');
    }

    public function blog() {
        return view('user.blog');
    }

    public function bookAppointmentUser() {
        return view('user.bookAppointmentUser');
    }

    public function storeAppointment(Request $request) {

        $validatedData = $request->validate([
            'fullname' => 'nullable',
            'email' => 'nullable',
            'phone' => 'nullable',
            'reason' => 'nullable',
            'experted_time' => 'nullable'
        ]);
        $validatedData['status'] = BookAppointment::STATUS_PENDING;
        BookAppointment::create($validatedData);
        return redirect()->route('home.index')->with('success', 'Đã nhận lịch hẹn. Chúng tôi sẽ liên hệ với quý khách hàng sau !');
    }






}
