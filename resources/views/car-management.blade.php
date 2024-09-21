@extends('layouts.app')

@section('content')
<div class="container">
    <a class="btn btn-primary mb-3" href="{{ route('cars.index') }}">Back to Cars</a>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Manajemen Mobil') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('car-management.store') }}">
                        @csrf

                         <!-- Image -->
                         <div class="row mb-3">
                            <label for="image" class="col-md-4 col-form-label text-md-end">{{ __('Gambar Mobil') }}</label>
                            <div class="col-md-6">
                                <input id="image" type="text" class="form-control @error('image') is-invalid @enderror" name="image" value="{{ old('image') }}" required autofocus>
                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Brand -->
                        <div class="row mb-3">
                            <label for="brand" class="col-md-4 col-form-label text-md-end">{{ __('Merek') }}</label>
                            <div class="col-md-6">
                                <input id="brand" type="text" class="form-control @error('brand') is-invalid @enderror" name="brand" value="{{ old('brand') }}" required autofocus>
                                @error('brand')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Model -->
                        <div class="row mb-3">
                            <label for="model" class="col-md-4 col-form-label text-md-end">{{ __('Model') }}</label>
                            <div class="col-md-6">
                                <input id="model" type="text" class="form-control @error('model') is-invalid @enderror" name="model" value="{{ old('model') }}" required>
                                @error('model')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- License Plate -->
                        <div class="row mb-3">
                            <label for="license_plate" class="col-md-4 col-form-label text-md-end">{{ __('Nomor Plat') }}</label>
                            <div class="col-md-6">
                                <input id="license_plate" type="text" class="form-control @error('license_plate') is-invalid @enderror" name="license_plate" value="{{ old('license_plate') }}" required>
                                @error('license_plate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Rental Rate -->
                        <div class="row mb-3">
                            <label for="rental_rate" class="col-md-4 col-form-label text-md-end">{{ __('Tarif Sewa per Hari') }}</label>
                            <div class="col-md-6">
                                <input id="rental_rate" type="number" step="0.01" class="form-control @error('rental_rate') is-invalid @enderror" name="rental_rate" value="{{ old('rental_rate') }}" required>
                                @error('rental_rate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Tambah Mobil') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
