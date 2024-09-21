@extends('layouts.app')

@section('content')
<div class="container">
    <a class="btn btn-primary mb-3" href="{{ route('cars.index') }}">Back to Cars</a>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <img class="card-img img-fluid w-100" src="{{ $car->image }}" alt="{{ $car->brand }}" style="height: 300px; object-fit: cover; border-radius: 10px;">
                    <h3 class="card-title mt-3">{{ $car->brand }} {{ $car->model }}</h3>
                    <p class="card-text"><strong>License Plate:</strong> {{ $car->license_plate }}</p>
                    <p class="card-text"><strong>Rental Rate:</strong> Rp{{ number_format($car->rental_rate, 0, ',', '.') }} per Hari</p>
                    <p class="card-text"><strong>Owner:</strong> {{ $car->user->name }}</p>
                    <p class="card-text"><strong>Rental Name:</strong> {{ $car->rental_name }}</p>

                    <!-- Cek jika pengguna saat ini bukan pemilik mobil, tampilkan tombol Sewa -->
                    @if (Auth::id() !== $car->user_id)
                        <form action="{{ route('rentals.store') }}" method="POST">
                            @csrf
                            <div class="form-group mt-3">
                                <label for="start_date">Start Date</label>
                                <input type="date" name="start_date" class="form-control" required>
                            </div>
                            <div class="form-group mt-3">
                                <label for="end_date">End Date</label>
                                <input type="date" name="end_date" class="form-control" required>
                            </div>

                            <input type="hidden" name="car_id" value="{{ $car->id }}">

                            <button type="submit" class="btn btn-primary mt-3">Sewa Mobil</button>
                        </form>
                    @else
                        <p class="mt-3 text-muted">Anda adalah pemilik mobil ini.</p>
                    @endif

                    <a href="{{ route('cars.index') }}" class="btn btn-secondary mt-3">Kembali ke Daftar Mobil</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
