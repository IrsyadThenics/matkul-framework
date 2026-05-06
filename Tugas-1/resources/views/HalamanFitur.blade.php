@extends('layouts.app')

@section('title', 'Fitur // Arena Grid')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-10 relative">
    <div class="mb-16 border-l-4 border-[#ccff00] pl-6">
        <h1 class="text-4xl font-neon font-bold lime-text mb-2 tracking-widest uppercase">
            System_Features
        </h1>
        <p class="text-gray-500 font-mono text-sm uppercase tracking-[0.3em]">
            Mengoptimalkan pengalaman reservasi melalui protokol digital.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        
        <div class="group relative p-8 bg-black/40 border border-lime-900/30 hover:border-[#ccff00] transition-all duration-500 backdrop-blur-sm overflow-hidden">
            <div class="absolute top-0 right-0 p-2 text-[8px] text-lime-900 font-mono group-hover:text-[#ccff00]">
                
            </div>
            
            <div class="mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 lime-text" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            
            <h3 class="text-xl font-neon font-bold text-white mb-4 group-hover:lime-text transition-colors">
                UP-TO-DATE
            </h3>
            <p class="text-gray-400 text-xs leading-relaxed font-mono">
                Kami menyediakan pemantauan jadwal yang selalu up-to-date, memungkinkan Anda untuk membuat keputusan reservasi yang tepat waktu.
            </p>
            
            <div class="mt-6 h-1 w-0 bg-[#ccff00] group-hover:w-full transition-all duration-500"></div>
        </div>

        <div class="group relative p-8 bg-black/40 border border-lime-900/30 hover:border-[#ccff00] transition-all duration-500 backdrop-blur-sm overflow-hidden">
            <div class="absolute top-0 right-0 p-2 text-[8px] text-lime-900 font-mono group-hover:text-[#ccff00]">
                
            </div>

            <div class="mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 lime-text" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
            </div>
            
            <h3 class="text-xl font-neon font-bold text-white mb-4 group-hover:lime-text transition-colors">
                SISTEM_MATCHING
            </h3>
            <p class="text-gray-400 text-xs leading-relaxed font-mono">
                Sistem kami bisa menemukan teman bermain Anda berdasarkan preferensi dan jadwal yang tersedia.
            </p>
            
            <div class="mt-6 h-1 w-0 bg-[#ccff00] group-hover:w-full transition-all duration-500"></div>
        </div>

        

    </div>

    <div class="mt-20 border border-dashed border-lime-500/30 p-10 text-center relative">
        <div class="absolute -top-3 left-1/2 -translate-x-1/2 bg-[#030400] px-4 font-mono text-[10px] text-lime-500 uppercase tracking-widest">
            Ready to Initialize?
        </div>
        <h2 class="text-2xl font-neon text-white mb-6 tracking-tighter">MASUK KE DALAM DASHBOARD SEKARANG</h2>
        <a href="{{ route('admins.index') }}" class="inline-block lime-border px-10 py-3 font-neon text-xs tracking-[0.2em] text-[#ccff00] hover:bg-[#ccff00] hover:text-black hover:shadow-[0_0_20px_#ccff00] transition-all duration-300">
            START NOW
        </a>
    </div>
</div>
@endsection