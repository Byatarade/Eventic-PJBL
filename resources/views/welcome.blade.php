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
    <main class="w-full" id="home">
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

        <!-- Event Section -->
        <x-event-section :events="$events" />
        
        <!-- Contact Section -->
        <section id="contact" class="w-full py-24 px-8 lg:px-24 flex flex-col items-center bg-gray-50/50">
            <div class="max-w-4xl w-full flex flex-col items-center text-center mb-16">
                <div class="text-[#4285F4] font-semibold tracking-wider uppercase text-sm mb-3">Hubungi Kami</div>
                <h2 class="text-4xl md:text-5xl font-bold mb-6 text-gray-900 leading-tight" style="font-family: 'Playfair Display', serif;">
                    Layanan Pengaduan & Masukan
                </h2>
                <p class="text-gray-600 text-lg leading-relaxed max-w-2xl font-medium" style="font-family: 'Instrument Sans', sans-serif;">
                    Apakah Anda mengalami kendala dengan tiket atau memiliki saran untuk kami? Silakan isi form di bawah ini dan tim kami akan segera menghubungi Anda.
                </p>
            </div>

            <div class="w-full max-w-3xl bg-white p-8 md:p-12 rounded-[2rem] shadow-[0_20px_40px_rgba(0,0,0,0.04)] border border-gray-100 relative overflow-hidden">
                <!-- Decorative Elements -->
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-[#4285F4]/5 rounded-full blur-2xl pointer-events-none"></div>
                <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-blue-100/50 rounded-full blur-2xl pointer-events-none"></div>
                
                <form action="#" method="POST" class="flex flex-col gap-6 relative z-10">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nama Lengkap -->
                        <div class="flex flex-col gap-2">
                            <label for="name" class="text-sm font-semibold text-gray-700">Nama Lengkap</label>
                            <input type="text" id="name" name="name" placeholder="Masukkan nama lengkap" class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-[#4285F4]/50 focus:border-[#4285F4] transition-all text-gray-800" required>
                        </div>
                        
                        <!-- Email -->
                        <div class="flex flex-col gap-2">
                            <label for="email" class="text-sm font-semibold text-gray-700">Email</label>
                            <input type="email" id="email" name="email" placeholder="contoh@email.com" class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-[#4285F4]/50 focus:border-[#4285F4] transition-all text-gray-800" required>
                        </div>
                    </div>

                    <!-- Subject -->
                    <div class="flex flex-col gap-2 relative">
                        <label for="subject" class="text-sm font-semibold text-gray-700">Subjek</label>
                        <div class="relative">
                            <select id="subject" name="subject" class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-[#4285F4]/50 focus:border-[#4285F4] transition-all appearance-none cursor-pointer text-gray-800" required>
                                <option value="" disabled selected>Pilih subjek pesan</option>
                                <option value="pengaduan_tiket">Pengaduan Tiket</option>
                                <option value="saran_masukan">Saran dan Masukan</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-5 pointer-events-none text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>
                    </div>

                    <!-- Message -->
                    <div class="flex flex-col gap-2">
                        <label for="message" class="text-sm font-semibold text-gray-700">Pesan</label>
                        <textarea id="message" name="message" rows="5" placeholder="Tuliskan pesan Anda di sini..." class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl focus:outline-none focus:ring-2 focus:ring-[#4285F4]/50 focus:border-[#4285F4] transition-all resize-none text-gray-800" required></textarea>
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="mt-2 w-full md:w-auto md:self-end px-10 py-4 bg-gray-900 text-white font-semibold rounded-2xl hover:bg-[#4285F4] transition-colors duration-300 shadow-lg shadow-gray-900/10 flex items-center justify-center gap-3 group">
                        Kirim Pesan
                        <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                </form>
            </div>
        </section>
    </main>

    <!-- Footer Section -->
    <footer class="bg-[#4285F4] pt-12 pb-8 border-t border-white/10 text-white/90">
        <div class="max-w-7xl mx-auto px-8 lg:px-24">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-12 lg:gap-8 mb-12">
                <!-- Brand & Description -->
                <div class="md:col-span-5 flex flex-col gap-6">
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('eventic.svg') }}" alt="Eventic Logo" class="w-10 h-10 filter brightness-0 invert">
                        <span class="text-2xl font-bold text-white tracking-tight" style="font-family: 'Playfair Display', serif;">Eventic</span>
                    </div>
                    <p class="text-white/80 leading-relaxed font-medium max-w-sm" style="font-family: 'Instrument Sans', sans-serif;">
                        Platform modern untuk menemukan dan mengelola event impian Anda. Nikmati kemudahan akses, pembelian tiket, dan pengalaman tanpa batas.
                    </p>
                    <!-- Social Media -->
                    <div class="flex items-center gap-4 mt-2">
                        <!-- Instagram -->
                        <a href="#" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-white hover:text-[#4285F4] transition-all duration-300">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4s1.791-4 4-4 4 1.79 4 4-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                        <!-- Facebook -->
                        <a href="#" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-white hover:text-[#4285F4] transition-all duration-300">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/></svg>
                        </a>
                        <!-- X (Twitter) -->
                        <a href="#" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-white hover:text-[#4285F4] transition-all duration-300">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 22.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="md:col-span-3 lg:col-span-2 lg:col-start-8">
                    <h4 class="text-white font-bold mb-6 tracking-wide uppercase text-sm">Quick Links</h4>
                    <ul class="flex flex-col gap-4 font-medium" style="font-family: 'Instrument Sans', sans-serif;">
                        <li><a href="#" class="text-white/80 hover:text-white hover:translate-x-1 inline-block transition-all">Beranda</a></li>
                        <li><a href="#about" class="text-white/80 hover:text-white hover:translate-x-1 inline-block transition-all">Tentang Kami</a></li>
                        <li><a href="#events" class="text-white/80 hover:text-white hover:translate-x-1 inline-block transition-all">Events</a></li>
                        <li><a href="#contact" class="text-white/80 hover:text-white hover:translate-x-1 inline-block transition-all">Layanan & Bantuan</a></li>
                    </ul>
                </div>

                <!-- Support/Legal -->
                <div class="md:col-span-4 lg:col-span-3">
                    <h4 class="text-white font-bold mb-6 tracking-wide uppercase text-sm">Legal & Bantuan</h4>
                    <ul class="flex flex-col gap-4 font-medium" style="font-family: 'Instrument Sans', sans-serif;">
                        <li><a href="#" class="text-white/80 hover:text-white hover:translate-x-1 inline-block transition-all">Syarat & Ketentuan</a></li>
                        <li><a href="#" class="text-white/80 hover:text-white hover:translate-x-1 inline-block transition-all">Kebijakan Privasi</a></li>
                        <li><a href="#" class="text-white/80 hover:text-white hover:translate-x-1 inline-block transition-all">FAQ</a></li>
                        <li class="flex items-center gap-2 text-white mt-2">
                            <svg class="w-5 h-5 text-white/70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            support@eventic.com
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Copyright -->
            <div class="pt-6 border-t border-white/10 flex flex-col md:flex-row items-center justify-between gap-4">
                <p class="text-white/60 text-sm font-medium" style="font-family: 'Instrument Sans', sans-serif;">
                    &copy; {{ date('Y') }} Eventic. All rights reserved.
                </p>
            </div>
        </div>
    </footer>
</body>
</html>
