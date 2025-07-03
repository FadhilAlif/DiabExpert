<div class="row">
    <div class="col-md-12">
        <div class="card shadow-lg border-0">
            <!-- Header Card -->
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-users"></i> Data Pasien</h5>
            </div>

            <!-- Body Card -->
            <div class="card-body">
                <!-- Tabel Pasien -->
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead class="thead-light">
                            <tr class="text-center">
                                <th>No</th>
                                <th>Umur</th>
                                <th>Jenis Kelamin</th>
                                <th>Diagnosa Penyakit</th>
                                <th>Keakuratan</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pasien as $item)
                            <tr>
                                <!-- Nomor -->
                                <td class="text-center">{{ $pasien->firstItem() + $loop->index }}.</td>
                                
                                <!-- Umur Pasien (Hanya Teks, Tanpa Link) -->
                                <td class="text-center">{{ $item->umur }}</td>
                                
                                <!-- Jenis Kelamin -->
                                <td class="text-center">{{ $item->jenis_kelamin }}</td>
                                
                                <!-- Diagnosa Penyakit -->
                                <td class="text-center">
                                    <span 
                                        class="badge {{ isset($item->penyakit) 
                                            ? ($item->penyakit->name == 'Diabetes Mellitus Tipe 1' 
                                                ? 'badge-warning' 
                                                : ($item->penyakit->name == 'Diabetes Mellitus Tipe 2' 
                                                    ? 'badge-success' 
                                                    : 'badge-danger')) 
                                            : 'badge-danger' }}" 
                                        style="font-size: 0.8rem; padding: 0.5em 0.75em;"
                                    >
                                        {{ isset($item->penyakit) ? $item->penyakit->name : 'Data Kosong' }}
                                    </span>
                                </td>
                                
                                <!-- Keakuratan -->
                                <td class="text-center">
                                    <span class="badge 
                                        @if($item->persentase <= 30) bg-success 
                                        @elseif($item->persentase <= 60) bg-primary 
                                        @elseif($item->persentase <= 90) bg-warning 
                                        @else bg-danger 
                                        @endif
                                        text-white" style="font-size: 0.8rem; padding: 0.5em 0.5em;">
                                        {{ $item->persentase }}% 
                                    </span>
                                </td>                                
                                
                                <!-- Aksi -->
                                <td class="text-center">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <!-- Tombol Lihat -->
                                        <a href="/diagnosa/keputusan/{{ $item->id }}"
                                           class="btn btn-info btn-sm mr-2 d-flex align-items-center justify-content-center"
                                           style="width: 80px; padding: 0.25rem 0.5rem;">
                                            <i class="fas fa-eye mr-1"></i> Lihat
                                        </a>
                                
                                        <!-- Tombol Hapus -->
                                        <form action="/admin/pasien/{{ $item->id }}" method="POST" class="m-0 p-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn btn-danger btn-sm d-flex align-items-center justify-content-center"
                                                    style="width: 80px; padding: 0.25rem 0.5rem;">
                                                <i class="fas fa-trash mr-1"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-3">
                    {{ $pasien->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
