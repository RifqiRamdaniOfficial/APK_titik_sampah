@extends('dashboard.layout.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Welcome Back, {{ auth()->user()->name }}</h1>
     </div>
     
     
     @if(session()->has('success'))
     <div class="alert alert-success col-lg-10" role="alert">
       {{ session('success') }}
     </div>
     @endif
     <div class="d-flex justify-content-center align-items-center">
      <img width="400" height="400" src="img/ilustrasi.png" alt="lbs">
    </div>
@endsection