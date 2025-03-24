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
        Alert::success('Sukses', 'Data Pasien Telah dihapus');
        return redirect('/admin/pasien');
    }


    public function print($pasien_id)
    {
        $pasien = Pasien::with('penyakit')->find($pasien_id);
        
        if (!$pasien) {
            Alert::error('Error', 'Pasien tidak ditemukan');
            return redirect()->back();
        }
        
        // Ambil semua diagnosa berdasarkan penyakit
        $diagnosaPerPenyakit = Diagnosa::with('gejala')
            ->where('pasien_id', $pasien_id)
            ->get()
            ->groupBy('penyakit_id'); // Kelompokkan berdasarkan penyakit
    
        $gejalaTerpilih = collect();
    
        foreach ($diagnosaPerPenyakit as $penyakit_id => $diagnosa) {
            // Kelompokkan berdasarkan gejala_id agar tidak duplikat
            $gejalaPerPenyakit = $diagnosa->groupBy('gejala_id')->map(function ($items) {
                return $items->first(); // Ambil hanya satu data per gejala
            });
    
            $gejalaTerpilih = $gejalaTerpilih->merge($gejalaPerPenyakit);
        }

        // Hapus duplikasi gejala
        $gejalaTerpilih = $gejalaTerpilih->unique('gejala_id');
    
        $data = [
            'title'  => 'Hasil Diagnosa',
            'pasien' => $pasien,
            'gejala' => $gejalaTerpilih,
        ];
    
        return view('admin.pasien.cetak', $data);
    }    
};