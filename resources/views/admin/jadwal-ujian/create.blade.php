<div class="modal fade" id="createModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
    aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">
                    Tambah Data
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('admin.jadwal-ujian.store')}}" method="post" id="storeForm">
                @csrf

                <div class="modal-body">
                    <div class="row">
                        <!-- Jenis Ujian -->
                        <div class="col-md-12 mb-3">
                            <label for="jenis_ujian_id" class="form-label">Jenis Ujian</label>
                            <select name="jenis_ujian_id" id="jenis_ujian_id" required class="form-select">
                                <option value="" selected disabled>-- Pilih Jenis Ujian --</option>
                                @foreach($jenisUjian as $ju)
                                    <option value="{{$ju->id}}">{{$ju->nama_ujian}}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Sesi Ujian -->
                        <div class="col-md-12 mb-3">
                            <label for="sesi" class="form-label">Jenis Ujian</label>
                            <select name="sesi" id="sesi" required class="form-select">
                                <option value="" selected disabled>-- Pilih Jenis Ujian --</option>
                                    <option value="1">Sesi 1</option>
                                    <option value="2">Sesi 2</option>
                                    <option value="3">Sesi 3</option>
                                    <option value="4">Sesi 4</option>
                            </select>
                        </div>

                        <!-- Tanggal Mulai & Selesai Try Out -->
                        <div class="col-md-6 mb-3">
                            <label for="waktu_mulai_to" class="form-label">Tanggal Mulai TO</label>
                            <input type="datetime-local" name="waktu_mulai_to" id="waktu_mulai_to" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="waktu_selesai_to" class="form-label">Tanggal Selesai TO</label>
                            <input type="datetime-local" name="waktu_selesai_to" id="waktu_selesai_to" class="form-control" required>
                        </div>

                        <!-- Tanggal Mulai & Selesai Ujian -->
                        <div class="col-md-6 mb-3">
                            <label for="waktu_mulai_ujian" class="form-label">Tanggal Mulai Ujian</label>
                            <input type="datetime-local" name="waktu_mulai_ujian" id="waktu_mulai_ujian" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="waktu_selesai_ujian" class="form-label">Tanggal Selesai Ujian</label>
                            <input type="datetime-local" name="waktu_selesai_ujian" id="waktu_selesai_ujian" class="form-control" required>
                        </div>

                        <!-- Tanggal Pengumuman Hasil Ujian -->
                        <div class="col-md-6 mb-3">
                            <label for="waktu_pengumuman" class="form-label">Tanggal Pengumuman Hasil Ujian</label>
                            <input type="datetime-local" name="waktu_pengumuman" id="waktu_pengumuman" class="form-control" required>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Tutup
                    </button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

