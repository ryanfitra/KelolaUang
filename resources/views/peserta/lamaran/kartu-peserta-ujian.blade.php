<div class="modal fade" id="detailPesertaUjian{{ $i }}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content rounded-4 shadow-lg" style="padding-inline: 20px;">
      <div class="modal-header">
        <h3 class="modal-title">Detail Peserta Ujian</h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="text-center mb-3">
          <img 
            src="{{isset ($detailPeserta['foto']) ? $detailPeserta['foto'] : asset('images/default.jpg') }}" 
            alt="Foto Peserta" 
            title="Foto Peserta"
            width="225" height="300" {{-- ukuran 3x4 cm (perbandingan 3:4) --}}
            class="border rounded"
            style="object-fit: cover;">
        </div>

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
            <th>Jenis Ujian</th>
            <td>{{ $ujian['nama_ujian'] ?? '-' }}</td>
          </tr>
          <tr>
            <th>Waktu Mulai</th>
            <td>{{ $ujian['waktu_mulai'] ?? '-' }}</td>
          </tr>
          <tr>
            <th>Waktu Selesai</th>
            <td>{{ $ujian['waktu_selesai'] ?? '-' }}</td>
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
