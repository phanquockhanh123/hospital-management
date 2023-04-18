<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Carbon\Carbon;
use App\Models\News;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Medical;
use App\Models\Patient;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Models\BookAppointment;
use App\Models\DoctorDepartment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index()
    {
        $doctors = Doctor::where('status', 1)->get();
        $news = News::where('status', News::STATUS_SUBMITTED)->orderByDesc('priority_level')->orderByDesc('created_at')->take(3)->get();
        return view('user.home', compact('doctors', 'news'));
    }

    public function getDoctor()
    {
        $doctors = Doctor::where('status', 1)->get();
        return view('user.doctor', compact('doctors'));
    }

    public function aboutUs()
    {
        $news = News::where('status', News::STATUS_SUBMITTED)->orderByDesc('priority_level')->orderByDesc('created_at')->take(6)->get();
        return view('user.aboutUs', compact('news'));
    }

    public function blog()
    {
        $news = News::where('status', News::STATUS_SUBMITTED)->orderByDesc('priority_level')->orderByDesc('created_at')->take(5)->get();
        return view('user.blog', compact('news'));
    }

    public function contact()
    {
        $news = News::where('status', News::STATUS_SUBMITTED)->orderByDesc('priority_level')->orderByDesc('created_at')->take(5)->get();
        return view('user.contact', compact('news'));
    }

    public function bookAppointmentUser()
    {
        return view('user.bookAppointmentUser');
    }

    public function storeAppointment(Request $request)
    {

        $validatedData = $request->validate([
            'fullname' => 'nullable',
            'email' => 'nullable',
            'phone' => 'nullable',
            'reason' => 'nullable',
            'experted_time' => 'nullable'
        ]);
        $validatedData['status'] = BookAppointment::STATUS_PENDING;
        BookAppointment::create($validatedData);

        return redirect()->route('home.index')->with('alert', 'Đã nhận lịch hẹn. Chúng tôi sẽ liên hệ với quý khách hàng sau !');
    }

    public function getDoctorListForUserSite()
    {
        $departments = DoctorDepartment::withCount('doctors')
            ->get();
        // Lấy danh sách 3 bác sĩ đầu tiên trong mỗi phòng ban
        foreach ($departments as $department) {
            $department->doctors = Doctor::where('doctor_department_id', $department->id)
                ->take(3)->get();
        }
        // dd($doctors);
        return view('user.getDoctorListForUserSite', compact('departments'));
    }

    public function getDoctorDetailForUserSite(Doctor $doctor)
    {
        $doctors = Doctor::where('status', 1)->where('id', '!=', $doctor->id)->get();
        return view('user.getDoctorDetailForUserSite', compact('doctor', 'doctors'));
    }

    public function getInfoPatient()
    {
        $patient = Patient::where('email', Auth::user()->email)->first();
        $diagnosises = $patient?->diagnosises;
        $prescriptionItemList = [];
        $billList = [];
        $diagnosisItems = [];
        foreach ($diagnosises ?? [] as $diagnosis) {
            $billList[] = $diagnosis->bill->toArray();
            $prescriptionItemList[] = $diagnosis->prescription?->prescriptionItems;
            foreach ($diagnosis?->diagnosisItems as $diagnosisItem) {
                $diagnosisItems[] = $diagnosisItem;
            }
        }
        //dd($prescriptionItemList);
        $diaPre = $diagnosisItems;
        
        $services = Service::all();
        // get list diagnosis
        $diagnosisesList = $diagnosises;
        $doctors = Doctor::all();
        // get list prescriptions
        $medicals = Medical::all();
        $countDiagnosis = 1;
        $countDiagnosisItem = 1;
        $countBill = 1;

        // get appointment
        $appointments = Appointment::where('patient_id', $patient->id)->get();

        $countAppointment = 1;
        return view('user.getInfoPatient', compact(
            'patient',
            'diaPre',
            'services',
            'diagnosisesList',
            'doctors',
            'medicals',
            'prescriptionItemList',
            'billList',
            'countDiagnosis',
            'countDiagnosisItem',
            'countBill',
            'appointments',
            'countAppointment'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateUserPatient(Request $request,Patient $patient) {
        $validatedData = $request->validate([
            'name' => 'nullable|string|max:255',
            'blood_group' => 'nullable|in:' . implode(',', array_keys(Patient::$bloodGroups)),
            'phone' => 'nullable|size:10|regex:' . config('const.regex_telephone'),
            'date_of_birth'  => [
                'nullable',
                'date_format:' . config('const.format.date_form'),
                'before_or_equal:' . Carbon::now()->format(config('const.format.date_form'))
            ],
            'gender' => 'nullable|in:' . implode(',', array_keys(Patient::$genders)),
            'profile'  => 'nullable',
            'address' => 'nullable|string|max:255',
            'identity_number' => [
                'nullable',
                'regex:' . config('const.regex_identity_number'),
            ],
            'identity_card_date' => [
                'nullable',
                'date_format:' . config('const.format.date_form'),
                'before_or_equal:' . Carbon::now()->format(config('const.format.date_form'))
            ],
            'identity_card_place'  => 'nullable|string|max:255',
        ]);
        // Handle the avatar file upload
        if ($request->profile) {
            $imagePath = "./imgPatient/" . $patient->filename;
            // Delete the old profile file, if there is one
            if ($patient->profile) {
                Storage::delete($patient->profile);
                File::delete($imagePath);
            }

            $profile = $request->file('profile');

            $filename = time() . '_' . $profile->getClientOriginalName();
            // Store the new profile file
            $profilePath = $request->file('profile')->move('imgPatient', $filename);
            $validatedData['profile'] = $profilePath;
            $validatedData['filename'] = $filename;
        }

        $patient->update($validatedData);
        $user = User::where('email', $patient->email)->first();
        $user->update([
            'name' => $patient->name,
            'phone' => $patient->phone,
            'address' => $patient->address,
            'gender' => $patient->gender,
            'dob' => $patient->date_of_birth,
            'identity_number' => $patient->identity_number,
            'identity_card_date' => $patient->identity_card_date,
            'identity_card_place' => $patient->identity_card_place,
            'filename' => $patient->filename
        ]);

        return redirect()->route('user.get-info-patient')
            ->with('success', 'Thông tin cá nhân đã được cập nhật thành công.');
    }
}
