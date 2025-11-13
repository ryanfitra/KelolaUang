<div class="modal fade" id="createModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
    aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="createModalLabel">
                    <i class="fa fa-calendar-plus"></i> Tambah Jadwal Ujian
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('admin.jadwal-ujian.store') }}" method="post" id="storeForm">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <!-- Jenis Ujian -->
                        <div class="col-md-12 mb-3">
                            <label for="jenis_ujian_id" class="form-label fw-bold">Jenis Ujian</label>
                            <select name="jenis_ujian_id" id="jenis_ujian_id" class="form-select" required>
                                <option value="" selected disabled>-- Pilih Jenis Ujian --</option>
                                @foreach($jenisUjian as $ju)
                                    <option value="{{ $ju->id }}">{{ $ju->nama_ujian }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Metode Ujian -->
                        <div class="col-md-12 mb-3">
                            <label for="metode_ujians" class="form-label fw-bold">Metode Ujian</label>
                            <select name="metode_ujians[]" id="metode_ujians" class="form-select" multiple required>
                                @foreach($metodeUjian as $m)
                                    <option value="{{ $m->id }}">{{ $m->nama_metode }}</option>
                                @endforeach
                            </select>

                            <small class="text-muted">
                                Tekan <kbd>Ctrl</kbd> (Windows) atau <kbd>⌘</kbd> (Mac) untuk memilih lebih dari satu metode.
                            </small>
                        </div>

                        <!-- Sesi Ujian -->
                        <div class="col-md-12 mb-3">
                            <label for="sesi" class="form-label fw-bold">Sesi Ujian</label>
                            <select name="sesi" id="sesi" class="form-select" required>
                                <option value="" selected disabled>-- Pilih Sesi Ujian --</option>
                                <option value="1">Sesi 1</option>
                                <option value="2">Sesi 2</option>
                                <option value="3">Sesi 3</option>
                                <option value="4">Sesi 4</option>
                            </select>
                        </div>

                        <!-- Tanggal Mulai & Selesai Try Out -->
                        <div class="col-md-6 mb-3">
                            <label for="waktu_mulai_to" class="form-label fw-bold">Tanggal Mulai TO</label>
                            <input type="datetime-local" name="waktu_mulai_to" id="waktu_mulai_to" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="waktu_selesai_to" class="form-label fw-bold">Tanggal Selesai TO</label>
                            <input type="datetime-local" name="waktu_selesai_to" id="waktu_selesai_to" class="form-control">
                        </div>

                        <!-- Tanggal Mulai & Selesai Ujian -->
                        <div class="col-md-6 mb-3">
                            <label for="waktu_mulai_ujian" class="form-label fw-bold">Tanggal Mulai Ujian</label>
                            <input type="datetime-local" name="waktu_mulai_ujian" id="waktu_mulai_ujian" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="waktu_selesai_ujian" class="form-label fw-bold">Tanggal Selesai Ujian</label>
                            <input type="datetime-local" name="waktu_selesai_ujian" id="waktu_selesai_ujian" class="form-control" required>
                        </div>

                        <!-- Tanggal Pengumuman -->
                        <div class="col-md-12 mb-3">
                            <label for="waktu_pengumuman" class="form-label fw-bold">Tanggal Pengumuman Hasil Ujian</label>
                            <input type="datetime-local" name="waktu_pengumuman" id="waktu_pengumuman" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fa fa-times"></i> Tutup
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
