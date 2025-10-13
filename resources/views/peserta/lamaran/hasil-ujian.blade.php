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

        {{-- @if($today < $selesai)
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
              <td>{{ $ujian['mulai'] ?? '-' }} WIB</td>
            </tr>
            <tr>
              <th>Waktu Selesai</th>
              <td>{{ $ujian['selesai'] ?? '-' }} WIB</td>
            </tr>
            <tr>
              <th>Link Ujian</th>
              <td>
                  <a href="https://cbt.unsri.ac.id/main/peserta" target="_blank" class="btn btn-sm btn-success">
                    <i class="fa fa-link"></i> Buka Ujian
                  </a>
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

          </table> --}}

        {{-- @elseif($pengumuman && $today < $pengumuman)  --}}
        
        @if($pengumuman && $today < $pengumuman)
          <div class="alert text-center">
            Hasil ujian akan diumumkan pada :
            <p class="text-center">
              <strong>
                <span class="text-primary mt-10">
                  <strong style="font-size: 20px;">
                    {{ \Carbon\Carbon::parse($pengumuman)->translatedFormat('d F Y') }} <br>
                    Pukul {{ \Carbon\Carbon::parse($pengumuman)->format('H:i') }}
                  </strong>
                </span>
              </strong>
            </p>
          </div>


          {{-- Countdown Timer --}}
          {{-- <div class="text-center mt-3">
            <label>Sisa Waktu</label><br>
              <table class="table d-inline-block text-center" style="width:auto;">
                  <thead class="table-primary">
                      <tr>
                          <th>Hari</th>
                          <th>Jam</th>
                          <th>Menit</th>
                          <th>Detik</th>
                      </tr>
                  </thead>
                  <tbody>
                      <tr>
                          <td id="days">0</td>
                          <td id="hours">0</td>
                          <td id="minutes">0</td>
                          <td id="seconds">0</td>
                      </tr>
                  </tbody>
              </table>
          </div> --}}
          
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
        @elseif($data_peserta->pesertaUjian[$i]->status_ujian == 'Tidak Lulus')
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
        @else
          <div class="alert text-center">
            <h3 class="text-info fw-bold">Hasil Ujian Sedang Diproses!</h3><br>
            Mohon menunggu informasi selanjutnya.
            <p>Informasi akan diupdate pada halaman lamaran</p>
          </div>
          <p class="text-danger text-center fw-bold">Silahkan periksa halaman lamaran secara berkala!</p>
          
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
