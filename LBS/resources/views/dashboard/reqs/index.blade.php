@extends('dashboard.layout.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Laporan Dibuat</h1>
    </div>
    <a href="/dashboard/reqs/create" class="btn btn-primary mb-3">Buat Pengajuan</a>

    @if(session()->has('success'))
    <div class="alert alert-success col-lg-10" role="alert">
      {{ session('success') }}
    </div>
    @endif

    <form action="/dashboard/reqs">
      <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Search.." name="search" value="{{ request('search') }}">
        <button class="btn btn-danger" type="submit">cari</button>
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
                <a href="/dashboard/reqs/{{ $req->slug }}/edit" class="badge bg-warning"><span data-feather="edit"></span></a>
                <form action="/dashboard/reqs/{{ $req->slug }}" method="post" class="d-inline">
                  @method('delete')
                  @csrf
                  <button class="badge bg-danger border-0" onclick="return confirm('Are You Sure?')"><span data-feather="x-circle"></span></button>
                </form>
              </td>
              
            </tr>
                
            @endforeach
            
          </tbody>
        </table>
       
      </div>
@endsection