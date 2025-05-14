@extends('dashboard.layout.main')

@section('container')
    <div class="contaiener">
            <div class="col-lg-8 ">
                <h1 class="mb-3">Reques area RW {{ $req->region_id }}</h1>

               
                @can('admin')
                <a href="/dashboard/admin_reqs" class="btn btn-success"><span data-feather="arrow-left"></span> Kembali</a>
                @endcan
                @can('petugas')
                <a href="/dashboard/tugas" class="btn btn-success"><span data-feather="arrow-left"></span> Kembali</a>
                @endcan
                </form>
            </div>
           
            
                <img src="{{ asset('storage/' . $req->image) }}" alt="{{ $req->region->name }}" class="img-fluid mt-3" width="300" height="200" alt="Description">
            
            
        
        <p>Request By : {{ $req->user->name}}</p>
        <article class="my-3 fs-5">
            Keterangan : {!! $req->information !!} 
           </article>
        <article class="my-3 fs-5">
         Alamat : {!! $req->addres !!} 
        </article>
        <article class="my-3 fs-5">
         Wilayah RW :  {!! $req->region->region_no !!} (Bapak {!! $req->region->name !!})
        </article>
        
        <article class="my-3 fs-5">
            Keterangan : {!! $req->status !!} 
           </article>
           <iframe src="https://www.google.com/maps?q={{ $req->latitude }},{{ $req->longitude }}&hl=es&z=14&output=embed" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"   width="100%" height="600px"></iframe>  
        </div>

        <a href="/dashboard/reqs" class="btn btn-success"><span data-feather="arrow-left"></span> Kembali</a>
    </div>
@endsection