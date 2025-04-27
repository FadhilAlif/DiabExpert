<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AdminAuthController extends Controller
{
    /**
     * Menampilkan halaman login
     * 
     * @return \Illuminate\View\View
     */
    function index()
    {
        return view('admin.auth.login');
    }

    /**
     * Memproses permintaan login
     * Melakukan autentikasi dan mengarahkan ke halaman diagnosa jika berhasil
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Coba melakukan autentikasi
        if (Auth::attempt($data)) {
            $request->session()->regenerate();
            return redirect('/diagnosa');
        }

        // Jika autentikasi gagal
        return back()->with('loginError', 'Gagal Login. Data tidak ditemukan');
    }

    /**
     * Memproses logout pengguna
     * Menghapus sesi dan mengarahkan ke halaman utama
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    }
}
