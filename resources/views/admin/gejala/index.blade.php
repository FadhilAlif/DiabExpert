<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-list"></i> Data Gejala</h5>
            </div>
            <div class="card-body">
                <a href="/admin/gejala/create" class="btn btn-primary mb-2"><i class="fas fa-plus"></i> Tambah</a>

                <table class="table table-striped table-hover table-sm text-center mt-2 shadow-sm rounded">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Kode Gejala</th>
                            <th>Name</th>
                            <th>Nilai CF</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($gejala as $item)
                        <tr>
                            <td>{{ $loop->iteration }}.</td>
                            <td>{{ $item->kode_gejala }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->nilai_cf }}</td>
                            <td>
                                <div class="d-flex justify-content-center align-items-center">
                                    <a href="/admin/gejala/{{ $item->id }}/edit"
                                       class="btn btn-warning btn-sm mr-2"
                                       style="width: 80px; padding: 0.25rem 0.5rem;">
                                        <i class="fas fa-edit mr-1"></i>Edit
                                    </a>
                                    <form action="/admin/gejala/{{ $item->id }}" method="POST" class="m-0 p-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-danger btn-sm"
                                                style="width: 80px; padding: 0.25rem 0.5rem;">
                                            <i class="fas fa-trash mr-1"></i>Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>                                                 
                        </tr>
                        @endforeach
                    </tbody>
                </table>                
            </div>
        </div>
    </div>
</div>