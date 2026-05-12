@props(['events'])

<section id="events" class="w-full pt-16 md:pt-24 pb-12 md:pb-20 px-5 sm:px-8 lg:px-24 bg-[#FDFCFB]" x-data="{ filter: 'all' }">
    <div class="max-w-7xl mx-auto">
        <!-- Section Header & Filters -->
        <div class="flex flex-col mb-12 md:mb-16 gap-8 md:gap-10">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-6 md:gap-8">
                <div class="max-w-2xl">
                    <div class="text-[#4285F4] font-bold tracking-[0.2em] uppercase text-[10px] md:text-xs mb-3 md:mb-4">Discover Experience</div>
                    <h2 class="text-3xl md:text-4xl font-semibold text-gray-900 leading-tight" style="font-family: 'Montserrat', sans-serif;">
                        Upcoming <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#4285F4] to-blue-500">Events</span>
                    </h2>
                    <div class="mt-4 md:mt-6 w-16 md:w-24 h-1.5 bg-[#4285F4] rounded-full"></div>
                </div>
                
                <!-- Filter Chips -->
                <div class="flex flex-wrap gap-2.5 md:gap-3 w-full">
                    <button @click="filter = 'all'" 
                            :class="filter === 'all' ? 'bg-[#4285F4] text-white' : 'bg-white text-gray-600 hover:bg-gray-100'"
                            class="px-5 md:px-6 py-2 md:py-2.5 rounded-full text-xs md:text-sm font-bold transition-all duration-300 border border-gray-200 shadow-sm">
                        Semua
                    </button>
                    <button @click="filter = 'musik'" 
                            :class="filter === 'musik' ? 'bg-[#4285F4] text-white' : 'bg-white text-gray-600 hover:bg-gray-100'"
                            class="px-5 md:px-6 py-2 md:py-2.5 rounded-full text-xs md:text-sm font-bold transition-all duration-300 border border-gray-200 shadow-sm">
                        Musik
                    </button>
                    <button @click="filter = 'olahraga'" 
                            :class="filter === 'olahraga' ? 'bg-[#4285F4] text-white' : 'bg-white text-gray-600 hover:bg-gray-100'"
                            class="px-5 md:px-6 py-2 md:py-2.5 rounded-full text-xs md:text-sm font-bold transition-all duration-300 border border-gray-200 shadow-sm">
                        Olahraga
                    </button>
                    <button @click="filter = 'wahana'" 
                            :class="filter === 'wahana' ? 'bg-[#4285F4] text-white' : 'bg-white text-gray-600 hover:bg-gray-100'"
                            class="px-5 md:px-6 py-2 md:py-2.5 rounded-full text-xs md:text-sm font-bold transition-all duration-300 border border-gray-200 shadow-sm">
                        Wahana
                    </button>
                    <button @click="filter = 'wisata'" 
                            :class="filter === 'wisata' ? 'bg-[#4285F4] text-white' : 'bg-white text-gray-600 hover:bg-gray-100'"
                            class="px-5 md:px-6 py-2 md:py-2.5 rounded-full text-xs md:text-sm font-bold transition-all duration-300 border border-gray-200 shadow-sm">
                        Wisata
                    </button>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($events as $event)
                <a href="{{ route('events.show', $event) }}" x-show="filter === 'all' || filter === '{{ strtolower($event->category ?? '') }}'"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 transform scale-95"
                     x-transition:enter-end="opacity-100 transform scale-100"
                     class="group bg-white rounded-3xl overflow-hidden border border-gray-100 hover:border-blue-100 transition-all duration-500 hover:shadow-[0_20px_40px_-15px_rgba(0,0,0,0.05)] flex flex-col h-full cursor-pointer">
                    
                    <!-- Banner Container -->
                    <div class="relative aspect-video overflow-hidden bg-slate-100">
                        <img src="{{ $event->image ? asset('storage/' . $event->image) : 'https://images.unsplash.com/photo-1492684223066-81342ee5ff30?q=80&w=2070&auto=format&fit=crop' }}" 
                             alt="{{ $event->name }}" 
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                        
                        <!-- Category Badge -->
                        @if($event->category)
                        <div class="absolute top-4 right-4 px-3 py-1 bg-white/90 backdrop-blur-md rounded-full">
                            <span class="text-[9px] font-black text-gray-800 uppercase tracking-widest">{{ $event->category }}</span>
                        </div>
                        @endif
                    </div>

                    <!-- Content -->
                    <div class="p-6 flex flex-col flex-grow">
                        <!-- Date & Location Row -->
                        <div class="flex items-center gap-4 mb-4 text-xs font-bold text-gray-500 uppercase tracking-wider">
                            <div class="flex items-center gap-1.5 text-[#4285F4]">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <span>{{ $event->date->format('d M Y') }}</span>
                            </div>
                            <div class="flex items-center gap-1.5 truncate">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                <span class="truncate">{{ $event->location }}</span>
                            </div>
                        </div>

                        <!-- Title -->
                        <h3 class="text-xl font-black text-gray-900 mb-4 group-hover:text-[#4285F4] transition-colors leading-snug line-clamp-2" style="font-family: 'Montserrat', sans-serif;">
                            {{ $event->name }}
                        </h3>

                        <!-- Bottom Section -->
                        <div class="mt-auto pt-5 border-t border-gray-50 flex items-center justify-between">
                            <!-- Organizer Info -->
                            <div class="flex items-center gap-2.5">
                                <div class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-600 text-xs font-bold uppercase shrink-0 border border-slate-200">
                                    {{ substr($event->organizer_name ?: 'E', 0, 1) }}
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest leading-none mb-1">By</span>
                                    <span class="text-xs font-bold text-gray-800 truncate max-w-[100px]">{{ $event->organizer_name ?: 'Eventic' }}</span>
                                </div>
                            </div>
                            
                            <!-- Price -->
                            <div class="flex flex-col items-end">
                                <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest leading-none mb-1">Mulai</span>
                                <span class="text-sm font-black text-[#4285F4]">Rp{{ number_format($event->tickets->min('price') ?? 0, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        <!-- Empty State (When Filter returns 0) -->
        <div x-show="!Array.from(document.querySelectorAll('.group')).some(el => el.style.display !== 'none')" 
             style="display: none;"
             class="w-full py-12 text-center flex flex-col items-center justify-center">
            <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <p class="text-gray-500 font-medium">Belum ada event untuk kategori ini.</p>
        </div>

    </div>
</section>
