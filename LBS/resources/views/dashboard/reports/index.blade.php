@extends('dashboard.layout.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard Reports</h1>
    </div>

    <form action="{{ route('dashboard.filter') }}" method="GET">
        <div class="row mb-3">
            <div class="col-md-3">
                <input type="date" name="date" class="form-control" value="{{ request('date') }}">
            </div>
            <div class="col-md-3">
                <input type="month" name="month" class="form-control" value="{{ request('month') }}">
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </div>
    </form>


    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Laporan Masuk</h5>
                    <p class="card-text"><a class="text-decoration-none" href="/dashboard/admin_reqs">{{ $totalRequests }}</a></p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Sudah Dibersihkan</h5>
                    <p class="card-text"><a class="text-decoration-none" href="/dashboar/riwayat">{{ $completedRequests }}</a></p>
                </div>
            </div>
        </div>
    </div>

   
    <div class="row mt-2">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Belum Dibersihkan</h5>
                    <p class="card-text"><a class="text-decoration-none" href="/dashboard/admin_reqs">{{ $pendingRequests }}</a></p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Wilayah</h5>
                    <p class="card-text"><a class="text-decoration-none" href="/dashboard/regions">{{ $totalWilayah }}</a></p>
                </div>
            </div>
        </div>
    </div>
    
    <form action="{{ route('exportPDF') }}" method="GET" class="mt-3">
        <input type="hidden" name="date" value="{{ request('date') }}">
        <input type="hidden" name="week" value="{{ request('week') }}">
        <input type="hidden" name="month" value="{{ request('month') }}">
        <button type="submit" class="btn btn-primary">Export PDF</button>
    </form>

    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Laporan Perwilayah</h5>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Region</th>
                                <th>RW</th>
                                <th>Total Requests</th>
                                <th>Requests Sudah Dibersihkan</th>
                                <th>Status Indikator</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($regions as $region)
                            <tr>
                                <td>{{ $region->name }}</td>
                                <td>{{ $region->region_no }}</td>
                                <td>{{ $region->reqs_count }}</td>
                                <td>{{ $region->cleaned_reqs_count }}</td>
                                <td>
                                    <span class="badge {{ $region->status_indicator }}">
                                        {{ $region->status_indicator === 'bg-success' ? 'Semua Dibersihkan' : ($region->status_indicator === 'bg-warning' ? 'Sebagian Dibersihkan' : 'Belum Dibersihkan') }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
