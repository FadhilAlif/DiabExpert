<?php

namespace App\Http\Controllers;

use App\Models\Gejala;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AdminGejalaController extends Controller
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
            'title'     => 'Manajemen Gejala',
            'gejala'      => Gejala::get(),
            'content'   => 'admin/gejala/index'
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
            'title'     => 'Tambah Gejala',
            'content'   => 'admin/gejala/create'
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
            'kode_gejala'      => 'required|unique:gejalas',
            'name'      => 'required',
            'nilai_cf'      => 'required',
        ]);

        Gejala::create($data);
        Alert::success('Sukses', 'Data Telah ditambahkan');
        return redirect('/admin/gejala');
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
            'title'     => 'Edit Gejala',
            'gejala'      => Gejala::find($id),
            'content'   => 'admin/gejala/create'
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
        $gejala = Gejala::find($id);
        $data =  $request->validate([
            'kode_gejala'      => 'required|unique:gejalas',
            'name'      => 'required',
            'nilai_cf'      => 'required',
        ]);


        $gejala->update($data);
        Alert::success('Sukses', 'Data Telah diubah');
        return redirect('/admin/gejala');
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
        $gejala = Gejala::find($id);
        $gejala->delete();
        Alert::success('Sukses', 'Data Telah dihapus');
        return redirect('/admin/gejala');
    }
}
