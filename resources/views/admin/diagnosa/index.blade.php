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

                    <!-- Nama Pasien -->
                    <div class="form-group">
                        <label for="name"><strong>Nama Pasien</strong></label>
                        <input type="text" id="name" name="name" class="form-control" required placeholder="Masukkan nama pasien" autofocus>
                    </div>

                    <!-- Umur -->
                    <div class="form-group">
                        <label for="umur"><strong>Umur</strong></label>
                        <input type="number" id="umur" name="umur" class="form-control" required placeholder="Masukkan umur pasien">
                    </div>

                    <!-- Tombol Submit -->
                    <div class="">
                        <button type="submit" class="btn btn-primary btn-block">
                            Mulai Diagnosa <i class="fas fa-arrow-right ml-1"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
