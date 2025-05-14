@extends('dashboard.layout.main')

@section('container')
    <div class="contaiener">
        <div class="row my-3 ">
            <div class="col-lg-8 ">
                <h1 class="mb-3">Kirim pesan kepada RW {{ $req->region_id }}</h1>

                <a href="/dashboard/admin_reqs" class="btn btn-success"><span data-feather="arrow-left"></span> Back to all requests</a>
                <a href="/dashboard/admin_reqs/{{ $req->slug }}/edit" class="btn btn-warning"><span data-feather="edit"></span> Edit</a>
                <form action="/dashboard/admin_reqs/{{ $req->slug }}" method="post" class="d-inline">
                  @method('delete')
                  @csrf
                  <button class="btn btn-danger" onclick="return confirm('Are You Sure?')"><span data-feather="x-circle"></span> Delete</button>
                </form>

               
            </div>
        </div>
    </div>

@endsection