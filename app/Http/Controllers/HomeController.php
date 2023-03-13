<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\User;
use App\Models\Doctor;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $doctors = Doctor::where('status', 1)->get();
        $news = News::where('status', News::STATUS_SUBMITTED)->orderByDesc('priority_level')->orderByDesc('created_at')->get();
        return view('user.home', compact('doctors', 'news'));
    }
}
