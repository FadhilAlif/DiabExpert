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
        try {
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
        
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Gejala berhasil ditambahkan'
                ]);
            }
        
            return redirect('/diagnosa/pilih-gejala');
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                ], 500);
            }
            
            Alert::error('Error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back();
        }
    }
    
    /**
     * Menghapus gejala yang telah dipilih oleh pasien
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    function hapusGejalaTerpilih()
    {
        try {
            $gejala_id = request('gejala_id');
            $pasien_id = session()->get('pasien_id');

            // Hapus semua diagnosa dengan gejala_id dan pasien_id yang sesuai
            $diagnosa = Diagnosa::whereGejalaId($gejala_id)->wherePasienId($pasien_id)->get();
            foreach ($diagnosa as $item) {
                $d = Diagnosa::find($item->id);
                $d->delete();
            }

            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Gejala berhasil dihapus'
                ]);
            }

            return redirect('/diagnosa/pilih-gejala');
        } catch (\Exception $e) {
            if (request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                ], 500);
            }
            
            Alert::error('Error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Proses diagnosa internal (tanpa redirect), untuk update hasil setelah perubahan kondisi gejala
     *
     * @param int $pasien_id
     * @return void
     */
    private function prosesDiagnosaInternal($pasien_id)
    {
        $diagnosa = Diagnosa::where('pasien_id', $pasien_id)->get();
        if (count($diagnosa) == 0) return;

        $penyakit_hasil = [];
        $diagnosaPerPenyakit = $diagnosa->groupBy('penyakit_id');
        foreach ($diagnosaPerPenyakit as $penyakit_id => $diagnosa) {
            $penyakit_hasil[$penyakit_id] = $this->hitung_cf($diagnosa);
        }
        $penyakit_tertinggi = collect($penyakit_hasil)->sortDesc()->keys()->first();
        $cf_tertinggi = $penyakit_hasil[$penyakit_tertinggi];

        $pasien = Pasien::find($pasien_id);
        $pasien->akumulasi_cf = round($cf_tertinggi, 4);
        $pasien->persentase = round($pasien->akumulasi_cf * 100, 2);
        $pasien->penyakit_id = $penyakit_tertinggi;
        $pasien->save();
    }

    /**
     * Memperbarui kondisi (nilai_cf) dari gejala yang dipilih
     * Update semua diagnosa dengan kombinasi pasien_id dan gejala_id yang sama,
     * lalu hitung ulang hasil diagnosa pasien agar hasil selalu akurat.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateKondisi(Request $request)
    {
        try {
            $diagnosa_id = $request->input('diagnosa_id');
            $nilai = $request->input('nilai');
            $diagnosa = Diagnosa::find($diagnosa_id);

            if ($diagnosa) {
                // Update semua diagnosa dengan kombinasi pasien_id dan gejala_id yang sama
                // Tujuannya agar tidak ada nilai lama yang tertinggal di database
                $allDiagnosa = Diagnosa::where('pasien_id', $diagnosa->pasien_id)
                    ->where('gejala_id', $diagnosa->gejala_id)
                    ->get();

                foreach ($allDiagnosa as $d) {
                    // Ambil bobot_cf sesuai kombinasi gejala dan penyakit
                    $role = Role::whereGejalaId($d->gejala_id)->wherePenyakitId($d->penyakit_id)->first();
                    $d->nilai_cf = $nilai;
                    $d->cf_hasil = $nilai * ($role ? $role->bobot_cf : 1);
                    $d->save();
                }

                // Proses diagnosa ulang setelah update kondisi (update hasil pasien)
                $this->prosesDiagnosaInternal($diagnosa->pasien_id);

                return response()->json(['success' => true]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Data diagnosa tidak ditemukan'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
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

        // Ambil hanya satu diagnosa per gejala (hindari duplikasi data diagnosa untuk gejala yang sama)
        $data = $data->groupBy('gejala_id')->map(function ($items) {
            return $items->first();
        });
        // Urutkan berdasarkan cf_hasil terbesar ke terkecil agar perhitungan kombinasi CF optimal
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