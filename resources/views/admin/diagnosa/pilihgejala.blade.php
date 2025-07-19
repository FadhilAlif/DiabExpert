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
                                    <tr data-gejala-id="{{ $item->id }}">
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
                                                    <a class="dropdown-item text-secondary" href="javascript:void(0)" onclick="pilihGejala({{ $item->id }}, 0.2)">
                                                        <i class="fas fa-question-circle text-secondary"></i> Tidak Yakin
                                                    </a>
                                                    <a class="dropdown-item text-info" href="javascript:void(0)" onclick="pilihGejala({{ $item->id }}, 0.4)">
                                                        <i class="fas fa-exclamation-circle text-info"></i> Sedikit Yakin
                                                    </a>
                                                    <a class="dropdown-item text-primary" href="javascript:void(0)" onclick="pilihGejala({{ $item->id }}, 0.6)">
                                                        <i class="fas fa-exclamation-triangle text-primary"></i> Cukup Yakin
                                                    </a>
                                                    <a class="dropdown-item text-warning" href="javascript:void(0)" onclick="pilihGejala({{ $item->id }}, 0.8)">
                                                        <i class="fas fa-check-circle text-warning"></i> Hampir Pasti
                                                    </a>
                                                    <a class="dropdown-item text-danger" href="javascript:void(0)" onclick="pilihGejala({{ $item->id }}, 1)">
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
                        <a href="{{ url('/diagnosa/proses') }}" class="btn btn-primary btn-block" id="btn-proses-diagnosa">
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

        // Disable tombol Proses Diagnosa jika belum ada gejala terpilih ---
        const btnProses = document.getElementById('btn-proses-diagnosa');
        // Hitung jumlah baris gejala terpilih (hanya baris data, bukan baris kosong/error)
        const tbodyTerpilih = document.querySelector('.col-md-6 table.table-striped tbody');
        const jumlahGejalaTerpilih = tbodyTerpilih ? tbodyTerpilih.querySelectorAll('tr').length : 0;
        if (btnProses) {
            if (jumlahGejalaTerpilih === 0) {
                btnProses.classList.add('disabled', 'cursor-not-allowed');
                btnProses.setAttribute('aria-disabled', 'true');
                btnProses.setAttribute('tabindex', '-1');
                // Hanya tambahkan event preventDefault jika belum ada
                if (!btnProses.hasAttribute('data-disabled')) {
                    btnProses.addEventListener('click', function(e) { e.preventDefault(); });
                    btnProses.setAttribute('data-disabled', 'true');
                }
            } else {
                btnProses.classList.remove('disabled');
                btnProses.removeAttribute('aria-disabled');
                btnProses.removeAttribute('tabindex');
                btnProses.removeAttribute('data-disabled');
            }
        }
    });

    /**
     * Menangani pemilihan gejala menggunakan AJAX
     * @param {number} gejalaId - ID gejala yang dipilih
     * @param {number} nilai - Nilai keyakinan yang dipilih
     */
    async function pilihGejala(gejalaId, nilai) {
        try {
            const response = await fetch(`/diagnosa/pilih?gejala_id=${gejalaId}&nilai=${nilai}`, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });

            const data = await response.json();
            
            if (data.success) {
                // Refresh halaman untuk menampilkan data terbaru
                window.location.reload();
            }
        } catch (error) {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Terjadi kesalahan saat menambahkan gejala'
            });
        }
    }

    /**
     * Menangani penghapusan gejala menggunakan AJAX
     * @param {number} gejalaId - ID gejala yang akan dihapus
     */
    async function hapusGejala(gejalaId) {
        try {
            const result = await Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Gejala yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            });

            if (result.isConfirmed) {
                const response = await fetch(`/diagnosa/hapus-gejala?gejala_id=${gejalaId}`, {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });

                const data = await response.json();
                
                if (data.success) {
                    // Refresh halaman untuk menampilkan data terbaru
                    window.location.reload();
                }
            }
        } catch (error) {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Terjadi kesalahan saat menghapus gejala'
            });
        }
    }

    /**
     * Menangani update nilai keyakinan gejala
     * @param {number} diagnosaId - ID diagnosa yang akan diupdate
     */
    async function updateKondisi(diagnosaId) {
        try {
            const form = document.querySelector(`#form-update-${diagnosaId}`);
            const formData = new FormData(form);

            const response = await fetch('/diagnosa/update-kondisi', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });

            const data = await response.json();
            
            if (data.success) {
                // Refresh halaman untuk menampilkan data terbaru
                window.location.reload();
            }
        } catch (error) {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Terjadi kesalahan saat mengupdate gejala'
            });
        }
    }
</script>
</body>
</html>