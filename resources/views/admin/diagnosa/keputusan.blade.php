<div class="row">
    <div class="col-md-12">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-primary text-white">
                <h5><i class="fas fa-notes-medical"></i> Hasil Diagnosa</h5>
            </div>
            <div class="card-body">
                <!-- Tombol Aksi -->
                <div class="d-flex justify-content-start mb-4">
                    <a href="/diagnosa" class="btn btn-primary" style="margin-right: 6px;">
                        <i class="fas fa-file"></i> Diagnosa Baru
                    </a>
                    <a href="/diagnosa/pasien/cetak/{{ $pasien->id }}" target="_blank" class="btn btn-warning">
                        <i class="fas fa-print"></i> Cetak Hasil
                    </a>
                </div>                                    

                <div class="row">
                    <!-- Informasi Pasien -->
                    <div class="col-md-6">
                        <div class="card border-secondary">
                            <div class="card-header bg-primary">
                                <h6 class="text-white"><strong>Informasi Pasien</strong></h6>
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <tr>
                                        <td><strong>Umur</strong></td>
                                        <td>{{ $pasien->umur }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Jenis Kelamin</strong></td>
                                        <td>{{ $pasien->jenis_kelamin}}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Nama Penyakit</strong></td>
                                        <td>
                                            <span class="badge {{ isset($pasien->penyakit) ? 'badge-success' : 'badge-danger' }}" style="font-size: 0.8rem; padding: 0.5em 0.75em;">
                                                {{ isset($pasien->penyakit) ? $pasien->penyakit->name : 'Gejala tidak akurat. Silakan lakukan diagnosa ulang' }}
                                            </span>
                                        </td>                                                                           
                                    </tr>
                                    <tr>
                                        <td><strong>Keakuratan</strong></td>
                                        <td>{{ $pasien->akumulasi_cf }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Persentase</strong></td>
                                        <td>
                                            <strong>{{ $pasien->persentase }}% </strong> -
                                            <span class="badge 
                                                @if($pasien->persentase <= 30) bg-success
                                                @elseif($pasien->persentase <= 60) bg-primary 
                                                @elseif($pasien->persentase <= 90) bg-warning 
                                                @else bg-danger 
                                                @endif
                                                text-white" style="font-size: 0.8rem; padding: 0.5em 0.75em;">
                                                @php
                                                    if ($pasien->persentase <= 30) {
                                                        echo 'Kemungkinan Sangat Rendah';
                                                    } elseif ($pasien->persentase <= 60) {
                                                        echo 'Kemungkinan Rendah';
                                                    } elseif ($pasien->persentase <= 90) {
                                                        echo 'Kemungkinan Tinggi';
                                                    } else {
                                                        echo 'Kemungkinan Sangat Tinggi';
                                                    }
                                                @endphp
                                            </span>
                                        </td>
                                    </tr>   
                                    <tr>
                                        <td><strong>Saran Medis</strong></td>
                                        <td style="max-width: 300px; word-wrap: break-word;">
                                            @php
                                                $tingkat_penanganan = isset($pasien->penyakit) ? json_decode($pasien->penyakit->tingkat_penanganan, true) : null;
                                            @endphp
                                            <span> 
                                                @if($pasien->persentase <= 30)
                                                    {{ $tingkat_penanganan['rendah'] ?? 'Tidak ada data' }}
                                                @elseif($pasien->persentase <= 60)
                                                    {{ $tingkat_penanganan['sedang'] ?? 'Tidak ada data' }}
                                                @elseif($pasien->persentase <= 90)
                                                    {{ $tingkat_penanganan['tinggi'] ?? 'Tidak ada data' }}
                                                @else
                                                    {{ $tingkat_penanganan['sangat_tinggi'] ?? 'Tidak ada data' }}
                                                @endif
                                            </span>
                                        </td>
                                    </tr>                                         
                                    <tr>
                                        <td><strong>Deskripsi</strong></td>
                                        <td style="max-width: 300px; word-wrap: break-word;">
                                            {{ isset($pasien->penyakit) ? $pasien->penyakit->desc : 'Gejala tidak akurat. Silakan lakukan diagnosa ulang' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Penanganan</strong></td>
                                        <td style="max-width: 300px; word-wrap: break-word;">
                                            {{ isset($pasien->penyakit) ? $pasien->penyakit->penanganan : 'Gejala tidak akurat. Silakan lakukan diagnosa ulang' }}
                                        </td>
                                    </tr>                                                                                            
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Detail Gejala -->
                    <div class="col-md-6">
                        <div class="card border-secondary">
                            <div class="card-header bg-primary">
                                <h6 class="text-white"><strong>Detail Gejala</strong></h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class="table-light">
                                            <tr class="text-center">
                                                <th>No</th>
                                                <th>Gejala</th>
                                                <th>Nilai</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $no = 1; @endphp
                                            @foreach ($gejala as $item)
                                                <tr>
                                                    <td class="text-center">{{ $no++ }}</td>
                                                    <td>{{ $item->gejala->name }}</td>
                                                    <td class="text-center">
                                                        <span class="badge bg-info text-white" style="font-size: 0.8rem; padding: 0.5em 0.75em;">
                                                            {{ number_format($item->cf_hasil, 2) }}
                                                        </span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>                                        
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
