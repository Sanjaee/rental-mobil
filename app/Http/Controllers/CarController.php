<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use Illuminate\Support\Facades\Auth;

class CarController extends Controller
{
    public function __construct()
    {
        // Hanya metode myRentals yang membutuhkan autentikasi
        $this->middleware(['auth', 'verified'])->only('myRentals');
    }

    // Menampilkan semua mobil yang disewakan (Publik)
    public function index()
    {
        $cars = Car::with('user')->get();
        return view('cars.index', compact('cars'));
    }

    public function show($id)
    {
        $car = Car::with('user')->findOrFail($id);
        return view('cars.show', compact('car'));
    }

    // Menampilkan mobil yang disewakan oleh pengguna saat ini (Harus Login)
    public function myRentals()
    {
        $user = Auth::user();
        $myCars = Car::where('user_id', $user->id)
                     ->with('rental.user') // Memuat relasi rental dan user
                     ->get();
        return view('cars.my_rentals', compact('myCars'));
    }
    
}