<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Mail\MailLogin;
use App\Models\Receptionist;
use Illuminate\Http\Request;
use App\Mail\MailLoginReceptionist;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class ReceptionistController extends Controller
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
            $receptionists = Receptionist::where('name', 'LIKE', '%' . $search . '%')
                ->orderByDesc('created_at')->paginate(config('const.perPage'));
        } else {
            $receptionists = Receptionist::orderByDesc('created_at')->paginate(config('const.perPage'));
        }

        return view('admin.receptionists.index', compact('receptionists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('admin.receptionists.create');
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
            'email' => 'required|string|max:255|unique:doctors,email|regex:'
                . config('const.regex_email_admin'),
            'designation' => 'nullable|string|max:255',
            'phone' => 'nullable|size:10|regex:' . config('const.regex_telephone'),
            'profile' => 'nullable',
            'date_of_birth' => [
                'nullable',
                'date_format:' . config('const.format.date_form'),
                'before_or_equal:' . Carbon::now()->format(config('const.format.date_form'))
            ],
            'gender' => 'required|in:' . implode(',', array_keys(Receptionist::$genders)),
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
        ]);

        // Lưu ảnh
        if ($request->hasFile('profile')) {
            $profile = $request->file('profile');

            $filename = time() . '_' . $profile->getClientOriginalName();

            $path = $profile->move('imgReceptionist', $filename);

            $validatedData['profile'] = $path;
            $validatedData['filename'] = $filename;
        }

        $validatedData['status'] = Receptionist::STATUS_ACTIVE;
        Receptionist::create($validatedData);

        return redirect()->route('receptionists.index')
            ->with('success', 'Thêm mới lễ tân đã được tạo thành công.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Receptionist $receptionist)
    {
        return view('admin.receptionists.show', compact('receptionist'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Receptionist $receptionist)
    {
        return view('admin.receptionists.edit', compact('receptionist'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Receptionist $receptionist)
    {
        $receptionistId = $receptionist->id;
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:doctors,email,' . $receptionistId . '|regex:'
                . config('const.regex_email_admin'),
            'designation' => 'nullable|string|max:255',
            'phone' => 'nullable|size:10|regex:' . config('const.regex_telephone'),
            'profile' => 'nullable',
            'date_of_birth' => [
                'nullable',
                'date_format:' . config('const.format.date_form'),
                'before_or_equal:' . Carbon::now()->format(config('const.format.date_form'))
            ],
            'gender' => 'required|in:' . implode(',', array_keys(Receptionist::$genders)),
            'address' => 'nullable|string|max:255',
            'identity_number' => [
                'required',
                'unique:doctors,identity_number,' . $receptionistId . '',
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
            ]
        ]);

        // Handle the avatar file upload
        if ($request->profile) {
            $imagePath = "./imgReceptionist/" . $receptionist->filename;
            // Delete the old profile file, if there is one
            if ($receptionist->profile) {
                Storage::delete($receptionist->profile);
                File::delete($imagePath);
            }

            $profile = $request->file('profile');

            $filename = time() . '_' . $profile->getClientOriginalName();
            // Store the new profile file
            $profilePath = $request->file('profile')->move('imgReceptionist', $filename);
            $validatedData['profile'] = $profilePath;
            $validatedData['filename'] = $filename;
        }

        $validatedData['status'] = Receptionist::STATUS_ACTIVE;

        $receptionist->update($validatedData);

        $user = $receptionist?->user;
        if ($user) {
            $user->update([
                'email' => $receptionist->email,
                'name' => $receptionist->name,
            ]);
        }

        return redirect()->route('receptionists.index')
            ->with('success', 'Thông tin lễ tân đã được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receptionist $receptionist)
    {
        $receptionist->delete();
        $receptionist->user->delete();
        return redirect()->route('receptionists.index')
            ->with('success', 'Lễ tân đã được xoá thành công.');
    }

    public function addAccountReceptionist(Request $request,Receptionist $receptionist) {
        if (User::where('email', $receptionist->email)->first()) {
            return redirect()->back() ->with('alert', 'Email đã tồn tại, vui lòng chọn email khác!');
        }
        $user = User::create([
            'email' => $receptionist->email,
            'name' => $receptionist->name,
            'role' => User::ROLE_RECEPTIONIST,
            'status' => User::STATUS_ACTIVE,
            'password' => Hash::make('Aa@123456')
        ]);
        $receptionist->update([
            'user_id' => $user->id
        ]);
        Mail::send(new MailLoginReceptionist($user));
        return redirect()->route('$receptionists.index')
            ->with('success', 'Thêm mới tài khoản cho bác sĩ thành công.');
    }
}
