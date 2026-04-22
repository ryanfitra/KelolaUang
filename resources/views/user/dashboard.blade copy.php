@extends('layouts.user')

@section('title', 'Dashboard User')

@section('content')
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xl-8 col-12">
            <div class="box bg-primary-light">
                <div class="box-body d-flex px-0">
                    <div class="flex-grow-1 p-30 flex-grow-1 bg-img dask-bg bg-none-md" style="background-position: right bottom; background-size: auto 100%; background-image: url(../images/svg-icon/color-svg/custom-1.svg)">
                        <div class="row">
                            <div class="col-12 col-xl-7">
                                <h2>Welcome back, <strong>John!</strong></h2>

                                <p class="text-dark my-10 fs-16">
                                    Your students complated <strong class="text-warning">80%</strong> of the tasks.
                                </p>
                                <p class="text-dark my-10 fs-16">
                                    Progress is <strong class="text-warning">very good!</strong>
                                </p>
                            </div>
                            <div class="col-12 col-xl-5"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-xl-6">
                    <div class="box">
                        <div class="box-header with-border">
                            <h4 class="box-title">Students Progress </h4>
                            <ul class="box-controls pull-right d-md-flex d-none">
                                <li class="dropdown">
                                <button class="btn btn-primary px-10 " data-bs-toggle="dropdown" href="#">View List</button>
                                </li>
                            </ul>
                        </div>
                        <div class="box-body">
                            <div class="d-flex align-items-center mb-30 gap-items-3 justify-content-between">
                                <div class="d-flex align-items-center fw-500">
                                    <div class="me-15 w-50 d-table">
                                        <img src="../images/avatar/avatar-1.png" class="avatar avatar-lg rounded10 bg-primary-light" alt="">
                                    </div>
                                    <div>
                                        <a href="#" class="text-dark hover-primary mb-5 d-block fs-16">Amelia</a>
                                        <div class="w-200">
                                            <div class="progress progress-sm mb-0">
                                                <div class="progress-bar progress-bar-primary progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <h5 class="fw-600 mb-0 badge badge-pill badge-primary">75%</h5>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-30 gap-items-3 justify-content-between">
                                <div class="d-flex align-items-center fw-500">
                                    <div class="me-15 w-50 d-table">
                                        <img src="../images/avatar/avatar-2.png" class="avatar avatar-lg rounded10 bg-primary-light" alt="">
                                    </div>
                                    <div>
                                        <a href="#" class="text-dark hover-primary mb-5 d-block fs-16">Johen</a>
                                        <div class="w-200">
                                            <div class="progress progress-sm mb-0">
                                                <div class="progress-bar progress-bar-warning progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="64" aria-valuemin="0" aria-valuemax="100" style="width: 64%">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <h5 class="fw-600 mb-0 badge badge-pill badge-warning">64%</h5>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-30 gap-items-3 justify-content-between">
                                <div class="d-flex align-items-center fw-500">
                                    <div class="me-15 w-50 d-table">
                                        <img src="../images/avatar/avatar-1.png" class="avatar avatar-lg rounded10 bg-primary-light" alt="">
                                    </div>
                                    <div>
                                        <a href="#" class="text-dark hover-primary mb-5 d-block fs-16">Micheal</a>
                                        <div class="w-200">
                                            <div class="progress progress-sm mb-0">
                                                <div class="progress-bar progress-bar-info progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="59" aria-valuemin="0" aria-valuemax="100" style="width: 59%">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <h5 class="fw-600 mb-0 badge badge-pill badge-info">59%</h5>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-30 gap-items-3 justify-content-between">
                                <div class="d-flex align-items-center fw-500">
                                    <div class="me-15 w-50 d-table">
                                        <img src="../images/avatar/avatar-1.png" class="avatar avatar-lg rounded10 bg-primary-light" alt="">
                                    </div>
                                    <div>
                                        <a href="#" class="text-dark hover-primary mb-5 d-block fs-16">Amanda</a>
                                        <div class="w-200">
                                            <div class="progress progress-sm mb-0">
                                                <div class="progress-bar progress-bar-danger progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <h5 class="fw-600 mb-0 badge badge-pill badge-danger">45%</h5>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-items-3 justify-content-between">
                                <div class="d-flex align-items-center fw-500">
                                    <div class="me-15 w-50 d-table">
                                        <img src="../images/avatar/avatar-1.png" class="avatar avatar-lg rounded10 bg-primary-light" alt="">
                                    </div>
                                    <div>
                                        <a href="#" class="text-dark hover-primary mb-5 d-block fs-16">Tyler</a>
                                        <div class="w-200">
                                            <div class="progress progress-sm mb-0">
                                                <div class="progress-bar progress-bar-primary progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <h5 class="fw-600 mb-0 badge badge-pill badge-primary">20%</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-6">
                    <div class="box">
                        <div class="box-header with-border">
                            <h4 class="box-title">Working Hours</h4>
                            <ul class="box-controls pull-right d-md-flex d-none">
                                <li class="dropdown">
                                <button class="dropdown-toggle btn btn-warning-light px-10" data-bs-toggle="dropdown" href="#">Today</button>										  
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item active" href="#">Today</a>
                                    <a class="dropdown-item" href="#">Yesterday</a>
                                    <a class="dropdown-item" href="#">Last week</a>
                                    <a class="dropdown-item" href="#">Last month</a>
                                </div>
                                </li>
                            </ul>
                        </div>
                        <div class="box-body">
                            <div id="revenue5" class="min-h-325"></div>
                            <div class="d-flex justify-content-center">
                                <p class="d-flex align-items-center fw-600 mx-20"><span class="badge badge-xl badge-dot badge-warning me-20"></span> Progress</p>
                                <p class="d-flex align-items-center fw-600 mx-20"><span class="badge badge-xl badge-dot badge-primary me-20"></span> Done</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6">
                    <div class="box">
                        <div class="box-body d-flex p-0">
                            <div class="flex-grow-1 bg-danger p-30 flex-grow-1 bg-img" style="background-position: calc(100% + 0.5rem) bottom; background-size: auto 100%; background-image: url(../images/svg-icon/color-svg/custom-3.svg)">

                                <h4 class="fw-400">User Activity</h4>

                                <p class="my-10 fs-16">
                                    Grow marketing &amp; sales<br>through product.
                                </p>

                                <a href="#" class="btn btn-danger-light">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="box">
                        <div class="box-body d-flex p-0">
                        <div class="flex-grow-1 bg-primary p-30 flex-grow-1 bg-img" style="background-position: calc(100% + 0.5rem) bottom; background-size: auto 100%; background-image: url(../images/svg-icon/color-svg/custom-4.svg)">

                            <h4 class="fw-400">Based On</h4>

                            <div class="mt-5">
                                <div class="d-flex mb-10 fs-16">
                                    <span class="icon-Arrow-right mt-5 me-10"><span class="path1"></span><span class="path2"></span></span>
                                    <span class="text-white">Activities</span>
                                </div>

                                <div class="d-flex mb-10 fs-16">
                                    <span class="icon-Arrow-right mt-5 me-10"><span class="path1"></span><span class="path2"></span></span>
                                    <span class="text-white">Sales</span>
                                </div>

                                <div class="d-flex mb-10 fs-16">
                                    <span class="icon-Arrow-right mt-5 me-10"><span class="path1"></span><span class="path2"></span></span>
                                    <span class="text-white">Releases</span>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box bg-transparent no-shadow mb-0">
                <div class="box-header no-border">
                    <h4 class="box-title">Media Files</h4>							
                    <div class="box-controls pull-right d-md-flex d-none">
                        <a href="#">View All</a>
                    </div>
                </div>
            </div>
            <div class="box">
                <div class="box-body py-0">
                    <div class="table-responsive">
                        <table class="table no-border mb-0">
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="bg-danger h-50 w-50 l-h-50 rounded text-center">
                                            <p class="mb-0 fs-20 fw-600">A1</p>
                                        </div>
                                    </td>
                                    <td class="fw-600">Biology Course</td>
                                    <td class="text-fade">StarterReplacement.pdf</td>
                                    <td class="fw-500"><span class="badge badge-sm badge-dot badge-warning me-10"></span>Only view</td>
                                    <td class="text-fade">78 members</td>
                                    <td class="fw-600">47 MB</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="bg-info h-50 w-50 l-h-50 rounded text-center">
                                            <p class="mb-0 fs-20 fw-600">B1</p>
                                        </div>
                                    </td>
                                    <td class="fw-600">Contemporary Art</td>
                                    <td class="text-fade">Loremipsum.doc</td>
                                    <td class="fw-500 text-warning"><span class="badge badge-sm badge-dot badge-warning me-10"></span>Edit available</td>
                                    <td class="text-fade">78 members</td>
                                    <td class="fw-600">78 MB</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="bg-primary h-50 w-50 l-h-50 rounded text-center">
                                            <p class="mb-0 fs-20 fw-600">C1</p>
                                        </div>
                                    </td>
                                    <td class="fw-600">Programming Language</td>
                                    <td class="text-fade">phpcore.mp3</td>
                                    <td class="fw-500"><span class="badge badge-sm badge-dot badge-primary me-10"></span>Only view</td>
                                    <td class="text-fade">48 members</td>
                                    <td class="fw-600">12 MB</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="bg-success h-50 w-50 l-h-50 rounded text-center">
                                            <p class="mb-0 fs-20 fw-600">A2</p>
                                        </div>
                                    </td>
                                    <td class="fw-600">Geometry Course</td>
                                    <td class="text-fade">dummyabz.pdf</td>
                                    <td class="fw-500"><span class="badge badge-sm badge-dot badge-primary me-10"></span>Only view</td>
                                    <td class="text-fade">24 members</td>
                                    <td class="fw-600">18 MB</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>										
        </div>
        <div class="col-xl-4 col-12">
            <div class="box">
                <div class="box-body">							
                    <div class="box no-shadow mb-0">
                        <div class="box-body px-0 pt-0">
                            <div id="calendar" class="dask evt-cal min-h-400"></div>
                        </div>
                    </div>
            
                    <div class="box no-shadow mb-0">
                        <div class="box-header no-border">
                            <h4 class="box-title">Lessons</h4>							
                            <div class="box-controls pull-right d-md-flex d-none">
                                <a href="#">View All</a>
                            </div>
                        </div>
                    </div>
                    <div class="px-5">
                        <div class="box bt-5 border-danger rounded">
                            <div class="box-body">	
                                <div class="flex-grow-1">	
                                    <div class="d-flex align-items-center pe-2 justify-content-between">							
                                        <h4 class="fw-500">
                                            Programming
                                        </h4>
                                        <div class="dropdown">
                                            <a data-bs-toggle="dropdown" href="#" class="px-10 pt-5"><i class="ti-more-alt"></i></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="#"><i class="ti-import"></i> Import</a>
                                                <a class="dropdown-item" href="#"><i class="ti-export"></i> Export</a>
                                                <a class="dropdown-item" href="#"><i class="ti-printer"></i> Print</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="#"><i class="ti-settings"></i> Settings</a>
                                            </div>
                                        </div>						
                                    </div>
                                    <p class="fs-16">
                                        Every Day 10am to 11am
                                    </p>
                                </div>							
                                <div class="d-flex align-items-center justify-content-between mt-10">
                                    <div class="d-flex">
                                        <a href="#" class="me-15 bg-lightest h-50 w-50 l-h-50 rounded-circle text-center overflow-hidden">
                                            <img src="../images/avatar/avatar-1.png" class="h-50 align-self-end" alt="">
                                        </a>
                                        <a href="#" class="me-15 bg-lightest h-50 w-50 l-h-50 rounded-circle text-center overflow-hidden">
                                            <img src="../images/avatar/avatar-3.png" class="h-50 align-self-end" alt="">
                                        </a>
                                        <a href="#" class="me-15 bg-lightest h-50 w-50 l-h-50 rounded-circle text-center overflow-hidden">
                                            <img src="../images/avatar/avatar-4.png" class="h-50 align-self-end" alt="">
                                        </a>
                                    </div>
                                    <button type="button" class="waves-effect waves-circle btn btn-circle btn-dark"><i class="mdi mdi-plus"></i></button>
                                </div>
                            </div>					
                        </div>
                        <div class="box bt-5 border-primary rounded">
                            <div class="box-body">	
                                <div class="flex-grow-1">	
                                    <div class="d-flex align-items-center pe-2 justify-content-between">							
                                        <h4 class="fw-500">
                                            Core Language
                                        </h4>
                                        <div class="dropdown">
                                            <a data-bs-toggle="dropdown" href="#" class="px-10 pt-5"><i class="ti-more-alt"></i></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="#"><i class="ti-import"></i> Import</a>
                                                <a class="dropdown-item" href="#"><i class="ti-export"></i> Export</a>
                                                <a class="dropdown-item" href="#"><i class="ti-printer"></i> Print</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="#"><i class="ti-settings"></i> Settings</a>
                                            </div>
                                        </div>						
                                    </div>
                                    <p class="fs-16">
                                        Every Day 12pm to 01pm
                                    </p>
                                </div>							
                                <div class="d-flex align-items-center justify-content-between mt-10">
                                    <div class="d-flex">
                                        <a href="#" class="me-15 bg-lightest h-50 w-50 l-h-50 rounded-circle text-center overflow-hidden">
                                            <img src="../images/avatar/avatar-2.png" class="h-50 align-self-end" alt="">
                                        </a>
                                        <a href="#" class="me-15 bg-lightest h-50 w-50 l-h-50 rounded-circle text-center overflow-hidden">
                                            <img src="../images/avatar/avatar-5.png" class="h-50 align-self-end" alt="">
                                        </a>
                                        <a href="#" class="me-15 bg-lightest h-50 w-50 l-h-50 rounded-circle text-center overflow-hidden">
                                            <img src="../images/avatar/avatar-6.png" class="h-50 align-self-end" alt="">
                                        </a>
                                    </div>
                                    <button type="button" class="waves-effect waves-circle btn btn-circle btn-dark"><i class="mdi mdi-plus"></i></button>
                                </div>
                            </div>					
                        </div>
                    </div>
            
                    <div class="box no-shadow mb-0">
                        <div class="box-header no-border">
                            <h4 class="box-title">Lessons</h4>							
                            <div class="box-controls pull-right d-md-flex d-none">
                                <a href="#">View All</a>
                            </div>
                        </div>
                    </div>
                    <div class="px-5">
                        <div class="box mb-15">
                            <div class="box-body">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <div class="me-15 bg-warning h-50 w-50 l-h-60 rounded text-center">
                                            <span class="icon-Book-open fs-24"><span class="path1"></span><span class="path2"></span></span>
                                        </div>
                                        <div class="d-flex flex-column fw-500">
                                            <a href="#" class="text-dark hover-primary mb-1 fs-16">Informatic Course</a>
                                            <span class="text-fade">Johen Doe, 19 April</span>
                                        </div>
                                    </div>
                                    <a href="#">
                                        <span class="icon-Arrow-right fs-24"><span class="path1"></span><span class="path2"></span></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="box mb-15">
                            <div class="box-body">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <div class="me-15 bg-primary h-50 w-50 l-h-60 rounded text-center">
                                            <span class="icon-Mail fs-24"></span>
                                        </div>
                                        <div class="d-flex flex-column fw-500">
                                            <a href="#" class="text-dark hover-primary mb-1 fs-16">Live Drawing</a>
                                            <span class="text-fade">Micak Doe, 12 June</span>
                                        </div>
                                    </div>
                                    <a href="#">
                                        <span class="icon-Arrow-right fs-24"><span class="path1"></span><span class="path2"></span></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="box mb-0">
                            <div class="box-body">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <div class="me-15 bg-danger h-50 w-50 l-h-60 rounded text-center">
                                            <span class="icon-Book-open fs-24"><span class="path1"></span><span class="path2"></span></span>
                                        </div>
                                        <div class="d-flex flex-column fw-500">
                                            <a href="#" class="text-dark hover-primary mb-1 fs-16">Contemporary Art</a>
                                            <span class="text-fade">Potar doe, 27 July</span>
                                        </div>
                                    </div>
                                    <a href="#">
                                        <span class="icon-Arrow-right fs-24"><span class="path1"></span><span class="path2"></span></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        
    </div>
