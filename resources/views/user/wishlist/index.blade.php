<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-deep-navy leading-tight">Wishlist Saya</h2>
        <p class="text-sm text-gray-500">Daftar event yang Anda simpan untuk nanti.</p>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($wishlists->isEmpty())
                <div class="bg-white rounded-3xl p-12 text-center shadow-sm border border-gray-100">
                    <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Wishlist Kosong</h3>
                    <p class="text-gray-500 mb-8 max-w-md mx-auto">Anda belum menyimpan event apapun. Jelajahi event menarik dan simpan yang Anda sukai!</p>
                    <a href="{{ url('/') }}" class="inline-flex items-center gap-2 bg-[#4F46E5] text-white px-6 py-3 rounded-2xl font-bold hover:bg-[#4338CA] transition-all shadow-lg shadow-indigo-500/20">
                        Jelajahi Event
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($wishlists as $wishlist)
                        @php $event = $wishlist->event; @endphp
                        <div class="bg-white rounded-3xl overflow-hidden shadow-sm border border-gray-100 hover:shadow-xl transition-all group flex flex-col h-full">
                            {{-- Image --}}
                            <div class="relative h-48 overflow-hidden">
                                <img src="{{ $event->image ? asset('storage/' . $event->image) : 'https://images.unsplash.com/photo-1540039155732-68473678d4dd?q=80&w=2070&auto=format&fit=crop' }}" 
                                     alt="{{ $event->name }}" 
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                <div class="absolute top-4 right-4">
                                    <form action="{{ route('user.wishlist.destroy', $wishlist) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-9 h-9 bg-white/90 backdrop-blur rounded-xl flex items-center justify-center text-red-500 hover:bg-red-500 hover:text-white transition-all shadow-sm">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                                <div class="absolute bottom-4 left-4">
                                    <span class="px-3 py-1 bg-white/90 backdrop-blur rounded-lg text-[10px] font-bold text-[#4F46E5] uppercase tracking-wider">{{ $event->category ?: 'Musik' }}</span>
                                </div>
                            </div>

                            {{-- Content --}}
                            <div class="p-6 flex flex-col flex-1">
                                <h4 class="font-bold text-lg text-gray-900 mb-2 line-clamp-1">{{ $event->name }}</h4>
                                
                                <div class="space-y-2 mb-6">
                                    <div class="flex items-center gap-2 text-xs text-gray-500">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        {{ $event->date->format('d M Y') }}
                                    </div>
                                    <div class="flex items-center gap-2 text-xs text-gray-500">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                                        {{ $event->location }}
                                    </div>
                                </div>

                                <div class="mt-auto pt-4 border-t border-gray-50 flex items-center justify-between">
                                    <div>
                                        <p class="text-[10px] text-gray-400 font-bold uppercase">Mulai dari</p>
                                        <p class="font-bold text-[#4F46E5]">Rp{{ number_format($event->tickets->min('price') ?? 0, 0, ',', '.') }}</p>
                                    </div>
                                    <a href="{{ route('events.show', $event) }}" class="px-4 py-2 bg-gray-900 text-white text-xs font-bold rounded-xl hover:bg-black transition-colors">
                                        Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
