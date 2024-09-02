@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-xl-4 col-md-6">
        <div class="mb-4 text-white card bg-primary">
            <div class="card-body">{{ $car }} Mobil</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="text-white small stretched-link" href="{{ route('car.index') }}">View Details</a>
                <div class="text-white small"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-6">
        <div class="mb-4 text-white card bg-warning">
            <div class="card-body">{{ $user }} Pelanggan</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="text-white small stretched-link" href="{{ route('user.index') }}">View Details</a>
                <div class="text-white small"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-6">
        <div class="mb-4 text-white card bg-success">
            <div class="card-body">{{ $rental }} Penyewaan Mobil</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="text-white small stretched-link" href="{{ route('rentals.index') }}">View Details</a>
                <div class="text-white small"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-6">
        <div class="mb-4 text-white card bg-danger">
            <div class="card-body">{{ $returns }} Pengembalian Mobil</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="text-white small stretched-link" href="{{ route('returns.index') }}">View Details</a>
                <div class="text-white small"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
</div>
@endsection
