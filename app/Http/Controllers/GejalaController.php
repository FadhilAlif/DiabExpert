<?php

namespace App\Http\Controllers;

use App\Models\Gejala;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class GejalaController extends Controller
{
    /**
     * Menampilkan daftar semua gejala
     * 
     * @return \Illuminate\View\View
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
     * Menampilkan form untuk membuat gejala baru
     * 
     * @return \Illuminate\View\View
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
     * Menyimpan data gejala baru ke database
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validasi input data
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
     * Menampilkan detail gejala tertentu
     * 
     * @param  int  $id
     * @return void
     */
    public function show($id)
    {
        // Method ini tidak diimplementasikan
    }

    /**
     * Menampilkan form untuk mengedit gejala
     * 
     * @param  int  $id
     * @return \Illuminate\View\View
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
     * Memperbarui data gejala di database
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        //
        $gejala = Gejala::find($id);
        $data =  $request->validate([
            'kode_gejala'      => 'required|unique:gejalas,kode_gejala,' . $id,
            'name'      => 'required',
            'nilai_cf'      => 'required',
        ]);


        $gejala->update($data);
        Alert::success('Sukses', 'Data Telah diubah');
        return redirect('/admin/gejala');
    }

    /**
     * Menghapus data gejala dari database
     * 
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        //
        $gejala = Gejala::find($id);
        $gejala->delete();
        Alert::success('Sukses', 'Data Telah dihapus');
        return redirect('/admin/gejala');
    }
}
