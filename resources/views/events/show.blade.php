<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $event->name }} - Eventic</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('eventic.svg') }}">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        [x-cloak] { display: none !important; }
        body { font-family: 'Inter', sans-serif; background-color: #ffffff; }
    </style>
</head>
<body class="antialiased text-gray-900 selection:bg-blue-500 selection:text-white">
    
    <x-navbar />

    <!-- x-data for tabs and ticket modal -->
    <main class="w-full pt-28 pb-32 px-5 sm:px-8 lg:px-16 max-w-[1400px] mx-auto" 
          x-data="{ 
              activeTab: 'deskripsi', 
              isModalOpen: false, 
              selectedTicket: null 
          }">
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-16 items-start">
            
            <!-- LEFT COLUMN: Details -->
            <div class="lg:col-span-7 space-y-8">
                
                <!-- Category Pill -->
                <div>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-md bg-[#EEF2FF] text-[#4F46E5] text-xs font-semibold border border-[#E0E7FF]">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"></path></svg>
                        {{ $event->category ?: 'Musik' }}
                    </span>
                </div>

                <!-- Event Title -->
                <h1 class="text-3xl md:text-4xl font-bold leading-snug text-gray-900">
                    {{ $event->name }}
                </h1>

                <!-- Organizer -->
                <div class="space-y-3">
                    <h3 class="text-sm font-semibold text-gray-500">Penyelenggara</h3>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-gray-900 text-white flex items-center justify-center font-bold text-lg shadow-sm">
                            {{ substr($event->organizer_name ?: 'E', 0, 1) }}
                        </div>
                        <span class="font-medium text-gray-800">{{ $event->organizer_name ?: 'Eventic Production' }}</span>
                    </div>
                </div>

                <!-- Social Media -->
                <div class="space-y-3">
                    <h3 class="text-sm font-semibold text-gray-500">Media Sosial</h3>
                    <div class="flex flex-wrap gap-3">
                        @if($event->organizer_social)
                            <a href="#" class="inline-flex items-center gap-2 px-4 py-2 rounded-full border border-gray-200 text-blue-600 hover:bg-blue-50 transition-colors text-sm font-medium">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                                {{ ltrim($event->organizer_social, '@') }}
                            </a>
                        @else
                            <a href="#" class="inline-flex items-center gap-2 px-4 py-2 rounded-full border border-gray-200 text-blue-600 hover:bg-blue-50 transition-colors text-sm font-medium">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                                Instagram
                            </a>
                            <a href="#" class="inline-flex items-center gap-2 px-4 py-2 rounded-full border border-gray-200 text-blue-600 hover:bg-blue-50 transition-colors text-sm font-medium">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.34 2.88 2.88 0 0 1 2.31-4.53 2.66 2.66 0 0 1 1.04.2v-3.24a5.28 5.28 0 0 0-1.04-.1 6.33 6.33 0 0 0-5.37 9.87 6.32 6.32 0 0 0 11.7-3.3V9.28a8.27 8.27 0 0 0 3.78 1.83V7.77a5.15 5.15 0 0 1-2.09-1.08z"/></svg>
                                TikTok
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Tabs Navigation -->
                <div class="pt-4 border-b border-gray-200 flex gap-6 overflow-x-auto scrollbar-hide">
                    <button @click="activeTab = 'deskripsi'" 
                            :class="activeTab === 'deskripsi' ? 'border-blue-600 text-gray-900 font-semibold' : 'border-transparent text-gray-500 hover:text-gray-700'" 
                            class="pb-3 border-b-2 transition-colors text-sm whitespace-nowrap">
                        Deskripsi
                    </button>
                    <button @click="activeTab = 'syarat'" 
                            :class="activeTab === 'syarat' ? 'border-blue-600 text-gray-900 font-semibold' : 'border-transparent text-gray-500 hover:text-gray-700'" 
                            class="pb-3 border-b-2 transition-colors text-sm whitespace-nowrap">
                        Syarat & Ketentuan
                    </button>
                    <button @click="activeTab = 'fasilitas'" 
                            :class="activeTab === 'fasilitas' ? 'border-blue-600 text-gray-900 font-semibold' : 'border-transparent text-gray-500 hover:text-gray-700'" 
                            class="pb-3 border-b-2 transition-colors text-sm whitespace-nowrap">
                        Fasilitas
                    </button>
                </div>

                <!-- Tabs Content -->
                <div class="py-4 min-h-[300px]">
                    
                    <!-- Deskripsi Tab -->
                    <div x-show="activeTab === 'deskripsi'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-4">
                        <h2 class="text-xl font-bold text-gray-900">Deskripsi</h2>
                        <div class="prose prose-gray max-w-none text-gray-600 text-sm leading-relaxed font-medium">
                            {!! nl2br(e($event->description)) !!}
                        </div>
                    </div>

                    <!-- Syarat & Ketentuan Tab -->
                    <div x-show="activeTab === 'syarat'" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-4">
                        <h2 class="text-xl font-bold text-gray-900">Syarat & Ketentuan</h2>
                        <div class="prose prose-gray max-w-none text-gray-600 text-sm leading-relaxed font-medium">
                            {!! $event->terms ? nl2br(e($event->terms)) : 'Tidak ada syarat dan ketentuan khusus yang berlaku untuk event ini.' !!}
                        </div>
                    </div>

                    <!-- Fasilitas Tab -->
                    <div x-show="activeTab === 'fasilitas'" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-4">
                        <h2 class="text-xl font-bold text-gray-900">Fasilitas</h2>
                        <ul class="list-disc pl-5 text-sm text-gray-600 space-y-2 font-medium">
                            <li>Area Parkir Luas</li>
                            <li>Toilet Bersih & Nyaman</li>
                            <li>Area Food & Beverage</li>
                            <li>Posko Medis</li>
                            <li>Musholla</li>
                        </ul>
                    </div>

                </div>
            </div>

            <!-- RIGHT COLUMN: Image & Quick Details -->
            <div class="lg:col-span-5 relative">
                <div class="sticky top-28 space-y-6">
                    
                    <!-- Event Banner Image -->
                    <div class="w-full rounded-[1.5rem] overflow-hidden aspect-[2/1] md:aspect-[4/3] shadow-md border border-gray-100 bg-gray-50">
                        <img src="{{ $event->image ? asset('storage/' . $event->image) : 'https://images.unsplash.com/photo-1540039155732-68473678d4dd?q=80&w=2070&auto=format&fit=crop' }}" 
                             alt="{{ $event->name }}" 
                             class="w-full h-full object-cover">
                    </div>

                    <!-- Detail Acara Info -->
                    <div class="space-y-5 px-1">
                        <h2 class="text-lg font-bold text-gray-900">Detail Acara</h2>
                        
                        <div class="space-y-4">
                            <!-- Date -->
                            <div class="flex items-start gap-4">
                                <div class="w-8 h-8 rounded-lg bg-[#EEF2FF] flex items-center justify-center text-[#4F46E5] shrink-0">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                                <div class="pt-1.5 text-sm font-semibold text-gray-800">
                                    {{ $event->date->format('d F Y') }}
                                </div>
                            </div>
                            <!-- Time -->
                            <div class="flex items-start gap-4">
                                <div class="w-8 h-8 rounded-lg bg-[#EEF2FF] flex items-center justify-center text-[#4F46E5] shrink-0">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <div class="pt-1.5 text-sm font-semibold text-gray-800">
                                    {{ $event->date->format('H:i') }} - Selesai
                                </div>
                            </div>
                            <!-- Location -->
                            <div class="flex items-start gap-4">
                                <div class="w-8 h-8 rounded-lg bg-[#EEF2FF] flex items-center justify-center text-[#4F46E5] shrink-0">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                </div>
                                <div class="pt-1.5 text-sm font-semibold text-gray-800 leading-snug">
                                    {{ $event->location }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Buy Box -->
                    <div class="bg-[#F8FAFC] border border-gray-100 rounded-2xl p-5 flex items-center justify-between shadow-sm mt-4">
                        <div>
                            <p class="text-[11px] font-semibold text-gray-500 mb-0.5">Harga mulai dari</p>
                            <p class="text-lg font-bold text-gray-900">
                                Rp{{ number_format($event->tickets->min('price') ?? 0, 0, ',', '.') }}
                            </p>
                        </div>
                        
                        @auth
                            @if(auth()->user()->role === 'user')
                                <button @click="isModalOpen = true" class="bg-[#4F46E5] hover:bg-[#4338CA] text-white px-5 py-2.5 rounded-xl font-semibold text-sm transition-colors flex items-center gap-2 shadow-md shadow-indigo-500/20 active:scale-95">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                                    Beli Tiket
                                </button>
                            @else
                                <div class="bg-gray-200 text-gray-500 px-4 py-2.5 rounded-xl font-semibold text-xs text-center">
                                    Hanya Akun User
                                </div>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="bg-gray-900 hover:bg-black text-white px-5 py-2.5 rounded-xl font-semibold text-sm transition-colors flex items-center shadow-md active:scale-95">
                                Login untuk Beli
                            </a>
                        @endauth
                    </div>

                </div>
            </div>

        </div>

        <!-- TICKET SELECTION MODAL -->
        <div x-show="isModalOpen" style="display: none;" class="fixed inset-0 z-[100] overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
                
                <!-- Background overlay -->
                <div x-show="isModalOpen" 
                     x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" 
                     x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" 
                     class="fixed inset-0 transition-opacity bg-black/40 backdrop-blur-sm" 
                     @click="isModalOpen = false"></div>

                <!-- Modal panel -->
                <div x-show="isModalOpen" 
                     x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
                     x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                     class="relative inline-block w-full max-w-md p-6 overflow-hidden text-left align-middle transition-all transform bg-white shadow-2xl rounded-2xl sm:my-8">
                    
                    <div class="flex items-center justify-between mb-5">
                        <h3 class="text-lg font-bold text-gray-900" id="modal-title">Pilih Tiket</h3>
                        <button @click="isModalOpen = false" class="text-gray-400 hover:text-gray-600 transition-colors bg-gray-100 hover:bg-gray-200 p-1.5 rounded-full">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>

                    <div class="space-y-3 max-h-[60vh] overflow-y-auto pr-1">
                        @if($event->tickets->count() > 0)
                            @foreach($event->tickets as $ticket)
                                <div @click="if({{ $ticket->stock }} > 0) selectedTicket = {{ $ticket->id }}"
                                     :class="selectedTicket === {{ $ticket->id }} ? 'border-[#4F46E5] bg-[#EEF2FF] ring-1 ring-[#4F46E5]' : 'border-gray-200 hover:border-gray-300'"
                                     class="border rounded-xl p-4 cursor-pointer transition-all {{ $ticket->stock <= 0 ? 'opacity-50 grayscale bg-gray-50' : 'bg-white' }}">
                                    
                                    <div class="flex justify-between items-start mb-2">
                                        <div>
                                            <h4 class="font-bold text-gray-900 text-base">{{ $ticket->type }}</h4>
                                            @if($ticket->stock <= 0)
                                                <span class="text-[10px] font-bold text-red-500 bg-red-100 px-2 py-0.5 rounded uppercase">Habis Terjual</span>
                                            @elseif($ticket->stock < 10)
                                                <span class="text-[10px] font-bold text-orange-500 bg-orange-100 px-2 py-0.5 rounded uppercase">Sisa {{ $ticket->stock }} Tiket</span>
                                            @else
                                                <span class="text-xs text-gray-500 font-medium">Tersedia {{ $ticket->stock }} tiket</span>
                                            @endif
                                        </div>
                                        <div class="w-5 h-5 rounded-full border-2 flex items-center justify-center shrink-0 mt-0.5" 
                                             :class="selectedTicket === {{ $ticket->id }} ? 'border-[#4F46E5] bg-[#4F46E5]' : 'border-gray-300'">
                                            <svg x-show="selectedTicket === {{ $ticket->id }}" class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                        </div>
                                    </div>
                                    <div class="text-[#4F46E5] font-bold text-lg mt-1">
                                        Rp{{ number_format($ticket->price, 0, ',', '.') }}
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center py-6">
                                <p class="text-gray-500 text-sm font-medium">Tiket belum tersedia untuk event ini.</p>
                            </div>
                        @endif
                    </div>

                    <div class="mt-6 pt-5 border-t border-gray-100 flex gap-3 justify-end">
                        <button @click="isModalOpen = false" type="button" class="px-4 py-2 text-sm font-semibold text-gray-700 bg-white border border-gray-300 rounded-xl hover:bg-gray-50">
                            Batal
                        </button>
                        <button :disabled="!selectedTicket" type="button" :class="!selectedTicket ? 'bg-gray-200 text-gray-400 cursor-not-allowed' : 'bg-[#4F46E5] hover:bg-[#4338CA] text-white shadow-md active:scale-95'" class="px-5 py-2 text-sm font-semibold rounded-xl transition-all flex items-center gap-2">
                            Lanjutkan Pembayaran
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
    </main>

    <x-footer />
</body>
</html>
