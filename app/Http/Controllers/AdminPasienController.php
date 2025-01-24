<?php

namespace App\Http\Controllers;

use App\Models\Diagnosa;
use App\Models\Pasien;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AdminPasienController extends Controller
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
            'title'     => 'Manajemen Pasien',
            'pasien'      => Pasien::with('penyakit')->orderBy('created_at', 'DESC')->paginate(10),
            'content'   => 'admin/pasien/index'
        ];
        return view('admin.layouts.wrapper', $data);
    }


    public function destroy($id)
    {
        //
        // die('masuk');
        $pasien = Pasien::find($id);
        $pasien->delete();
        Alert::success('Sukses', 'Data Telah dihapus');
        return redirect('/admin/pasien');
    }


    public function print($pasien_id)
    {
        //

        $data = [
            'title'     => 'Hasil Diagnosa',
            'pasien'    => Pasien::with('penyakit')->find($pasien_id),
            'gejala'    => Diagnosa::with('gejala')->wherePasienId($pasien_id)->get(),
        ];
        return view('admin.pasien.cetak', $data);
    }
}
