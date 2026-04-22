
{{-- =========================
    🔥 MODAL TRANSACTION
========================= --}}
<div class="modal fade" id="modalTransaction" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
    aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered rounded-20" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="modalTitle">Tambah Transaksi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form id="transactionForm" action="{{ route('user.transactions.store') }}" method="POST">
                @csrf

                <input type="hidden" name="id" id="transaction_id">
                <input type="hidden" name="_method" id="form_method" value="POST">

                <div class="modal-body">

                    {{-- Tanggal --}}
                    <div class="mb-3">
                        <label for="transaction_date" class="form-label">Tanggal</label>
                        <input type="date" name="transaction_date" id="transaction_date" class="form-select"
                               value="{{ old('transaction_date', date('Y-m-d')) }}"
                            required>
                    </div>

                    {{-- Jenis --}}
                    <div class="mb-3">
                        <label for="type_id" class="form-label">Jenis</label>
                        <select name="type_id" id="type_id" class="form-select" required>
                            <option value="">-- Pilih Jenis --</option>
                            @foreach($types as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Kategori (DYNAMIC) --}}
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Kategori</label>
                        <select name="category_id" id="category_id" class="form-select" required>
                            <option value="">-- Pilih Kategori --</option>
                        </select>
                    </div>

                    {{-- Jumlah --}}
                    <div class="mb-3">
                       <label for="amount" class="form-label">Nominal</label>
                        <input class="form-control"  type="text" name="amount" id="amount" min="1" required placeholder="Contoh : 2000000">
                    </div>

                    {{-- Deskripsi --}}
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea name="description" id="description" class="form-control" placeholder="Masukkan Deskripsi"></textarea>
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-primary">Simpan</button>
                </div>

            </form>

        </div>
    </div>
</div>
