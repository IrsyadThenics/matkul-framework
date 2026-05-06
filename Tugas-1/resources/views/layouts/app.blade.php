<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Arena Grid')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=JetBrains+Mono:wght@300;500&display=swap" rel="stylesheet">
    
    <style>
        :root { --lime: #ccff00; }
        body { background-color: #030400; color: #e0e0e0; font-family: 'JetBrains Mono', monospace; }
        .font-neon { font-family: 'Orbitron', sans-serif; }
        
        .lime-border { border: 1px solid var(--lime); box-shadow: 0 0 10px rgba(204, 255, 0, 0.3); }
        .lime-text { text-shadow: 0 0 10px #ccff00; color: #ccff00; }
        .bg-grid {
            background-image: linear-gradient(to right, #121500 1px, transparent 1px),
                              linear-gradient(to bottom, #121500 1px, transparent 1px);
            background-size: 30px 30px;
        }
        /* Scanline Effect */
        .scanline {
            width: 100%; height: 2px; background: rgba(204, 255, 0, 0.05);
            position: fixed; top: 0; left: 0; pointer-events: none; z-index: 100;
            animation: scan 4s linear infinite;
        }
        @keyframes scan { 0% { top: -5%; } 100% { top: 100%; } }
    </style>
</head>
<body class="bg-grid min-h-screen flex flex-col">
    <div class="scanline"></div>

    <nav class="fixed w-full z-50 py-4 px-8 border-b border-lime-500/20 bg-black/80 backdrop-blur-md flex justify-between items-center">
        <a href="/" class="text-xl font-neon font-bold text-[#ccff00] tracking-tighter">
            E<span class="text-white">-RESERVE_</span>
        </a>
        <div class="hidden md:flex items-center space-x-8 text-[10px] tracking-[0.2em] uppercase">
            <a href="/" class="hover:text-[#ccff00] transition {{ request()->is('home') ? 'lime-text' : '' }}">Home</a>
            <a href="/about" class="hover:text-[#ccff00] transition {{ request()->is('about') ? 'lime-text' : '' }}">About</a>
            <a href="/contact" class="hover:text-[#ccff00] transition {{ request()->is('contact') ? 'lime-text' : '' }}">Contact</a>
            <a href="/HalamanFitur" class="lime-border px-4 py-1 rounded-sm hover:bg-[#ccff00] hover:text-black transition">Fitur</a>
        </div>
    </nav>

    <main class="flex-grow pt-24">@yield('content')</main>

    <footer class="p-8 border-t border-lime-900/30 text-center text-[10px] text-lime-900 font-neon">
        Copyright © 2023 E-Reserv. All rights reserved.
    </footer>
</body>
</html>