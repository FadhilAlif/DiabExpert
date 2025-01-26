<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AdminAuthController extends Controller
{
    //

    function index()
    {
        return view('admin.auth.login');
    }

    function login(Request $request)
    {
        // dd('masuk');
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($data)) {
            $request->session()->regenerate();
            return redirect('/diagnosa');
        }

        return back()->with('loginError', 'Gagal Login. Data tidak ditemukan');
    }

    function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/login');
    }
}