</section>
<!-- /.content -->
<section class="content container-fluid py-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Dashboard</h4>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTransaction">
            + Tambah Data
        </button>
    </div>

    {{-- 🔹 SUMMARY CARD --}}
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card bg-success text-white p-3">
                <h5>Total Pemasukan</h5>
                
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-danger text-white p-3">
                <h5>Total Pengeluaran</h5>
                <h3>Rp {{ number_format($totalExpense, 0, ',', '.') }}</h3>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-primary text-white p-3">
                <h5>Saldo</h5>
                <h3>Rp {{ number_format($balance, 0, ',', '.') }}</h3>
            </div>
        </div>
    </div>

    {{-- 🔹 CHART --}}
    <div class="row">
        <div class="card p-3">
            <h5>Grafik Pemasukan & Pengeluaran</h5>
            <div style="height:300px;">
                <canvas id="incomeExpenseChart"></canvas>
            </div>
        </div>

        <div class="card p-3">
            <h5>Pengeluaran per Kategori</h5>
            <div style="height:300px;">
                <canvas id="categoryChart"></canvas>
            </div>
        </div>
    </div>


    <div class="box">
                <div class="box-body py-0">
                    <div class="table-responsive">
                        <table id="data" class="table no-border mb-0">
                            <tbody>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Jenis</th>
                                    <th>Kategori</th>
                                    <th>Nominal</th>
                                    <th>Deskripsi</th>
                                </tr>
                                @foreach($transactions as $index => $transaction)
                                <tr class="hover:bg-gray-100 cursor-pointer" onclick='editTransaction(@json($transaction))'>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ date('d M Y', strtotime($transaction->transaction_date)) }}</td>
                                    <td>{{ $transaction->type?->name }}</td>
                                    <td>{{ $transaction->category?->name }}</td>
                                    <td>Rp {{ number_format($transaction->amount, 0, ',', '.') }}</td>
                                    <td>{{ $transaction->description }}</td>
                                </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>			
