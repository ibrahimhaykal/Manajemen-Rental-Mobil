@extends('layouts.main')

@section('content')
<h1>Edit Pengguna</h1>

@if(session('success'))
<div class="alert alert-success" role="alert">
    {{ session('success') }}
</div>
@endif

<form action="{{ route('user.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="name">Nama</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" required>
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
    </div>

    <div class="form-group">
        <label for="address">Alamat</label>
        <input type="text" name="address" id="address" class="form-control" value="{{ $user->address }}">
    </div>

    <div class="form-group">
        <label for="phone_number">Nomor Telepon</label>
        <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ $user->phone_number }}">
    </div>

    <div class="form-group">
        <label for="SIM_number">Nomor SIM</label>
        <input type="text" name="SIM_number" id="SIM_number" class="form-control" value="{{ $user->SIM_number }}">
    </div>

    <button type="submit" class="btn btn-primary">Perbarui Pengguna</button>
</form>
@endsection
