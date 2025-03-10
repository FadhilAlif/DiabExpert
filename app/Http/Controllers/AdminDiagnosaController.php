<?php

namespace App\Http\Controllers;

use App\Models\Diagnosa;

use App\Models\Gejala;
use App\Models\Pasien;
use App\Models\Penyakit;
use App\Models\Role;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AdminDiagnosaController extends Controller
{
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
            'umur'          => $request->umur,
            'jenis_kelamin' => $request->jenis_kelamin
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
        $nilai_cf_user = $request->get('nilai');
    
        // Dapatkan data role terkait gejala_id
        $role = Role::whereGejalaId($gejala_id)->get();
    
        foreach ($role as $r) {
            // Hitung CF berdasarkan nilai_cf pengguna dan bobot CF pada role
            $cf_hasil = $nilai_cf_user * $r->bobot_cf;
    
            // Simpan diagnosa ke dalam database
            $data  = [
                'pasien_id' => session()->get('pasien_id'),
                'penyakit_id' => $r->penyakit_id,
                'gejala_id' => $gejala_id,
                'nilai_cf' => $nilai_cf_user,
                'cf_hasil'  => $cf_hasil
            ];
    
            Diagnosa::create($data);
        }
    
        return redirect('/diagnosa/pilih-gejala');
    }
    


    function hapusGejalaTerpilih()
    {
        $gejala_id = request('gejala_id');
        $pasien_id = session()->get('pasien_id');

        $diagnosa = Diagnosa::whereGejalaId($gejala_id)->wherePasienId($pasien_id)->get();
        foreach ($diagnosa as $item) {
            $d = Diagnosa::find($item->id);
            $d->delete();
        }
        return redirect('/diagnosa/pilih-gejala');
    }

    public function updateKondisi(Request $request)
    {
        $diagnosa_id = $request->input('diagnosa_id');
        $nilai = $request->input('nilai');
    
        // Temukan diagnosa berdasarkan ID
        $diagnosa = Diagnosa::find($diagnosa_id);
    
        // Pastikan data ditemukan
        if ($diagnosa) {
            // Update nilai_cf sesuai dengan nilai baru
            $diagnosa->nilai_cf = $nilai;
    
            // Hitung kembali cf_hasil
            $role = Role::whereGejalaId($diagnosa->gejala_id)->first();
            $cf_hasil = $nilai * $role->bobot_cf;
            $diagnosa->cf_hasil = $cf_hasil;
    
            // Simpan perubahan
            $diagnosa->save();
    
            // Mengirimkan respons JSON
            return response()->json(['success' => true]);
        }
    
        // Jika gagal menemukan data
        return response()->json(['success' => false]);
    }    

    public function prosesDiagnosa()
    {
        $pasien_id = session()->get('pasien_id');
        
        // Dapatkan semua diagnosa berdasarkan pasien
        $diagnosa = Diagnosa::where('pasien_id', $pasien_id)->get();
        
        // Periksa gejala diagnosa 
        if (count($diagnosa) == 0) {
            Alert::error('Error', 'Pilih gejala terlebih dahulu');
            return redirect()->back();
        }

        $penyakit_hasil = [];
        
        // Dapatkan semua diagnosa berdasarkan penyakit
        $diagnosaPerPenyakit = $diagnosa->groupBy('penyakit_id');
        
        foreach ($diagnosaPerPenyakit as $penyakit_id => $diagnosa) {
            $penyakit_hasil[$penyakit_id] = $this->hitung_cf($diagnosa);
        }
        
        // Ambil penyakit dengan CF tertinggi
        $penyakit_tertinggi = collect($penyakit_hasil)->sortDesc()->keys()->first();
        $cf_tertinggi = $penyakit_hasil[$penyakit_tertinggi];
        
        // Simpan hasil ke database
        $pasien = Pasien::find($pasien_id);
        $pasien->akumulasi_cf = $cf_tertinggi;
        $pasien->persentase = round($cf_tertinggi * 100, 2);
        $pasien->penyakit_id = $penyakit_tertinggi;
        $pasien->save();
        
        return redirect('/diagnosa/keputusan/' . $pasien_id);
    }
    
    public function hitung_cf($data)
    {
        $cfOld = 0; // CF awal
    
        // Urutkan gejala berdasarkan CF Gejala (cf_hasil) dari yang terbesar ke terkecil
        $data = $data->sortByDesc('cf_hasil'); 
        
        foreach ($data as $item) {
            $cfNew = $item->cf_hasil; // Ambil nilai CF gejala
            $cfOld = $cfOld + ($cfNew * (1 - $cfOld)); // Terapkan rumus CF Combine
        }
        
        return $cfOld;
    }
    
    public function keputusan($pasien_id)
    {
        if ($pasien_id == null) {
            $pasien_id = session()->get('pasien_id');
        }
    
        $pasien = Pasien::with('penyakit')->find($pasien_id);
    
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
            'content' => 'admin/diagnosa/keputusan'
        ];
    
        return view('admin.layouts.wrapper', $data);
    }          
}