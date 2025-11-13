<div class="modal fade" id="detailPesertaUjian{{ $i }}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content rounded-4 shadow-lg" style="padding-inline: 20px;">
      <div class="modal-header">
        <h3 class="modal-title">Kartu Peserta Ujian</h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <!-- @if($detailPeserta['foto'] != NULL )
          <div class="text-center mb-3">
              
            <img 
              {{-- src="{{ $detailPeserta['foto'] }}"  --}}
              src="{{ $detailPeserta['foto']
                    ? $detailPeserta['foto'] 
                    : asset('images/foto_peserta/default.png') }}"

              alt="Foto Peserta" 
              title="Foto Peserta"
              width="225" height="300"
              class="border rounded"
              style="object-fit: cover;">
          </div>
        @endif -->

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
                {{-- @if(!empty($ujian['link'])) --}}
                  <a href="https://103.121.159.166/main/peserta_psikologi" target="_blank" class="btn btn-sm btn-success">
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

        @php
            $customId = $data_peserta->id . '-' . $detailPeserta['ujian'][$i]['no_peserta'] . '-' . $detailPeserta['ujian'][$i]['jenis_ujian_id'];
        @endphp

        {{-- <a href="{{ route('peserta.download-kartu-peserta', $customId) }}" 
          class="btn btn-primary" 
          target="_blank"
          download="KARTU_PESERTA_{{ $format_nama }}.pdf"
          >
          <i class="fa fa-download"></i> Download Kartu Peserta
        </a> --}}


      {{-- MENAMPILKAN JADWAL WAWANCARA DARING --}}
      @php
          $hasWawancaraDaring = false;

          if (isset($ujian['metode_ujians'])) {
              $hasWawancaraDaring = collect($ujian['metode_ujians'])->contains('id', 2);
          } elseif (isset($ujian->metodeUjians)) {
              $hasWawancaraDaring = $ujian->metodeUjians->contains('id', 2);
          }
      @endphp

      @if($hasWawancaraDaring)
        <div class="alert mt-20 p-0">
            <h5 class="text-primary">
                <i class="fa fa-video-camera"></i> Jadwal Wawancara Daring
            </h5>

            @if(empty($ujian['wawancara_mulai']) || $ujian['wawancara_mulai'] == '-' || empty($ujian['wawancara_selesai']) || $ujian['wawancara_selesai'] == '-')
                <div class="alert alert-warning mt-2 mb-0">
                    <i class="fa fa-exclamation-circle"></i> Jadwal wawancara belum diisi. Silakan menunggu informasi selanjutnya.
                </div>
            @else
                <table class="table table-bordered mt-2">
                    <tr>
                        <th>Tanggal</th>
                        <td>{{ \Carbon\Carbon::parse($ujian['wawancara_mulai'])->format('d M Y') }}</td>
                    </tr>
                    <tr>
                        <th>Waktu</th>
                        <td>
                            {{ \Carbon\Carbon::parse($ujian['wawancara_mulai'])->format('H:i') }} -
                            {{ \Carbon\Carbon::parse($ujian['wawancara_selesai'])->format('H:i') }} WIB
                        </td>
                    </tr>
                    <tr>
                        <th>Link Wawancara</th>
                        <td>
                            @if($ujian['link_wawancara'] == '-' || empty($ujian['link_wawancara']))
                                <button class="btn btn-sm btn-danger">
                                    <i class="fa fa-clock-o"></i> Link Zoom Meeting akan diupdate 1 jam sebelum wawancara
                                </button>
                            @else
                                <a href="{{ $ujian['link_wawancara'] }}" 
                                  target="_blank" 
                                  class="btn btn-sm btn-primary">
                                    <i class="fa fa-link"></i> Masuk Wawancara
                                </a>
                            @endif
                        </td>
                    </tr>
                </table>
            @endif
        </div>
    @endif

      </div>
    </div>
  </div>
</div>

@push('scripts')
<style>
  @media print {
    .no-print {
      display: none !important;
    }
  }
</style>
<script>
  function printKartuPeserta(i) {
    let modal = document.getElementById("detailPesertaUjian" + i);
    let printContents = modal.querySelector('.modal-body').innerHTML;
    let originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
    location.reload(); // refresh agar tampilan kembali normal
  }
</script>
@endpush
