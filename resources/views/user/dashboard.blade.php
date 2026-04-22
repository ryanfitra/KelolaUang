@extends('layouts.user')

@section('title', 'Dashboard User')

@section('content')
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xl-12 col-12">
            <div class="box bg-primary-light">
                <div class="box-body d-flex px-0">
                    <div class="flex-grow-1 p-30 flex-grow-1 bg-img dask-bg bg-none-md" style="background-position: right bottom; background-size: auto 100%; background-image: url(../images/svg-icon/color-svg/custom-1.svg)">
                        <div class="row">
                            <div class="col-12 col-xl-7">
                                <h2>Welcome back, <strong>{{ Auth::user()->name }}</strong></h2>

                                <p class="text-dark my-10 font-size-16">
                                    Kelola pemasukan dan pengeluaran Anda dengan lebih <strong class="text-warning">Mudah</strong>.
                                </p>
                                <p class="text-dark my-10 font-size-16">
                                    Pantau kondisi <strong class="text-warning">Keuangan</strong> Anda hari ini.
                                </p>
                            </div>
                            <div class="col-12 col-xl-5"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-4">
                    <div class="box">
                        <div class="box-body d-flex p-0">
                            <div class="flex-grow-1 bg-success p-30 flex-grow-1 bg-img" style="background-position: calc(100% + 0.5rem) bottom; background-size: auto 100%; background-image: url(../images/svg-icon/color-svg/wallet-income.png)">

                                <h4 class="fw-bold">Total Pemasukan</h4>

                                <h3 style="vertical-align: bottom; margin: 30px 0 0px 0">Rp {{ number_format($totalIncome, 0, ',', '.') }}</h3>

                                {{--<a href="#" class="btn btn-danger-light">Read More</a>--}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="box">
                        <div class="box-body d-flex p-0">
                            <div class="flex-grow-1 bg-warning p-30 flex-grow-1 bg-img" style="background-position: calc(100% + 0.5rem) bottom; background-size: auto 100%; background-image: url(../images/svg-icon/color-svg/wallet-expense.png)">

                                <h4 class="fw-bold">Total Pengeluaran</h4>

                                <h3 style="vertical-align: bottom; margin: 30px 0 0px 0">Rp {{ number_format($totalExpense, 0, ',', '.') }}</h3>

                                {{--<a href="#" class="btn btn-danger-light">Read More</a>--}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="box">
                        <div class="box-body d-flex p-0">
                            <div class="flex-grow-1 bg-primary p-30 flex-grow-1 bg-img" style="background-position: calc(100% + 0.5rem) bottom; background-size: auto 100%; background-image: url(../images/svg-icon/color-svg/wallet-balance.png)">

                                <h4 class="fw-bold">Total Saldo</h4>

                                <h3 style="vertical-align: bottom; margin: 30px 0 0px 0">Rp {{ number_format($balance, 0, ',', '.') }}</h3>

                                {{--<a href="#" class="btn btn-danger-light">Read More</a>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 🔹 CHART --}}
            <div class="row">
                <div class="col-xl-6">
                    <div class="card p-3">
                        <h5>Grafik Pemasukan & Pengeluaran</h5>
                        <div style="height:300px;">
                           <div id="incomeExpenseChart"></div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="card p-3">
                        <h5>Grafik Kategori</h5>
                        <div id="categoryChart" style="height:300px;width:100%;">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12 col-12">
            <div class="box box-outline-success bs-3 border-success">
                <div class="box-header with-border d-flex justify-content-between align-items-center pb-0">
                    <div class="d-flex justify-content-start">
                        <h4>Transaksi</h4>
                    </div>
                    {{--<div class="d-flex justify-content-end">
                        <button class="btn btn-success waves-effect waves-light" data-bs-toggle="modal"
                            data-bs-target="#modalTransaction"><i class="fa fa-plus"></i> Tambah Data</button>
                        <span class="divider-line mx-1"></span>
                        <!-- Modal trigger button -->

                    </div>--}}
                </div>
                @include('user.create')
                <div class="box-body pt-0">
                    {{--<div class="row">
                            <div class="col-xl-6 col-lg-6">
                                <form action="{{ route('univ.krs-manual') }}" method="get" id="semesterForm">
                    <div class="mb-3">
                        <label for="semester_view" class="form-label">Semester</label>
                        <select
                            class="form-select"
                            name="semester_view"
                            id="semester_view"
                            onchange="document.getElementById('semesterForm').submit();">
                            <option value="" selected disabled>-- Pilih Semester --</option>
                            @foreach ($semester as $p)
                            <option value="{{$p->id_semester}}"
                                @if ($semester_pilih !=null)
                                {{$semester_pilih == $p->id_semester ? 'selected' : ''}}
                                @endif>{{$p->nama_semester}}</option>
                            @endforeach
                        </select>
                    </div>
                    </form>
                </div>
            </div>--}}
            <hr>
            <div class="table-responsive">
                <table id="data" class="table table-hover table-bordered margin-top-10 w-p100">
                    <thead>
                        <tr>
                            <th class="text-center align-middle">No</th>
                            <th class="text-center align-middle">Tanggal</th>
                            <th class="text-center align-middle">Jenis</th>
                            <th class="text-center align-middle">Kategori</th>
                            <th class="text-center align-middle">Nominal</th>
                            <th class="text-center align-middle">Deskripsi</th>
                            <th class="text-center align-middle">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transactions as $index => $transaction)
                        <tr>
                            <td class="text-center align-middle">{{$index + 1}}</td>
                            <td class="text-center align-middle">{{ date('d M Y', strtotime($transaction->transaction_date)) }}</td>
                            <td class="text-start align-middle {{ empty($d->riwayat) || empty($d->riwayat->nama_mahasiswa) ? 'text-danger' : '' }}">
                                {{ $transaction->type?->name }}
                            </td>
                            <td class="text-center align-middle">{{ $transaction->category?->name }}</td>
                            <td class="text-center align-middle">
                                Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                            </td>
                            <td class="text-center align-middle">{{ $transaction->description }}</td>
                            <td class="text-center align-middle">
                                <button class="btn btn-rounded bg-warning mb-2" title="Edit Data" data-bs-toggle="modal" data-bs-target="#editModal" onclick="editBatas({{$transaction}}, {{$transaction->id}})">
                                    <i class="fa fa-pencil-square-o"><span class="path1"></span><span class="path2"></span></i>
                                </button>
                                <form action="{{route('user.transactions.delete', $transaction->id)}}" method="POST" id="delete-form-{{$transaction->id}}">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-rounded bg-danger" title="Delete Data">
                                        <i class="fa fa-trash"><span class="path1"></span><span class="path2"></span></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/echarts/dist/echarts.min.js"></script>
<script src="{{asset('assets/vendor_components/datatable/datatables.min.js')}}"></script>
<script src="{{asset('assets/vendor_components/select2/dist/js/select2.min.js')}}"></script>
<script src="{{asset('assets/vendor_components/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{asset('assets/vendor_components/apexcharts-bundle/dist/apexcharts.js')}}"></script>

<script>
    "use strict";

    $('#data').DataTable();

    // ===============================
    // DATA
    // ===============================
    const monthlyData = @json($monthly);
    const categoryData = @json($categories);
    const categoriesAll = @json($categoriesAll);

    // ===============================
    // CHART
    // ===============================
    const incomeExpenseOptions = {
        chart: {
            type: 'bar',
            height: 300
        },
        series: [
            {
                name: 'Pemasukan',
                data: monthlyData.map(i => i.income)
            },
            {
                name: 'Pengeluaran',
                data: monthlyData.map(i => i.expense)
            }
        ],
        xaxis: {
            categories: monthlyData.map(i => 'Bulan ' + i.month)
        },
        colors: ['#04a08b', '#ff9920'],
        plotOptions: {
            bar: {
                columnWidth: '30%',
                borderRadius: 6
            }
        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return 'Rp ' + val.toLocaleString('id-ID');
                }
            }
        },
        yaxis: {
            labels: {
                formatter: function (val) {
                    return 'Rp ' + val.toLocaleString('id-ID');
                }
            }
        },
        dataLabels: {
            enabled: false
        }
    };

    // 🔥 BAR RENDER (SETELAH OPTIONS ADA)
    const incomeChartEl = document.querySelector("#incomeExpenseChart");

    if (incomeChartEl && monthlyData.length > 0) {
        new ApexCharts(incomeChartEl, incomeExpenseOptions).render();
    }

    
    document.addEventListener('DOMContentLoaded', function () {
    const pieChartEl = document.getElementById('categoryChart');

    if (pieChartEl && categoryData.length > 0) {
        const pieChart = echarts.init(pieChartEl);

        const option = {
            tooltip: {
                trigger: 'item',
                formatter: function (params) {
                    return params.name + '<br/>Rp ' + params.value.toLocaleString('id-ID') +
                        ' (' + params.percent + '%)';
                }
            },
            legend: {
                orient: 'vertical',
                left: 'left',
                data: categoryData.map(i => i.name)
            },
            color: ['#04a08b', '#f59e0b', '#3b82f6', '#f43f5e', '#22c55e'],
            series: [{
                name: 'Kategori',
                type: 'pie',
                radius: '70%',
                center: ['50%', '60%'],
                data: categoryData.map(i => ({
                    value: i.total,
                    name: i.name
                })),
                label: {
                    show: true,
                    formatter: '{b}'
                },
                labelLine: {
                    show: true
                }
            }]
        };

        pieChart.setOption(option);

        // 🔥 penting kalau layout admin pakai flex / tab / card
        window.addEventListener('resize', function () {
            pieChart.resize();
        });
    }
});

    // ===============================
    // DYNAMIC CATEGORY
    // ===============================
    const typeSelect = document.getElementById('type_id');
    const categorySelect = document.getElementById('category_id');

    if (typeSelect) {
        typeSelect.addEventListener('change', function() {
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
    document.addEventListener('DOMContentLoaded', function() {

        const amountInput = document.getElementById('amount');

        function formatRupiah(angka) {
            return 'Rp ' + angka.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }

        function cleanRupiah(value) {
            return value.replace(/[^0-9]/g, '');
        }

        if (amountInput) {
            amountInput.addEventListener('keyup', function() {
                let angka = cleanRupiah(this.value);
                this.value = angka ? formatRupiah(angka) : '';
            });
        }

        const form = document.getElementById('transactionForm');
        if (form) {
            form.addEventListener('submit', function() {
                amountInput.value = cleanRupiah(amountInput.value);
            });
        }

    });

    // ===============================
    // SUBMIT (BERSIHKAN FORMAT)
    // ===============================
    const form = document.getElementById('transactionForm');

    if (form) {
        form.addEventListener('submit', function() {
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