@extends('dashboard.layout.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Tambah RW</h1>
    </div>
    <div class="col-lg-8">
        <form method="post" action="/dashboard/regions" enctype="multipart/form-data"> 
            @csrf
            <div class="mb-3">
                <label for="region_no" class="form-label" >RW</label>
                <input type="text" class="form-control @error('region_no') is-invalid @enderror" id="region_no" name="region_no" required autofocus value="{{ old('region_no') }}"><small  class="form-text text-muted">Isi diantara 01 - 99</small>
                @error('region_no')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="name" class="form-label" >Nama</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required autofocus value="{{ old('name') }}">
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label" >No HP</label>
                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" required autofocus value="{{ old('phone') }}">
                <small  class="form-text text-muted">Masukan inputan angka 62</small>
                @error('phone')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
           
            <button type="submit" class="btn btn-primary">Buat</button>
        </form>
    </div>

    
@endsection