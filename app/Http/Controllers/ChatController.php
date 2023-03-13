<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index() {
        $users = User::orderBy('id')->get();
        return view('user.chat', compact('users'));
    }
}
