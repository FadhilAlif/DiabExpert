<?php

namespace App\Http\Controllers;

use App\Models\Gejala;
use App\Models\Penyakit;
use App\Models\Role;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AdminPenyakitController extends Controller
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
            'title'     => 'Manajemen Penyakit',
            'penyakit'      => Penyakit::get(),
            'content'   => 'admin/penyakit/index'
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
            'title'     => 'Tambah Penyakit',
            'content'   => 'admin/penyakit/create'
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
            'desc'      => 'required',
            'penanganan'      => 'required',
        ]);

        Penyakit::create($data);
        Alert::success('Sukses', 'Data Telah ditambahkan');
        return redirect('/admin/penyakit');
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

        $role = Role::with('gejala')->wherePenyakitId($id)->get();
        $data = [
            'title'     => 'Penyakit',
            'penyakit'  => Penyakit::find($id),
            'gejala'    => Gejala::get(),
            'role'      => $role,
            'content'   => 'admin/penyakit/show'
        ];
        return view('admin.layouts.wrapper', $data);
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
            'title'     => 'Edit Penyakit',
            'penyakit'      => Penyakit::find($id),
            'content'   => 'admin/penyakit/create'
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
        $penyakit = Penyakit::find($id);
        $data =  $request->validate([
            'name'      => 'required',
            'desc'      => 'required',
            'penanganan'      => 'required',
        ]);


        $penyakit->update($data);
        Alert::success('Sukses', 'Data Telah diubah');
        return redirect('/admin/penyakit');
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
        $penyakit = Penyakit::find($id);
        $penyakit->delete();
        Alert::success('Sukses', 'Data Telah dihapus');
        return redirect('/admin/penyakit');
    }

    function addGejala(Request $request)
    {
        // dd($request->all());
        $data = [
            'penyakit_id' => $request->penyakit_id,
            'gejala_id' => $request->gejala_id,
            'bobot_cf' => $request->bobot_cf,
        ];

        Role::create($data);
        Alert::success('Sukses', 'Data Telah tersimpan');
        return redirect('/admin/penyakit/' . $request->penyakit_id);
    }

    function deleteRole($id)
    {
        $role = Role::find($id);
        $role->delete();
        Alert::success('Sukses', 'Data Telah dihapus');
        return redirect('/admin/penyakit/' . $role->penyakit_id);
    }
}
