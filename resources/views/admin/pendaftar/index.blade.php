@extends('layouts.admin')
@section('title')
DAFTAR PENDAFTAR
@endsection
@section('content')
@include('swal')
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="me-auto">
            <h3 class="page-title">DAFTAR PENDAFTAR</h3>
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="mdi mdi-home-outline"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Pendaftar</li>
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
                    {{-- <div class="d-flex justify-content-start">
                        <form action="{{route('univ.p-bayar')}}" method="get" id="semesterForm">
                            <select name="id_semester" id="id_semester" class="form-select"
                                onchange="document.getElementById('semesterForm').submit();">
                                <option value="">-- Pilih Semester --</option>
                                @foreach ($semester as $s)
                                <option value="{{$s->id_semester}}" {{ request('id_semester') == $s->id_semester ? 'selected' : '' }}>{{$s->nama_semester}}</option>
                                @endforeach
                            </select>
                        </form>
                    </div> --}}
                    {{-- Tombol Generate Nomor Peserta --}}
                    <div class="mb-0">
                        <form action="{{ route('admin.pendaftar.generateAll') }}" method="POST" id="generateAllForm">
                            @csrf
                            <button type="button" class="btn btn-primary" onclick="generateAllPeserta()">
                                <i class="fa fa-id-card me-1"></i> Generate Nomor Peserta
                            </button>
                        </form>
                    </div>
                    <span class="divider-line mx-1"></span>
                        {{-- <button
                        type="button"
                        class="btn btn-primary waves-effect waves-light"
                        data-bs-toggle="modal"
                        data-bs-target="#uploadModal"
                    >
                    <i class="fa fa-upload me-2"></i>Upload Data
                    </button> --}}
                    {{-- </div> --}}
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="data" class="table table-hover table-bordered margin-top-10 w-p100">
                          <thead>
                             <tr>
                                <th class="text-center align-middle">No</th>
                                <th class="text-center align-middle">Nama</th>
                                <th class="text-center align-middle">Nomer Identitas</th>
                                <th class="text-center align-middle">Jenis Kelamin</th>
                                <th class="text-center align-middle">No. HP</th>
                                <th class="text-center align-middle">Posisi yang Dilamar</th>
                                <th class="text-center align-middle">Aksi</th>
                             </tr>
                          </thead>
                          <tbody>
                            @foreach ($pendaftar as $d)
                            <tr>
                                <td class="text-center align-middle">{{$loop->iteration}}</td>
                                <td class="text-center align-middle">{{$d->nama}}</td>
                                <td class="text-center align-middle">{{$d->nik}}</td>
                                <td class="text-center align-middle">
                                    @if($d->jenis_kelamin == 'L')
                                        Laki-laki
                                    @elseif($d->jenis_kelamin == 'P')
                                        Perempuan
                                    @elseif(empty($d->jenis_kelamin))
                                        Tidak diisi
                                    @else
                                        -
                                    @endif
                                </td>

                                <td class="text-center align-middle">{{$d->no_wa}}</td>
                                <td class="text-start align-middle">{{$d->posisi}}</td>
                                
                                <td class="text-center align-middle">
                                    {{-- Tombol Delete --}}
                                    <button type="button" class="btn btn-rounded bg-danger my-2" title="Delete Data" onclick="deleteRuang({{$d->id}})">
                                        <i class="fa fa-trash"><span class="path1"></span><span class="path2"></span></i>
                                    </button>
                                    <form action="{{route('admin.pendaftar.delete', $d->id)}}" method="POST" id="delete-form-{{$d->id}}">
                                        @csrf
                                        @method('delete')
                                    </form>

                                    {{-- Tombol Generate per Peserta --}}
                                    <button type="button" class="btn btn-rounded bg-primary my-2" title="Generate Nomor Peserta" onclick="generatePeserta({{$d->id}})">
                                        <i class="fa fa-id-card"></i>
                                    </button>
                                    <form action="{{route('admin.pendaftar.generate', $d->id)}}" method="POST" id="generate-form-{{$d->id}}">
                                        @csrf
                                    </form>
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

    // Generate nomor peserta untuk 1 user
    function generatePeserta(id) {
        swal({
            title: 'Generate Nomor Peserta',
            text: "Nomor peserta akan dibuat/diupdate untuk user ini. Lanjutkan?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Generate',
            cancelButtonText: 'Batal'
        }, function(isConfirm){
            if (isConfirm) {
                document.getElementById('generate-form-' + id).submit();
            }
        });
    }

    // Generate nomor peserta untuk semua user
    function generateAllPeserta() {
        swal({
            title: 'Generate Nomor Peserta Semua',
            text: "Nomor peserta akan dibuat/diupdate untuk semua pendaftar. Lanjutkan?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Generate Semua',
            cancelButtonText: 'Batal'
        }, function(isConfirm){
            if (isConfirm) {
                document.getElementById('generateAllForm').submit();
            }
        });
    }

    // Hapus data
    function deleteRuang(id) {
        swal({
            title: 'Delete Data',
            text: "Apakah anda yakin ingin menghapus data?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Lanjutkan',
            cancelButtonText: 'Batal'
        }, function(isConfirm){
            if (isConfirm) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>
@endpush
