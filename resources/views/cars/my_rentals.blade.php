@extends('layouts.app')

@section('content')
<div class="container">
    <a class="btn btn-primary mb-3" href="{{ route('cars.index') }}">Back to Cars</a>
    <div class="row">
        @foreach ($myCars as $car)
        <div class="col-md-4">
            <div class="card mb-4">
                <img class="card-img-top" src="{{ $car->image }}" alt="{{ $car->brand }}" style="height: 200px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title">{{ $car->brand }} {{ $car->model }}</h5>
                    <p class="card-text">License Plate: {{ $car->license_plate }}</p>
                    <p class="card-text">Rental Rate: Rp{{ number_format($car->rental_rate, 0, ',', '.') }} per Hari</p>
                    
                    <!-- Kondisi untuk menampilkan warna berdasarkan status -->
                    <p class="card-text fw-bold {{ $car->status === 'sedang di sewa' ? 'text-danger' : 'text-success' }}">
                        Status: {{ $car->status }}
                    </p>

                    <!-- Tampilkan nama penyewa jika mobil sedang disewa -->
                    @if ($car->status === 'sedang di sewa')
                        @if ($car->rental && $car->rental->user)
                            <p class="card-text">Penyewa: {{ $car->rental->user->name }}</p>
                        @else
                            <p class="card-text">Penyewa tidak diketahui</p>
                        @endif
                    @else
                        <p class="card-text text-success fw-bold">Mobil tersedia</p>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
