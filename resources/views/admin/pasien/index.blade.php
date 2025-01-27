<div class="row mt-4">
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
                                <th>Nama Pasien</th>
                                <th>Umur</th>
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
                                
                                <!-- Nama Pasien -->
                                <td>
                                    <a href="/diagnosa/keputusan/{{ $item->id }}" class="text-primary font-weight-bold">
                                        {{ $item->name }}
                                    </a>
                                </td>
                                
                                <!-- Umur -->
                                <td class="text-center">{{ $item->umur }} Tahun</td>
                                
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
                                    <span class="badge bg-info text-white" style="font-size: 0.8rem; padding: 0.5em 0.5em;">
                                        {{ $item->persentase }}%
                                    </span>
                                </td>
                                
                                <!-- Aksi -->
                                <td class="text-center">
                                    <form action="/admin/pasien/{{ $item->id }}" method="POST" class="d-inline">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus pasien ini?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
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
