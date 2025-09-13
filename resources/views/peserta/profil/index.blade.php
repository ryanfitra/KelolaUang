@extends('layouts.peserta')
@section('title')
Lamaran Peserta
@endsection

@section('content')
<section class="content">
    
    <div class="row align-items-end">
        <div class="col-xl-12 col-12">
            <div class="box bg-primary-light">
                <div class="box-body d-flex px-0">
                    <div class="flex-grow-1 p-30 bg-img dask-bg bg-none-md" 
                        style="background-position: right bottom; background-size: auto 100%; background-image: url(../images/svg-icon/color-svg/custom-1.svg)">
                        <div class="row">
                            <div class="col-12 col-xl-7">
                                <h2>Welcome back, <strong>{{ auth()->user()->nama }}!</strong></h2>
                                <p class="text-dark my-10 fs-16">
                                    Profil Perusahaan <strong class="text-warning">very good!</strong>
                                </p>
                            </div>
                            <div class="col-12 col-xl-5"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- LIST LAMARAN --}}
    
</section>
@endsection
