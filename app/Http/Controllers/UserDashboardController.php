<?php

namespace App\Http\Controllers;

class UserDashboardController extends Controller
{
    public function dashboard()
    {
        return view('user.dashboard', [
            'student' => auth()->user()->student()->with('department')->first(),
        ]);
    }
}
