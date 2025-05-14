@extends('dashboard.layout.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Seluruh Wilayah</h1>
    </div>
    <a href="/dashboard/regions/create" class="btn btn-primary mb-3">Tambah RW</a>

    @if(session()->has('success'))
    <div class="alert alert-success col-lg-10" role="alert">
      {{ session('success') }}
    </div>
    @endif

      <div class="table-responsive col-lg-10">
        <form action="/dashboard/regions">
          
        </form>
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Rw</th>
              <th scope="col">Nama</th>
              <th scope="col">No HandPhone</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($regions as $region)
            <tr>
              <td>{{ $loop->iteration }}</td> 
              <td>{{ $region->region_no }}</td>
              <td>{{ $region->name}}</td>
              <td>{{ $region->phone}}</td>
              <td>
                <a href="/dashboard/regions/{{ $region->id }}/edit" class="badge bg-warning"><span data-feather="edit"></span></a>
                <form action="/dashboard/regions/{{ $region->id }}" method="post" class="d-inline">
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