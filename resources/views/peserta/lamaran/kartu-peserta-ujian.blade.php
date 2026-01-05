<div class="modal fade" id="detailPesertaUjian{{ $i }}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content rounded-4 shadow-lg" style="padding-inline: 20px;">
      <div class="modal-header">
        <h3 class="modal-title">Kartu Peserta Ujian</h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        {{-- MENAMPILKAN JADWAL WAWANCARA DARING --}}
        @php
            $customId =
              $data_peserta->id . '-' .
              $detailPeserta['ujian'][$i]['no_peserta'] . '-' .
              $detailPeserta['ujian'][$i]['jenis_ujian_id'];

            $format_nama = Str::upper(Str::replace(' ', '_', $detailPeserta['nama']));

            $hasCAT = false;
            $hasWawancaraDaring = false;
            $hasWawancaraOffline = false;

            if (isset($ujian['metode_ujians'])) {
                $hasWawancaraOffline = collect($ujian['metode_ujians'])->contains('id', 1);
            } elseif (isset($ujian->metodeUjians)) {
                $hasWawancaraOffline = $ujian->metodeUjians->contains('id', 1);
            }

            if (isset($ujian['metode_ujians'])) {
                $hasWawancaraDaring = collect($ujian['metode_ujians'])->contains('id', 2);
            } elseif (isset($ujian->metodeUjians)) {
                $hasWawancaraDaring = $ujian->metodeUjians->contains('id', 2);
            }

            if (isset($ujian['metode_ujians'])) {
                $hasWawancaraOffline = collect($ujian['metode_ujians'])->contains('id', 3);
            } elseif (isset($ujian->metodeUjians)) {
                $hasWawancaraOffline = $ujian->metodeUjians->contains('id', 3);
            }

        @endphp
        <!-- @php
            $customId = $data_peserta->id . '-' . $detailPeserta['ujian'][$i]['no_peserta'] . '-' . $detailPeserta['ujian'][$i]['jenis_ujian_id'];
        @endphp -->

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
              <td class="text-wrap">{{ str_replace('-', '', $ujian['no_peserta'] ?? '') }}</td>
            </tr>
            @if($hasCAT)
            <tr>
              <th>PIN Ujian</th>
              <td class="text-wrap">
                {{ !empty($data_peserta->tanggal_lahir) ? \Carbon\Carbon::parse($data_peserta->tanggal_lahir)->format('Ym') : '-' }}
              </td>
            </tr>
            @endif
            <tr>
              <th>Jenis Ujian</th>
              <td class="text-wrap">{{ $ujian['nama_ujian'] ?? '-' }}</td>
            </tr>
            <tr>
              <th>Sesi Ujian</th>
              <td class="text-wrap">Sesi {{ $ujian['sesi'] ?? '-' }}</td>
            </tr>
            <tr>
              <th>Waktu Mulai</th>
              <td class="text-wrap">{{ \Carbon\Carbon::parse($ujian['mulai'])->format('d M Y') }}, Pukul {{\Carbon\Carbon::parse($ujian['mulai'])->format('H:i') }} WIB</td>
            </tr>
            <tr>
              <th>Waktu Selesai</th>
              <td class="text-wrap">{{ \Carbon\Carbon::parse($ujian['selesai'])->format('d M Y') }}, Pukul {{\Carbon\Carbon::parse($ujian['selesai'])->format('H:i') }} WIB</td>
            </tr>
            @if($hasCAT)
            <tr>
              <th>Link Ujian</th>
              <td>
                  <a href="https://103.121.159.166/main/peserta_psikologi" target="_blank" class="btn btn-sm btn-success">
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
            @endif

            @if($hasWawancaraOffline)
            <tr>
              <th>Lokasi Ujian</th>
              <td class="text-wrap">
                Gedung Graha Sriwijaya - Universitas Sriwijaya Palembang
              </td>
            </tr>
            <!-- <tr>
              <th></th>
              <td>
                <a href="{{ route('peserta.download-kartu-peserta', $customId) }}" 
                  class="btn btn-primary" 
                  target="_blank"
                  download="KARTU_PESERTA_{{ $format_nama }}.pdf"
                  >
                  <i class="fa fa-download"></i> Download Kartu Peserta
                </a>
              </td>
            </tr> -->
            <ul class="text-danger"><strong>Panduan Ujian:</strong>
              <li class="text-black">
                <p class="mb-0">Wajib datang 60 menit sebelum waktu ujian dimulai.</p>
              </li>
              <li class="text-black">
                <p class="mb-0">Wajib menggunakan pakaian Formal.</p>
              </li>
              <li class="text-black">
                <p class="mb-0">Wajib membawa Berkas Asli (KTP, Ijazah, Transkrip, Surat Pengalaman Kerja).</p>
              </li>
            </ul>
            @endif

          </table>

        
        {{-- <a href="{{ route('peserta.download-kartu-peserta', $customId) }}" 
          class="btn btn-primary" 
          target="_blank"
          download="KARTU_PESERTA_{{ $format_nama }}.pdf"
          >
          <i class="fa fa-download"></i> Download Kartu Peserta
        </a> --}}

      @if($hasWawancaraDaring)
        <div class="alert mt-20 p-0">
            <h5 class="text-primary">
                <i class="fa fa-video-camera"></i> Jadwal Wawancara Daring
            </h5>
            <ul class="text-danger"><strong>Panduan Join Zoom Meeting:</strong>
              <li class="text-black">
                <p class="mb-0">Username zoom peserta gunakan format : <strong>Formasi_Nama Peserta_Nomor Peserta<strong></p>
              </li>
            </ul>

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
                                <button class="btn btn-sm btn-danger text-wrap">
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
