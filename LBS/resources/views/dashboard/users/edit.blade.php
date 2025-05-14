@extends('dashboard.layout.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit User </h1>
    </div>
    <div class="col-lg-8">
        <form method="post" action="/dashboard/users/{{ $user->id }}" enctype="multipart/form-data"> 
            @method('put')
            @csrf
           
            <div class="mb-3">
                <label for="name" class="form-label" >Nama</label>
                <input type="text" class="form-control" id="name" name="name" required autofocus value="{{ old('name',$user->name) }}">
            </div>
            <div class="mb-3">
                <label for="username" class="form-label" >Username</label>
                <input type="text" class="form-control" id="username" name="username" required autofocus  value="{{ old('username', $user->username) }}">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label" >Email</label>
                <input type="text" class="form-control" id="email" name="email" required autofocus  value="{{ old('email', $user->email) }}">
            </div>
            <div class="mb-3">
                <label for="type" class="form-label">Tipe User</label>
                <select class="form-select" name="type" value="{{old('type',$user->type)}}">
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                        <option value="petugas">Petugas</option>
                </select>
            </div>
            
            <button type="submit" class="btn btn-primary">Update User</button>
        </form>
    </div>

    
@endsection