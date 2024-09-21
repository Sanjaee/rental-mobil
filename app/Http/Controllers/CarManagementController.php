<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car; // Pastikan model Car sudah ada

class CarManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']); // Menambahkan middleware untuk otentikasi dan verifikasi email
    }

    public function index()
    {
        return view('car-management');
    }

    public function store(Request $request)
    {
       
    
        Car::create([
            'user_id' => auth()->id(),
            'image' => $request->image,
            'brand' => $request->brand,
            'model' => $request->model,
            'license_plate' => $request->license_plate,
            'rental_rate' => $request->rental_rate,
            'rental_name' => auth()->user()->name,
        ]);
    
        return redirect()->route('cars.index')->with('success', 'Mobil berhasil ditambahkan!');
    }
    
}
