@extends('layouts.main')

@section('content')
    <div class="container">
        <h1 class="mt-4">Daftar Mobil</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Beranda</a></li>
            <li class="breadcrumb-item active">Daftar Mobil</li>
        </ol>
        <!-- Tombol untuk menambahkan data mobil baru -->
        <div class="mb-3">
            <a href="{{ route('car.create') }}" class="btn btn-primary">Tambah Mobil Baru</a>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-car mr-1"></i>
                Daftar Mobil
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Merek</th>
                            <th>Model</th>
                            <th>Plat Nomor</th>
                            <th>Biaya Sewa Per Hari</th>
                            <th>Ketersediaan</th>
                            <th>Gambar</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cars as $car)
                        <tr>
                            <td>{{ $car->brand }}</td>
                            <td>{{ $car->model }}</td>
                            <td>{{ $car->license_plate }}</td>
                            <td>{{ number_format($car->rental_rate_per_day, 2) }}</td>
                            <td>
                                <span class="badge {{ $car->availability ? 'bg-success' : 'bg-danger' }}">
                                    {{ $car->availability ? 'Tersedia' : 'Tidak Tersedia' }}
                                </span>
                            </td>
                            <td>
                                @if ($car->image)
                                    <img src="{{ Storage::url($car->image) }}" alt="Gambar Mobil" style="width: 100px;">
                                @else
                                    Tanpa Gambar
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('car.edit', $car->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#detail{{ $car->id }}">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <form action="{{ route('car.destroy', $car->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus mobil ini?');">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @foreach($cars as $car)
        <!-- Sertakan kode modal di sini -->
        <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="detail{{ $car->id }}" tabindex="-1" aria-labelledby="detail{{ $car->id }}Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detail{{ $car->id }}Label">Detail Mobil</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Merek: {{ $car->brand }}</p>
                        <p>Model: {{ $car->model }}</p>
                        <p>Plat Nomor: {{ $car->license_plate }}</p>
                        <p>Biaya Sewa Per Hari: {{ number_format($car->rental_rate_per_day, 2) }}</p>
                        <p>Status: 
                            @if($car->availability == 1)
                                <span class="badge bg-success">Tersedia</span>
                            @else
                                <span class="badge bg-danger">Tidak Tersedia</span>
                            @endif
                        </p>
                        <p>
                            @if ($car->image)
                                <img src="{{ asset('storage/' . $car->image) }}" width="400" alt="Gambar Mobil">
                            @else
                                Tanpa Gambar
                            @endif
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
