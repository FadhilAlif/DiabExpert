<?php

namespace App\Http\Controllers;

use App\Models\Gejala;
use App\Models\Penyakit;
use App\Models\Role;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PenyakitController extends Controller
{
    /**
     * Menampilkan daftar semua penyakit
     * 
     * @return \Illuminate\View\View
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
     * Menampilkan form untuk menambah penyakit baru
     * 
     * @return \Illuminate\View\View
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
     * Menyimpan data penyakit baru ke database
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validasi input data
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
     * Menampilkan detail penyakit beserta gejala terkait
     * 
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // Mengambil semua relasi (role) antara penyakit dan gejala
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
     * Menampilkan form untuk mengedit penyakit
     * 
     * @param  int  $id
     * @return \Illuminate\View\View
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
     * Memperbarui data penyakit di database
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
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
     * Menghapus data penyakit dari database
     * 
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        //
        $penyakit = Penyakit::find($id);
        $penyakit->delete();
        Alert::success('Sukses', 'Data Telah dihapus');
        return redirect('/admin/penyakit');
    }

    /**
     * Menambahkan relasi gejala ke penyakit dengan bobot CF tertentu
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    function addGejala(Request $request)
    {
        // Membuat relasi baru antara penyakit dan gejala (role)
        $data = [
            'penyakit_id' => $request->penyakit_id,
            'gejala_id' => $request->gejala_id,
            'bobot_cf' => $request->bobot_cf,
        ];

        Role::create($data);
        return redirect('/admin/penyakit/' . $request->penyakit_id);
    }

    /**
     * Menghapus relasi antara gejala dan penyakit
     * 
     * @param  int  $id ID dari role yang akan dihapus
     * @return \Illuminate\Http\RedirectResponse
     */
    function deleteRole($id)
    {
        $role = Role::find($id);
        $role->delete();
        Alert::success('Sukses', 'Data Telah dihapus');
        return redirect('/admin/penyakit/' . $role->penyakit_id);
    }
}
