<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function redirect()
    {
        if (Auth::id()) {
            return view('admin.home');
        } else {
            return redirect()->back();
        }
    }
}
