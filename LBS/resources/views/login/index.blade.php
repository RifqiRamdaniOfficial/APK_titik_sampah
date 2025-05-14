@extends('layouts.main')

@section('container')

    <div class="row justify-content-center mt-4">
      
      <div class="col-md-5 card shadow p-3 mb-5 bg-white rounded">
        
        @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
  
        @if (session()->has('loginGagal'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          {{ session('loginGagal') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
  
          <main class="form-signin text-center ">
            <img width="200" height="200" src="img/sam.png" alt="lbs">
              <h1 class="h3 mb-4 mt-3 fw-normal text-center">Please Login</h1>
            <form action="/login" method="post">
              @csrf
              <div class="container">
                <div class="row justify-content-center">
                  <div class="col-md-8">
                    <div class="form-floating mb-3">
                      <input type="email" class="form-control @error('email') is-invalid  @enderror" name="email" id="email" placeholder="name@example.com" autofocus required value="{{ old('email') }}">
                      <label for="email" autofocus required>Email address</label>
                      @error('email')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>
                    <div class="form-floating">
                      <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                      <label for="password">Password</label>
                    </div>
                  </div>
                </div>
              </div>
              
          
              <button class=" btn btn-lg btn-primary col-md-6 mt-2" type="submit">Sign in</button>
            </form>
            <small class="d-block text-center mt-3 mb-4">Not Registered ? <a href="/register">Register Now</a></small>
          </main>
      </div>
    </div>

@endsection