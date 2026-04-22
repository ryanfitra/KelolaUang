@extends('layouts.peserta')
@section('title')
PROFIL PERUSAHAAN
@endsection
@section('content')
@include('swal')
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="me-auto">
            <h3 class="page-title">PROFIL PERUSAHAAN</h3>
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="mdi mdi-home-outline"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Profil Perusahaan</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="row">
        <div class="col-12">
          <div class="box">
            <div class="box-header with-border text-center">
                {{-- <h4 class="box-title">PT TELP</h4> --}}
                <div class="text-center mb-4">
                    <img src="{{ asset('images/company/pt-telp/1.jpg') }}" alt="Logo PT TELP" style="max-width: 1000px;">
                </div>
            </div>
            <div class="box-body">
                <div class="text-center mb-4">
                    <img src="{{ asset('images/company/pt-telp/2.jpg') }}" style="max-height: 500px;">
                </div>
              <dl class="row">
                <dt class="col-sm-4">Nama Perusahaan</dt>
                <dd class="col-sm-8">PT Tanjungenim Lestari Pulp and Paper ( TELPP)</dd>

                <dt class="col-sm-4">Alamat Kantor Pusat</dt>
                <dd class="col-sm-8">Menara Astra 22nd floor – Zona D, Jalan Jenderal Sudirman Kav. 5-6 Kel. Karet Tengsin, Kec. Tanah Abang</dd>

                <dt class="col-sm-4">Telepon</dt>
                <dd class="col-sm-8"> (+62) 713-324-150</dd>

                <dt class="col-sm-4">Email Resmi</dt>
                <dd class="col-sm-8">marketing@telpp.com</dd>

                <dt class="col-sm-4">Website</dt>
                <dd class="col-sm-8"><a href="https://www.telpp.com/" target="_blank">www.telpp.com</a></dd>

                <dt class="col-sm-4">Tentang Perusahaan</dt>
                <dd class="col-sm-8 text-justify">
                  PT Tanjungenim Lestari Pulp and Paper ( TeL) is world class manufacturer of high product quality and environmental friendly market pulp mill. This was established on June 18, 1990, commenced construction in mid-1997 and the commercial operation started on May, 2000 . The mill is located in 1,250 ha area in the Banuayu village, District Empat Petulai Dangku, Muara Enim Regency, South Sumatra province, Indonesia.

TeL is a Foreign Investment Company (PMA)- Marubeni Corporation , Japan , as the National Vital Objects Industrial sector (OVNI) declared by the Minister of Industry in 2014 . The mill has market pulp production capacity of 490,000 Adt / year. Presently mill has 1600 employees and support workforce together where ~ 80% of them are residents of South Sumatra
                </dd>
              </dl>
            </div>
          </div>
        </div>
      </div>
    </section>

  </div>
</div>
@endsection

@section('script')
{{-- Jika di kemudian hari perlu script khusus --}}
@endsection
