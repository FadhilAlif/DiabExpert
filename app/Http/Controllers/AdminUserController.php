<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // dd($request->all());
        $data =  $request->validate([
            'name'      => 'required',
            'email'      => 'required|unique:users',
            'role'      => 'required',
            'password'      => 'required',
            're_pass'       => 'required|same:password'
        ]);

        $data['password']   = Hash::make($data['password']);
        $user = User::create($data);
        // dd($user);
        Alert::success('Sukses', 'Data Telah ditambahkan');
        return redirect('/admin/user');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        // die('masuk');
        $user = User::find($id);
        $user->delete();
        Alert::success('Sukses', 'Data Telah dihapus');
        return redirect('/admin/user');
    }
}
