<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Booking::with(['user', 'court'])->latest()->get();
        return response()->json([
            'data' => $bookings->map(function($booking) {
                return [
                    'id' => $booking->id,
                    'booking_code' => $booking->booking_code,
                    'user' => $booking->user,
                    'court' => $booking->court,
                    'date' => $booking->date,
                    'start_time' => $booking->start_time,
                    'end_time' => $booking->end_time,
                    'duration_hours' => $booking->duration_hours,
                    'total_price' => $booking->total_price,
                    'status' => $booking->status,
                    'created_at' => $booking->created_at,
                ];
            })
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
            'user_id'        => 'required|exists:users,id',
            'court_id'       => 'required|exists:courts,id',
            'date'           => 'required|date',
            'start_time'     => ['required', 'regex:/^\d{2}:\d{2}(:\d{2})?$/'],
            'end_time'       => ['required', 'regex:/^\d{2}:\d{2}(:\d{2})?$/'],
            'duration_hours' => 'required|integer|min:1',
            'total_price'    => 'required|integer|min:0',
        ]);

        $booking = Booking::create([
            'booking_code'   => 'BK' . strtoupper(Str::random(8)),
            'user_id'        => $request->user_id,
            'court_id'       => $request->court_id,
            'date'           => $request->date,
            'start_time'     => $request->start_time,
            'end_time'       => $request->end_time,
            'duration_hours' => $request->duration_hours,
            'total_price'    => $request->total_price,
            'status'         => 'pending',
        ]);

        if ($request->wantsJson()) {
            return response()->json($booking->load(['user', 'court']), 201);
        }

        return redirect()->route('admin.dashboard')
            ->with('success', 'Booking berhasil dibuat.')
            ->withInput(['currentTab' => 'bookings']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $booking = Booking::with(['user', 'court'])->findOrFail($id);
        return response()->json($booking);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'user_id'        => 'sometimes|exists:users,id',
            'court_id'       => 'sometimes|exists:courts,id',
            'date'           => 'sometimes|date',
            'start_time'     => ['sometimes', 'regex:/^\d{2}:\d{2}(:\d{2})?$/'],
            'end_time'       => ['sometimes', 'regex:/^\d{2}:\d{2}(:\d{2})?$/'],
            'duration_hours' => 'sometimes|integer|min:1',
            'total_price'    => 'sometimes|integer|min:0',
            'status'         => 'sometimes|in:pending,approved,rejected',
        ]);

        $booking = Booking::findOrFail($id);
        $booking->update($request->all());

        if ($request->wantsJson()) {
            return response()->json($booking->load(['user', 'court']));
        }

        return redirect()->route('admin.dashboard')
            ->with('success', 'Booking berhasil diupdate.')
            ->withInput(['currentTab' => 'bookings']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        Booking::findOrFail($id)->delete();

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Booking berhasil dihapus']);
        }

        return redirect()->route('admin.dashboard')
            ->with('success', 'Booking berhasil dihapus.')
            ->withInput(['currentTab' => 'bookings']);
    }

    public function approve(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $booking->update(['status' => 'approved']);

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Booking disetujui', 'booking' => $booking]);
        }

        return redirect()->route('admin.dashboard')
            ->with('success', 'Booking berhasil disetujui.')
            ->withInput(['currentTab' => 'bookings']);
    }

    // Reject booking
    public function reject(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $booking->update(['status' => 'rejected']);

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Booking ditolak', 'booking' => $booking]);
        }

        return redirect()->route('admin.dashboard')
            ->with('success', 'Booking berhasil ditolak.')
            ->withInput(['currentTab' => 'bookings']);
    }

    // Booking by user
    public function byUser($userId)
    {
        $bookings = Booking::with(['user', 'court'])
            ->where('user_id', $userId)
            ->latest()
            ->get();
        return response()->json($bookings);
    }
}
