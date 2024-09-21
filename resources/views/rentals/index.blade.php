@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Daftar Mobil yang Disewa</h3>
    @if($rentals->isEmpty())
        <p>{{ __('Anda belum menyewa mobil apapun.') }}</p>
    @else
        <div class="row">
            @foreach($rentals as $rental)
                <div class="col-md-6">
                    <div class="card mb-4 shadow-sm" style="border-radius: 10px;">
                        <div class="card-body">
                            <img class="card-img img-fluid w-100" src="{{ $rental->car->image }}" style="height: 200px; object-fit: cover; border-radius: 10px 10px 0 0;">
                            <h5 class="card-title mt-3">{{ $rental->car->brand }} {{ $rental->car->model }}</h5>
                            <p class="card-text"><strong>Tanggal Mulai:</strong> {{ $rental->start_date }}</p>
                            <p class="card-text"><strong>Tanggal Selesai:</strong> {{ $rental->end_date }}</p>
                            <p class="card-text"><strong>Total Biaya Sewa:</strong> Rp{{ number_format($rental->total_cost, 0, ',', '.') }}</p>
                            <p class="card-text"><strong>Pemilik Mobil:</strong> {{ $rental->car->user->name }}</p>
                            <p class="card-text"><strong>Nama Peminjam:</strong> {{ $rental->renter_name }}</p> 
                            <form action="{{ route('rentals.return') }}" method="POST">
                                @csrf
                                <input type="hidden" name="license_plate" value="{{ $rental->car->license_plate }}">
                                <button type="submit" class="btn btn-danger">Bayar</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
