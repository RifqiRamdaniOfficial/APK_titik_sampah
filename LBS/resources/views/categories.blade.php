@extends('layouts.main')

@section('container')
<div class="container">
    <h1 class="mb-5 mt-4">Post Categories</h1>

    <div class="container">
        <div class="row">
            @foreach ($categories as $category)
            <div class="col-md-4">
                <a href="/posts?category={{ $category->slug }}">
                    <div class="card bg-dark text-white">
                        <img src="https://loremflickr.com/500/400/{{ urlencode($category->name) }}" class="card-img" alt="{{ $category->name }}">
                        <div class="card-img-overlay d-flex align-items-center p-0">
                            <h5 class="card-title text-center flex-fill p-4 fs-3" style="background-color: rgba(0,0,0,0.7)">{{ $category->name }}</h5>  
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>
    

@endsection
