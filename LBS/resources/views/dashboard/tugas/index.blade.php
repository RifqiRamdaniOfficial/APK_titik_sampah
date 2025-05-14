@extends('dashboard.layout.main')

@section('container')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Daftar Titik Sampah</h1>
    </div>
    @if(session()->has('success'))
    <div class="alert alert-success col-lg-10" role="alert">
      {{ session('success') }}
    </div>
    @endif

    <form action="/dashboard/tugas" class="col-lg-10">
      <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Search.." name="search" value="{{ request('search') }}">
        <button class="btn btn-dark" type="submit">cari</button>
      </div>
    </form>
      <div class="table-responsive col-lg-10">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Alamat</th>
              <th scope="col">RW</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($reqs as $req)
            <tr>
              <td>{{ $loop->iteration }}</td> 
              <td>{{ $req->addres }}</td>
              <td>{{ $req->region_id }}</td>
              <td>
                <a href="/dashboard/reqs/{{ $req->slug }}" class="badge bg-info"><span data-feather="eye"></span></a>
                <a href="/dashboard/reqs/{{ $req->slug }}/edit" class="badge bg-success text-decoration-none"><span data-feather="edit"></span>Proses</a>
              </td>
            </tr>
                
            @endforeach
            
          </tbody>
        </table>
        <div class="d-flex justify-content-center">
          {{ $reqs->links() }}
        
        </div>
      </div>

@endsection