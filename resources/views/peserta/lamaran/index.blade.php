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
                                {{-- <p class="text-dark my-10 fs-16">
                                    Lamaran Peserta <strong class="text-warning">very good!</strong>
                                </p> --}}
                            </div>
                            <div class="col-12 col-xl-5"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- LIST LAMARAN --}}
    <div class="row">
        <div class="col-xl-12 col-12">
            <div class="box no-shadow mb-0 bg-transparent">
                <div class="box-header no-border px-0">
                    <h2 class="box-title"><strong>Lamaran</strong></h2>							
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="box bt-5 border-danger rounded mb-3">
                @if(empty($detailPeserta['ujian']))
                <div class="box-body">
                    <h3 class="box-title mb-1"><strong>{{ $data_peserta->posisi }}</strong></h3>
                    <p class="subtitle mb-20">{{ $data_peserta->instansi->nama_instansi }}</p>
                    <div class="clearfix">
                        <div class="alert alert-warning" role="alert">
                            <h4 class="alert-heading">Info!</h4>
                            <p>Belum ada jadwal ujian yang tersedia untuk Anda saat ini. Silakan hubungi administrator atau
                                pihak terkait untuk informasi lebih lanjut.</p>
                        </div>  
                    </div>
                </div>
                @else
                <div class="box-body">
                    <h3 class="box-title mb-1"><strong>{{ $data_peserta->posisi }}</strong></h3>
                    <p class="subtitle mb-20">{{ $data_peserta->instansi->nama_instansi }}</p>
                    <div class="clearfix">
                    @for($i = 0; $i < count($detailPeserta['ujian']); $i++)
                         @php
                            $ujian = $detailPeserta['ujian'][$i]; 
                            $ujian['mulai']   =$ujian['mulai'] ?? '';
                            $ujian['selesai'] =$ujian['selesai'] ?? '';
                            $mulai   =$ujian['mulai'] ?? '';
                            $selesai =$ujian['selesai'] ?? '';
                            $pengumuman = $ujian['pengumuman'] ?? '';
                            //$today = \Carbon\Carbon::now()->format('d-m-Y H:i');
                        @endphp

                       {{-- {{ \Carbon\Carbon::parse($today)->format('d-m-Y H:i') }} WIB --}}

                        {{-- TRY OUT: belum mulai --}}
                        {{-- JANGAN LUPA KEMBALIKAN KONDISI INI --}}
                        {{-- @if($today <= '12-10-2025 10:00') --}}
                        @if($today <$ujian['mulai'])
                            <button type="button"
                                class="waves-effect waves-light btn btn-rounded btn-outline btn-primary btn-lg"
                                data-bs-toggle="modal" data-bs-target="#detailPesertaUjian{{$i}}"
                                onclick="showDetail({{ $i }})" style="margin: 5px 10px;">
                                <i class="fa fa-file-pen"></i>
                                {{ $ujian['nama_ujian'] }}
                            </button>

                        {{-- TRY OUT: sedang berlangsung --}}{{-- UJIAN NORMAL --}}
                        {{-- @elseif($today <= '12-10-2025 10:00') --}}
                        @elseif($today >=$ujian['mulai'] && $today <= $ujian['selesai'])
                            <button type="button"
                                class="waves-effect waves-light btn btn-rounded btn-outline btn-primary btn-lg"
                                data-bs-toggle="modal" data-bs-target="#detailPesertaUjian{{$i}}"
                                onclick="showDetail({{ $i }})" style="margin: 5px 10px;">
                                <i class="fa fa-file-pen"></i>
                                {{ $ujian['nama_ujian'] }}
                            </button>
                        
                        {{-- HASIL --}}
                        @elseif($today > $ujian['selesai'] || $ujian['pengumuman' == NULL])
                            <button type="button"
                                class="waves-effect waves-light btn btn-rounded btn-outline btn-primary btn-lg"
                                data-bs-toggle="modal" data-bs-target="#hasilUjian{{$i}}"
                                onclick="showHasil({{ $i }})" style="margin: 5px 10px;">
                                <i class="fa fa-file-pen"></i>
                                {{ $ujian['nama_ujian'] }}
                            </button>
                        @endif

                        @include('peserta.lamaran.kartu-peserta-ujian')
                        @include('peserta.lamaran.hasil-ujian', ['i' => $i, 'jadwal' => $ujian])
                    @endfor

                    </div>
                </div>
                @endif
                <ul class="text-danger"><strong>Panduan :</strong>
                    <li class="text-black">
                      <p class="mb-0">Klik tombol <strong>Hasil</strong> untuk melihat hasil ujian sesuai jadwal Pengumuman.</p>
                    </li>
                    <li class="text-black">
                      <p class="mb-0">Klik tombol <strong>Try Out</strong> atau <strong>Tes</strong> untuk lihat Kartu Peserta dan masuk ke halaman ujian.</p>
                    </li>
                </ul>
                <ul class="text-danger"><strong>Catatan :</strong>
                    <li class="text-black">
                      <p class="mb-0">Peserta diwajibkan mengikuti Try Out dan Tes menggunakan perangkat <strong>Komputer / PC / Laptop</strong> dengan <strong>web browser (Google Chrome / Firefox)</strong> versi terbaru.</p>
                    </li>
                    <li class="text-black">
                      <p class="mb-0">Kegiatan <strong>Try Out</strong> bertujuan untuk melakukan uji coba aplikasi dan jaringan saat ujian, serta memperkenalkan cara menggunakan aplikasi ujian kepada peserta.</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
@endsection
@push('scripts')
@if(!empty($pengumuman))
<script>
    // Ambil waktu pengumuman dari PHP (sudah dalam format "d-m-Y H:i")
    var targetDate = new Date("{{ \Carbon\Carbon::parse($pengumuman)->format('Y-m-d H:i:s') }}").getTime();

    var countdown = setInterval(function() {
        var now = new Date().getTime();
        var distance = targetDate - now;

        if (distance <= 0) {
            clearInterval(countdown);
            document.getElementById("days").innerHTML    = "0";
            document.getElementById("hours").innerHTML   = "0";
            document.getElementById("minutes").innerHTML = "0";
            document.getElementById("seconds").innerHTML = "0";
            return;
        }

        var days    = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours   = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        document.getElementById("days").innerHTML    = days;
        document.getElementById("hours").innerHTML   = hours;
        document.getElementById("minutes").innerHTML = minutes;
        document.getElementById("seconds").innerHTML = seconds;
    }, 1000);
</script>
@endif

{{-- <script>
   window.detailPeserta = @json($detailPeserta);

    function showDetail(i) {
        let data = window.detailPeserta.ujian[i]; // ambil data berdasarkan index i

        if (data) {
            document.getElementById("namaPeserta").value = window.detailPeserta.nama;
            document.getElementById("noPeserta").value = data.no_peserta;
            document.getElementById("jenisUjian").value = data.nama_ujian;
            document.getElementById("waktuMulai").value = data.mulai;
            document.getElementById("waktuSelesai").value = data.selesai;
            document.getElementById("fotoPeserta").src = window.detailPeserta.foto ?? "/images/default.jpg";
        }
    }

    function showHasil(i) {
        let data = window.detailPeserta.ujian[i]; // ambil data berdasarkan index i

        if (data) {
            document.getElementById("hasilJenisUjian").innerText = data.nama_ujian;
            document.getElementById("hasilNilai").innerText = data.nilai ?? 0;
            document.getElementById("hasilStatus").innerText = data.status_ujian;
        }
    }
</script> --}}


@endpush


