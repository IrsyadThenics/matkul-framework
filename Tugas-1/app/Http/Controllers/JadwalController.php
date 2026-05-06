<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;
use App\Models\Admin;
use App\Models\Court;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = Admin::all();
        $courts = Court::all();
        $jadwals = Jadwal::with('court')->get();
        return view('HalamanAdmin', compact('admins', 'courts', 'jadwals'));
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
            'court_id' => 'required',
            'tanggal' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'harga' => 'required',
            'status' => 'required',
        ]);

        Jadwal::create($request->all());

        return redirect()->route('jadwal.index')
            ->with('success', 'Jadwal created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
            'court_id' => 'required',
            'tanggal' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'harga' => 'required',
            'status' => 'required',
        ]);

        $jadwal = Jadwal::find($id);
        $jadwal->update($request->all());

        return redirect()->route('jadwal.index')
            ->with('success', 'Jadwal updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jadwal = Jadwal::find($id);
        $jadwal->delete();

        return redirect()->route('jadwal.index')
            ->with('success', 'Jadwal deleted successfully.');
    }
}
