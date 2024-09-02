@extends('layouts.main')

@section('content')
<h1>Buat Pengguna Baru</h1>

<form action="{{ route('user.store') }}" method="POST">
    @csrf

    <div class="form-group">
        <label for="name">Nama</label>
        <input type="text" name="name" id="name" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="password">Kata Sandi</label>
        <input type="password" name="password" id="password" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="address">Alamat</label>
        <input type="text" name="address" id="address" class="form-control">
    </div>

    <div class="form-group">
        <label for="phone_number">Nomor Telepon</label>
        <input type="text" name="phone_number" id="phone_number" class="form-control">
    </div>

    <div class="form-group">
        <label for="SIM_number">Nomor SIM</label>
        <input type="text" name="SIM_number" id="SIM_number" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Buat Pengguna</button>
</form>
@endsection
