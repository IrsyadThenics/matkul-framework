<?php

namespace App\Http\Controllers;

use App\Models\Court;
use App\Models\Jadwal;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $courts = Court::all();
        $jadwals = Jadwal::with('court')->where('status', 'tersedia')->get();
        return view('Home', compact('courts', 'jadwals'));
    }
}
