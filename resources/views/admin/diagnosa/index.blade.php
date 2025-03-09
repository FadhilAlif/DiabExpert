<div class="row">
    <div class="col-md-6">
        <div class="card shadow-lg border-0">
            <!-- Header Card -->
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-user-plus"></i> Masukkan Informasi Pasien</h5>
            </div>
            <!-- Body Card -->
            <div class="card-body">
                <form action="/diagnosa/create-pasien" method="post">
                    @csrf

                    <!-- Umur -->
                    <div class="form-group">
                        <label for="umur"><strong>Umur</strong></label>
                        <input type="number" id="umur" name="umur" class="form-control" required placeholder="Masukkan umur pasien">
                    </div>

                    <!-- Jenis Kelamin (Radio Button) -->
                    <div class="form-group">
                        <label><strong>Jenis Kelamin</strong></label>
                        <div class="d-flex">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="laki" value="Laki-laki" required>
                                <label class="form-check-label" for="laki">Laki-laki</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="Perempuan" value="Perempuan" required>
                                <label class="form-check-label" for="perempuan">Perempuan</label>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Submit -->
                    <div>
                        <button type="submit" class="btn btn-primary btn-block">
                            Mulai Diagnosa <i class="fas fa-arrow-right ml-1"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
