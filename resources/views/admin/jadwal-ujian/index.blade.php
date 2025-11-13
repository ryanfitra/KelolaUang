@extends('layouts.admin')
@section('title')
JADWAL UJIAN
@endsection
@section('content')
@include('swal')
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="me-auto">
            <h3 class="page-title">DAFTAR JADWAL UJIAN</h3>
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="mdi mdi-home-outline"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Jadwal Ujian</li>
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
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-success waves-effect waves-light" data-bs-toggle="modal"
                        data-bs-target="#createModal"><i class="fa fa-plus"></i> Tambah Data</button>
                        <span class="divider-line mx-1"></span>
                        {{-- <button
                        type="button"
                        class="btn btn-primary waves-effect waves-light"
                        data-bs-toggle="modal"
                        data-bs-target="#uploadModal"
                    >
                    <i class="fa fa-upload me-2"></i>Upload Data
                    </button> --}}
                    </div>
                </div>
                @include('admin.jadwal-ujian.create')
                @include('admin.jadwal-ujian.edit')
                {{-- @include('admin.jadwal-ujian.upload') --}}
                
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="data" class="table table-hover table-bordered margin-top-10 w-p100">
                          <thead>
                             <tr>
                                <th class="text-center align-middle">No</th>
                                <th class="text-center align-middle">Nama Ujian</th>
                                <th class="text-center align-middle">Sesi Ujian</th>
                                <th class="text-center align-middle">Jadwal Try Out</th>
                                <th class="text-center align-middle">Jadwal Ujian</th>
                                <th class="text-center align-middle">Jadwal Pengumuman</th>
                                {{-- <th class="text-center align-middle">No. HP</th>
                                <th class="text-center align-middle">Posisi yang Dilamar</th> --}}
                                <th class="text-center align-middle">Aksi</th>
                             </tr>
                          </thead>
                          <tbody>
                            @foreach ($data as $d)
                            <tr>
                                <td class="text-center align-middle">{{ $loop->iteration }}</td>

                                <td class="text-center align-middle">
                                    {{ $d->jenisUjian->nama_ujian ?? '-' }}
                                </td>

                                <td class="text-center align-middle">{{ $d->sesi ?? '-' }}</td>

                                <td class="text-center align-middle">
                                    @if($d->waktu_mulai_to && $d->waktu_selesai_to)
                                        {{ \Carbon\Carbon::parse($d->waktu_mulai_to)->format('d-m-Y (H:i)') }} -
                                        {{ \Carbon\Carbon::parse($d->waktu_selesai_to)->format('d-m-Y (H:i)') }}
                                    @else
                                        <span class="text-muted">Belum dijadwalkan</span>
                                    @endif
                                </td>

                                <td class="text-center align-middle">
                                    @if($d->waktu_mulai_ujian && $d->waktu_selesai_ujian)
                                        {{ \Carbon\Carbon::parse($d->waktu_mulai_ujian)->format('d-m-Y (H:i)') }} - 
                                        {{ \Carbon\Carbon::parse($d->waktu_selesai_ujian)->format('d-m-Y (H:i)') }}
                                    @else
                                        <span class="text-muted">Belum ditentukan</span>
                                    @endif
                                </td>

                                <td class="text-center align-middle">
                                    {{ $d->waktu_pengumuman ? \Carbon\Carbon::parse($d->waktu_pengumuman)->format('d-m-Y (H:i)') : '-' }}
                                </td>

                                <td class="text-center align-middle">
                                    <button class="btn btn-rounded bg-warning" 
                                        title="Edit Data" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editModal" 
                                        onclick='editButton(@json($d), {{ $d->id }})'>
                                        <i class="fa fa-pencil-square-o"></i>
                                    </button>

                                    <button type="button" 
                                        class="btn btn-rounded bg-danger my-2" 
                                        title="Delete Data" 
                                        onclick="deleteButton({{ $d->id }})">
                                        <i class="fa fa-trash"></i>
                                    </button>

                                    <form action="{{ route('admin.jadwal-ujian.delete', $d->id) }}" method="POST" id="delete-form-{{ $d->id }}">
                                        @csrf
                                        @method('DELETE')
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

    function editButton(data, id) {
        // isi action form edit
        document.getElementById('editForm').action = '/admin/jadwal-ujian/' + id;

        // isi field
        document.getElementById('edit_jenis_ujian_id').value = data.jenis_ujian_id;
        document.getElementById('edit_waktu_mulai_to').value = data.waktu_mulai_to.replace(' ', 'T');
        document.getElementById('edit_waktu_selesai_to').value = data.waktu_selesai_to.replace(' ', 'T');
        document.getElementById('edit_waktu_mulai_ujian').value = data.waktu_mulai_ujian.replace(' ', 'T');
        document.getElementById('edit_waktu_selesai_ujian').value = data.waktu_selesai_ujian.replace(' ', 'T');
        document.getElementById('edit_waktu_pengumuman').value = data.waktu_pengumuman.replace(' ', 'T');
    }


    function deleteButton(id) {
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
                $('#spinner').show();
            }
        });
    }

    $('#storeForm').submit(function(e){
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
                $('#storeForm').unbind('submit').submit();
                $('#spinner').show();
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
    
    $('#metode_ujians').select2({
        placeholder: 'Pilih satu atau lebih metode ujian',
        width: '100%',
        dropdownParent: $('#createModal') // atau #editModal tergantung letaknya
    });


</script>
@endpush
