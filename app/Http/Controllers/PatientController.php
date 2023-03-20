<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class PatientController extends Controller
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
            $patients = Patient::where('name', 'LIKE', '%' . $search . '%')
                ->orderByDesc('created_at')->paginate(config('const.perPage'));
        } else {
            $patients = Patient::orderByDesc('created_at')->paginate(config('const.perPage'));
        }

        return view('admin.patients.index', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('admin.patients.create');
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
            'blood_group' => 'required|in:' . implode(',', array_keys(Patient::$bloodGroups)),
            'email' => 'required|string|max:255|unique:doctors,email|regex:'
            . config('const.regex_email_admin'),
            'phone' => 'nullable|size:10|regex:' . config('const.regex_telephone'),
            'date_of_birth'  => [
                'required',
                'date_format:' . config('const.format.date_form'),
                'before_or_equal:' . Carbon::now()->format(config('const.format.date_form'))
            ],
            'gender' => 'required|in:' . implode(',', array_keys(Patient::$genders)),
            'profile'  => 'required|file|max:5120|file|mimes:'
            . implode(',', config('const.application_cv_file_extension')),
            'address' => 'required|string|max:255',
            'identity_number' => [
                'required',
                'regex:' . config('const.regex_identity_number'),
            ],
            'identity_card_date' => [
                'nullable',
                'date_format:' . config('const.format.date_form'),
                'before_or_equal:' . Carbon::now()->format(config('const.format.date_form'))
            ],
            'identity_card_place'  => 'nullable|string|max:255',
        ]);

        // Lưu ảnh
        if ($request->hasFile('profile')) {
            $profile = $request->file('profile');

            $filename = time() . '_' . $profile->getClientOriginalName();

            $path = $profile->move('imgPatient', $filename);

            $validatedData['profile'] = $path;
            $validatedData['filename'] = $filename;
        }
        $validatedData['patient_code'] = Patient::generateNextCode();
        $validatedData['profile'] = $path;
        Patient::create($validatedData);

        return redirect()->route('patients.index')
            ->with('success', 'Thêm mới bệnh nhân đã được tạo thành công.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient)
    {
        return view('admin.patients.show', compact('patient'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient)
    {
        return view('admin.patients.edit', compact('patient'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'blood_group' => 'required|in:' . implode(',', array_keys(Patient::$bloodGroups)),
            'email' => 'required|string|max:255|unique:doctors,email|regex:'
            . config('const.regex_email_admin'),
            'phone' => 'nullable|size:10|regex:' . config('const.regex_telephone'),
            'date_of_birth'  => [
                'required',
                'date_format:' . config('const.format.date_form'),
                'before_or_equal:' . Carbon::now()->format(config('const.format.date_form'))
            ],
            'gender' => 'required|in:' . implode(',', array_keys(Patient::$genders)),
            'profile'  => 'required',
            'address' => 'required|string|max:255',
            'identity_number' => [
                'required',
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

        return redirect()->route('patients.index')
            ->with('success', 'Thông tin bệnh nhân đã được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient)
    {
        $patient->delete();

        return redirect()->route('patients.index')
            ->with('success', 'Bệnh nhân đã được xoá thành công.');
    }
}
