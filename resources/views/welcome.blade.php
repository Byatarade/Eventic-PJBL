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
        <div class="p-3 sm:p-4 pt-[5.5rem] sm:pt-[7rem] md:pt-[8rem] pb-4 w-full h-[70svh] lg:h-[100svh] min-h-[480px] lg:min-h-[600px] flex flex-col" 
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
                            <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent lg:bg-none lg:bg-black/50 lg:backdrop-blur-[2px]"></div>
                            
                            <!-- Text Content -->
                                    <div class="w-full h-full max-w-7xl mx-auto px-6 sm:px-8 lg:px-12 flex items-center lg:items-center items-end pb-16 lg:pb-0" style="font-family: 'Montserrat', sans-serif;">
                                        <div class="grid grid-cols-1 lg:grid-cols-12 gap-4 lg:gap-8 items-center w-full mt-auto lg:mt-0">
                                            
                                            <!-- Content Left -->
                                            <div class="lg:col-span-7 flex flex-col items-start text-left"
                                                 x-show="activeSlide === {{ $index }}"
                                                 x-transition:enter="transition ease-out duration-700"
                                                 x-transition:enter-start="opacity-0 translate-y-8"
                                                 x-transition:enter-end="opacity-100 translate-y-0"
                                                 x-transition:leave="transition ease-in duration-500"
                                                 x-transition:leave-start="opacity-100 translate-y-0"
                                                 x-transition:leave-end="opacity-0 -translate-y-8">
                                                
                                                <!-- Top Info -->
                                                <div class="flex items-center gap-2 mb-2 lg:mb-8 lg:inline-flex lg:px-4 lg:py-2 lg:bg-white/10 lg:backdrop-blur-xl lg:border lg:border-white/20 lg:rounded-full lg:shadow-[0_10px_30px_rgba(0,0,0,0.3)]">
                                                    <div class="w-1.5 h-1.5 lg:w-2 lg:h-2 bg-[#4285F4] rounded-full shadow-[0_0_10px_#4285F4] animate-pulse"></div>
                                                    <span class="text-[10px] font-bold lg:font-black tracking-[0.2em] lg:tracking-[0.3em] uppercase text-white/90">LIVE EVENT</span>
                                                </div>

                                                <!-- Title -->
                                                <h1 class="font-bold lg:font-black tracking-tight lg:tracking-tighter text-white mb-1 lg:mb-8 drop-shadow-md lg:drop-shadow-[0_10px_20px_rgba(0,0,0,0.5)] uppercase leading-tight lg:leading-[0.9]" 
                                                    :class="'{{ strlen($event->name) }}' > 15 ? 'text-3xl sm:text-5xl md:text-6xl lg:text-7xl' : 'text-4xl sm:text-6xl md:text-7xl lg:text-8xl'">
                                                    {{ $event->name }}
                                                </h1>

                                                <!-- Mobile Organizer Text (Minimalist) -->
                                                <p class="lg:hidden text-xs text-white/80 mb-5 font-medium tracking-wide">Penyelenggara: <span class="text-white font-bold">{{ $event->organizer_name ?: 'Eventic' }}</span></p>

                                                <!-- Actions & Meta -->
                                                <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4 lg:gap-6 relative z-10 w-full sm:w-auto">
                                                    
                                                    <!-- Beli Tiket Button -->
                                                    <a href="{{ route('events.show', $event) }}" class="h-10 lg:h-14 px-6 lg:px-8 bg-[#4285F4] text-white font-bold lg:font-black rounded-lg lg:rounded-full hover:bg-[#3b78e7] transition-all duration-300 lg:shadow-xl lg:shadow-[#4285F4]/40 flex items-center justify-center gap-2 lg:gap-3 w-fit transform hover:scale-105 active:scale-95">
                                                        <span class="uppercase tracking-wide lg:tracking-widest text-xs lg:text-sm">Beli Tiket</span>
                                                        <div class="hidden lg:flex w-8 h-8 rounded-full bg-white/20 items-center justify-center transition-colors">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                                        </div>
                                                    </a>

                                                    <!-- Desktop Organizer Pill -->
                                                    <div class="hidden lg:flex items-center gap-4 px-5 py-2.5 bg-black/40 backdrop-blur-md border border-white/10 rounded-full cursor-default">
                                                        <div class="w-9 h-9 rounded-full bg-gradient-to-tr from-gray-200 to-white flex items-center justify-center text-gray-900 font-black text-sm shadow-inner shrink-0">
                                                            {{ substr($event->organizer_name ?: 'E', 0, 1) }}
                                                        </div>
                                                        <div class="flex flex-col text-left">
                                                            <span class="text-[9px] font-black text-white/50 uppercase tracking-[0.2em] mb-0.5">Penyelenggara</span>
                                                            <span class="text-xs font-black text-white uppercase tracking-wider line-clamp-1">{{ $event->organizer_name ?: 'Eventic' }}</span>
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
                    <div class="absolute bottom-8 md:bottom-12 left-1/2 -translate-x-1/2 z-20 flex gap-3">
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
        <!-- About Section -->
        <section id="about" class="w-full py-16 md:py-24 px-5 sm:px-8 lg:px-24 bg-white flex flex-col items-center">
            <div class="max-w-6xl w-full flex flex-col lg:flex-row gap-12 lg:gap-16 items-center">
                
                <!-- Text Content -->
                <div class="w-full lg:w-1/2 order-2 lg:order-1 flex flex-col items-start">
                    <span class="text-[#4285F4] font-bold uppercase tracking-[0.2em] text-xs mb-6">Tentang Eventic</span>
                    
                    <h2 class="text-2xl md:text-4xl font-semibold mb-6 text-gray-900 leading-tight" style="font-family: 'Montserrat', sans-serif;">
                        Platform Terpadu Untuk Kesuksesan Event Anda.
                    </h2>
                    
                    <p class="text-gray-500 text-base md:text-lg leading-relaxed mb-10 font-medium" style="font-family: 'Montserrat', sans-serif;">
                        Kami menjembatani penyelenggara dengan peserta. Dari publikasi hingga distribusi tiket, Eventic memberikan kemudahan akses dan manajemen yang cerdas tanpa hambatan.
                    </p>

                    <div class="flex items-center gap-6 sm:gap-8 mb-10">
                        <div>
                            <div class="text-2xl md:text-3xl font-semibold text-gray-900 mb-1" style="font-family: 'Montserrat', sans-serif;">100+</div>
                            <div class="text-[10px] text-gray-400 uppercase tracking-widest font-bold">Event Sukses</div>
                        </div>
                        <div class="w-px h-12 bg-gray-200"></div>
                        <div>
                            <div class="text-2xl md:text-3xl font-semibold text-gray-900 mb-1" style="font-family: 'Montserrat', sans-serif;">2k+</div>
                            <div class="text-[10px] text-gray-400 uppercase tracking-widest font-bold">Pengguna</div>
                        </div>
                    </div>
                    
                    <a href="#events" class="px-8 py-3.5 bg-[#4285F4] text-white font-semibold rounded-full hover:bg-[#3b78e7] transition-colors duration-300" style="font-family: 'Montserrat', sans-serif;">
                        Jelajahi Event
                    </a>
                </div>

                <!-- Visual Content -->
                <div class="w-full lg:w-1/2 order-1 lg:order-2">
                    <div class="aspect-[4/3] rounded-[2rem] overflow-hidden bg-gray-100 shadow-xl shadow-gray-200/50 group">
                        <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?q=80&w=2070&auto=format&fit=crop" alt="Conference" class="w-full h-full object-cover grayscale-[20%] group-hover:grayscale-0 group-hover:scale-105 transition-all duration-700" />
                    </div>
                </div>
            </div>
        </section>

        <!-- Event Section -->
        <x-event-section :events="$events" />
        
        <!-- Contact Section -->
        <section id="contact" class="w-full pt-12 md:pt-20 pb-16 md:pb-24 px-5 sm:px-8 lg:px-24 flex flex-col items-center bg-gray-50/50">
            <div class="max-w-4xl w-full flex flex-col items-center text-center mb-12 md:mb-16">
                <div class="text-[#4285F4] font-semibold tracking-wider uppercase text-sm mb-3">Hubungi Kami</div>
                <h2 class="text-3xl md:text-4xl font-semibold mb-6 text-gray-900 leading-tight" style="font-family: 'Montserrat', sans-serif;">
                    Layanan Pengaduan & Masukan
                </h2>
                <p class="text-gray-600 text-lg leading-relaxed max-w-2xl font-medium" style="font-family: 'Montserrat', sans-serif;">
                    Apakah Anda mengalami kendala dengan tiket atau memiliki saran untuk kami? Silakan isi form di bawah ini dan tim kami akan segera menghubungi Anda.
                </p>
            </div>

            <div class="w-full max-w-3xl bg-white p-6 sm:p-8 md:p-12 rounded-[2rem] shadow-[0_20px_40px_rgba(0,0,0,0.04)] border border-gray-100 relative overflow-hidden">
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
                    <button type="submit" class="mt-2 w-full md:w-auto md:self-end px-10 py-4 bg-[#4285F4] text-white font-semibold rounded-2xl hover:bg-[#3b78e7] transition-colors duration-300 shadow-lg shadow-[#4285F4]/20 flex items-center justify-center gap-3 group">
                        Kirim Pesan
                        <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                </form>
            </div>
        </section>
    </main>

    <!-- Footer Section -->
    <x-footer />
</body>
</html>
