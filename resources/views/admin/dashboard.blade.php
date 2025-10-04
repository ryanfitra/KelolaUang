@extends('layouts.admin')
@section('title')
DASHBOARD
@endsection
@section('content')
@include('swal')
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="me-auto">
            <h3 class="page-title">DASHBOARD ADMIN</h3>
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="mdi mdi-home-outline"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
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
                {{-- <div class="box-header with-border d-flex justify-content-between">
                    //Tombol Generate Nomor Peserta
                    <div class="mb-0">
                        <form action="{{ route('admin.pendaftar.generateAll') }}" method="POST" id="generateAllForm">
                            @csrf
                            <button type="button" class="btn btn-primary" onclick="generateAllPeserta()">
                                <i class="fa fa-id-card me-1"></i> Generate Nomor Peserta
                            </button>
                        </form>
                    </div>
                    <span class="divider-line mx-1"></span>
                        <button
                        type="button"
                        class="btn btn-success waves-effect waves-light"
                        data-bs-toggle="modal"
                        data-bs-target="#uploadModal"
                    >
                    <i class="fa fa-upload me-2"></i>Upload Data
                    </button>
                    </div>
                </div>
                @include('admin.peserta-ujian.upload') --}}
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h5>Jumlah Peserta Ujian</h5>
                                    <h1>{{ $jumlahPeserta }}</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h5>Jumlah Jenis Ujian</h5>
                                    <h1>{{ $jumlahJenisUjian }}</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h5>Jumlah Jabatan Dibuka</h5>
                                    <h1>{{ $jumlahJabatan }}</h1>
                                </div>
                            </div>
                        </div>
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
