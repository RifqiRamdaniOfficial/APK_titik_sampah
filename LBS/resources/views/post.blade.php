@extends('layouts.main')

@section('container')
    <div class="contaiener">
        <div class="row justify-content-center ">
            <div class="col-md-8">
                <h1>{{ $post->title }}</h1>

                <p>by. <a href="/posts?author={{ $post->user->username }}" class="text-decoration-none">{{ $post->user->name }}</a> in <a href="/posts?category={{ $post->category->slug }}"> {{ $post->category->name }}</a></p>

               @if($post->image)
                    <div style="max-height: 350px; overflow:hidden;">
                        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->category->name }}" class="img-fluid ">
                    </div>
                @else
                <img src="https://loremflickr.com/1200/400/{{ urlencode($post->category->name) }}" alt="{{ $post->category->name }}" class="img-fluid">
                @endif

                <article class="my-3 fs-5">
                 {{-- memanggil beserta tag HTML --}}
                 {!! $post->body !!} 
                </article>
                <a href="/posts">Back To Post</a>
            </div>
        </div>
    </div>

@endsection