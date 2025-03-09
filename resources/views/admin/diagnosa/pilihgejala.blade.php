<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DiabExpert | Pilih Gejala</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>

    </style>
</head>
<body>
<div class="row">
    <div class="col-md-12">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Pilih Gejala</h4>
            </div>
            <div class="card-body">

                <!-- Informasi Pasien -->
                <div class="row">
                    <div class="col-md-3">
                        <h5 class="text-primary">Informasi Pasien</h5>
                        <table class="table table-borderless mt-2 mb-2 text-left font-weight-bold">
                            <tr>
                                <th>Umur :</th>
                                <td>{{ $pasien->umur }}</td>
                            </tr>
                            <tr>
                                <th>Jenis Kelamin :</th>
                                <td>{{ $pasien->jenis_kelamin }}</td>
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
                                    <th>Opsi</th>
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
                                                    <a class="dropdown-item text-info" href="{{ url('/diagnosa/pilih?gejala_id=' . $item->id . '&nilai=0.4') }}">
                                                        <i class="fas fa-exclamation-circle text-info"></i> Sedikit Yakin
                                                    </a>
                                                    <a class="dropdown-item text-primary" href="{{ url('/diagnosa/pilih?gejala_id=' . $item->id . '&nilai=0.6') }}">
                                                        <i class="fas fa-exclamation-triangle text-primary"></i> Cukup Yakin
                                                    </a>
                                                    <a class="dropdown-item text-warning" href="{{ url('/diagnosa/pilih?gejala_id=' . $item->id . '&nilai=0.8') }}">
                                                        <i class="fas fa-check-circle text-warning"></i> Hampir Pasti
                                                    </a>
                                                    <a class="dropdown-item text-danger" href="{{ url('/diagnosa/pilih?gejala_id=' . $item->id . '&nilai=1') }}">
                                                        <i class="fas fa-check-circle text-danger"></i> Sangat Yakin
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
                                    <th>Kondisi</th> 
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($gejelaTerpilih as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->gejala->kode_gejala }}</td>
                                    <td>{{ $item->gejala->name }}</td>
                                    <td class="text-center">
                                        <form id="form-update-{{ $item->id }}">
                                            @csrf
                                            <input type="hidden" name="diagnosa_id" value="{{ $item->id }}">
                                            <select name="nilai" class="custom-select custom-select-sm select2"
                                                onchange="updateKondisi({{ $item->id }})" style="width: 100%;">
                                    
                                                <option value="0.2" {{ $item->nilai_cf == 0.2 ? 'selected' : '' }} {{ $item->nilai_cf == 0.2 ? 'disabled' : '' }}>
                                                    ⚫ Tidak Yakin
                                                </option>
                                                <option value="0.4" {{ $item->nilai_cf == 0.4 ? 'selected' : '' }} {{ $item->nilai_cf == 0.4 ? 'disabled' : '' }}>
                                                    🔵 Sedikit Yakin
                                                </option>
                                                <option value="0.6" {{ $item->nilai_cf == 0.6 ? 'selected' : '' }} {{ $item->nilai_cf == 0.6 ? 'disabled' : '' }}>
                                                    🔵 Cukup Yakin
                                                </option>
                                                <option value="0.8" {{ $item->nilai_cf == 0.8 ? 'selected' : '' }} {{ $item->nilai_cf == 0.8 ? 'disabled' : '' }}>
                                                    🟡 Hampir Pasti
                                                </option>
                                                <option value="1" {{ $item->nilai_cf == 1 ? 'selected' : '' }} {{ $item->nilai_cf == 1 ? 'disabled' : '' }}>
                                                    🔴 Sangat Yakin
                                                </option>
                                            </select>
                                        </form>
                                    </td>                                                                                                                                                                                                                                                                                 
                                    <td>
                                        <a href="/diagnosa/hapus-gejala?gejala_id={{ $item->gejala_id }}" class="btn btn-danger btn-sm">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

                            @if ($errors->any())
                            <div class="alert alert-danger text-center">
                                @foreach ($errors->all() as $error)
                                    {{ $error }}
                                @endforeach
                            </div>
                            @endif
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

<script>
    // Menunggu DOM selesai dibuat
    document.addEventListener('DOMContentLoaded', function () {
        // Menangani perubahan dropdown
        document.querySelectorAll('select[name="nilai"]').forEach(function(selectElement) {
            selectElement.addEventListener('change', function() {
                const diagnosaId = this.closest('form').querySelector('input[name="diagnosa_id"]').value;
                updateKondisi(diagnosaId);
            });
        });
    });

    // Fungsi untuk mengupdate nilai kondisi
    async function updateKondisi(diagnosaId) {
        try {
            const form = document.querySelector(`#form-update-${diagnosaId}`);
            const formData = new FormData(form);

            // Mengirimkan request AJAX menggunakan fetch
            const response = await fetch('/diagnosa/update-kondisi', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });

            const data = await response.json();
            
            if (data.success) {
                console.log('Data berhasil diperbarui');
            } else {
                console.error('Terjadi kesalahan');
            }
        } catch (error) {
            console.error('Error:', error);
        }
    }
</script>
</body>
</html>