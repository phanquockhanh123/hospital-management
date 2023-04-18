<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
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
            $users = User::where('name', 'LIKE', '%' . $search . '%')->where('id', '!=', Auth::user()->id)
                ->orderByDesc('created_at')->paginate(config('const.perPage'));
        } else {
            $users = User::orderByDesc('created_at')->where('id', '!=', Auth::user()->id)->paginate(config('const.perPage'));
        }

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $users = Doctor::whereNull('user_id')->get();
        return view('admin.users.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'user_id' => 'required',
            'password' => 'required|min:8|regex:#(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])#',
            'confirmPassword' => 'required_with:password|same:password|min:6',
            
        ]);
        $validatedData = $request->all();

        // Lưu tệp
        if ($request->hasFile('profile')) {
            $profile = $request->file('profile');

            $filename = time() . '_' . $profile->getClientOriginalName();
            $path = $profile->move('imgUser', $filename);
            $validatedData['profile'] = $path;
            $validatedData['filename'] = $filename;
        }
        $validatedData['status'] = User::STATUS_ACTIVE;
        $validatedData['password'] = Hash::make($request->password);
        User::create($validatedData);

        return redirect()->route('users.index')
            ->with('success', 'Người dùng đã được tạo thành công.');
    }

    /**
     * Display the specified resource.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $userId = $user->id;
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users,email,' . $userId . '|regex:'
                . config('const.regex_email_admin'),
            'phone' => 'nullable|size:10|regex:' . config('const.regex_telephone'),
            'gender' => 'nullable|in:' . implode(',', array_keys(User::$gender)),
            'address' => 'nullable|max:10|string',
            'role' => 'nullable|in:' . implode(',', array_keys(User::$roles)),
            'dob' => [
                'nullable',
                'date_format:' . config('const.format.date_form'),
                'before_or_equal:' . Carbon::now()->format(config('const.format.date_form'))
            ],
            'profile' => 'required',
        ]);
        if ($request->profile) {
            $imagePath = "./imgUser/" . $user->filename;
            // Delete the old profile file, if there is one
            if ($user->profile) {
                Storage::delete($user->profile);
                File::delete($imagePath);
            }

            $profile = $request->file('profile');

            $filename = time() . '_' . $profile->getClientOriginalName();

            // Store the new profile file
            $profilePath = $request->file('profile')->move('imgUser', $filename);

            // 
            $validatedData['profile'] = $profilePath;
            $validatedData['filename'] = $filename;
        }
        $validatedData['status'] = User::STATUS_ACTIVE;

        $user->update($validatedData);

        return redirect()->route('users.index')
            ->with('success', 'Thông tin người dùng đã được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')
            ->with('success', 'Người dùng đã được xoá thành công.');
    }
}
