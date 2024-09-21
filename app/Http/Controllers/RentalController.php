<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class RentalController extends Controller
{
    // Tampilkan form peminjaman mobil
    public function create()
    {
        // Menampilkan hanya mobil yang tersedia
        $cars = Car::where('status', 'tersedia')->get();
        return view('rentals.create', compact('cars'));
    }

    // Proses penyimpanan peminjaman mobil
    public function store(Request $request)
    {
        $request->validate([
            'car_id' => 'required|exists:cars,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
        ]);

        // Verifikasi ketersediaan mobil
        $car = Car::findOrFail($request->car_id);
        $isAvailable = Rental::where('car_id', $car->id)
            ->where(function ($query) use ($request) {
                $query->whereBetween('start_date', [$request->start_date, $request->end_date])
                      ->orWhereBetween('end_date', [$request->start_date, $request->end_date]);
            })->doesntExist() && $car->status === 'tersedia';

        if (!$isAvailable) {
            return back()->withErrors(['error' => 'Mobil tidak tersedia pada tanggal yang dipilih.']);
        }

        // Hitung jumlah hari sewa
        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);
        $days = $endDate->diffInDays($startDate) + 1;

        // Hitung total biaya sewa
        $totalCost = $days * $car->rental_rate;

        // Simpan data peminjaman
        Rental::create([
            'user_id' => Auth::id(),
            'car_id' => $car->id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'total_cost' => $totalCost,
            'renter_name' => Auth::user()->name, // Menyimpan nama peminjam
        ]);

        // Update status mobil
        $car->update(['status' => 'sedang di sewa']);

        return redirect()->route('rentals.index')->with('success', 'Mobil berhasil dipesan. Total biaya sewa: Rp' . number_format($totalCost, 0, ',', '.'));
    }

    // Tampilkan daftar mobil yang sedang disewa oleh user
    public function index()
    {
        $rentals = Rental::where('user_id', Auth::id())->with('car')->get();
        return view('rentals.index', compact('rentals'));
    }

    // Tampilkan form pengembalian mobil
    public function showReturnForm()
    {
        return view('rentals.return');
    }

    // Proses pengembalian mobil
    public function returnCar(Request $request)
    {
        $request->validate([
            'license_plate' => 'required|exists:cars,license_plate',
        ]);

        // Cari rental berdasarkan plat nomor dan user
        $rental = Rental::whereHas('car', function ($query) use ($request) {
            $query->where('license_plate', $request->license_plate);
        })->where('user_id', Auth::id())
        ->first();

        if (!$rental) {
            return back()->withErrors(['error' => 'Mobil tidak ditemukan atau tidak disewa oleh Anda.']);
        }

        // Hitung total biaya berdasarkan tarif harian dan durasi sewa
        $startDate = Carbon::parse($rental->start_date);
        $endDate = Carbon::now();
        $daysRented = $startDate->diffInDays($endDate) + 1;
        $totalCost = $daysRented * $rental->car->rental_rate;

        // Simpan pengembalian mobil (misalnya hapus dari daftar rental)
        $rental->delete();

        // Update status mobil
        $car = $rental->car;
        $car->update(['status' => 'tersedia']);

        return redirect()->route('rentals.index')->with('success', 'Mobil berhasil dikembalikan. Total biaya: Rp' . number_format($totalCost, 0, ',', '.') . ' untuk ' . $daysRented . ' hari.');
    }
}
