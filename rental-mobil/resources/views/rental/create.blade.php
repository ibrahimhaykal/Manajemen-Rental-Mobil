@extends('layouts.main')

@section('content')
<h1 class="mt-4">Buat Penyewaan</h1>
<ol class="mb-4 breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('rental.index') }}">Penyewaan</a></li>
    <li class="breadcrumb-item active">Buat Penyewaan</li>
</ol>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('rental.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="user_id">Pengguna</label>
        <select class="form-control" id="user_id" name="user_id">
            <option value="">Pilih pengguna</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                    {{ $user->name }} ({{ $user->email }})
                </option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="car_id">Mobil</label>
        <select class="form-control" id="car_id" name="car_id">
            <option value="">Pilih mobil</option>
            @foreach($cars as $car)
                <option value="{{ $car->id }}" {{ old('car_id') == $car->id ? 'selected' : '' }}>
                    {{ $car->brand }} {{ $car->model }} ({{ $car->license_plate }}) - ${{ $car->rental_rate_per_day }} per hari
                </option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="start_date">Tanggal Mulai</label>
        <input type="date" class="form-control" id="start_date" name="start_date" value="{{ old('start_date') }}">
    </div>
    <div class="form-group">
        <label for="end_date">Tanggal Selesai</label>
        <input type="date" class="form-control" id="end_date" name="end_date" value="{{ old('end_date') }}">
    </div>
    <button type="submit" class="btn btn-primary">Buat Penyewaan</button>
</form>
@endsection
