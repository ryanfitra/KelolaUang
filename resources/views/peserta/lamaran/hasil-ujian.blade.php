<div class="modal fade" id="hasilUjian" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content rounded-4 shadow-lg" style="padding-inline: 20px;">
      <div class="modal-header">
        <h3 class="modal-title">
          {{ $ujian['jenis_ujian'] ?? '-' }}
        </h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <div class="row mb-3">
          <div class="col-md-6">
            <h3 class="fw-bold mt-0">{{ $detailPeserta['nama'] ?? '-' }}</h3>
            <p>Nomor Peserta: <span class="text-primary">{{ $ujian['no_peserta'] ?? '-' }}</span></p>
          </div>
          <div class="col-md-6 text-md-end">
            <p>{{ $detailPeserta['instansi']['nama_instansi'] ?? 'Tidak diisi' }}</p>
            <p>{{ $detailPeserta['posisi'] ?? 'Tidak diisi' }}</p>
          </div>
        </div>
        <hr>

        @if($data_peserta->pesertaUjian[$i]->status_ujian == 'Lulus')
          <div class="alert text-center text-primary">
            <strong>SELAMAT!</strong><br>
            Anda dinyatakan <span class="text-success"><strong>LOLOS</strong></span> dan dapat melanjutkan ke ujian berikutnya
          </div>
        @else
          <div class="alert  text-center">
            <strong class="text-warning">Mohon Maaf</strong><br>
            Anda dinyatakan <span class="text-danger"><strong>TIDAK LOLOS</strong></span> dan tidak dapat melanjutkan ke ujian berikutnya
          </div>
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

        <p class="text-center">
          {{-- Anda menempati nomor urut <strong>{{ $peringkat }}</strong> dari <strong>{{ $totalPeserta }}</strong> peserta. --}}
          {{-- Anda menempati nomor urut <strong>12</strong>  --}}
        </p>
        <p class="text-center">
          Dengan ini Anda dapat melanjutkan ke tahap berikutnya: <br>
          <strong>
            {{ isset($data_peserta->pesertaUjian[$i+1]) ? $data_peserta->pesertaUjian[$i+1]->jenisUjian->nama_ujian : '-' }}
          </strong>
        </p>
      </div>
    </div>
  </div>
</div>
