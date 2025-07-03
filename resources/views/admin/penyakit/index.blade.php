<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-disease"></i> Data Penyakit</h5>
            </div>

            <div class="card-body">
                <a href="/admin/penyakit/create" class="btn btn-primary mb-2"><i class="fas fa-plus"></i> Tambah</a>

                <table class="table table-striped table-hover table-sm text-center mt-2 shadow-sm rounded">
                    <thead class="thead-light">
                    <tr class="text-center">
                        <th>No</th>
                        <th>Nama Penyakit</th>
                        <th>Opsi</th>
                    </tr>
                    </thead>

                    @foreach ($penyakit as $item)
                        
                    <tr>
                        <td>{{ $loop->iteration }}.</td>
                        <td>
                            <a href="/admin/penyakit/{{ $item->id }}"><b>
                            {{ $item->name }}</b>
                            </a>
                        </td>
                        <td>
                            <div class="d-flex justify-content-center align-items-center">
                                <!-- Tombol Edit -->
                                <a href="/admin/penyakit/{{ $item->id }}/edit"
                                   class="btn btn-warning btn-sm mr-2 d-flex align-items-center justify-content-center"
                                   style="width: 80px; padding: 0.25rem 0.5rem;"
                                   title="Edit">
                                    <i class="fas fa-edit mr-1"></i> Edit
                                </a>
                        
                                <!-- Tombol Hapus -->
                                <form action="/admin/penyakit/{{ $item->id }}" method="POST" class="m-0 p-0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="btn btn-danger btn-sm d-flex align-items-center justify-content-center"
                                            style="width: 80px; padding: 0.25rem 0.5rem;"
                                            title="Hapus">
                                        <i class="fas fa-trash mr-1"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                        
                    </tr>

                    @endforeach

                </table>
            </div>
        </div>
    </div>
</div>