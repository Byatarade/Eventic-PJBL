<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Eventic - Events</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('eventic.svg') }}">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600|playfair-display:400,500,600,700|montserrat:400,500,600,700,800,900" rel="stylesheet" />
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
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
<body class="bg-white font-sans text-gray-900 antialiased relative">
    
    <!-- Navbar Component -->
    <x-navbar />

    <!-- Main Content -->
    <main class="w-full">
        <!-- Hero Section Container -->
        <div class="p-4 pt-[8rem] pb-4 w-full h-screen flex flex-col" 
             x-data="{ 
                activeSlide: 0, 
                slidesCount: {{ $events->count() > 0 ? $events->count() : 1 }},
                interval: null,
                next() { this.activeSlide = (this.activeSlide + 1) % this.slidesCount },
                start() { if(this.slidesCount > 1) this.interval = setInterval(() => this.next(), 6000) },
                stop() { clearInterval(this.interval) },
                init() { this.start() }
             }"
             @mouseenter="stop"
             @mouseleave="start">
            <div class="w-full flex-grow relative rounded-[2.5rem] overflow-hidden flex items-center shadow-2xl bg-gray-900">
                
                @if($events->count() > 0)
                    @foreach($events as $index => $event)
                        <div x-show="activeSlide === {{ $index }}" 
                             x-transition:enter="transition ease-out duration-1000"
                             x-transition:enter-start="opacity-0 scale-105"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-1000"
                             x-transition:leave-start="opacity-100"
                             x-transition:leave-end="opacity-0"
                             class="absolute inset-0 w-full h-full">
                            
                            <!-- Background Image -->
                            <div class="absolute inset-0 bg-cover bg-center transition-transform duration-[10000ms] ease-linear transform scale-110"
                                 :class="activeSlide === {{ $index }} ? 'scale-100' : 'scale-110'"
                                 style="background-image: url('{{ $event->image ? asset('storage/' . $event->image) : 'https://images.unsplash.com/photo-1540039155732-68473678d4dd?q=80&w=2070&auto=format&fit=crop' }}')">
                            </div>

                            <!-- Dark Overlay -->
                            <div class="absolute inset-0 bg-black/50 backdrop-blur-[2px]"></div>
                            
                            <!-- Text Content -->
                                    <div class="w-full h-full max-w-7xl mx-auto px-6 lg:px-12 flex items-center" style="font-family: 'Montserrat', sans-serif;">
                                        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8 items-center w-full mt-12 lg:mt-0">
                                            
                                            <!-- Content Left -->
                                            <div class="lg:col-span-7 flex flex-col items-center lg:items-start text-center lg:text-left"
                                                 x-show="activeSlide === {{ $index }}"
                                                 x-transition:enter="transition ease-out duration-1000 delay-300"
                                                 x-transition:enter-start="opacity-0 -translate-x-12"
                                                 x-transition:enter-end="opacity-100 translate-x-0">
                                                
                                                <!-- Top Info Pill -->
                                                <div class="inline-flex px-4 py-2 bg-white/10 backdrop-blur-xl border border-white/20 rounded-full items-center gap-3 mb-6 lg:mb-8 shadow-[0_10px_30px_rgba(0,0,0,0.3)]">
                                                    <div class="flex items-center gap-2">
                                                        <div class="w-2 h-2 bg-[#4285F4] rounded-full shadow-[0_0_10px_#4285F4] animate-pulse"></div>
                                                        <span class="text-[10px] font-black tracking-[0.3em] uppercase text-white/90">LIVE EVENT</span>
                                                    </div>
                                                </div>

                                                <!-- Massive Title -->
                                                <h1 class="font-black tracking-tighter text-white mb-8 drop-shadow-[0_10px_20px_rgba(0,0,0,0.5)] uppercase leading-[0.9]" 
                                                    :class="'{{ strlen($event->name) }}' > 15 ? 'text-5xl md:text-6xl lg:text-7xl' : 'text-6xl md:text-7xl lg:text-8xl'">
                                                    {{ $event->name }}
                                                </h1>

                                                <!-- Actions & Meta -->
                                                <div class="flex flex-col sm:flex-row items-center gap-4 sm:gap-6 mt-4 relative z-50">
                                                    <a href="#" class="h-14 px-8 bg-blue-500 text-white font-black rounded-full hover:bg-blue-600 transition-all duration-300 shadow-xl shadow-blue-500/40 flex items-center justify-center gap-3 w-full sm:w-auto transform hover:scale-105 active:scale-95">
                                                        <span class="uppercase tracking-widest text-sm">Beli Tiket</span>
                                                        <div class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center transition-colors">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                                        </div>
                                                    </a>

                                                    <div class="flex items-center gap-4 px-5 py-2.5 bg-black/40 backdrop-blur-md border border-white/10 rounded-full cursor-default w-full sm:w-auto justify-center sm:justify-start">
                                                        <div class="w-9 h-9 rounded-full bg-gradient-to-tr from-gray-200 to-white flex items-center justify-center text-gray-900 font-black text-sm shadow-inner">
                                                            {{ substr($event->organizer_name ?: 'E', 0, 1) }}
                                                        </div>
                                                        <div class="flex flex-col text-left">
                                                            <span class="text-[9px] font-black text-white/50 uppercase tracking-[0.2em] mb-0.5">Penyelenggara</span>
                                                            <span class="text-xs font-black text-white uppercase tracking-wider">{{ $event->organizer_name ?: 'Eventic' }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Visual Right / Ticket Card -->
                                            <div class="lg:col-span-5 hidden lg:flex justify-end"
                                                 x-show="activeSlide === {{ $index }}"
                                                 x-transition:enter="transition ease-out duration-1000 delay-700"
                                                 x-transition:enter-start="opacity-0 translate-x-12"
                                                 x-transition:enter-end="opacity-100 translate-x-0">
                                                
                                                <div class="relative w-full max-w-[340px] transform rotate-3 hover:rotate-0 transition-transform duration-700 mt-10 lg:mt-0">
                                                    <!-- Glowing backdrop -->
                                                    <div class="absolute inset-0 bg-[#4285F4] blur-[80px] opacity-30 rounded-full"></div>
                                                    
                                                    <!-- Ticket Container -->
                                                    <div class="relative bg-white/10 backdrop-blur-2xl border border-white/20 rounded-3xl p-8 shadow-[0_30px_60px_rgba(0,0,0,0.5)] overflow-hidden">
                                                        <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full blur-2xl -mr-10 -mt-10"></div>
                                                        
                                                        <div class="flex flex-col gap-8">
                                                            <!-- Detail Row: Date -->
                                                            <div class="flex items-start gap-4">
                                                                <div class="w-12 h-12 rounded-2xl bg-white/10 flex items-center justify-center border border-white/10 text-[#4285F4] shadow-inner shrink-0">
                                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                                </div>
                                                                <div>
                                                                    <p class="text-[10px] font-black tracking-[0.2em] text-white/50 uppercase mb-1">Tanggal Event</p>
                                                                    <p class="text-base font-black text-white uppercase">{{ $event->date->format('d M Y') }}</p>
                                                                </div>
                                                            </div>

                                                            <!-- Detail Row: Location -->
                                                            <div class="flex items-start gap-4">
                                                                <div class="w-12 h-12 rounded-2xl bg-white/10 flex items-center justify-center border border-white/10 text-[#4285F4] shadow-inner shrink-0">
                                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                                                </div>
                                                                <div>
                                                                    <p class="text-[10px] font-black tracking-[0.2em] text-white/50 uppercase mb-1">Lokasi</p>
                                                                    <p class="text-sm font-black text-white uppercase leading-snug">{{ $event->location }}</p>
                                                                </div>
                                                            </div>

                                                            <!-- Divider -->
                                                            <div class="w-full h-px bg-gradient-to-r from-transparent via-white/20 to-transparent my-2"></div>

                                                            <!-- Bottom Status -->
                                                            <div class="flex items-center justify-between">
                                                                <div class="flex flex-col">
                                                                    <p class="text-[10px] font-black tracking-[0.2em] text-white/50 uppercase mb-1">Status</p>
                                                                    <div class="flex items-center gap-2">
                                                                        <span class="relative flex h-2.5 w-2.5">
                                                                          <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                                                          <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-green-500"></span>
                                                                        </span>
                                                                        <span class="text-sm font-black text-white uppercase tracking-wider">Tersedia</span>
                                                                    </div>
                                                                </div>
                                                                
                                                                <!-- Decorative Barcode -->
                                                                <div class="flex gap-1 h-8 opacity-40">
                                                                    <div class="w-1 bg-white h-full rounded-full"></div>
                                                                    <div class="w-0.5 bg-white h-full rounded-full"></div>
                                                                    <div class="w-2 bg-white h-full rounded-full"></div>
                                                                    <div class="w-1 bg-white h-full rounded-full"></div>
                                                                    <div class="w-1.5 bg-white h-full rounded-full"></div>
                                                                    <div class="w-0.5 bg-white h-full rounded-full"></div>
                                                                    <div class="w-2 bg-white h-full rounded-full"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                        </div>
                    @endforeach
                @else
                    <!-- Fallback / Static Hero if no events -->
                    <div class="absolute inset-0 w-full h-full hero-bg bg-cover bg-center">
                        <div class="absolute inset-0 bg-black/45"></div>
                        <div class="relative z-10 px-12 md:px-24 w-full h-full flex items-center text-white">
                            <div class="flex flex-col max-w-3xl">
                                <h1 class="text-7xl md:text-[8rem] lg:text-[10rem] font-bold mb-4 tracking-tighter text-shadow" style="font-family: 'Playfair Display', serif; line-height: 1;">
                                    Events
                                </h1>
                                <p class="text-xl md:text-2xl font-medium max-w-xl leading-relaxed opacity-95 text-shadow" style="font-family: 'Instrument Sans', sans-serif;">
                                    Easily Add And Organize Events, With Notifications To Keep Everyone Engaged
                                </p>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Navigation Dots -->
                @if($events->count() > 1)
                    <div class="absolute bottom-12 left-1/2 -translate-x-1/2 z-20 flex gap-3">
                        @foreach($events as $index => $event)
                            <button @click="activeSlide = {{ $index }}" 
                                    class="w-3 h-3 rounded-full transition-all duration-300"
                                    :class="activeSlide === {{ $index }} ? 'bg-[#4285F4] w-10' : 'bg-white/40 hover:bg-white/60'"></button>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
        
        <!-- About Section -->
        <section id="about" class="w-full py-24 px-8 lg:px-24 flex flex-col items-center">
            <div class="max-w-7xl w-full flex flex-col lg:flex-row gap-16 items-center">
                <!-- Visual -->
                <div class="w-full lg:w-1/2 relative">
                    <div class="aspect-[4/3] rounded-[2.5rem] overflow-hidden shadow-2xl relative z-10">
                        <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?q=80&w=2070&auto=format&fit=crop" alt="Conference" class="w-full h-full object-cover" />
                    </div>
                    <div class="absolute -bottom-8 -left-8 w-48 h-48 bg-[#4285F4]/10 rounded-full z-0"></div>
                    <div class="absolute -top-8 -right-8 w-32 h-32 bg-blue-100 rounded-full z-0"></div>
                </div>
                
                <!-- Text -->
                <div class="w-full lg:w-1/2">
                    <div class="text-[#4285F4] font-semibold tracking-wider uppercase text-sm mb-3">About Eventic</div>
                    <h2 class="text-4xl md:text-5xl font-bold mb-6 text-gray-900 leading-tight" style="font-family: 'Playfair Display', serif;">
                        Elevate Your Event Experience
                    </h2>
                    <p class="text-gray-600 text-lg leading-relaxed mb-6 font-medium" style="font-family: 'Instrument Sans', sans-serif;">
                        Eventic is a modern, intuitive platform designed to bridge the gap between event organizers and attendees. We provide seamless ticketing, real-time updates, and an elegant experience from start to finish.
                    </p>
                    <p class="text-gray-500 text-lg leading-relaxed mb-8">
                        Whether you're hosting an intimate workshop or a massive conference, our tools are crafted to make your job effortless, letting you focus on what truly matters: creating unforgettable moments.
                    </p>
                    
                    <div class="flex items-center gap-6">
                        <a href="#" class="px-8 py-3.5 bg-gray-900 text-white font-semibold rounded-full hover:bg-gray-800 transition shadow-lg shadow-gray-900/20">
                            Learn More
                        </a>
                        <div class="flex -space-x-4">
                            <img class="w-12 h-12 rounded-full border-4 border-white object-cover" src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&auto=format&fit=crop" alt="User" />
                            <img class="w-12 h-12 rounded-full border-4 border-white object-cover" src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=100&auto=format&fit=crop" alt="User" />
                            <img class="w-12 h-12 rounded-full border-4 border-white object-cover" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=100&auto=format&fit=crop" alt="User" />
                            <div class="w-12 h-12 rounded-full border-4 border-white bg-gray-100 flex items-center justify-center text-xs font-bold text-gray-600">
                                +2k
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

</body>
</html>
