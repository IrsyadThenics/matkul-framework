<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;

class BookingController extends Controller
{
        // app/Http/Controllers/BookingClientController.php

public function index()
{
    // 1. Ambil data dari API Project A
    $response = Http::get('http://127.0.0.1:8080/api/bookings');

    if ($response->successful()) {
        // 2. Ambil bagian "data" dari JSON
        $bookings = $response->json()['data']; 

        // 3. Kirim ke view 'bookings.index'
        return view('bookings.index', compact('bookings'));
    }

    return abort(500, 'Gagal terhubung ke API');
}

// Masih di dalam Controller yang sama di Project B

public function approve($id)
{
    // Letakkan di sini untuk menyuruh Backend (Project A) mengubah status
    $response = Http::patch("http://127.0.0.1:8080/api/bookings/{$id}/approve");

    if ($response->successful()) {
        return redirect()->route('booking.index')->with('success', 'Booking berhasil disetujui!');
    }

    return back()->withErrors('Gagal mengupdate status.');
}
}
