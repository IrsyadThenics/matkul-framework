<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Court;
use App\Models\Admin;
use App\Models\Jadwal;

class CourtController extends Controller
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
            'name' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'harga' => 'required|integer',
        ]);
        Court::create([
            'name' => $request->name,
            'status' => $request->status,
            'harga' => $request->harga,
        ]);
        return redirect()->route('courts.index')->with('success', 'Court created successfully.');
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
            'name' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'harga' => 'required|integer',
        ]);
        $court = Court::findOrFail($id);
        $court->update([
            'name' => $request->name,
            'status' => $request->status,
            'harga' => $request->harga,
        ]);
        return redirect()->route('courts.index')->with('success', 'Court updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $court = Court::findOrFail($id);
        $court->delete();
        return redirect()->route('courts.index')->with('success', 'Court deleted successfully.');
    }
}
