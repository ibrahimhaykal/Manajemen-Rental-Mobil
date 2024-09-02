@extends('layouts.main')

@section('content')
    <h1>Detail Penyewaan</h1>
    <div>
        <p><strong>Pengguna:</strong> {{ $rental->user->name }}</p>
        <p><strong>Mobil:</strong> {{ $rental->car->brand }}</p>
        <p><strong>Tanggal Mulai:</strong> {{ $rental->start_date }}</p>
        <p><strong>Tanggal Selesai:</strong> {{ $rental->end_date }}</p>
        <p><strong>Status:</strong> {{ $rental->status }}</p>
        <p><strong>Total Biaya:</strong> {{ $rental->total_cost }}</p>
    </div>
    <a href="{{ route('rental.index') }}" class="btn btn-primary">Kembali</a>
@endsection
