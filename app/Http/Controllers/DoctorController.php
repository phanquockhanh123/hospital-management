<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Bed;
use App\Models\User;
use App\Models\Doctor;
use App\Mail\MailLogin;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\DoctorDepartment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $academicLevels = Doctor::$academicLevels;
        $doctorDepartments = DoctorDepartment::all();

        $doctors = Doctor::with('doctorDepartment');
        if ($request['fullname'] != null) {
            $doctors->where('name', 'LIKE', '%' . $request['fullname'] . '%');
        }

        if ($request['status'] != null) {
            $doctors->where('status', 'LIKE', '%' . $request['status'] . '%');
        }
        if ($request['doctor_department_id'] != null) {
            $doctors->where('doctor_department_id', $request['doctor_department_id']);
        }

        if ($request['academic_level'] != null) {
            $doctors->where('academic_level', $request['academic_level']);
        }

        $doctors = $doctors->orderByDesc('updated_at')->orderByDesc('id')->paginate(config('const.perPage'));
        $count = 1;
        return view('admin.doctors.index', compact('doctors', 'academicLevels', 'doctorDepartments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $doctorDepartments = DoctorDepartment::all();
        return view('admin.doctors.create', compact('doctorDepartments'));
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
            'name' => 'required|string|max:255',
            'doctor_department_id' => 'required|integer|exists:doctor_departments,id,deleted_at,NULL',
            'blood_group' => 'required|in:' . implode(',', array_keys(Doctor::$bloodGroups)),
            'email' => 'required|string|max:255|unique:doctors,email|regex:'
                . config('const.regex_email_admin'),
            'designation' => 'nullable|string|max:255',
            'phone' => 'nullable|size:10|regex:' . config('const.regex_telephone'),
            'profile' => 'nullable',
            'academic_level' => 'required|in:' . implode(',', array_keys(Doctor::$academicLevels)),
            'date_of_birth' => [
                'nullable',
                'date_format:' . config('const.format.date_form'),
                'before_or_equal:' . Carbon::now()->format(config('const.format.date_form'))
            ],
            'gender' => 'required|in:' . implode(',', array_keys(Doctor::$genders)),
            'address' => 'nullable|string|max:255',
            'identity_number' => [
                'required',
                'unique:doctors,identity_number',
                'regex:' . config('const.regex_identity_number'),
            ],
            'identity_card_date' => [
                'nullable',
                'date_format:' . config('const.format.date_form'),
                'before_or_equal:' . Carbon::now()->format(config('const.format.date_form'))
            ],
            'identity_card_place'  => 'nullable|string|max:255',
            'start_work_date' => [
                'nullable',
                'date_format:' . config('const.format.date_form'),
                'before_or_equal:' . Carbon::now()->format(config('const.format.date_form'))
            ],
            'specialist' => 'nullable|string|max:255',
        ]);

        // Lưu ảnh
        if ($request->hasFile('profile')) {
            $profile = $request->file('profile');

            $filename = time() . '_' . $profile->getClientOriginalName();

            $path = $profile->move('imgDoctor', $filename);

            $validatedData['profile'] = $path;
            $validatedData['filename'] = $filename;
        }

        $validatedData['status'] = Doctor::STATUS_ACTIVE;

        DB::beginTransaction();
        try {
            Doctor::create($validatedData);
            DB::commit();
        } catch (\Exception $error) {
            DB::rollback();
            Log::error($error);
            return [Response::HTTP_INTERNAL_SERVER_ERROR, ['message' => [trans('messages.MsgErr006')]]];
        }

        return redirect()->route('doctors.index')
            ->with('success', 'Thêm mới bác sĩ đã được tạo thành công.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Doctor $doctor)
    {
        return view('admin.doctors.show', compact('doctor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Doctor $doctor)
    {
        $doctorDepartments = DoctorDepartment::all();
        return view('admin.doctors.edit', compact('doctor', 'doctorDepartments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Doctor $doctor)
    {
        $doctorId = $doctor->id;
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'doctor_department_id' => 'required|integer|exists:doctor_departments,id,deleted_at,NULL',
            'blood_group' => 'required|in:' . implode(',', array_keys(Doctor::$bloodGroups)),
            'email' => 'required|string|max:255|unique:doctors,email,' . $doctorId . '|regex:'
                . config('const.regex_email_admin'),
            'designation' => 'nullable|string|max:255',
            'phone' => 'nullable|size:10|regex:' . config('const.regex_telephone'),
            'profile' => 'nullable',
            'academic_level' => 'required|in:' . implode(',', array_keys(Doctor::$academicLevels)),
            'date_of_birth' => [
                'nullable',
                'date_format:' . config('const.format.date_form'),
                'before_or_equal:' . Carbon::now()->format(config('const.format.date_form'))
            ],
            'gender' => 'required|in:' . implode(',', array_keys(Doctor::$genders)),
            'address' => 'nullable|string|max:255',
            'identity_number' => [
                'required',
                'unique:doctors,identity_number,' . $doctorId . '',
                'regex:' . config('const.regex_identity_number'),
            ],
            'identity_card_date' => [
                'nullable',
                'date_format:' . config('const.format.date_form'),
                'before_or_equal:' . Carbon::now()->format(config('const.format.date_form'))
            ],
            'identity_card_place'  => 'nullable|string|max:255',
            'start_work_date' => [
                'nullable',
                'date_format:' . config('const.format.date_form'),
                'before_or_equal:' . Carbon::now()->format(config('const.format.date_form'))
            ],
            'specialist' => 'nullable|string|max:1000',
        ]);

        // Handle the avatar file upload
        if ($request->profile) {
            $imagePath = "./imgDoctor/" . $doctor->filename;
            // Delete the old profile file, if there is one
            if ($doctor->profile) {
                Storage::delete($doctor->profile);
                File::delete($imagePath);
            }

            $profile = $request->file('profile');

            $filename = time() . '_' . $profile->getClientOriginalName();
            // Store the new profile file
            $profilePath = $request->file('profile')->move('imgDoctor', $filename);
            $validatedData['profile'] = $profilePath;
            $validatedData['filename'] = $filename;
        }

        $validatedData['status'] = Doctor::STATUS_ACTIVE;

        DB::beginTransaction();
        try {
            $doctor->update($validatedData);
            $user = $doctor?->user;

            if ($user) {
                $user->update([
                    'email' => $doctor->email,
                    'name' => $doctor->name,
                ]);
            }
            DB::commit();
        } catch (\Exception $error) {
            DB::rollback();
            Log::error($error);
            return [Response::HTTP_INTERNAL_SERVER_ERROR, ['message' => [trans('messages.MsgErr006')]]];
        }


        return redirect()->route('doctors.index')
            ->with('success', 'Thông tin bác sĩ đã được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doctor $doctor)
    {
        DB::beginTransaction();
        try {
            $doctor->delete();
            if($doctor->user != null) {
                $doctor->user->delete();
            }
            DB::commit();
        } catch (\Exception $error) {
            DB::rollback();
            Log::error($error);
            return [Response::HTTP_INTERNAL_SERVER_ERROR, ['message' => [trans('messages.MsgErr006')]]];
        }

        return redirect()->route('doctors.index')
            ->with('success', 'Bác sĩ đã được xoá thành công.');
    }

    public function addAccountDoctor(Request $request, Doctor $doctor)
    {
        if (User::where('email', $doctor->email)->first()) {
            return redirect()->back()->with('alert', 'Email đã tồn tại, vui lòng chọn email khác!');
        }

        DB::beginTransaction();
        try {
            $user = User::create([
                'email' => $doctor->email,
                'name' => $doctor->name,
                'role' => User::ROLE_DOCTOR,
                'status' => User::STATUS_ACTIVE,
                'password' => Hash::make('Aa@123456')
            ]);
            $doctor->update([
                'user_id' => $user->id
            ]);
            DB::commit();
        } catch (\Exception $error) {
            DB::rollback();
            Log::error($error);
            return [Response::HTTP_INTERNAL_SERVER_ERROR, ['message' => [trans('messages.MsgErr006')]]];
        }

        Mail::send(new MailLogin($user));
        return redirect()->route('doctors.index')
            ->with('success', 'Thêm mới tài khoản cho bác sĩ thành công.');
    }
}
