<div class="modal fade" id="hasilUjian{{ $i }}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content rounded-4 shadow-lg" style="padding-inline: 20px;">
      <div class="modal-header">
        <h3 class="modal-title">
          {{ $ujian['nama_ujian'] ?? '-' }}
        </h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body" style="padding: 14px 14px 48px 14px">
        <div class="row mb-3">
          <div class="col-md-6">
            <h3 class="fw-bold mt-0">{{ $detailPeserta['nama'] ?? '-' }}</h3>
            <p>Nomor Peserta: <span class="text-primary">{{ $ujian['no_peserta'] ?? '-' }}</span></p>
            {{-- {{$ujian['mulai']}}{{$ujian['selesai']}}{{$ujian['pengumuman']}} {{$today}} --}}
          </div>
          <div class="col-md-6 text-md-end">
            <p>{{ $detailPeserta['instansi']['nama_instansi'] ?? 'Tidak diisi' }}</p>
            <p>{{ $detailPeserta['posisi'] ?? 'Tidak diisi' }}</p>
          </div>
        </div>
        <hr>

        @if($today < $pengumuman)
          <table class="table table-bordered">
          <tr>
            <th width="200">Nama</th>
            <td>{{ $detailPeserta['nama'] ?? '-' }}</td>
          </tr>
          <tr>
            <th>No Peserta</th>
            <td>{{ str_replace('-', '', $ujian['no_peserta'] ?? '') }}</td>
          </tr>
          <tr>
            <th>PIN Ujian</th>
            <td>
              {{ !empty($data_peserta->tanggal_lahir) ? \Carbon\Carbon::parse($data_peserta->tanggal_lahir)->format('Ym') : '-' }}
            </td>
          </tr>
          <tr>
            <th>Jenis Ujian</th>
            <td>{{ $ujian['nama_ujian'] ?? '-' }}</td>
          </tr>
          <tr>
            <th>Sesi Ujian</th>
            <td>Sesi {{ $ujian['sesi'] ?? '-' }}</td>
          </tr>
          <tr>
            <th>Waktu Mulai</th>
            <td>{{ $ujian['mulai'] ?? '-' }}</td>
          </tr>
          <tr>
            <th>Waktu Selesai</th>
            <td>{{ $ujian['selesai'] ?? '-' }}</td>
          </tr>
          <tr>
            <th>Link Ujian</th>
            <td>
              {{-- @if(!empty($ujian['link'])) --}}
                <a href="https://cbt.unsri.ac.id/main/peserta" target="_blank" class="btn btn-sm btn-success">
                  <i class="fa fa-link"></i> Buka Ujian
                </a>
              {{-- @else --}}
                {{-- <span class="text-muted">Belum tersedia</span> --}}
              {{-- @endif --}}
            </td>
          </tr>
          <ul class="text-danger"><strong>Panduan Login Ujian:</strong>
            <li class="text-black">
              <p class="mb-0">Gunakan Nomer Peserta untuk login ke laman ujian (tanpa menggunakan tanda "-").</p>
            </li>
            <li class="text-black">
              <p class="mb-0">PIN Ujian menggunakan tahun dan bulan lahir anda (6 digit angka).</a></p>
            </li>
          </ul>

        </table>

          
        @elseif($data_peserta->pesertaUjian[$i]->status_ujian == 'Lulus')
          <div class="alert text-center text-primary">
            <strong>SELAMAT!</strong><br>
            Anda dinyatakan <span class="text-success"><strong>LOLOS</strong></span> {{ isset($data_peserta->pesertaUjian[$i]) ? $data_peserta->pesertaUjian[$i]->jadwalUjian->jenisUjian->nama_ujian.' ('.$data_peserta->pesertaUjian[$i]->jadwalUjian->jenisUjian->deskripsi.')' : '' }}</br>
          </div>

          <p class="text-center">
            {{-- Anda menempati nomor urut <strong>{{ $peringkat }}</strong> dari <strong>{{ $totalPeserta }}</strong> peserta. --}}
            {{-- Anda menempati nomor urut <strong>12</strong>  --}}
          </p>
          <p class="text-center">
            Dengan ini Anda dapat melanjutkan ke tahap berikutnya
            {{-- <strong>
              {{ isset($data_peserta->pesertaUjian[$i+1]) ? $data_peserta->pesertaUjian[$i+1]->jenisUjian->nama_ujian : '-' }}
            </strong> --}}
          </p>
        @else
          <div class="alert  text-center">
            <strong class="text-warning">MOHON MAAF!</strong><br>
            Anda dinyatakan <span class="text-danger"><strong>TIDAK LOLOS</strong></span> {{ isset($data_peserta->pesertaUjian[$i]) ? $data_peserta->pesertaUjian[$i]->jenisUjian->nama_ujian.' ('.$data_peserta->pesertaUjian[$i]->jenisUjian->deskripsi.')' : '' }}</br>
          </div>
          
          <p class="text-center">
            {{-- Anda menempati nomor urut <strong>{{ $peringkat }}</strong> dari <strong>{{ $totalPeserta }}</strong> peserta. --}}
            {{-- Anda menempati nomor urut <strong>12</strong>  --}}
          </p>
          <p class="text-center">
            Anda tidak dapat melanjutkan ke tahap berikutnya
          </p>
        @endif

        {{-- <div class="row text-center">
          <div class="col">
            <h6>Nilai TKD</h6>
            <p>(min: 58)</p>
            <h4>{{ $detailPeserta->nilai_tkd ?? 0 }}</h4>
          </div>
          
          <div class="col border-start">
            <h6>Nilai AKHLAK</h6>
            <p>(min: 65)</p>
            <h4>{{ $detailPeserta->nilai_akhlak ?? 0 }}</h4>
          </div>
          
          <div class="col border-start">
            <h6>Nilai Wawasan Kebangsaan</h6>
            <p>(min: 50)</p>
            <h4>{{ $detailPeserta->nilai_wawasan ?? 0 }}</h4>
          </div>
        </div> --}}


        {{-- <div class="text-center my-3">
          <button class="btn btn-primary">
            Nilai Akhir: {{ number_format($detailPeserta->nilai_akhir,2) }}
            179
          </button>
        </div> --}}

        
      </div>
    </div>
  </div>
</div>
