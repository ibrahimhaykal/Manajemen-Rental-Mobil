@extends('layouts.main')

@section('content')
<h1 class="mt-4">Dashboard</h1>
<ol class="mb-4 breadcrumb">
    <li class="breadcrumb-item active">Dashboard</li>
</ol>
<div class="d-flex">
    <a href="{{ route('rental.create') }}" class="btn btn-primary">Tambah Transaksi</a>
</div>
<div class="mt-3 justify-content-center">
    <form action="{{ route('rental.index') }}" method="GET">
        <div class="row">
            <div class="col">
                <div class="mb-3 input-group">
                    <input type="text" value="{{ Request::input('search') }}" class="form-control" placeholder="search . . ." name="search">
                </div>
            </div>
            <div class="col-1">
                <button class="btn btn-outline-primary" type="submit">Search</button>
            </div>
        </div>
    </form>
</div>
<table class="table table-bordered yajra-datatable">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Pelanggan</th>
            <th scope="col">Mobil</th>
            <th scope="col">Tanggal mulai</th>
            <th scope="col">Tanggal selesai</th>
            <th scope="col">Status</th>
            <th scope="col">Total</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td colspan="8" class="text-center">
                Belum ada data
            </td>
        </tr>
    </tbody>
</table>
@endsection

@push('style')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" />
<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

@push('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.show-detail').click(function() {
            var rentalId = $(this).data('rental-id');
            var detailRow = $('#detail-row-' + rentalId);
            
            if (detailRow.is(':visible')) {
                detailRow.hide();
            } else {
                $('.detail-row').hide(); // Menyembunyikan semua detail lainnya
                detailRow.show(); // Menampilkan detail yang dipilih
                // Request AJAX untuk mendapatkan detail rental dan menampilkan di dalam detail-info
                $.get("{{ url('rental') }}/" + rentalId, function(data) {
                    $('#detail-row-' + rentalId + ' .detail-info').html(data);
                });
            }
        });
    });
</script>
<script type="text/javascript">
    $(function() {
        var table = $('.yajra-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('rental.index') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'user.name', name: 'user.name' },
                { data: 'car.brand', name: 'car.brand' },
                { data: 'start_date', name: 'start_date' },
                { data: 'end_date', name: 'end_date' },
                { data: 'status', name: 'status' },
                { data: 'total_cost', name: 'total_cost' },
                { data: 'action', name: 'action', orderable: true, searchable: true }
            ]
        });
    });
</script>
@endpush 