</section>
@include('user.create')

@endsection

@push('js')
<script src="{{asset('assets/vendor_components/datatable/datatables.min.js')}}"></script>
<script src="{{asset('assets/vendor_components/select2/dist/js/select2.min.js')}}"></script>
<script src="{{asset('assets/vendor_components/sweetalert/sweetalert.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // ===============================
    // DATA
    // ===============================
    const monthlyData = @json($monthly);
    const categoryData = @json($categories);
    const categoriesAll = @json($categoriesAll);

    // ===============================
    // CHART
    // ===============================
    new Chart(document.getElementById('incomeExpenseChart'), {
        type: 'bar',
        data: {
            labels: monthlyData.map(i => 'Bulan ' + i.month),
            datasets: [
                { label: 'Pemasukan', data: monthlyData.map(i => i.income), backgroundColor: 'green' },
                { label: 'Pengeluaran', data: monthlyData.map(i => i.expense), backgroundColor: 'red' }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });

    new Chart(document.getElementById('categoryChart'), {
        type: 'pie',
        data: {
            labels: categoryData.map(i => i.name),
            datasets: [{
                data: categoryData.map(i => i.total)
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });

    // ===============================
    // DYNAMIC CATEGORY
    // ===============================
    const typeSelect = document.getElementById('type_id');
    const categorySelect = document.getElementById('category_id');

    if (typeSelect) {
        typeSelect.addEventListener('change', function () {
            filterCategory(this.value);
        });
    }

    function filterCategory(typeId = null) {
        typeId = typeId || typeSelect.value;

        categorySelect.innerHTML = '<option value="">-- Pilih Kategori --</option>';

        const filtered = categoriesAll.filter(c => c.type_id == parseInt(typeId));

        filtered.forEach(c => {
            let opt = document.createElement('option');
            opt.value = c.id;
            opt.text = c.name;
            categorySelect.appendChild(opt);
        });
    }

    // ===============================
    // FORMAT RUPIAH
    // ===============================
    document.addEventListener('DOMContentLoaded', function () {

        const amountInput = document.getElementById('amount');

        function formatRupiah(angka) {
            return 'Rp ' + angka.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }

        function cleanRupiah(value) {
            return value.replace(/[^0-9]/g, '');
        }

        if (amountInput) {
            amountInput.addEventListener('keyup', function () {
                let angka = cleanRupiah(this.value);
                this.value = angka ? formatRupiah(angka) : '';
            });
        }

        const form = document.getElementById('transactionForm');
        if (form) {
            form.addEventListener('submit', function () {
                amountInput.value = cleanRupiah(amountInput.value);
            });
        }

    });

    // ===============================
    // SUBMIT (BERSIHKAN FORMAT)
    // ===============================
    const form = document.getElementById('transactionForm');

    if (form) {
        form.addEventListener('submit', function () {
            if (amountInput) {
                amountInput.value = cleanRupiah(amountInput.value);
            }
        });
    }

    // ===============================
    // EDIT DATA
    // ===============================
    function editTransaction(data) {
        document.getElementById('modalTitle').innerText = 'Edit Catatan';

        document.getElementById('transaction_id').value = data.id;
        document.getElementById('transaction_date').value = data.transaction_date;
        document.getElementById('type_id').value = data.type_id;

        filterCategory(data.type_id);

        setTimeout(() => {
            document.getElementById('category_id').value = data.category_id;
        }, 100);

        // 🔥 format rupiah saat edit
        document.getElementById('amount').value = formatRupiah(data.amount.toString());

        document.getElementById('description').value = data.description;

        document.getElementById('form_method').value = 'PUT';
        document.getElementById('transactionForm').action = '/user/transactions/' + data.id;

        new bootstrap.Modal(document.getElementById('modalTransaction')).show();
    }

    // ===============================
    // RESET MODAL
    // ===============================
    const btnOpenModal = document.querySelector('[data-bs-target="#modalTransaction"]');

    if (btnOpenModal) {
        btnOpenModal.addEventListener('click', () => {
            document.getElementById('modalTitle').innerText = 'Tambah Catatan';
            document.getElementById('transactionForm').reset();

            if (amountInput) amountInput.value = '';

            document.getElementById('form_method').value = 'POST';
            document.getElementById('transactionForm').action = "{{ route('user.transactions.store') }}";
        });
    }
</script>
@endpush