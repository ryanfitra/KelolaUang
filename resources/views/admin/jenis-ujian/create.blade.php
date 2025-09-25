<div class="modal fade" id="createModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
    aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                {{-- <h5 class="modal-title" id="createModalLabel">
                    Tambah Data
                </h5> --}}
                <h4 class="box-title text-info mb-0"><i class="ti-user me-15"></i> Jenis Ujian</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('admin.jenis-ujian.store')}}" method="post" id="storeForm">
                @csrf

                <div class="modal-body">
                    <!-- Jenis Ujian -->
                    {{-- <hr class="my-15"> --}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="jenis_ujian" class="form-label">Nama Jenis Ujian</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text"><i class="ti-pencil-alt"></i></span>
                                    <input type="text" name="jenis_ujian" id="jenis_ujian" class="form-control" placeholder="Jenis Ujian">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text"><i class="ti-receipt"></i></span>
                                    <textarea type="text" name="deskripsi" id="deskripsi" class="form-control" placeholder="Deskripsi"></textarea>
                                </div>
                            </div>
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

