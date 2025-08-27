@extends('layouts.peserta')
@section('title')
Lamaran Peserta
@endsection

@section('content')
<section class="content">
    
    <div class="row align-items-end">
        <div class="col-xl-12 col-12">
            <div class="box bg-primary-light">
                <div class="box-body d-flex px-0">
                    <div class="flex-grow-1 p-30 bg-img dask-bg bg-none-md" 
                        style="background-position: right bottom; background-size: auto 100%; background-image: url(../images/svg-icon/color-svg/custom-1.svg)">
                        <div class="row">
                            <div class="col-12 col-xl-7">
                                <h2>Welcome back, <strong>{{ auth()->user()->nama }}!</strong></h2>
                                <p class="text-dark my-10 fs-16">
                                    Lamaran Peserta <strong class="text-warning">very good!</strong>
                                </p>
                            </div>
                            <div class="col-12 col-xl-5"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- List Lamaran --}}
    <div class="row">
        <div class="col-xl-12 col-12">
            <div class="box no-shadow mb-0 bg-transparent">
                <div class="box-header no-border px-0">
                    <h2 class="box-title"><strong>Lamaran</strong></h2>							
                </div>
            </div>
            <div class="box bt-5 border-danger rounded mb-3">
                <div class="box-body bg-secondary-light">	
                    <div class="flex-grow-1">	
                        <div class="d-flex align-items-center pe-2 justify-content-between">							
                            <h3 class="fw-500">{{ $data_peserta->posisi }}</h3>					
                        </div>
                        <p class="fs-16">PT Tanjungenim Lestari Pulp and Paper (TeL)</p>
                    </div>		
                    <div class="row mt-30">
                    {{-- LOOPING JUMLAH UJIAN --}}
                    {{-- @if($today <= $jadwal_ujian->first()->waktu_selesai_ujian && $data_peserta->pesertaUjian->status_ujian == 'Lulus') --}}
                        {{-- Tampilkan SEMUA ujian --}}
                        @for($i = 0; $i < count($jadwal_ujian); $i++)
                            @php
                                $jadwal = $jadwal_ujian[$i]; // ambil data berdasarkan index
                            @endphp
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="box mb-15 pull-up">
                                    <div class="box-body">

                                        {{-- Kondisi Try Out --}}
                                        @if($today <= $jadwal->waktu_mulai_to && $today <= $jadwal->waktu_selesai_to)
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="d-flex align-items-center">
                                                    <div class="me-15 bg-warning d-flex justify-content-center align-items-center rounded" 
                                                        style="width:60px; height:60px;">
                                                        <i class="fa-solid fa-file-pen fa-2x text-white"></i>
                                                    </div>
                                                    <div class="d-flex flex-column fw-500">
                                                        <a href="#" class="text-dark hover-primary mb-1 fs-16">
                                                            Try Out {{ $jadwal->jenisUjian->nama_ujian }}
                                                        </a>
                                                        <span class="text-fade">
                                                            Mulai   : {{ date('d-m-Y H:i', strtotime($jadwal->waktu_mulai_to)) }} <br>
                                                            Selesai : {{ date('d-m-Y H:i', strtotime($jadwal->waktu_selesai_to)) }}
                                                        </span>
                                                    </div>
                                                </div>

                                                {{-- Tombol detail, kirim index i --}}
                                                <button type="button" 
                                                    class="btn btn-sm btn-warning btn-rounded"
                                                    title="Detail Peserta"
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#detailPesertaUjian"
                                                    onclick="showDetail({{ $i }})">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                            </div>

                                        {{-- Kondisi Ujian Normal --}}
                                        @elseif($today <= $jadwal->waktu_mulai_ujian && $today > $jadwal->waktu_selesai_to)
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="d-flex align-items-center">
                                                    <div class="me-15 bg-warning d-flex justify-content-center align-items-center rounded" 
                                                        style="width:60px; height:60px;">
                                                        <i class="fa-solid fa-file-pen fa-2x text-white"></i>
                                                    </div>
                                                    <div class="d-flex flex-column fw-500">
                                                        <a href="#" class="text-dark hover-primary mb-1 fs-16">
                                                            {{ $jadwal->jenisUjian->nama_ujian }}
                                                        </a>
                                                        <span class="text-fade">
                                                            Mulai   : {{ date('d-m-Y H:i', strtotime($jadwal->waktu_mulai_to)) }} <br>
                                                            Selesai : {{ date('d-m-Y H:i', strtotime($jadwal->waktu_selesai_to)) }}
                                                        </span>
                                                    </div>
                                                </div>

                                                {{-- Tombol detail, kirim index i --}}
                                                <button type="button" 
                                                    class="btn btn-sm btn-warning btn-rounded"
                                                    title="Detail Peserta"
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#detailPesertaUjian"
                                                    onclick="showDetail({{ $i }})">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                            </div>
                                        @else
                                            {{-- Kondisi Hasil --}}
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="d-flex align-items-center">
                                                    <div class="me-15 bg-warning d-flex justify-content-center align-items-center rounded" 
                                                        style="width:60px; height:60px;">
                                                        <i class="fa-solid fa-file-pen fa-2x text-white"></i>
                                                    </div>
                                                    <div class="d-flex flex-column fw-500">
                                                        <a href="#" class="text-dark hover-primary mb-1 fs-16">
                                                            Hasil {{ $jadwal->jenisUjian->nama_ujian }}
                                                        </a>
                                                    </div>
                                                </div>

                                                {{-- Tombol hasil, kirim index i --}}
                                                <button type="button" class="waves-effect waves-light btn btn-rounded btn-outline btn-primary mb-5 btn-lg" 
                                                    title="Lihat Hasil Ujian"
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#hasilUjian"
                                                    onclick="showHasil({{ $i }})">
                                                    <i class="fa fa-eye"></i> Lihat Hasil
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            {{-- ✅ include modal per ujian --}}

                            @include('peserta.lamaran.kartu-peserta-ujian')
                            @include('peserta.lamaran.hasil-ujian', ['i' => $i, 'jadwal' => $jenisUjian[$i]])
                        @endfor

                    </div>
                </div>					
            </div>
        </div>
    </div>	
</section>
@endsection
@push('scripts')
<script>
   window.detailPeserta = @json($detailPeserta);

    function showDetail(i) {
        let data = window.detailPeserta.ujian[i]; // ambil data berdasarkan index i

        if (data) {
            document.getElementById("namaPeserta").value = window.detailPeserta.nama;
            document.getElementById("noPeserta").value = data.no_peserta;
            document.getElementById("jenisUjian").value = data.jenis_ujian;
            document.getElementById("waktuMulai").value = data.waktu_mulai;
            document.getElementById("waktuSelesai").value = data.waktu_selesai;
            document.getElementById("fotoPeserta").src = window.detailPeserta.foto ?? "/images/default.png";
        }
    }

    function showHasil(i) {
        let data = window.detailPeserta.ujian[i]; // ambil data berdasarkan index i

        if (data) {
            document.getElementById("hasilJenisUjian").innerText = data.jenis_ujian;
            document.getElementById("hasilNilai").innerText = data.nilai ?? 0;
            document.getElementById("hasilStatus").innerText = data.status_ujian;
        }
    }
</script>


@endpush


