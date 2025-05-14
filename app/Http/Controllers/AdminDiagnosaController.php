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
    /**
     * Menampilkan halaman utama diagnosa penyakit
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        //
        $data = [
            'title'     => 'Diagnosa Penyakit',
            'content'   => 'admin/diagnosa/index'
        ];
        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Membuat data pasien baru berdasarkan input umur dan jenis kelamin
     * Menyimpan ID pasien ke session untuk digunakan di proses selanjutnya
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * Menampilkan halaman pilih gejala untuk diagnosa
     * Memuat data pasien, daftar gejala, dan gejala yang sudah dipilih
     * 
     * @return \Illuminate\View\View
     */
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

    /**
     * Memproses gejala yang dipilih dan menghitung nilai CF untuk setiap penyakit terkait
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function pilih(Request $request)
    {
        // Ambil gejala_id dan nilai_cf dari query string
        $gejala_id = $request->get('gejala_id');
        $nilai_cf_user = $request->get('nilai');
    
        // Dapatkan data role terkait gejala_id
        $role = Role::whereGejalaId($gejala_id)->get();
    
        foreach ($role as $r) {
            // CF hasil = CF user * CF pakar
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
    
    /**
     * Menghapus gejala yang telah dipilih oleh pasien
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    function hapusGejalaTerpilih()
    {
        $gejala_id = request('gejala_id');
        $pasien_id = session()->get('pasien_id');

        // Hapus semua diagnosa dengan gejala_id dan pasien_id yang sesuai
        $diagnosa = Diagnosa::whereGejalaId($gejala_id)->wherePasienId($pasien_id)->get();
        foreach ($diagnosa as $item) {
            $d = Diagnosa::find($item->id);
            $d->delete();
        }
        return redirect('/diagnosa/pilih-gejala');
    }

    /**
     * Memperbarui kondisi (nilai_cf) dari gejala yang dipilih
     * dan menghitung ulang cf_hasil
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
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

    /**
     * Memproses diagnosa dengan menghitung certainty factor
     * dan menentukan penyakit dengan CF tertinggi
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
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
        
        // Hitung CF kombinasi untuk setiap penyakit
        foreach ($diagnosaPerPenyakit as $penyakit_id => $diagnosa) {
            $penyakit_hasil[$penyakit_id] = $this->hitung_cf($diagnosa);
        }
        
        // Ambil penyakit dengan CF tertinggi
        $penyakit_tertinggi = collect($penyakit_hasil)->sortDesc()->keys()->first();
        $cf_tertinggi = $penyakit_hasil[$penyakit_tertinggi];
        
        // Simpan hasil ke database
        $pasien = Pasien::find($pasien_id);
        $pasien->akumulasi_cf = round($cf_tertinggi, 4); // Bulatkan ke 4 desimal
        $pasien->persentase = round($pasien->akumulasi_cf * 100, 2); // Hitung persentase dan bulatkan ke 2 desimal
        $pasien->penyakit_id = $penyakit_tertinggi;
        $pasien->save();
        
        return redirect('/diagnosa/keputusan/' . $pasien_id);
    }
    
    /**
     * Menghitung nilai Certainty Factor (CF) gabungan dari beberapa gejala
     * Menggunakan metode CF Combine: CF(H,E) = CF(E) + CF(H) * (1 - CF(E))
     * 
     * @param \Illuminate\Support\Collection $data Kumpulan diagnosa
     * @return float Nilai CF gabungan
     */
    public function hitung_cf($data)
    {
        $cfOld = 0; // CF awal
    
        // Urutkan gejala berdasarkan CF Gejala (cf_hasil) dari yang terbesar ke terkecil
        $data = $data->sortByDesc('cf_hasil'); 
        
        // Iterasi setiap gejala dan terapkan rumus CF Combine
        foreach ($data as $item) {
            $cfNew = $item->cf_hasil; // Ambil nilai CF gejala
            $cfOld = $cfOld + ($cfNew * (1 - $cfOld)); // Terapkan rumus CF Combine
        }
        
        return $cfOld;
    }
    
    /**
     * Menampilkan hasil keputusan diagnosa berdasarkan ID pasien
     * 
     * @param int $pasien_id ID pasien
     * @return \Illuminate\View\View
     */
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
    
        // Proses untuk menghilangkan duplikasi gejala
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