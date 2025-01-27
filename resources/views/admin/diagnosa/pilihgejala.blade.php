<div class="row">
    <div class="col-md-12">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Pilih Gejala</h4>
            </div>
            <div class="card-body">
                
                <!-- Informasi Pasien -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <table class="table table-bordered">
                            <tr>
                                <th>Nama :</th>
                                <td>{{ $pasien->name }}</td>
                            </tr>
                            <tr>
                                <th>Umur :</th>
                                <td>{{ $pasien->umur }} Tahun</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <!-- Gejala Belum Terpilih -->
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="text-primary">Gejala Belum Terpilih</h5>
                        <table class="table table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>Gejala</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($gejala as $item)
                                    @php
                                        $cek = App\Models\Diagnosa::whereGejalaId($item->id)->wherePasienId(session()->get('pasien_id'))->first();
                                    @endphp

                                    @if (!$cek)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->kode_gejala }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-info">Pilih</button>
                                                <button type="button" class="btn btn-info dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-expanded="false">
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item text-secondary" href="{{ url('/diagnosa/pilih?gejala_id=' . $item->id . '&nilai=0.2') }}">
                                                        <i class="fas fa-question-circle text-secondary"></i> Tidak Yakin
                                                    </a>
                                                    <a class="dropdown-item text-warning" href="{{ url('/diagnosa/pilih?gejala_id=' . $item->id . '&nilai=0.4') }}">
                                                        <i class="fas fa-exclamation-circle text-warning"></i> Kemungkinan Rendah
                                                    </a>
                                                    <a class="dropdown-item text-primary" href="{{ url('/diagnosa/pilih?gejala_id=' . $item->id . '&nilai=0.6') }}">
                                                        <i class="fas fa-exclamation-triangle text-primary"></i> Kemungkinan Besar
                                                    </a>
                                                    <a class="dropdown-item text-info" href="{{ url('/diagnosa/pilih?gejala_id=' . $item->id . '&nilai=0.8') }}">
                                                        <i class="fas fa-check-circle text-info"></i> Hampir Pasti
                                                    </a>
                                                    <a class="dropdown-item text-success" href="{{ url('/diagnosa/pilih?gejala_id=' . $item->id . '&nilai=1') }}">
                                                        <i class="fas fa-check-circle text-success"></i> Sangat Yakin
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Gejala Terpilih -->
                    <div class="col-md-6">
                        <h5 class="text-primary">Gejala Terpilih</h5>
                        <table class="table table-striped table-hover">
                            <thead class="thead-light">
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>Gejala</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($gejelaTerpilih as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->gejala->kode_gejala }}</td>
                                    <td>{{ $item->gejala->name }}</td>
                                    <td>
                                        <a href="/diagnosa/hapus-gejala?gejala_id={{ $item->gejala_id }}" class="btn btn-danger btn-sm">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <a href="{{ url('/diagnosa/proses') }}" class="btn btn-primary btn-block">
                            <i class="fas fa-play"></i> Proses Diagnosa
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
