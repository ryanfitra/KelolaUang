@extends('layouts.peserta')

@section('title', 'Dashboard Peserta CBT Universitas Sriwijaya')

@section('content')
<section class="content container-fluid py-4">

    {{-- 🎉 Greeting Section --}}
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-lg bg-gradient-primary text-white p-4 rounded-4">
                <div class="align-items-md-center justify-content-between">
                    <div>
                        <h3 class="fw-bold mb-2">
                            Selamat Datang, <span class="text-warning">{{ auth()->user()->nama }}</span> 🎓
                        </h3>
                        <!-- <p class="mb-0 fs-5">Semoga sukses dalam pelaksanaan <strong>Computer Based Test Universitas Sriwijaya</strong>.</p> -->
                    </div>
                    <!-- <img src="https://placehold.co/150x90?text=CBT+Illustration" alt="CBT Illustration" class="img-fluid mt-3 mt-md-0" style="max-height: 90px;"> -->
                </div>
            </div>
        </div>
    </div>

    {{-- 🔔 Announcement Card --}}
    {{-- 🎓 Pengumuman Khusus untuk Peserta Lulus Jenis Ujian ID = 2 --}}
    @if(!empty($detailPeserta['ujian'][1]) 
        && $detailPeserta['ujian'][1]['jenis_ujian_id'] == 2
        && strtolower($detailPeserta['ujian'][1]['status_ujian']) == 'lulus')
        <div class="row mt-4">
            <div class="col-12">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-header bg-gradient-danger text-white rounded-top-4">
                        <h4 class="mb-0 fw-bold text-center">📢 PENGUMUMAN PENTING</h4>
                    </div>
                    <div class="card-body p-4">
                        <div class="alert alert-light border-start border-4 border-danger shadow-sm">
                            <p class="fs-5">
                                Pada tanggal <strong class="text-danger">15 - 16 November 2025</strong> pukul 
                                <strong class="text-danger">08:00 - 18:00 WIB</strong> akan dilaksanakan 
                                <strong class="text-primary">Seleksi Tahap III (Tes Psikologi)</strong> 
                                bagi peserta yang <strong class="text-success">Lulus Tahap II</strong>.
                            </p>

                            <p class="fs-5">
                                Sebelum mengikuti ujian Peserta diwajibkan mengisi Formulir pada link berikut :<br>
                                <a href="https://forms.gle/gWK9ZtgiSS5EYcQx7" target="_blank" class="text-primary fw-bold">
                                    Formulir Daftar Riwayat Hidup
                                </a> 
                            </p>

                            <p class="fs-5">
                                Ujian dilaksanakan secara <strong>online</strong> di website 
                                <a href="https://103.121.159.166/main/peserta_psikologi" target="_blank" class="text-primary fw-bold">
                                    cbt.unsri.ac.id
                                </a> dan melalui <strong>Zoom Meeting</strong>.
                            </p>

                            <div class="mt-3">
                                <h6 class="fw-bold">⏰ Waktu Ujian CBT:</h6>
                                <ul class="mb-3">
                                    <li><strong>Sesi I:</strong> 08:00 - 12:00 WIB</li>
                                    <li><strong>Sesi II:</strong> 13:00 - 17:00 WIB</li>
                                </ul>

                                <p class="mb-2">
                                    Untuk jadwal ujian CBT dan Wawancara Daring, silakan buka halaman :
                                </p>
                                <a href="{{ route('peserta.lamaran') }}" class="btn btn-success btn-sm shadow-sm">
                                    <i class="fa fa-file"></i> Halaman Lamaran (Kartu Peserta)
                                </a>
                            </div>
                        </div>
                        <ul class="text-danger"><strong>Catatan :</strong>
                            <li class="text-black">
                            <p class="mb-0">Peserta diwajibkan mengikuti Tes menggunakan perangkat <strong>Komputer / PC / Laptop</strong> dengan <strong>web browser (Google Chrome / Firefox)</strong> versi terbaru.</p>
                            </li>
                            <!-- <li class="text-black">
                            <p class="mb-0">Kegiatan <strong>Try Out</strong> bertujuan untuk melakukan uji coba aplikasi dan jaringan saat ujian, serta memperkenalkan cara menggunakan aplikasi ujian kepada peserta.</p>
                            </li> -->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- 📊 Quick Stats --}}
    <div class="row mt-4 g-3">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4 hover-shadow text-center py-4">
                <h6 class="text-muted">Tahapan Seleksi</h6>
                <h2 class="fw-bold text-primary display-5 mb-0">{{ $jenisUjian->count() }}</h2>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4 hover-shadow text-center py-4">
                <h6 class="text-muted">Tahapan Selesai</h6>
                <h2 class="fw-bold mb-0">
                    <a href="{{ route('peserta.lamaran') }}" class="text-success text-decoration-none fs-42">
                        2
                    </a>
                </h2>
            </div>
        </div>
    </div>

    {{-- 📅 Next Exam --}}
    {{-- <div class="row mt-4">
        <div class="col-12">
            <div class="card border-0 shadow-lg rounded-4">
                <div class="card-header bg-gradient-light rounded-top-4">
                    <h5 class="fw-bold mb-0">📅 Jadwal Ujian Berikutnya</h5>
                </div>
                <div class="card-body p-4">
                    <p class="fs-5">
                        Ujian akan dilaksanakan secara online melalui 
                        <a href="https://103.121.159.166/main/peserta_psikologi" target="_blank" class="text-primary fw-bold">
                            https://cbt.unsri.ac.id/main/peserta
                        </a>.
                        <br>
                        Untuk melihat detail jadwal dan sesi ujian, klik tombol di bawah:
                    </p>
                    <a href="{{ route('peserta.lamaran') }}" class="btn btn-primary btn-lg shadow-sm mt-2">
                        <i class="fa fa-calendar"></i> Lihat Jadwal & Kartu Peserta
                    </a>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- 🕒 Timeline Seleksi --}}
    <div class="row mt-4">
        <div class="col-12">
            <div class="card border-0 shadow-lg rounded-4">
                <div class="card-header bg-gradient-light rounded-top-4">
                    <h4 class="mb-0 fw-bold">📆 Jadwal Seleksi</h4>
                </div>
                <div class="card-body p-4">
                    @if($timelines->isEmpty())
                        <div class="text-center py-5 text-muted">
                            <i class="fa fa-calendar-times fa-2x mb-3"></i>
                            <h5>Belum ada Jadwal yang tersedia</h5>
                        </div>
                    @else
                        <ul class="timeline list-unstyled position-relative ps-3">
                            @foreach($timelines as $timeline)
                                @php
                                    $mulai = $timeline->tanggal_mulai ? \Carbon\Carbon::parse($timeline->tanggal_mulai)->format('d M Y') : null;
                                    $selesai = $timeline->tanggal_selesai ? \Carbon\Carbon::parse($timeline->tanggal_selesai)->format('d M Y') : null;
                                @endphp
                                <li class="mb-4 position-relative ps-4 border-start border-3 border-primary">
                                    <div class="mb-1 fw-bold text-primary">
                                        📍 {{ $timeline->nama_kegiatan }}
                                    </div>
                                    <div class="text-muted small">
                                        {{ $mulai ? $mulai.($selesai ? ' - '.$selesai : '') : 'Tanggal belum ditentukan' }}
                                    </div>
                                    <p class="mt-1 mb-0">{{ $timeline->deskripsi }}</p>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- 📢 Additional Announcements --}}
    <div class="row mt-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-gradient-light rounded-top-4">
                    <h5 class="mb-0 fw-bold">ℹ️ Informasi Umum</h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0 fs-6">
                        <li>✅ Pengumuman hasil ujian akan ditampilkan di dashboard ini.</li>
                        <li>⚠️ Pastikan login tepat waktu sesuai jadwal ujian.</li>
                        <li>💡 Gunakan browser terbaru (Google Chrome / Firefox) untuk performa terbaik.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</section>

{{-- 🎨 Custom Styles --}}
<style>
    .bg-gradient-primary {
        background: linear-gradient(90deg, #007bff 0%, #00bcd4 100%);
    }
    .bg-gradient-danger {
        background: linear-gradient(90deg, #dc3545 0%, #ff6b6b 100%);
    }
    .bg-gradient-light {
        background: linear-gradient(90deg, #f8f9fa 0%, #e9ecef 100%);
    }
    .hover-shadow:hover {
        transform: translateY(-3px);
        transition: 0.2s;
        box-shadow: 0 8px 16px rgba(0,0,0,0.15) !important;
    }
    .timeline::before {
        content: "";
        position: absolute;
        left: 12px;
        top: 0;
        width: 4px;
        height: 100%;
        background: #007bff;
        border-radius: 2px;
    }
    .timeline li::before {
        content: "";
        position: absolute;
        left: -9px;
        top: 5px;
        width: 18px;
        height: 18px;
        background: #fff;
        border: 3px solid #007bff;
        border-radius: 50%;
    }
</style>
@endsection
