<div class="modal fade" id="editModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
    aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Ubah Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="editForm">
                @csrf
                @method('patch')

                <div class="modal-body">
                    <!-- Nama Jenis Ujian -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="edit_jenis_ujian" class="form-label">Nama Jenis Ujian</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text"><i class="ti-pencil-alt"></i></span>
                                    <input type="text" name="nama_ujian" id='edit_jenis_ujian' class="form-control"
                                           required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="edit_deskripsi" class="form-label">Deskripsi</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text"><i class="ti-receipt"></i></span>
                                    <textarea name="deskripsi" id="edit_deskripsi" class="form-control" placeholder="Deskripsi"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>