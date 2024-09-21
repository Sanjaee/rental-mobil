@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @foreach ($cars as $car)
        <div class="col-md-4">
            <div class="card mb-4">
                <img class="card-img-top" src="{{ $car->image }}" alt="{{ $car->brand }}" style="height: 200px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title">{{ $car->brand }} {{ $car->model }}</h5>
                    <p class="card-text">License Plate: {{ $car->license_plate }}</p>
                    <p class="card-text">Rental Rate: Rp{{ number_format($car->rental_rate, 0, ',', '.') }} per Hari</p>
                    <p class="card-text  fw-bold">Status: {{ $car->status }}</p>
                    @if ($car->status === 'tersedia')
                        <a href="{{ route('cars.show', $car->id) }}" class="btn btn-primary fw-bold ">Sewa Mobil</a>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
