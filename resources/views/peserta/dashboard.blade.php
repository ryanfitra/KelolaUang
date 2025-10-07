@extends('layouts.peserta')

@section('title', 'Dashboard Peserta CBT Universitas Sriwijaya')

@section('content')
<section class="content">

  {{-- Greeting Section --}}
  <div class="row align-items-end">
      <div class="col-12">
          <div class="card bg-primary text-white shadow-sm mb-4">
              <div class="card-body">
                  <h3>Selamat Datang, <strong>{{ auth()->user()->nama }}</strong> 🎉</h3>
                  {{-- <p class="mb-0">Selamat mengikuti <strong>Computer Based Test Universitas Sriwijaya</strong>.</p> --}}
              </div>
          </div>
      </div>
  </div>

  {{-- Quick Stats --}}
  <div class="row">
    <div class="col-md-4">
        <div class="card shadow-sm border-left-primary">
            <div class="card-body text-center">
                <h5 class="text-muted">Tahapan Seleksi</h5>
                <h2 class="fw-bold">
                    {{ $jenisUjian->count() }}
                </h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow-sm border-left-success">
            <div class="card-body text-center">
            <h5 class="text-muted">Tahapan Selesai</h5>
            <h2>
                <a href="{{ route('peserta.lamaran') }}" 
                class="fw-bold text-success" 
                style="text-decoration: none;">
                {{-- 1 --}}
                {{ collect($detailPeserta['ujian'])->whereNotIn('status_ujian',['Belum Ujian', 'Sedang Ujian', NULL])->count() }}
                </a>
            </h2>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm border-left-warning">
            <div class="card-body text-center">
                <h5 class="text-muted">Tahapan Aktif</h5>
                <h2 class="fw-bold text-warning">
                {{ collect($detailPeserta['ujian'])->where('status_ujian','Sedang Ujian')->count() }}
                </h2>
            </div>
        </div>
    </div>
  </div>

  {{-- Upcoming Exam --}}
  {{-- <div class="row mt-4">
      <div class="col-12">
          <div class="card shadow-sm">
              <div class="card-header bg-light">
                  <h5 class="mb-0">Jadwal Ujian Berikutnya</h5>
              </div>
              <div class="card-body">
                  @php
                    $nextExam = collect($detailPeserta['ujian'])->first();
                  @endphp
                  @if($nextExam)
                      <p><strong>{{ $nextExam['nama_ujian'] }}</strong></p>
                      <p>Tanggal: {{ $nextExam['waktu_mulai'] }} s/d {{ $nextExam['waktu_selesai'] }}</p>
                      <p>No Peserta: <span class="fw-bold">{{ $nextExam['no_peserta'] }}</span></p>
                      <a href="#" class="btn btn-primary btn-sm">
                          <i class="fa fa-eye"></i> Detail Ujian
                      </a>
                  @else
                      <p class="text-muted">Belum ada jadwal ujian.</p>
                  @endif
              </div>
          </div>
      </div>
  </div> --}}

  {{-- Timeline Seleksi --}}
    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-light">
                    <h4 class="card-title">Jadwal Seleksi</h4>
                </div>
                <div class="card-body">
                    @if($timelines->isEmpty())
                        <div class="timeline__post">
                            <div class="timeline__content">
                                <h4>Belum ada Jadwal yang tersedia</h4>
                                {{-- <p>{{ $timeline->deskripsi }}</p> --}}
                            </div>
                        </div>
                    @else
                        <div class="timeline5">
                            <div class="timeline__group">
                                <span class="timeline__year">2025</span>
                                
                                @foreach($timelines as $timeline)
                                    @php
                                        $tanggalMulai = $timeline->tanggal_mulai ? \Carbon\Carbon::parse($timeline->tanggal_mulai) : null;
                                        $tanggalSelesai = $timeline->tanggal_selesai ? \Carbon\Carbon::parse($timeline->tanggal_selesai) : null;
                                    @endphp

                                    <div class="timeline__box" 
                                        style="{{ !$tanggalSelesai && $tanggalMulai ? 'margin-left: 30px; padding-left:120px' : '' }}">
                                        
                                            @if(!$tanggalMulai)
                                            <div class="timeline__date text-center" style="margin-left: 15px">
                                                <span class="timeline__month text-center" ><strong>Diinfokan<br>Kemudian</strong></span>
                                            </div>
                                            @elseif($tanggalMulai && !$tanggalSelesai)
                                            <div class="timeline__date text-center">
                                                <span class="timeline__day">{{ $tanggalMulai->format('d') }}</span>
                                                <span class="timeline__month">{{ $tanggalMulai->format('M') }}</span>
                                            </div>
                                            @else
                                            <div class="timeline__date text-center">
                                                <span class="timeline__day">
                                                    {{ $tanggalMulai->format('d') }} - {{ $tanggalSelesai->format('d') }}
                                                </span>
                                                <span class="timeline__month">{{ $tanggalMulai->format('M') }}</span>
                                            </div>
                                            @endif

                                        <div class="timeline__post">
                                            <div class="timeline__content">
                                                <h6>{{ $timeline->nama_kegiatan }}</h6>
                                                <p>{{ $timeline->deskripsi }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach


                            </div>
                        </div>
                    @endif
                </div>                
            </div>
        </div>
    </div>

  

  {{-- Announcements --}}
  <div class="row mt-4">
      <div class="col-12">
          <div class="card shadow-sm">
              <div class="card-header bg-light">
                  <h5 class="mb-0">Pengumuman</h5>
              </div>
              <div class="card-body">
                  <ul class="list-unstyled mb-0">
                      <li>📢 Pengumuman hasil ujian akan disampaikan melalui dashboard ini.</li>
                      <li>⚠️ Pastikan Anda login tepat waktu sesuai jadwal ujian.</li>
                      <li>💡 Gunakan browser terbaru untuk menghindari masalah teknis.</li>
                  </ul>
              </div>
          </div>
      </div>
  </div>

</section>
@endsection
