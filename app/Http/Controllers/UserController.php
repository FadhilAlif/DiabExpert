<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    /**
     * Menampilkan daftar semua pengguna
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        //
        $data = [
            'title'     => 'Manajemen User',
            'user'      => User::get(),
            'content'   => 'admin/user/index'
        ];
        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Menampilkan form untuk membuat pengguna baru
     * 
     * @return \Illuminate\View\View
     */
    public function create()
    {
        //
        $data = [
            'title'     => 'Tambah User',
            'content'   => 'admin/user/create'
        ];
        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Menyimpan data pengguna baru ke dalam database
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validasi input data
        $data =  $request->validate([
            'name'      => 'required',
            'email'      => 'required|unique:users',
            'role'      => 'required',
            'password'      => 'required',
            're_pass'       => 'required|same:password'
        ]);

        // Hash password sebelum disimpan untuk keamanan
        $data['password']   = Hash::make($data['password']);
        $user = User::create($data);
        
        Alert::success('Sukses', 'Data Telah ditambahkan');
        return redirect('/admin/user');
    }

    /**
     * Menampilkan detail pengguna tertentu
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Menampilkan form untuk mengubah data pengguna
     * 
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        //
        $data = [
            'title'     => 'Tambah User',
            'user'      => User::find($id),
            'content'   => 'admin/user/create'
        ];
        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Memperbarui data pengguna di database
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        //
        $user = User::find($id);
        $data =  $request->validate([
            'name'      => 'required',
            'email'      => 'required',
            'role'      => 'required',
        ]);

        // Hanya update password jika diisi, jika tidak gunakan password yang sudah ada
        if ($request->password == '') {
            $data['password']   = $user->password;
        } else {
            $data['password']   = Hash::make($request['password']);
        }
        $user->update($data);
        Alert::success('Sukses', 'Data Telah diubah');
        return redirect('/admin/user');
    }

    /**
     * Menghapus data pengguna dari database
     * 
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        Alert::success('Sukses', 'Data Telah dihapus');
        return redirect('/admin/user');
    }
}
