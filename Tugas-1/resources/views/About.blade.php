@extends('layouts.app')

@section('content')
<section class="max-w-5xl mx-auto px-8 py-16">
    <div class="border-l-2 border-[#ccff00] pl-8 space-y-12">
        <div class="space-y-4">
            <h1 class="text-6xl font-neon font-bold tracking-tighter italic">Tentang_kami</h1>
            <p class="text-xl text-zinc-400 max-w-2xl leading-relaxed">
                Arena Grid adalah sistem manajemen lapangan berbasis <span class="text-[#ccff00]">Web dan Mobile.</span> Kami memudahkan anda dalam proses reservasi lapangan.
            </p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 pt-10">
            <div class="p-6 bg-zinc-900/30 border border-zinc-800">
                <h3 class="text-[#ccff00] font-neon text-xs mb-2 uppercase">up-to-date</h3>
                <p class="text-zinc-500 text-sm">Kami menyediakan pemantauan jadwal yang selalu up-to-date, memungkinkan Anda untuk membuat keputusan reservasi yang tepat waktu.</p>
            </div>
            <div class="p-6 bg-zinc-900/30 border border-zinc-800">
                <h3 class="text-[#ccff00] font-neon text-xs mb-2 uppercase">Sistem Matching</h3>
                <p class="text-zinc-500 text-sm">Sistem kami bisa menemukan teman bermain Anda berdasarkan preferensi dan jadwal yang tersedia.</p>
            </div>
        </div>
    </div>
</section>
@endsection