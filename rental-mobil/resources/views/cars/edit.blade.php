@extends('layouts.main')

@section('content')
    <div class="container">
        <h1 class="mt-4">Edit Mobil</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Beranda</a></li>
            <li class="breadcrumb-item active">Edit Mobil</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-car mr-1"></i>
                Edit Mobil
            </div>
            <div class="card-body">
                <form action="{{ route('car.update', $car->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="brand">Merek:</label>
                        <input type="text" name="brand" class="form-control" id="brand" value="{{ $car->brand }}" required>
                    </div>
                    <div class="form-group">
                        <label for="model">Model:</label>
                        <input type="text" name="model" class="form-control" id="model" value="{{ $car->model }}" required>
                    </div>
                    <div class="form-group">
                        <label for="license_plate">Nomor Plat:</label>
                        <input type="text" name="license_plate" class="form-control" id="license_plate" value="{{ $car->license_plate }}" required>
                    </div>
                    <div class="form-group">
                        <label for="rental_rate_per_day">Tarif Sewa Per Hari:</label>
                        <input type="number" step="0.01" name="rental_rate_per_day" class="form-control" id="rental_rate_per_day" value="{{ $car->rental_rate_per_day }}" required>
                    </div>
                    <div class="form-group">
                        <label for="availability">Ketersediaan:</label>
                        <select name="availability" class="form-control" id="availability" required>
                            <option value="1" {{ $car->availability ? 'selected' : '' }}>Tersedia</option>
                            <option value="0" {{ !$car->availability ? 'selected' : '' }}>Tidak Tersedia</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="image">Gambar Mobil:</label>
                        @if($car->image)
                            <img src="{{ Storage::url($car->image) }}" alt="Gambar Mobil" style="width: 100px;">
                            <input type="hidden" name="oldImage" value="{{ $car->image }}">
                        @endif
                        <input type="file" name="image" class="form-control-file" id="image">
                    </div>
                    <button type="submit" class="btn btn-primary">Perbarui Mobil</button>
                </form>
            </div>
        </div>
    </div>
@endsection
