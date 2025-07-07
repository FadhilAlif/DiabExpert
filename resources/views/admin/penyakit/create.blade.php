<div class="row">
    <div class="col-lg-6 col-md-10">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">
                    @isset($penyakit)
                        Form Edit Penyakit
                    @else
                        Form Tambah Penyakit
                    @endisset
                </h4>
            </div>
            <div class="card-body">
                @isset($penyakit)
                <form action="/admin/penyakit/{{ $penyakit->id }}" method="POST">
                    @method('PUT')
                @else
                <form action="/admin/penyakit" method="POST">
                @endisset
                    @csrf

                    <div class="form-group">
                        <label for="name">Nama Penyakit</label>
                        <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" 
                               name="name" placeholder="Masukkan Nama Penyakit" 
                               value="{{ isset($penyakit) ? $penyakit->name : old('name') }}">
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="desc">Deskripsi</label>
                        <textarea name="desc" id="desc" class="form-control @error('desc') is-invalid @enderror" 
                                  rows="5" placeholder="Masukkan Deskripsi Penyakit">{{ isset($penyakit) ? $penyakit->desc : old('desc') }}</textarea>
                        @error('desc')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="penanganan">Penanganan</label>
                        <textarea name="penanganan" id="penanganan" class="form-control @error('penanganan') is-invalid @enderror" 
                                  rows="5" placeholder="Masukkan Penanganan">{{ isset($penyakit) ? $penyakit->penanganan : old('penanganan') }}</textarea>
                        @error('penanganan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="/admin/penyakit" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
