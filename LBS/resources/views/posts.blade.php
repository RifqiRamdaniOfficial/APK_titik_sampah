@extends('layouts.main')

@section('container')
    <h1 class="mb-3 text-center mt-4">{{ $title }}</h1>
    <div class="container">
      <div class="row justify-content-center mb-3">
        <div class="col-md-6">
          <form action="/posts">
            {{-- agar saat didalam category dan lakukan search tetap melakukan search didalam category --}}
            @if (request('category'))
                <input type="hidden" name="category" value="{{ request('category') }}">
            @endif
             @if (request('user'))
                <input type="hidden" name="user" value="{{ request('user') }}">
            @endif
            <div class="input-group mb-3">
              <input type="text" class="form-control" placeholder="Search.." name="search" value="{{ request('search') }}">
              <button class="btn btn-danger" type="submit">Search</button>
            </div>
          </form>
        </div>
      </div>
  
  {{-- mengecek apakah ada postingan --}}
  @if ($posts->count()) 
  <div class="card mb-3">
     @if($posts[0]->image)
      <div style="max-height: 350px; overflow:hidden;">
        <img src="{{ asset('storage/' . $posts[0]->image) }}" alt="{{ $posts[0]->category->name }}" class="img-fluid">
      </div>
      @else
      <img src="https://loremflickr.com/1200/400/{{ urlencode($posts[0]->category->name) }}" class="card-img-top" alt="{{ $posts[0]->category->name }}">
      @endif
    
    <div class="card-body text-center">
      <h3 class="card-title"><a href="/posts/{{ $posts[0]->slug }}" class="text-decoration-none text-dark">{{ $posts[0]->title }}</a></h3>
      <p>
        <small class="text-muted">by. <a href="/posts?user={{ $posts[0]->user->username }}" class="text-decoration-none">{{ $posts[0]->user->name }}</a> in <a href="/posts?category={{ $posts[0]->category->slug }}" class="text-decoration-none"> {{ $posts[0]->category->name }}</a>{{ $posts[0]->created_at->diffForHumans() }}</small>
      </p>
      <p class="card-text">{{ $posts[0]->excerpt }}</p>
      <a href="/posts/{{ $posts[0]->slug }}" class="text-decoration-none btn btn-primary">Read More</a>
    </div>
  
  
  <div class="container">
      <div class="row">
        @foreach ($posts->skip(1) as $post)
        {{-- skip mengulang semua postingan kecuali postingan pertama --}}
          <div class="col-md-4 mb-3">
              <div class="card">
                <div class="position-absolute px-3 py-2" style="background-color: rgba(0,0,0,0.7)"><a href="/posts?category={{ $post->category->slug }}" class="text-decoration-none text-light">{{ $post->category->name }}</a></div>
                @if($post->image)
                          <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->category->name }}" class="img-fluid">
                  @else
                      <img src="https://loremflickr.com/500/400/{{ urlencode($post->category->name) }}" class="card-img-top" alt="{{ $post->category->name }}">
                  @endif
                
                <div class="card-body">
                  <h5 class="card-title">{{ $post->title }}</h5>
                  <p>
                    <small class="text-muted">by. <a href="/posts?user={{ $post->user->username }}" class="text-decoration-none">{{ $post->user->name }}</a>{{ $post->created_at->diffForHumans() }}</small>
                  </p>
                  <p class="card-text">{{ $post->excerpt }}</p>
                  <a href="/posts/{{ $post->slug }}" class="text-decoration-none btn btn-primary">Read More</a>
                </div>
              </div>
          </div>
          @endforeach
      </div>
  </div>
  
  @else
    <p class="tetx-center fs-4">No Post Found.</p>
  @endif
  
  {{-- pagination --}}
  {{-- rubah konfigurasi untuk boostrap di app/Providers/AppServiceProvider dan rubah bootanya --}}
  
  <div class="d-flex justify-content-center">
    {{ $posts->links() }}
  
  </div>
  
    </div>
    



@endsection
