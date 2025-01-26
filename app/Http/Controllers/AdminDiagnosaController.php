<?php

namespace App\Http\Controllers;

use App\Models\Diagnosa;
use App\Models\Gejala;
use App\Models\Pasien;
use App\Models\Penyakit;
use App\Models\Role;
use Illuminate\Http\Request;

class AdminDiagnosaController extends Controller
{
    //

    // public function __construct()
    // {
    //     // Middleware untuk memastikan hanya admin yang dapat mengakses fitur admin
    //     $this->middleware('auth')->except(['index', 'createPasien', 'pilihGejala', 'pilih', 'hapusGejalaTerpilih', 'prosesDiagnosa', 'keputusan']);
    // }

    public function index()
    {
        //
        $data = [
            'title'     => 'Diagnosa Penyakit',
            'content'   => 'admin/diagnosa/index'
        ];
        return view('admin.layouts.wrapper', $data);
    }

    function createPasien(Request $request)
    {
        $data = [
            'name'      => $request->name,
            'umur'      => $request->umur,
        ];
        $pasien = Pasien::create($data);
        session()->put('pasien_id', $pasien->id);
        return redirect('/diagnosa/pilih-gejala'); 
    }    

    public function pilihGejala()
    {
        //
        $pasien_id = session()->get('pasien_id');
        $data = [
            'title'     => 'Diagnosa Penyakit',
            'pasien'    => Pasien::find($pasien_id),
            'gejala'    => Gejala::get(),
            'gejelaTerpilih' => Diagnosa::with('gejala')->wherePasienId($pasien_id)->groupBy('gejala_id')->get(),
            'content'   => 'admin/diagnosa/pilihgejala'
        ];
        return view('admin.layouts.wrapper', $data);
    }

    public function pilih(Request $request)
    {
        // Ambil gejala_id dan nilai_cf dari query string
        $gejala_id = $request->get('gejala_id');
        $nilai_cf = $request->get('nilai');
    
        // Dapatkan data role terkait gejala_id
        $role = Role::whereGejalaId($gejala_id)->get();
    
        foreach ($role as $r) {
            $data  = [
                'pasien_id' => session()->get('pasien_id'),
                'penyakit_id' => $r->penyakit_id,
                'gejala_id' => $gejala_id,
                'nilai_cf' => $nilai_cf,
                'cf_hasil'  => $nilai_cf * $r->bobot_cf
            ];
            // Simpan diagnosa ke dalam database
            Diagnosa::create($data);
        }
    
        // Redirect ke halaman pilih-gejala setelah pemilihan gejala
        return redirect('/diagnosa/pilih-gejala');
    }    

    function hapusGejalaTerpilih()
    {
        $gejala_id = request('gejala_id');
        $pasien_id = session()->get('pasien_id');

        // dd($pasien_id);
        $diagnosa = Diagnosa::whereGejalaId($gejala_id)->wherePasienId($pasien_id)->get();
        foreach ($diagnosa as $item) {
            $d = Diagnosa::find($item->id);
            $d->delete();
        }
        return redirect('/diagnosa/pilih-gejala');
    }

    public function prosesDiagnosa()
    {
        $pasien_id = session()->get('pasien_id');
        $hasil = 0;
        $penyakit_id = '';
    
        // Proses diagnosa sesuai dengan logika Anda
        $role = Role::get();
        foreach ($role as $r) {
            $diagnosa = Diagnosa::wherePasienId($pasien_id)->wherePenyakitId($r->penyakit_id)->whereGejalaId($r->gejala_id)->first();
    
            if ($diagnosa == null) {
                $data = [
                    'pasien_id' => session()->get('pasien_id'),
                    'penyakit_id' => $r->penyakit_id,
                    'gejala_id' => $r->gejala_id,
                    'nilai_cf' => 0,
                    'cf_hasil'  => 0
                ];
    
                Diagnosa::create($data);
            }
        }
    
        $penyakit = Penyakit::get();
        foreach ($penyakit as $p) {
            $diagnosa = Diagnosa::wherePenyakitId($p->id)->wherePasienId($pasien_id)->get();
            $diagnosa_hasil = $this->hitung_cf($diagnosa);
            if ($diagnosa_hasil > $hasil) {
                $hasil = $diagnosa_hasil;
                $penyakit_id = $p->id;
            }
        }
    
        // Update pasien dengan hasil diagnosa
        $pasien = Pasien::find($pasien_id);
        $pasien->akumulasi_cf = $hasil;
        $pasien->persentase  = round($hasil * 100);
        $pasien->penyakit_id = $penyakit_id;
        $pasien->save();
    
        // Redirect ke halaman keputusan tanpa prefix admin
        return redirect('/diagnosa/keputusan/' . $pasien_id);
    }
    
    function hitung_cf($data)
    {
        $cf_old = 0;
        foreach ($data as $key => $value) {
            if ($key == 0) {
                $cf_old =  0;
            } else {
                $cf_old = $cf_old + $value->cf_hasil * (1 - $cf_old);
            }
        }

        return $cf_old;
    }

    public function keputusan($pasien_id)
    {
        //

        if ($pasien_id == null) {
            $pasien_id = session()->get('pasien_id');
        }
        $data = [
            'title'     => 'Hasil Diagnosa',
            'pasien'    => Pasien::with('penyakit')->find($pasien_id),
            'gejala'    => Diagnosa::with('gejala')->wherePasienId($pasien_id)->get(),
            'content'   => 'admin/diagnosa/keputusan'
        ];
        return view('admin.layouts.wrapper', $data);
    }
}