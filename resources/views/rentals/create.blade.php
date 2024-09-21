

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ __('Rent a Car') }}</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('rentals.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="car_id" class="form-label">Pilih Mobil</label>
            <select class="form-control" id="car_id" name="car_id" required>
                <option value="">Pilih mobil...</option>
                @foreach ($cars as $car)
                    <option value="{{ $car->id }}">{{ $car->brand }} {{ $car->model }} - Rp{{ number_format($car->rental_rate, 0, ',', '.') }} per hari</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="start_date" class="form-label">Tanggal Mulai</label>
            <input type="date" class="form-control" id="start_date" name="start_date" required>
        </div>
        <div class="mb-3">
            <label for="end_date" class="form-label">Tanggal Selesai</label>
            <input type="date" class="form-control" id="end_date" name="end_date" required>
        </div>
        <button type="submit" class="btn btn-primary">Pesan Mobil</button>
    </form>
</div>
@endsection
