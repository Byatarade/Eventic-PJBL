@props(['events'])

<section id="events" class="w-full py-24 px-8 lg:px-24 bg-[#FDFCFB]">
    <div class="max-w-7xl mx-auto">
        <!-- Section Header -->
        <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-8">
            <div class="max-w-2xl">
                <div class="text-[#4285F4] font-bold tracking-[0.2em] uppercase text-xs mb-4">Discover Experience</div>
                <h2 class="text-4xl md:text-6xl font-black text-gray-900 leading-tight uppercase tracking-tighter" style="font-family: 'Montserrat', sans-serif;">
                    Upcoming <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">Events</span>
                </h2>
                <div class="mt-6 w-24 h-1.5 bg-blue-500 rounded-full"></div>
            </div>
            <div class="hidden md:block">
                <p class="text-gray-500 font-medium max-w-xs text-right italic">
                    "Every event is a new story waiting to be told. Find your next chapter here."
                </p>
            </div>
        </div>

        <!-- Events Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($events as $event)
                <div class="group bg-white rounded-[1.5rem] overflow-hidden border border-gray-100 hover:border-blue-100 transition-all duration-500 hover:shadow-[0_20px_40px_-15px_rgba(0,0,0,0.05)] flex flex-col h-full">
                    <!-- Image Container -->
                    <div class="relative aspect-[16/10] overflow-hidden">
                        <img src="{{ $event->image ? asset('storage/' . $event->image) : 'https://images.unsplash.com/photo-1492684223066-81342ee5ff30?q=80&w=2070&auto=format&fit=crop' }}" 
                             alt="{{ $event->name }}" 
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                        
                        <!-- Mini Date Badge -->
                        <div class="absolute top-4 left-4 flex flex-col items-center justify-center w-12 h-14 bg-white/95 backdrop-blur-md rounded-xl shadow-lg">
                            <span class="text-[8px] font-black text-blue-600 uppercase tracking-tighter">{{ $event->date->format('M') }}</span>
                            <span class="text-lg font-black text-gray-900 leading-none">{{ $event->date->format('d') }}</span>
                        </div>

                        <!-- Status Overlay -->
                        <div class="absolute top-4 right-4 px-3 py-1 bg-black/30 backdrop-blur-sm rounded-full">
                            <div class="flex items-center gap-1.5">
                                <div class="w-1.5 h-1.5 bg-green-400 rounded-full animate-pulse"></div>
                                <span class="text-[8px] font-black text-white uppercase tracking-widest">Available</span>
                            </div>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-5 flex flex-col flex-grow">
                        <div class="flex items-center gap-2 mb-3">
                            <svg class="w-3 h-3 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider truncate">
                                {{ $event->location }}
                            </span>
                        </div>

                        <h3 class="text-lg font-black text-gray-900 mb-3 group-hover:text-blue-600 transition-colors leading-tight uppercase tracking-tight line-clamp-2" style="font-family: 'Montserrat', sans-serif;">
                            {{ $event->name }}
                        </h3>

                        <div class="mt-auto pt-4 border-t border-gray-50 flex items-center justify-between">
                            <div class="flex flex-col">
                                <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-0.5">Start From</span>
                                <span class="text-sm font-black text-blue-600">Rp{{ number_format($event->tickets->min('price') ?? 0, 0, ',', '.') }}</span>
                            </div>
                            
                            <a href="#" class="w-8 h-8 rounded-xl bg-gray-900 text-white flex items-center justify-center transition-all duration-300 group-hover:bg-blue-600 group-hover:rotate-12 shadow-lg shadow-gray-900/10">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- View All Button -->
        <div class="mt-20 flex justify-center">
            <a href="#" class="group relative px-12 py-5 bg-white border-2 border-gray-900 text-gray-900 font-black rounded-full overflow-hidden transition-all duration-300 hover:text-white">
                <span class="relative z-10 uppercase tracking-[0.2em] text-sm">Explore All Events</span>
                <div class="absolute inset-0 bg-gray-900 transition-transform duration-300 transform translate-y-full group-hover:translate-y-0"></div>
            </a>
        </div>
    </div>
</section>
