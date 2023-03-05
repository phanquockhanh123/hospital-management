<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
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
        // Kiểm tra xem request có chứa file không
        if ($request->hasFile('profile')) {
            // Lưu file vào thư mục uploads và lấy đường dẫn để lưu vào CSDL
            $path = $request->file('profile')->store('public\imgPatient');

            // Lấy tên file để hiển thị
            $fileName = $request->file('profile')->getClientOriginalName();
        } else {
            $path = null;
            $fileName = null;
        }
        $validatedData = $request->validate([
            'name' => 'required',
            'blood_group' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'date_of_birth' => 'required',
            'gender' => 'required',
            'profile' => 'nullable',
            'address' => 'required',
            'identity_number' => 'required',
            'identity_card_date' => 'required',
            'identity_card_place' => 'required',
        ]);

        // Lưu tệp
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
            'name' => 'required',
            'blood_group' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'date_of_birth' => 'required',
            'gender' => 'required',
            'profile' => 'nullable',
            'address' => 'required',
            'identity_number' => 'required',
            'identity_card_date' => 'required',
            'identity_card_place' => 'required',
        ]);
        if ($request->hasFile('profile')) {
            // Delete the old profile file, if there is one
            if ($patient->profile) {
                Storage::delete($patient->profile);
            }

            $profile = $request->file('profile');

            $filename = time() . '_' . $profile->getClientOriginalName();

            // Store the new profile file
            $profilePath = $request->file('profile')->store('public/imgPatient');
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
