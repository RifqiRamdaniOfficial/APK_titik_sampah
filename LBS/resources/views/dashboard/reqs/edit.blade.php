@extends('dashboard.layout.main')

@section('container') 
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Pengajuan </h1>
    </div>
    <div class="col-lg-8">
        <form method="post" action="/dashboard/reqs/{{ $req->slug }}" enctype="multipart/form-data"> 
            @method('put')
            @csrf
            <div class="mb-3">
                <label for="image" class="form-label">Post Image</label>
                <input type="hidden" name="oldImage" value="{{ $req->image }}">
                @if($req->image)
                <img src="{{ asset('storage/' . $req->image) }}" class="img-preview img-fluid mb-3 col-sm-5 d-block">
                @else
                <img class="img-preview img-fluid mb-3 col-sm-5">
                @endif 
                <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" onchange="previewImage()">
                @error('slug')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="addres" class="form-label" >Alamat</label>
                <input type="text" class="form-control" id="title" name="addres" required autofocus value="{{ old('addres',$req->addres) }}">
            </div>
            <div class="mb-3">
                <label for="slug" class="form-label" >Slug</label>
                <input type="text" class="form-control" id="slug" name="slug" required autofocus readonly value="{{ old('slug', $req->slug) }}">
            </div>
            <div class="mb-3">
                <label for="region" class="form-label">RW</label>
                <select class="form-select" name="region_id">
                    @foreach ($regions as $region)
                    @if(old('region_id',$req->region_id) == $region->id)
                        <option value="{{ $region->id }}" selected>{{ $region->region_no }}</option>
                    @else
                        <option value="{{ $region->id }}" >{{ $region->region_no }}</option>
                     @endif       
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="information" class="form-label">Keterangan</label>
                @error('information')
                <p class="text-danger">{{ $message }}</p>
                @enderror
                <input id="information" value="{{ old('information',$req->information) }}" type="hidden" name="information">
                <trix-editor input="information"></trix-editor>
            </div>
            @can('admin') 
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" name="status" value="{{old('status',$req->status)}}">
                        <option value="belum dibersihkan">Belum Dibersihkan</option>
                        <option value="sudah dibersihkan">Sudah Dibersihkan</option>
                </select>
            </div>
            @endcan
            @can('petugas') 
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" name="status" value="{{old('status',$req->status)}}">
                        <option value="belum dibersihkan">Belum Dibersihkan</option>
                        <option value="sudah dibersihkan">Sudah Dibersihkan</option>
                </select>
            </div>
            @endcan
            <iframe src="https://www.google.com/maps?q={{ $req->latitude }},{{ $req->longitude }}&hl=es&z=14&output=embed" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"   width="100%" height="600px"></iframe> 
            <button type="submit" class="btn btn-primary">Update Pengajuan</button>
        </form>
    </div>

    
@endsection