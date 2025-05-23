@extends('dashboard.layout.main')

@section('container')
    <div class="contaiener">
        <div class="row my-3 ">
            <div class="col-lg-8 ">
                <h1 class="mb-3">{{ $post->title }}</h1>

                <a href="/dashboard/posts" class="btn btn-success"><span data-feather="arrow-left"></span> Back to all my posts</a>
                <a href="/dashboard/posts/{{ $post->slug }}/edit" class="btn btn-warning"><span data-feather="edit"></span> Edit</a>
                <form action="/dashboard/posts/{{ $post->slug }}" method="post" class="d-inline">
                  @method('delete')
                  @csrf
                  <button class="btn btn-danger" onclick="return confirm('Are You Sure?')"><span data-feather="x-circle"></span> Delete</button>
                </form>

                @if($post->image)
                    <div style="max-height: 350px; overflow:hidden;">
                        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->category->name }}" class="img-fluid mt-3">
                    </div>
                @else
                    <img src="https://loremflickr.com/1200/400/{{ urlencode($post->category->name) }}" alt="{{ $post->category->name }}" class="img-fluid mt-3">
                @endif
                 

                <article class="my-3 fs-5">
                 {{-- memanggil beserta tag HTML --}}
                 {!! $post->body !!} 
                </article>
            </div>
        </div>
    </div>

@endsection