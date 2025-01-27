<div class="row">
  <div class="col-md-12">
      <div class="card shadow-sm border-0">
          <div class="card-body">
              <div class="row">
                  <div class="col-md-6">
                      <h4 class="font-weight-bold text-primary">{{ $penyakit->name }}</h4>
                      <p class="mt-3">
                          <strong>Deskripsi:</strong><br>
                          {{ $penyakit->desc }}
                      </p>
                      <p>
                          <strong>Penanganan:</strong><br>
                          {{ $penyakit->penanganan }}
                      </p>
                  </div>
                  <div class="col-md-6 text-md-right">
                      <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#modal-add-gejala">
                          <i class="fas fa-plus"></i> Tambah Gejala
                      </button>

                      <!-- Modal Tambah Gejala -->
                      <div class="modal fade" id="modal-add-gejala" tabindex="-1" role="dialog" aria-labelledby="modalAddGejalaLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h5 class="modal-title" id="modalAddGejalaLabel">Tambah Gejala</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                      </button>
                                  </div>
                                  <div class="modal-body">
                                      <form action="/admin/penyakit/add-gejala" method="post">
                                          @csrf
                                          <input type="hidden" name="penyakit_id" value="{{ $penyakit->id }}">

                                          <div class="form-group">
                                            <p for="gejala_id" class="text-left font-weight-bold">Gejala</p>
                                              <select name="gejala_id" id="gejala_id" class="form-control">
                                                  <option value="">-- Pilih Gejala --</option>
                                                  @foreach ($gejala as $item)
                                                      @php
                                                          $cek = App\Models\Role::whereGejalaId($item->id)->wherePenyakitId($penyakit->id)->first();
                                                      @endphp
                                                      @if ($cek == false)
                                                          <option value="{{ $item->id }}">{{ $item->kode_gejala }} - {{ $item->name }}</option>
                                                      @endif
                                                  @endforeach
                                              </select>
                                          </div>

                                          <div class="form-group">
                                              <p for="bobot_cf" class="text-left font-weight-bold">Bobot CF</p>
                                              <input type="text" id="bobot_cf" name="bobot_cf" class="form-control" placeholder="0.0">
                                          </div>

                                          <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                              <button type="submit" class="btn btn-primary">Simpan</button>
                                          </div>
                                      </form>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <!-- End Modal -->
                  </div>
              </div>

              <!-- Tabel Gejala -->
              <table class="table table-striped table-hover table-sm text-center mt-2 shadow-sm rounded">
                  <table class="table table-bordered">
                      <thead class="thead-light">
                          <tr class="text-center">
                              <th>No</th>
                              <th>Kode</th>
                              <th>Nama Gejala</th>
                              <th>Bobot CF</th>
                              <th>Opsi</th>
                          </tr>
                      </thead>
                      <tbody class="text-center">
                          @foreach ($role as $item)
                              <tr>
                                  <td>{{ $loop->iteration }}</td>
                                  <td>{{ $item->gejala->kode_gejala }}</td>
                                  <td>{{ $item->gejala->name }}</td>
                                  <td>{{ $item->bobot_cf }}</td>
                                  <td>
                                      <form action="/admin/penyakit/delete-role/{{ $item->id }}" method="POST" class="d-inline">
                                          @csrf
                                          @method('DELETE')
                                          <button type="submit" class="btn btn-danger btn-sm" title="Hapus"><i class="fas fa-trash"></i></button>
                                      </form>
                                  </td>
                              </tr>
                          @endforeach
                      </tbody>
                  </table>
              </div>
              <!-- End Tabel Gejala -->
          </div>
      </div>
  </div>
</div>
