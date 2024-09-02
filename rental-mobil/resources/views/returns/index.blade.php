@extends('layouts.main')

@section('content')
    <h1>Pengembalian Mobil</h1>
    <div class="mt-4">
        <form action="{{ route('returns.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="license_plate">Nomor Plat Kendaraan:</label>
                <input type="text" class="form-control" id="license_plate" name="license_plate" placeholder="Masukkan Nomor Plat Kendaraan">
            </div>
            <button type="submit" class="btn btn-primary">Kembalikan Mobil</button>
        </form>
    </div>

    <h2 class="mt-4">Penyewaan yang Perlu Dikembalikan</h2>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>#</th>
                <th>Pengguna</th>
                <th>Mobil</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Status</th>
                <th>Total Biaya</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($rentals as $index => $rental)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $rental->user->name }}</td>
                    <td>{{ $rental->car->license_plate }}</td>
                    <td>{{ $rental->start_date }}</td>
                    <td>{{ $rental->end_date }}</td>
                    <!-- Tambahkan kolom untuk status dan total_cost -->
                    <td>{{ $rental->status }}</td>
                    <td>{{ $rental->total_cost }}</td>
                    <td>
                        <form action="{{ route('returns.update', $rental->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="rental_id" value="{{ $rental->id }}">
                            <input type="hidden" name="return_date" value="{{ now() }}">
                            <!-- Tambahan data untuk rental_cost dan status -->
                            <input type="hidden" name="rental_cost" value="{{ $rental->total_cost }}">
                            <input type="hidden" name="status" value="DIKEMBALIKAN">
                            <button type="submit" class="btn btn-success">Kembalikan</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">Tidak ada penyewaan yang perlu dikembalikan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
