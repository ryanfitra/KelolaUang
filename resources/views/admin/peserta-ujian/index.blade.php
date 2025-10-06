@extends('layouts.admin')
@section('title')
DAFTAR PESERTA
@endsection
@section('content')
@include('swal')
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="me-auto">
            <h3 class="page-title">DAFTAR PESERTA</h3>
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="mdi mdi-home-outline"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Peserta</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="box box-outline-success bs-3 border-success">
                <div class="box-header with-border d-flex justify-content-between">
                    {{-- Tombol Generate Nomor Peserta --}}
                    {{-- <div class="mb-0">
                        <form action="{{ route('admin.pendaftar.generateAll') }}" method="POST" id="generateAllForm">
                            @csrf
                            <button type="button" class="btn btn-primary" onclick="generateAllPeserta()">
                                <i class="fa fa-id-card me-1"></i> Generate Nomor Peserta
                            </button>
                        </form>
                    </div> --}}
                    <span class="divider-line mx-1"></span>
                        <button
                        type="button"
                        class="btn btn-success waves-effect waves-light"
                        data-bs-toggle="modal"
                        data-bs-target="#uploadModal"
                    >
                    <i class="fa fa-upload me-2"></i>Upload Data
                    </button>
                    {{-- </div> --}}
                </div>
                @include('admin.peserta-ujian.upload')
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="data" class="table table-hover table-bordered margin-top-10 w-p100">
                          {{-- <table class="table table-bordered"> --}}
                            <thead>
                                <tr>
                                    <th class="text-center text-middle">No</th>
                                    <th class="text-start text-middle">Nama Peserta</th>
                                    <th class="text-center text-middle">No Peserta</th>
                                    <th class="text-center text-middle">Jenis Ujian</th>
                                    <th class="text-center text-middle">Status</th>
                                    <th class="text-center text-middle">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($peserta as $p)
                                <tr>
                                    <td class="text-center text-middle">{{ $loop->iteration }}</td>
                                    <td class="text-start text-middle">{{ $p->user->nama ?? '-' }}</td>
                                    <td class="text-center text-middle">{{ $p->no_peserta }}</td>
                                    <td class="text-center text-middle">{{ $p->jadwalUjian->jenisUjian->nama_ujian }}</td>
                                    <td class="text-center text-bottom">
                                        @if($p->status_ujian == 'Lulus')
                                            <span class="badge bg-success">Lulus</span>
                                        @elseif($p->status_ujian == 'Tidak Lulus')
                                            <span class="badge bg-danger">Gagal</span>
                                        @else
                                            <span class="badge bg-secondary">Belum Diverifikasi</span>
                                        @endif
                                    </td>
                                    <td class="text-center text-bottom">
                                        @if($p->status_ujian === 'Lulus')
                                            {{-- Sudah Lulus → hanya tombol Gagal --}}
                                            <form action="{{ route('admin.peserta-ujian.verifikasi', $p->id) }}" method="POST" class="form-verifikasi" style="display:inline;">
                                                @csrf
                                                <input type="hidden" name="status_ujian" value="Tidak Lulus">
                                                <button type="button" class="btn btn-sm btn-danger mb-1 btn-confirm">Gagal</button>
                                            </form>
                                        @elseif($p->status_ujian === 'Tidak Lulus')
                                            {{-- Tidak Lulus → semua tombol hilang --}}
                                            {{-- <span class="text-muted">-</span> --}}
                                        @else
                                            {{-- Belum Ujian / Sedang Ujian → tampilkan tombol --}}
                                            <form action="{{ route('admin.peserta-ujian.verifikasi', $p->id) }}" method="POST" class="form-verifikasi" style="display:inline;">
                                                @csrf
                                                <input type="hidden" name="status_ujian" value="Lulus">
                                                <button type="button" class="btn btn-sm btn-success mb-1 btn-confirm">Lulus</button>
                                            </form>

                                            <form action="{{ route('admin.peserta-ujian.verifikasi', $p->id) }}" method="POST" class="form-verifikasi" style="display:inline;">
                                                @csrf
                                                <input type="hidden" name="status_ujian" value="Tidak Lulus">
                                                <button type="button" class="btn btn-sm btn-danger mb-1 btn-confirm">Gagal</button>
                                            </form>
                                        @endif
                                    </td>



                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                      </div>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection
@push('js')
<script src="{{asset('assets/vendor_components/datatable/datatables.min.js')}}"></script>
<script src="{{asset('assets/vendor_components/select2/dist/js/select2.min.js')}}"></script>
<script src="{{asset('assets/vendor_components/sweetalert/sweetalert.min.js')}}"></script>
<script>

     $(function() {
        "use strict";

        $('#data').DataTable();
    });

    $('.btn-confirm').click(function(e) {
        e.preventDefault();

        let form = $(this).closest('form');
        let status = form.find('input[name="status_ujian"]').val();

        swal({
            title: "Apakah anda yakin?",
            text: "Peserta akan diberi status: " + status,
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Lanjutkan",
            cancelButtonText: "Batal"
        }, function(isConfirm) {
            if (isConfirm) {
                form.submit();
            }
        });
    });


    $('#uploadForm').submit(function(e){
        e.preventDefault();
        swal({
            title: 'Simpan Data',
            text: "Apakah anda yakin ingin menyimpan data?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Lanjutkan',
            cancelButtonText: 'Batal'
        }, function(isConfirm){
            if (isConfirm) {
                $('#uploadForm').unbind('submit').submit();
                $('#spinner').show();
            }
        });
    });

    $('#editForm').submit(function(e){
        e.preventDefault();
        swal({
            title: 'Edit Data',
            text: "Apakah anda yakin ingin merubah data?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Lanjutkan',
            cancelButtonText: 'Batal'
        }, function(isConfirm){
            if (isConfirm) {
                $('#editForm').unbind('submit').submit();
                $('#spinner').show();
            }
        });
    });


</script>
@endpush
