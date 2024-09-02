@extends('layouts.main')

@section('content')
<h1 class="mt-4">Rental</h1>
<ol class="mb-4 breadcrumb">
    <li class="breadcrumb-item active">Edit Rental</li>
</ol>
<form action="{{ route('rental.update', $rental->id) }}" method="POST" enctype="multipart/form-data">
    @csrf()
    @method('PUT')
  <div class="mb-3">
    <label for="user_id" class="form-label">Pilih Pelanggan</label>
    <select class="form-select" id="user_id" name="user_id">
    @foreach($users as $user)
    <option {{ (old('user_id', $rental->user_id) == $user->id ? 'selected' : '') }} value="{{ $user->id }}">{{ $user->name }}</option>
    @endforeach
    </select>
    @error('user_id')
    <span class="invalid-feedback">{{ $message }}</span>
    @enderror
  </div>
  <div class="mb-3">
        <label for="car_id" class="form-label">Pilih Mobil</label>
        <select class="form-select" id="car_id" name="car_id">
            @foreach($cars as $car)
                <option {{ old('car_id', $rental->car_id) == $car->id ? 'selected' : '' }} value="{{ $car->id }}">{{ $car->brand }}</option>
            @endforeach
        </select>
        @error('car_id')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
  <div class="mb-3">
    <label for="start_date" class="form-label">Tanggal Mulai</label>
    <input type="date" class="form-control @error('start_date') is-invalid @enderror" name="start_date" id="start_date" value="{{ old('start_date', $rental->start_date) }}">
    @error('start_date')
    <span class="invalid-feedback">
      {{ $message }}
    </span>
    @enderror
  </div>
  <div class="mb-3">
    <label for="end_date" class="form-label">Tanggal Selesai</label>
    <input type="date" class="form-control @error('end_date') is-invalid @enderror" name="end_date" id="end_date" value="{{ old('end_date', $rental->end_date) }}">
    @error('end_date')
    <span class="invalid-feedback">
      {{ $message }}
    </span>
    @enderror
  </div>
  <div class="d-flex justify-content-end">
    <button type="submit" class="btn btn-primary">Update</button>
  </div>
</form>
@endsection
