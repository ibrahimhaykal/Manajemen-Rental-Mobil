@extends('layouts.main')

@section('content')
    <div class="container">
        <h1 class="mt-4">Tambah Mobil Baru</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Beranda</a></li>
            <li class="breadcrumb-item active">Tambah Mobil Baru</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-car mr-1"></i>
                Tambah Mobil Baru
            </div>
            <div class="card-body">
                <form action="{{ route('car.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="brand">Merek:</label>
                        <input type="text" name="brand" class="form-control" id="brand" placeholder="Masukkan merek" required>
                    </div>
                    <div class="form-group">
                        <label for="model">Model:</label>
                        <input type="text" name="model" class="form-control" id="model" placeholder="Masukkan model" required>
                    </div>
                    <div class="form-group">
                        <label for="license_plate">Nomor Plat:</label>
                        <input type="text" name="license_plate" class="form-control" id="license_plate" placeholder="Masukkan nomor plat" required>
                    </div>
                    <div class="form-group">
                        <label for="rental_rate_per_day">Tarif Sewa Per Hari:</label>
                        <input type="number" step="0.01" name="rental_rate_per_day" class="form-control" id="rental_rate_per_day" placeholder="Masukkan tarif sewa" required>
                    </div>
                    <div class="form-group">
                        <label for="availability">Ketersediaan:</label>
                        <select name="availability" class="form-control" id="availability" required>
                            <option value="1">Tersedia</option>
                            <option value="0">Tidak Tersedia</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="image">Gambar Mobil:</label>
                        <input type="file" name="image" class="form-control-file" id="image" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah Mobil</button>
                </form>
            </div>
        </div>
    </div>
@endsection
