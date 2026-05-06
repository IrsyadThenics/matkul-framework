@extends('layouts.app')

@section('content')
<div class="bg-black text-zinc-100 min-h-screen selection:bg-[#ccff00] selection:text-black" x-data="{ selectedCourt: null }">

    <nav class="flex justify-between items-center px-8 py-6 max-w-7xl mx-auto">
    </nav>

    <header class="max-w-5xl mx-auto px-6 pt-20 pb-16 text-center">
        <h1 class="text-5xl md:text-7xl font-neon leading-tight mb-6 bg-gradient-to-b from-white to-zinc-500 bg-clip-text text-transparent">
            E-RESERVE<br> <span class="text-[#ccff00]">BOOKING LAPANGAN.</span>
        </h1>
        <p class="text-zinc-400 text-lg md:text-xl max-w-2xl mx-auto mb-10 leading-relaxed">
            Sistem reservasi lapangan yang memudahkan Anda memesan arena favorit dengan cepat dan aman. Nikmati pengalaman booking yang mulus tanpa hambatan.
        </p>
        <div class="flex flex-col md:flex-row justify-center gap-4">
            <a href="{{ route('admins.index') }}" class="px-8 py-4 bg-[#ccff00] text-black font-bold rounded-full hover:shadow-[0_0_20px_rgba(204,255,0,0.3)] transition-all">
                Mulai Reservasi
            </a>
        </div>
    </header>




</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Inter:wght@300;400;600&display=swap');

    .font-neon {
        font-family: 'Orbitron', sans-serif;
    }

    body {
        font-family: 'Inter', sans-serif;
    }

    /* Smooth Scroll */
    html {
        scroll-behavior: smooth;
    }

    /* Custom Gradient Text */
    .lime-gradient {
        background: linear-gradient(180deg, #ccff00 0%, #99cc00 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
</style>
<div class="max-w-6xl mx-auto px-4 py-10" x-data="{ 
    selectedCourt: null, 
    jadwals: @js($jadwals) 
}">
    <div class="mb-12 text-center">
        <h1 class="text-4xl font-neon lime-text mb-2">FIELD_SELECTION</h1>
        <p class="text-zinc-500 text-xs tracking-widest">MAP_VERSION_2.0 // SELECT AVAILABLE SECTOR</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        <div class="lg:col-span-2 bg-zinc-900/20 border border-zinc-800 p-8 rounded-3xl relative overflow-hidden">
            <div class="grid grid-cols-2 gap-6 relative z-10">
                @foreach($courts as $court)
                <div @click="selectedCourt = @js($court)"
                    :class="selectedCourt && selectedCourt.id === {{ $court->id }} ? 'border-[#ccff00] bg-[#ccff00]/10' : 'border-zinc-800 bg-black/40'"
                    class="h-48 rounded-xl border-2 flex flex-col items-center justify-center cursor-pointer transition-all hover:shadow-[0_0_20px_rgba(204,255,0,0.2)] group">
                    <div :class="selectedCourt && selectedCourt.id === {{ $court->id }} ? 'bg-[#ccff00]' : 'bg-zinc-800'" class="w-12 h-1 mb-4"></div>
                    <span class="font-neon text-sm" :class="selectedCourt && selectedCourt.id === {{ $court->id }} ? 'text-[#ccff00]' : 'text-zinc-500'">{{ $court->name }}</span>
                </div>
                @endforeach
            </div>
            <div class="absolute inset-0 pointer-events-none opacity-20 bg-[radial-gradient(circle,rgba(204,255,0,0.1)_1px,transparent_1px)] bg-[size:20px_20px]"></div>
        </div>

        <div class="bg-zinc-950 border border-lime-500/30 p-8 rounded-3xl shadow-[0_0_30px_rgba(0,0,0,1)]">
            <h2 class="font-neon text-sm text-zinc-400 mb-6 uppercase tracking-tighter">Sector_Data</h2>
            <template x-if="selectedCourt">
                <div class="space-y-6">
                    <div class="text-3xl font-neon text-white" x-text="selectedCourt.name"></div>
                    <div class="space-y-4">
                        <p class="text-xs text-zinc-500">AVAILABLE_TIME_SLOTS:</p>
                        <div class="grid grid-cols-2 gap-2">
                            <template x-for="jadwal in jadwals.filter(j => j.court_id === selectedCourt.id)" :key="jadwal.id">
                                <button class="py-2 border border-zinc-800 rounded text-[10px] hover:border-[#ccff00] hover:text-[#ccff00] transition" x-text="jadwal.jam_mulai.substring(0, 5) + ' - ' + jadwal.jam_selesai.substring(0, 5)"></button>
                            </template>
                        </div>
                        <template x-if="jadwals.filter(j => j.court_id === selectedCourt.id).length === 0">
                            <p class="text-[10px] text-red-500 italic">NO_AVAILABLE_SLOTS_FOR_THIS_SECTOR</p>
                        </template>
                    </div>
                    <button class="w-full py-4 bg-[#ccff00] text-black font-neon font-bold text-xs tracking-widest hover:brightness-110 active:scale-95 transition">INITIALIZE_BOOKING</button>
                </div>
            </template>
            <template x-if="!selectedCourt">
                <div class="h-full flex items-center justify-center text-zinc-700 italic text-sm">
                    WAITING_FOR_INPUT...
                </div>
            </template>
        </div>
    </div>
</div>
@endsection