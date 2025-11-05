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
                  <a href="https://103.121.159.166/main/peserta" target="_blank" class="btn btn-sm btn-success">
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
