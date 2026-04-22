@extends('layouts.user')

@section('title', 'Transaksi')

@section('content')
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xl-12 col-12">
            <div class="box box-outline-success bs-3 border-success">
                <div class="box-header with-border d-flex justify-content-between align-items-center mb-3">
                    <div class="d-flex justify-content-start">
                        <h4>DATA TRANSAKSI</h4>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-success waves-effect waves-light" data-bs-toggle="modal"
                            data-bs-target="#modalTransaction"><i class="fa fa-plus"></i> Tambah Data</button>
                        <span class="divider-line mx-1"></span>
                        <!-- Modal trigger button -->

                    </div>
                </div>
                @include('user.create')
                <div class="box-body">
                    {{--<div class="row">
                            <div class="col-xl-6 col-lg-6">
                                <form action="{{ route('univ.krs-manual') }}" method="get" id="semesterForm">
                    <div class="mb-3">
                        <label for="semester_view" class="form-label">Semester</label>
                        <select
                            class="form-select"
                            name="semester_view"
                            id="semester_view"
                            onchange="document.getElementById('semesterForm').submit();">
                            <option value="" selected disabled>-- Pilih Semester --</option>
                            @foreach ($semester as $p)
                            <option value="{{$p->id_semester}}"
                                @if ($semester_pilih !=null)
                                {{$semester_pilih == $p->id_semester ? 'selected' : ''}}
                                @endif>{{$p->nama_semester}}</option>
                            @endforeach
                        </select>
                    </div>
                    </form>
                </div>
            </div>--}}
            <hr>
            <div class="table-responsive">
                <table id="data" class="table table-hover table-bordered margin-top-10 w-p100">
                    <thead>
                        <tr>
                            <th class="text-center align-middle">No</th>
                            <th class="text-center align-middle">Tanggal</th>
                            <th class="text-center align-middle">Jenis</th>
                            <th class="text-center align-middle">Kategori</th>
                            <th class="text-center align-middle">Nominal</th>
                            <th class="text-center align-middle">Deskripsi</th>
                            <th class="text-center align-middle">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transactions as $index => $transaction)
                        <tr>
                            <td class="text-center align-middle">{{$index + 1}}</td>
                            <td class="text-center align-middle">{{ date('d M Y', strtotime($transaction->transaction_date)) }}</td>
                            <td class="text-start align-middle {{ empty($d->riwayat) || empty($d->riwayat->nama_mahasiswa) ? 'text-danger' : '' }}">
                                {{ $transaction->type?->name }}
                            </td>
                            <td class="text-center align-middle">{{ $transaction->category?->name }}</td>
                            <td class="text-center align-middle">
                                Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                            </td>
                            <td class="text-center align-middle">{{ $transaction->description }}</td>
                            <td class="text-center align-middle">
                                <button class="btn btn-rounded bg-warning mb-1" title="Edit Data"
                                    onclick='editTransaction(@json($transaction))'>
                                    <i class="fa fa-pencil-square-o"><span class="path1"></span><span class="path2"></span></i>
                                </button>
                                <form action="{{route('user.transactions.delete', $transaction->id)}}" method="POST">
                                    @csrf
                                    @method('delete')

                                    <button type="button" 
                                        class="btn btn-rounded bg-danger"
                                        onclick="confirmDelete(this)">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->

@endsection

@push('js')
<script src="{{asset('assets/vendor_components/datatable/datatables.min.js')}}"></script>
<script src="{{asset('assets/vendor_components/select2/dist/js/select2.min.js')}}"></script>
<script src="{{asset('assets/vendor_components/sweetalert/sweetalert.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    "use strict";

    $('#data').DataTable({
        pageLength: 10,
        ordering: true,
        responsive: true
    });


    const categoriesAll = @json($categoriesAll);

    // ===============================
    // DYNAMIC CATEGORY
    // ===============================
    const typeSelect = document.getElementById('type_id');
    const categorySelect = document.getElementById('category_id');

    if (typeSelect) {
        typeSelect.addEventListener('change', function() {
            filterCategory(this.value);
        });
    }

    function filterCategory(typeId = null) {
        typeId = typeId || typeSelect.value;

        categorySelect.innerHTML = '<option value="">-- Pilih Kategori --</option>';

        const filtered = categoriesAll.filter(c => c.type_id == parseInt(typeId));

        filtered.forEach(c => {
            let opt = document.createElement('option');
            opt.value = c.id;
            opt.text = c.name;
            categorySelect.appendChild(opt);
        });
    }

    // ===============================
    // FORMAT RUPIAH
    // ===============================
    document.addEventListener('DOMContentLoaded', function() {

        const amountInput = document.getElementById('amount');

        function formatRupiah(angka) {
            return 'Rp ' + angka.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }

        function cleanRupiah(value) {
            return value.replace(/[^0-9]/g, '');
        }

        if (amountInput) {
            amountInput.addEventListener('keyup', function() {
                let angka = cleanRupiah(this.value);
                this.value = angka ? formatRupiah(angka) : '';
            });
        }

        const form = document.getElementById('transactionForm');
        if (form) {
            form.addEventListener('submit', function() {
                amountInput.value = cleanRupiah(amountInput.value);
            });
        }

    });

    // ===============================
    // SUBMIT (BERSIHKAN FORMAT)
    // ===============================
    const form = document.getElementById('transactionForm');

    if (form) {
        form.addEventListener('submit', function() {
            if (amountInput) {
                amountInput.value = cleanRupiah(amountInput.value);
            }
        });
    }

    // ===============================
    // EDIT DATA
    // ===============================
    function editTransaction(data) {
        document.getElementById('modalTitle').innerText = 'Edit Catatan';

        document.getElementById('transaction_id').value = data.id;
        document.getElementById('transaction_date').value = data.transaction_date;
        document.getElementById('type_id').value = data.type_id;

        filterCategory(data.type_id);

        setTimeout(() => {
            document.getElementById('category_id').value = data.category_id;
        }, 100);

        // 🔥 format rupiah saat edit
        document.getElementById('amount').value = formatRupiah(data.amount.toString());

        document.getElementById('description').value = data.description;

        document.getElementById('form_method').value = 'PUT';
        document.getElementById('transactionForm').action = '/user/transactions/' + data.id;

        new bootstrap.Modal(document.getElementById('modalTransaction')).show();
    }

    // ===============================
    // RESET MODAL
    // ===============================
    const btnOpenModal = document.querySelector('[data-bs-target="#modalTransaction"]');

    if (btnOpenModal) {
        btnOpenModal.addEventListener('click', () => {
            document.getElementById('modalTitle').innerText = 'Tambah Catatan';
            document.getElementById('transactionForm').reset();

            if (amountInput) amountInput.value = '';

            document.getElementById('form_method').value = 'POST';
            document.getElementById('transactionForm').action = "{{ route('user.transactions.store') }}";
        });
    }

    // ===============================
    // KONFIRMASI DELETE
    // ===============================
    function confirmDelete(button) {
        swal({
            title: "Yakin hapus?",
            text: "Data tidak bisa dikembalikan!",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, hapus!",
            cancelButtonText: "Batal",

            // 🔥 WARNA TOMBOL
            confirmButtonColor: "#e3342f", // merah
            cancelButtonColor: "#6c757d",  // abu-abu

            closeOnConfirm: false
        }, function(isConfirm) {
            if (isConfirm) {
                console.log('Submit jalan');
                button.closest('form').submit();
            }
        });
    }
</script>
@endpush