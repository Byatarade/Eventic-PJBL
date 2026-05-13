<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center gap-8">
            <h2 class="font-bold text-2xl text-deep-navy leading-tight">
                {{ __('Detail Event') }}
            </h2>
            <div class="flex gap-3">
                <a href="{{ route('eo.events.index') }}" class="px-4 py-2 text-gray-500 hover:text-deep-navy transition-colors text-sm font-semibold flex items-center">
                    &larr; Kembali
                </a>
                <a href="{{ route('eo.events.edit', $event) }}" class="px-4 py-2 bg-electric-blue text-white rounded-xl hover:bg-blue-600 font-semibold transition-colors shadow-sm flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    Edit Event
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- Main Content (Left) -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Event Banner & Basic Info -->
                    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="relative h-64 md:h-96 w-full">
                            @if($event->image)
                                <img src="{{ Storage::url($event->image) }}" alt="{{ $event->name }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-slate-100 flex items-center justify-center">
                                    <svg class="w-20 h-20 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            @endif
                            <div class="absolute top-4 right-4">
                                <span class="px-4 py-2 rounded-full text-xs font-bold uppercase tracking-wider {{ $event->status === 'published' ? 'bg-green-500 text-white' : 'bg-yellow-500 text-white' }}">
                                    {{ $event->status }}
                                </span>
                            </div>
                        </div>
                        <div class="p-8">
                            <h1 class="text-3xl font-bold text-deep-navy mb-4">{{ $event->name }}</h1>
                            <div class="flex flex-wrap gap-6 text-gray-500 mb-8">
                                <div class="flex items-center gap-2">
                                    <svg class="w-5 h-5 text-electric-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <span class="font-medium">{{ $event->date->format('d M Y, H:i') }} WIB</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <svg class="w-5 h-5 text-electric-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    <span class="font-medium">{{ $event->location }}</span>
                                </div>
                            </div>

                            <div class="prose prose-blue max-w-none">
                                <h3 class="text-xl font-bold text-deep-navy mb-3">Deskripsi Event</h3>
                                <p class="text-gray-600 leading-relaxed">{{ $event->description ?: 'Tidak ada deskripsi.' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Terms & Conditions -->
                    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
                        <h3 class="text-xl font-bold text-deep-navy mb-4">Syarat & Ketentuan</h3>
                        <div class="text-gray-600 whitespace-pre-line leading-relaxed">
                            {{ $event->terms ?: 'Tidak ada syarat dan ketentuan khusus.' }}
                        </div>
                    </div>
                </div>

                <!-- Sidebar (Right) -->
                <div class="space-y-8">
                    <!-- Ticket Info -->
                    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="bg-slate-white px-6 py-4 border-b border-gray-100">
                            <h3 class="font-bold text-deep-navy uppercase text-xs tracking-widest">Informasi Tiket</h3>
                        </div>
                        <div class="p-6 space-y-6">
                            @forelse($event->tickets as $ticket)
                                <div class="bg-blue-50 rounded-2xl p-5 border border-blue-100 relative overflow-hidden">
                                    <div class="absolute -right-4 -top-4 opacity-10">
                                        <svg class="w-20 h-20 text-electric-blue" fill="currentColor" viewBox="0 0 24 24"><path d="M20 12V4H4v8c0 1.1.9 2 2 2s2-.9 2-2V8h8v4c0 1.1.9 2 2 2s2-.9 2-2z"/></svg>
                                    </div>
                                    <div class="flex justify-between items-start mb-3">
                                        <span class="px-3 py-1 bg-white text-electric-blue rounded-lg text-xs font-bold uppercase">{{ $ticket->type }}</span>
                                        <span class="text-lg font-bold text-deep-navy">Rp {{ number_format($ticket->price, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="flex justify-between items-center text-sm">
                                        <span class="text-gray-500">Kapasitas:</span>
                                        <span class="font-bold text-deep-navy">{{ $ticket->stock }} Tiket</span>
                                    </div>
                                    <div class="flex justify-between items-center text-sm mt-1">
                                        <span class="text-gray-500">Terjual:</span>
                                        <span class="font-bold text-green-600">0 Tiket</span>
                                    </div>
                                </div>
                            @empty
                                <p class="text-sm text-gray-500 italic">Belum ada tiket yang dibuat.</p>
                            @endforelse
                        </div>
                    </div>

                    <!-- Organizer Info -->
                    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6">
                        <h3 class="font-bold text-deep-navy uppercase text-xs tracking-widest mb-4">Penyelenggara</h3>
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-12 h-12 bg-electric-blue rounded-xl flex items-center justify-center text-white font-bold text-xl">
                                {{ substr($event->organizer_name, 0, 1) }}
                            </div>
                            <div>
                                <h4 class="font-bold text-deep-navy">{{ $event->organizer_name }}</h4>
                                <div class="flex flex-col gap-1 mt-1">
                                    @if($event->organizer_ig)
                                        <p class="text-[10px] text-gray-500 flex items-center gap-1">
                                            <svg class="w-3 h-3 text-pink-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                                            {{ $event->organizer_ig }}
                                        </p>
                                    @endif
                                    @if($event->organizer_tiktok)
                                        <p class="text-[10px] text-gray-500 flex items-center gap-1">
                                            <svg class="w-3 h-3 text-black" fill="currentColor" viewBox="0 0 24 24"><path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.34 2.88 2.88 0 0 1 2.31-4.53 2.66 2.66 0 0 1 1.04.2v-3.24a5.28 5.28 0 0 0-1.04-.1 6.33 6.33 0 0 0-5.37 9.87 6.32 6.32 0 0 0 11.7-3.3V9.28a8.27 8.27 0 0 0 3.78 1.83V7.77a5.15 5.15 0 0 1-2.09-1.08z"/></svg>
                                            {{ $event->organizer_tiktok }}
                                        </p>
                                    @endif
                                    @if(!$event->organizer_ig && !$event->organizer_tiktok)
                                        <p class="text-xs text-gray-400 italic">No social media</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="bg-red-50 rounded-3xl border border-red-100 p-6">
                        <h3 class="font-bold text-red-700 uppercase text-xs tracking-widest mb-4">Area Berbahaya</h3>
                        <form action="{{ route('eo.events.destroy', $event) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus event ini? Semua data tiket dan transaksi akan ikut terhapus.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full px-4 py-3 bg-red-600 text-white rounded-xl hover:bg-red-700 font-bold transition-colors shadow-sm flex items-center justify-center gap-2 text-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                Hapus Event Permanen
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
