<div class="modal fade" id="editModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
    aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="box-title text-info mb-0"><i class="ti-user me-15"></i> 
                    Jabatan
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="editForm">
                @csrf
                @method('patch')

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="edit_nama_jabatan" class="form-label">Nama Jabatan</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text"><i class="ti-pencil-alt"></i></span>
                                    <input type="text" name="nama_jabatan" id="edit_nama_jabatan" class="form-control" placeholder="Nama Jabatan">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="edit_keterangan" class="form-label">Keterangan</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text"><i class="ti-receipt"></i></span>
                                    <textarea type="text" name="keterangan" id="edit_keterangan" class="form-control" placeholder="Keterangan"></textarea>
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
