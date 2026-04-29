<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Eventic - Events</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600|playfair-display:400,500,600,700" rel="stylesheet" />
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        .nav-shape {
            /* This gives the exact angled sides with rounded bottoms from the image */
            clip-path: polygon(0 0, 100% 0, 95% 100%, 5% 100%);
            border-bottom-left-radius: 1.5rem;
            border-bottom-right-radius: 1.5rem;
        }

        .hero-bg {
            background-image: url('https://images.unsplash.com/photo-1540039155732-68473678d4dd?q=80&w=2070&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
        }

        .text-shadow {
            text-shadow: 0px 4px 15px rgba(0, 0, 0, 0.6);
        }
    </style>
</head>
<body class="bg-white font-sans text-gray-900 antialiased h-screen flex flex-col overflow-hidden">
    
    <!-- Header -->
    <header class="w-full flex justify-between items-start px-8 lg:px-12 z-50 absolute top-0 left-0 right-0">
        <!-- Left: Logo & Brand -->
        <div class="flex items-center gap-3 pt-6 w-1/3">
            <svg class="w-8 h-8 text-[#3b82f6]" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <!-- Similar to Eventic logo -->
                <path d="M4 6L12 2L20 6V18L12 22L4 18V6Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                <path d="M4 6L12 10L20 6" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                <path d="M12 10V22" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                <path d="M8 8V16M16 8V16" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            </svg>
            <span class="text-2xl font-bold tracking-tight text-gray-900">Eventic</span>
        </div>

        <!-- Center: Navigation -->
        <nav class="bg-[#4285F4] text-white px-16 py-4 nav-shape flex items-center justify-center gap-8 shadow-lg w-auto relative -top-1">
            <a href="#" class="font-medium text-sm lg:text-base hover:text-blue-100 transition">Beranda</a>
            <a href="#" class="font-medium text-sm lg:text-base hover:text-blue-100 transition">About</a>
            <a href="#" class="font-medium text-sm lg:text-base hover:text-blue-100 transition">Event</a>
            <a href="#" class="font-medium text-sm lg:text-base hover:text-blue-100 transition">Hubungi Kami</a>
        </nav>

        <!-- Right: Auth Links -->
        <div class="flex items-center justify-end gap-6 pt-5 w-1/3">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="font-bold text-gray-900 hover:text-blue-600 transition">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="font-bold text-gray-900 hover:text-blue-600 transition text-sm lg:text-base">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="px-6 py-2.5 bg-[#4285F4] text-white font-medium rounded-lg hover:bg-blue-600 transition shadow-md text-sm lg:text-base">Register</a>
                    @endif
                @endauth
            @endif
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow p-4 pt-[5rem] pb-4 w-full h-full flex">
        <!-- Hero Section -->
        <div class="w-full h-full relative rounded-[2.5rem] overflow-hidden hero-bg flex items-center shadow-2xl">
            <!-- Dark Overlay -->
            <div class="absolute inset-0 bg-black/45"></div>
            
            <!-- Text Content -->
            <div class="relative z-10 px-12 md:px-24 w-full text-white">
                <div class="flex flex-col max-w-3xl">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="bg-black/70 rounded-full p-2.5 flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        </div>
                        <div>
                            <p class="font-bold text-sm tracking-wide text-shadow">5.0 Rated</p>
                            <a href="#" class="text-sm underline underline-offset-4 opacity-90 hover:opacity-100 transition text-shadow">Read Our Success Stories</a>
                        </div>
                    </div>

                    <h1 class="text-7xl md:text-[8rem] lg:text-[10rem] font-bold mb-4 tracking-tighter text-shadow" style="font-family: 'Playfair Display', serif; line-height: 1;">
                        Events
                    </h1>
                    
                    <p class="text-xl md:text-2xl font-medium max-w-xl leading-relaxed opacity-95 text-shadow" style="font-family: 'Instrument Sans', sans-serif;">
                        Easily Add And Organize Events, With Notifications To Keep Everyone Engaged
                    </p>
                </div>
            </div>
        </div>
    </main>

</body>
</html>
