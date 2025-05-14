@extends('dashboard.layout.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Buat Pengajuan Baru</h1>
    </div>
    <div class="col-lg-8">
        <form class="myForm" method="post" action="/dashboard/reqs" enctype="multipart/form-data">  
            @csrf
            <div class="mb-3">
                <label for="image" class="form-label">Post Image</label>
                <img class="img-preview img-fluid mb-3 col-sm-5">
                <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" onchange="previewImage()" capture="camera">
                @error('image')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="addres" class="form-label" >Alamat</label>
                <input type="text" class="form-control" id="title" name="addres" required autofocus value="{{ old('addres') }}">
            </div>
            <div class="mb-3">
                <label for="slug" class="form-label" >Slug</label>
                <input type="text" class="form-control" id="slug" name="slug" required autofocus readonly value="{{ old('slug') }}">
            </div>
            <div class="mb-3">
                <label for="region" class="form-label">RW</label>
                <select class="form-select" name="region_id">
                    @foreach ($regions as $region)
                    @if(old('region_id') == $region->id)
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
                <input id="information" value="{{ old('information') }}" type="hidden" name="information">
                <trix-editor input="information"></trix-editor>
            </div>
            <div class="form-group row">
                <label for="lokasi" class="form-label" >Lokasi</label>
            <div class="mb-2 col-md-4">
                <input type="text" class="form-control" id="latitude" name="latitude" readonly>
            </div>
            <div class="mb-2 col-md-4">
                <input type="text" class="form-control" id="longitude" name="longitude" readonly>
            </div>
            </div>
            <button type="submit" class="btn btn-primary">Buat</button>
        </form>
    </div>

   

@endsection