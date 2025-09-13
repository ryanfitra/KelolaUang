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
                <div class="box-body">
                    <h3 class="box-title mb-1"><strong>{{ $data_peserta->posisi }}</strong></h3>
                    <p class="subtitle mb-20">{{ $data_peserta->instansi->nama_instansi }}</p>
                    <div class="clearfix">
                    {{-- LOOPING SESUAI KONDISI --}}
                    @for($i = 0; $i < count($ujiansToShow); $i++)
                        @php
                            $ujian   = $ujiansToShow[$i]; 
                            $mulai   = \Carbon\Carbon::createFromFormat('d-m-Y H:i', $ujian['waktu_mulai']);
                            $selesai = \Carbon\Carbon::createFromFormat('d-m-Y H:i', $ujian['waktu_selesai']);
                        @endphp

                        {{-- TRY OUT: belum mulai --}}
                        @if($today < $mulai)
                            <button type="button"
                                class="waves-effect waves-light btn btn-rounded btn-outline btn-primary btn-lg"
                                data-bs-toggle="modal" data-bs-target="#detailPesertaUjian{{$i}}"
                                onclick="showDetail({{ $i }})" style="margin: 5px 10px;">
                                <i class="fa fa-file-pen"></i>
                                {{ $ujian['nama_ujian'] }}
                            </button>

                        {{-- sedang berlangsung --}}
                        @elseif($today >= $mulai && $today <= $selesai)
                            <button type="button"
                                class="waves-effect waves-light btn btn-rounded btn-outline btn-primary btn-lg"
                                data-bs-toggle="modal" data-bs-target="#detailPesertaUjian{{$i}}"
                                onclick="showDetail({{ $i }})" style="margin: 5px 10px;">
                                <i class="fa fa-file-pen"></i>
                                {{ $ujian['nama_ujian'] }}
                            </button>

                        {{-- sudah selesai tampilkan hasil --}}
                        @elseif($today > $selesai)
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
            </div>
        </div>
    </div>
</section>
@endsection
@push('scripts')
{{-- <script>
   window.detailPeserta = @json($detailPeserta);

    function showDetail(i) {
        let data = window.detailPeserta.ujian[i]; // ambil data berdasarkan index i

        if (data) {
            document.getElementById("namaPeserta").value = window.detailPeserta.nama;
            document.getElementById("noPeserta").value = data.no_peserta;
            document.getElementById("jenisUjian").value = data.nama_ujian;
            document.getElementById("waktuMulai").value = data.waktu_mulai;
            document.getElementById("waktuSelesai").value = data.waktu_selesai;
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


