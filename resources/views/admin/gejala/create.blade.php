<div class="row">
    <div class="col-lg-6 col-md-10">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Form Tambah Gejala</h4>
            </div>
            <div class="card-body">
                @isset($gejala)
                <form action="/admin/gejala/{{ $gejala->id }}" method="POST">
                    @method('PUT')
                @else
                <form action="/admin/gejala" method="POST">
                @endisset
                    @csrf

                    <div class="form-group">
                        <label for="kode_gejala">Kode Gejala</label>
                        <input type="text" id="kode_gejala" class="form-control @error('kode_gejala') is-invalid @enderror" 
                               name="kode_gejala" placeholder="Masukkan Kode Gejala" 
                               value="{{ isset($gejala) ? $gejala->kode_gejala : old('kode_gejala') }}">
                        @error('kode_gejala')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="name">Nama Gejala</label>
                        <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" 
                               name="name" placeholder="Masukkan Nama Gejala" 
                               value="{{ isset($gejala) ? $gejala->name : old('name') }}">
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nilai_cf">Nilai CF</label>
                        <input type="text" id="nilai_cf" class="form-control @error('nilai_cf') is-invalid @enderror" 
                               name="nilai_cf" placeholder="Masukkan Nilai CF" 
                               value="{{ isset($gejala) ? $gejala->nilai_cf : old('nilai_cf') }}">
                        @error('nilai_cf')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="/admin/gejala" class="btn btn-secondary">
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
