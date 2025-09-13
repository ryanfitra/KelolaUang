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
                  <p class="mb-0">Selamat mengikuti <strong>Computer Based Test Universitas Sriwijaya</strong>.</p>
              </div>
          </div>
      </div>
  </div>

  {{-- Quick Stats --}}
  <div class="row">
      <div class="col-md-4">
          <div class="card shadow-sm border-left-primary">
              <div class="card-body text-center">
                  <h5 class="text-muted">Total Ujian</h5>
                  <h2 class="fw-bold">{{ count($jadwal_ujian ?? []) }}</h2>
              </div>
          </div>
      </div>
      <div class="col-md-4">
          <div class="card shadow-sm border-left-success">
              <div class="card-body text-center">
                  <h5 class="text-muted">Ujian Selesai</h5>
                  <h2 class="fw-bold text-success">
                    {{ collect($detailPeserta['ujian'])->where('status_ujian','!=',null)->count() }}
                  </h2>
              </div>
          </div>
      </div>
      <div class="col-md-4">
          <div class="card shadow-sm border-left-warning">
              <div class="card-body text-center">
                  <h5 class="text-muted">Ujian Aktif</h5>
                  <h2 class="fw-bold text-warning">
                    {{ collect($detailPeserta['ujian'])->where('status_ujian',null)->count() }}
                  </h2>
              </div>
          </div>
      </div>
  </div>

  {{-- Upcoming Exam --}}
  <div class="row mt-4">
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
  </div>

  {{-- Upcoming Exam --}}
  <div class="row mt-4">
      <div class="col-12">
          <div class="card shadow-sm">
              {{-- <div class="box"> --}}
                <div class="card-header bg-light">
                    <h4 class="card-title">Jadwal Seleksi</h4>
                </div>
                <div class="card-body">
                    <div class="timeline5">
                        <div class="timeline__group">
                            <span class="timeline__year">2025</span>
                            <div class="timeline__box">
                                <div class="timeline__date">
                                    <span class="timeline__day">2 - 5</span>
                                    <span class="timeline__month">Feb</span>
                                </div>
                                <div class="timeline__post">
                                    <div class="timeline__content">
                                    <p>Attends the Philadelphia Museum School of Industrial Art. Studies design with Alexey Brodovitch, art director at Harper's Bazaar, and works as his assistant.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                
            {{-- </div> --}}
          </div>
      </div>
  </div>


  {{-- Timeline Seleksi --}}
    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-light">
                    <h4 class="card-title">Jadwal Seleksi</h4>
                </div>
                <div class="card-body">
                    <div class="timeline5">
                        <div class="timeline__group">
                            <span class="timeline__year">2025</span>
                            
                            @foreach($timelines as $timeline)
                            <div class="timeline__box">
                                <div class="timeline__date">
                                    <span class="timeline__day">
                                        {{ \Carbon\Carbon::parse($timeline->start_date)->format('d') }}
                                        @if($timeline->end_date)
                                            - {{ \Carbon\Carbon::parse($timeline->end_date)->format('d') }}
                                        @endif
                                    </span>
                                    <span class="timeline__month">
                                        {{ \Carbon\Carbon::parse($timeline->start_date)->format('M') }}
                                    </span>
                                </div>
                                <div class="timeline__post">
                                    <div class="timeline__content">
                                        <h6>{{ $timeline->title }}</h6>
                                        <p>{{ $timeline->description }}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            
                        </div>
                    </div>
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
