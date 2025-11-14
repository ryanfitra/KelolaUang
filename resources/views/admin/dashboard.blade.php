@extends('layouts.admin')
@section('title', 'DASHBOARD')

@section('content')
@include('swal')

<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="me-auto">
            <h3 class="page-title">DASHBOARD ADMIN</h3>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="mdi mdi-home-outline"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<section class="content">
    {{-- Statistik --}}
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-white bg-primary shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Jumlah Peserta</h5>
                            <h2>{{ $jumlahPeserta }}</h2>
                        </div>
                        <i class="fa fa-users fa-3x"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Jenis Ujian</h5>
                            <h2>{{ $jumlahJenisUjian }}</h2>
                        </div>
                        <i class="fa fa-file-alt fa-3x"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-warning shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Jabatan Dibuka</h5>
                            <h2>{{ $jumlahJabatan }}</h2>
                        </div>
                        <i class="fa fa-briefcase fa-3x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr>

    {{-- Pemantauan User Login --}}
    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-gradient-success text-white rounded-top-4">
                    <h4 class="mb-0 fw-bold text-center">LOG PESERTA</h4>
                </div>
                <div class="card-body p-4">
                    <div class="alert alert-light border-start border-4 border-success shadow-sm">
                        <h4 class="mb-3"><i class="fa fa-user"></i> Pemantauan User Login</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover" id="sessionTable">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Nama User</th>
                                        <th>Email</th>
                                        <th>IP Address</th>
                                        <th>Terakhir Aktif</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($logs as $index => $log)
                                        @php
                                            $lastActive = $log->terakhir_aktif
                                                ? \Carbon\Carbon::parse($log->terakhir_aktif)
                                                : null;

                                            $isOnline = $lastActive && $lastActive->diffInMinutes(now()) <= 5;
                                        @endphp

                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $log->user->nama ?? 'Guest' }}</td>
                                            <td>{{ $log->user->email ?? '-' }}</td>
                                            <td>{{ $log->ip_address ?? '-' }}</td>
                                            <td>{{ $lastActive ? $lastActive->diffForHumans() : '-' }}</td>
                                            <td>
                                                <span class="badge {{ $isOnline ? 'bg-success' : 'bg-secondary' }}">
                                                    {{ $isOnline ? 'Online' : 'Offline' }}
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-muted">Belum ada user yang login</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('js')
<script src="{{ asset('assets/vendor_components/datatable/datatables.min.js') }}"></script>
<script src="{{ asset('assets/vendor_components/select2/dist/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/vendor_components/sweetalert/sweetalert.min.js') }}"></script>
<script>
$(function() {
    $('#sessionTable').DataTable({
        pageLength: 10,
        order: [[4, 'desc']],
        // responsive: true
    });
});
</script>
@endpush
