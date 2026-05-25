<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>404 - Halaman Tidak Ditemukan | Eventic</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600|montserrat:400,500,600,700,800,900" rel="stylesheet" />

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('eventic.svg') }}" type="image/svg+xml">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="antialiased bg-[#F8FAFC] font-sans text-[#0F172A] selection:bg-[#4285F4] selection:text-white">
    <div class="min-h-screen flex flex-col items-center justify-center p-6 text-center relative overflow-hidden">
        
        <!-- Background Decorative Elements -->
        <div class="absolute top-0 left-0 w-full h-full -z-10 overflow-hidden pointer-events-none">
            <div class="absolute -top-24 -right-24 w-96 h-96 bg-[#4285F4]/5 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-[#3B82F6]/5 rounded-full blur-3xl"></div>
        </div>

        <!-- Logo -->
        <div class="mb-12 animate-fade-in">
            <a href="{{ url('/') }}" class="inline-flex items-center gap-3 group transition-transform duration-500 hover:scale-105">
                <img src="{{ asset('eventic.svg') }}" class="w-12 h-12" alt="Eventic Logo">
                <span class="text-3xl font-bold tracking-tight text-[#0F172A]" style="font-family: 'Montserrat', sans-serif;">Eventic</span>
            </a>
        </div>

        <!-- 404 Content -->
        <div class="relative max-w-2xl mx-auto flex items-center justify-center">
            <!-- Background 404 Text -->
            <h1 class="text-[12rem] sm:text-[20rem] font-black leading-none text-[#4285F4]/10 select-none tracking-tighter" style="font-family: 'Montserrat', sans-serif;">
                404
            </h1>
            
            <!-- Foreground Message -->
            <div class="absolute inset-0 flex flex-col items-center justify-center pt-8 sm:pt-12">
                <h2 class="text-3xl sm:text-6xl font-bold uppercase tracking-tighter mb-4 text-[#0F172A]" style="font-family: 'Montserrat', sans-serif;">
                    Error Not Found
                </h2>
                <div class="h-2 w-28 bg-[#4285F4] rounded-full mb-8 shadow-lg shadow-[#4285F4]/20"></div>
                <p class="text-gray-500 font-semibold text-base sm:text-xl max-w-lg mx-auto px-4 leading-relaxed italic">
                    "Oops! Halaman yang Anda cari sepertinya sedang berpesta di tempat lain atau tidak pernah ada."
                </p>
            </div>
        </div>

        <!-- Actions -->
        <div class="mt-16 flex flex-col sm:flex-row items-center gap-4 z-10">
            <a href="{{ url('/') }}" class="w-full sm:w-auto px-8 py-4 bg-[#4285F4] text-white font-bold rounded-2xl hover:bg-[#3b78e7] transition-all duration-300 shadow-xl shadow-[#4285F4]/25 transform hover:scale-105 active:scale-95 flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                Kembali ke Beranda
            </a>
            <a href="{{ url()->previous() }}" class="w-full sm:w-auto px-8 py-4 bg-white border-2 border-gray-100 text-[#0F172A] font-bold rounded-2xl hover:bg-gray-50 hover:border-gray-200 transition-all duration-300 transform hover:scale-105 active:scale-95 flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali
            </a>
        </div>

        <!-- Footer Note -->
        <div class="mt-24 text-gray-400 text-sm font-semibold tracking-wide flex flex-col items-center gap-2">
            <div class="flex items-center gap-2">
                <div class="w-1 h-1 bg-gray-300 rounded-full"></div>
                <div class="w-1 h-1 bg-gray-300 rounded-full"></div>
                <div class="w-1 h-1 bg-gray-300 rounded-full"></div>
            </div>
            <p>&copy; {{ date('Y') }} EVENTIC. ALL RIGHTS RESERVED.</p>
        </div>
    </div>
</body>
</html>
