<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-deep-navy leading-tight">
            {{ __('Tiket Saya') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- ============================================= --}}
            {{-- EVENT BANNER CAROUSEL --}}
            {{-- ============================================= --}}
            @if($bannerEvents->count() > 0)
            <div x-data="{
                current: 0,
                total: {{ $bannerEvents->count() }},
                autoplay: null,
                init() {
                    this.autoplay = setInterval(() => { this.next() }, 5000);
                },
                next() { this.current = (this.current + 1) % this.total },
                prev() { this.current = (this.current - 1 + this.total) % this.total },
                destroy() { clearInterval(this.autoplay) }
            }" class="relative rounded-2xl overflow-hidden shadow-lg group">
                {{-- Slides --}}
                <div class="relative h-[200px] sm:h-[280px] md:h-[320px]">
                    @foreach($bannerEvents as $idx => $bannerEvent)
                    <div x-show="current === {{ $idx }}"
                         x-transition:enter="transition ease-out duration-500"
                         x-transition:enter-start="opacity-0 scale-105"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-300"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="absolute inset-0">
                        @if($bannerEvent->image)
                            <img src="{{ Storage::url($bannerEvent->image) }}" alt="{{ $bannerEvent->name }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-[#4F46E5] via-[#6366F1] to-[#818CF8]"></div>
                        @endif

                        {{-- Overlay --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent"></div>

                        {{-- Content --}}
                        <div class="absolute bottom-0 left-0 right-0 p-6 sm:p-8">
                            <div class="flex items-end justify-between gap-4">
                                <div class="flex-1 min-w-0">
                                    @if($bannerEvent->category)
                                    <span class="inline-block px-3 py-1 bg-white/20 backdrop-blur-sm text-white text-[11px] font-bold rounded-full uppercase tracking-wider mb-3 border border-white/10">{{ $bannerEvent->category }}</span>
                                    @endif
                                    <h3 class="text-white font-bold text-lg sm:text-2xl mb-1 truncate">{{ $bannerEvent->name }}</h3>
                                    <div class="flex items-center gap-4 text-white/80 text-sm">
                                        <span class="flex items-center gap-1.5">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            {{ $bannerEvent->date->format('d M Y') }}
                                        </span>
                                        <span class="flex items-center gap-1.5">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                            {{ Str::limit($bannerEvent->location, 30) }}
                                        </span>
                                    </div>
                                </div>
                                @php $minPrice = $bannerEvent->tickets->min('price'); @endphp
                                <a href="{{ route('events.show', $bannerEvent) }}" class="shrink-0 bg-white hover:bg-gray-50 text-[#4F46E5] px-5 py-2.5 rounded-xl font-bold text-sm transition-all shadow-lg hover:shadow-xl hover:scale-105 active:scale-95">
                                    @if($minPrice > 0)
                                        Mulai Rp{{ number_format($minPrice, 0, ',', '.') }}
                                    @else
                                        GRATIS
                                    @endif
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- Navigation Arrows --}}
                @if($bannerEvents->count() > 1)
                <button @click="prev()" class="absolute left-3 top-1/2 -translate-y-1/2 w-10 h-10 bg-white/20 backdrop-blur-sm text-white rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all hover:bg-white/40 hover:scale-110">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                </button>
                <button @click="next()" class="absolute right-3 top-1/2 -translate-y-1/2 w-10 h-10 bg-white/20 backdrop-blur-sm text-white rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all hover:bg-white/40 hover:scale-110">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </button>

                {{-- Dots --}}
                <div class="absolute bottom-3 left-1/2 -translate-x-1/2 flex gap-1.5">
                    @foreach($bannerEvents as $idx => $be)
                    <button @click="current = {{ $idx }}" :class="current === {{ $idx }} ? 'bg-white w-6' : 'bg-white/40 w-2'" class="h-2 rounded-full transition-all duration-300"></button>
                    @endforeach
                </div>
                @endif
            </div>
            @endif

            {{-- ============================================= --}}
            {{-- FILTER TABS + TICKET CARDS --}}
            {{-- ============================================= --}}
            @php
                $countAll      = $orders->count();
                $countPaid     = $orders->where('status','paid')->count();
                $countPending  = $orders->where('status','pending')->count();
                $countCanceled = $orders->where('status','canceled')->count();
            @endphp
            <div x-data="{ filter: 'semua' }" class="space-y-6">
                {{-- Filter Buttons --}}
                <div class="flex flex-wrap gap-3">
                    <button @click="filter = 'semua'" :class="filter === 'semua' ? 'bg-[#4F46E5] text-white shadow-md shadow-indigo-200 border-transparent' : 'bg-white text-gray-600 border-gray-200 hover:bg-gray-50'" class="px-5 py-2.5 rounded-full text-sm font-semibold border transition-all duration-200 inline-flex items-center gap-2">Semua <span class="bg-white/20 rounded-full px-1.5 py-0.5 text-[10px]">{{ $countAll }}</span></button>
                    <button @click="filter = 'paid'" :class="filter === 'paid' ? 'bg-[#4F46E5] text-white shadow-md shadow-indigo-200 border-transparent' : 'bg-white text-gray-600 border-gray-200 hover:bg-gray-50'" class="px-5 py-2.5 rounded-full text-sm font-semibold border transition-all duration-200 inline-flex items-center gap-2">Lunas <span class="bg-emerald-100 text-emerald-700 rounded-full px-1.5 py-0.5 text-[10px] font-bold">{{ $countPaid }}</span></button>
                    <button @click="filter = 'pending'" :class="filter === 'pending' ? 'bg-[#4F46E5] text-white shadow-md shadow-indigo-200 border-transparent' : 'bg-white text-gray-600 border-gray-200 hover:bg-gray-50'" class="px-5 py-2.5 rounded-full text-sm font-semibold border transition-all duration-200 inline-flex items-center gap-2">Pending @if($countPending > 0)<span class="bg-amber-100 text-amber-700 rounded-full px-1.5 py-0.5 text-[10px] font-bold animate-pulse">{{ $countPending }}</span>@endif</button>
                    <button @click="filter = 'canceled'" :class="filter === 'canceled' ? 'bg-[#4F46E5] text-white shadow-md shadow-indigo-200 border-transparent' : 'bg-white text-gray-600 border-gray-200 hover:bg-gray-50'" class="px-5 py-2.5 rounded-full text-sm font-semibold border transition-all duration-200 inline-flex items-center gap-2">Dibatalkan <span class="bg-red-100 text-red-600 rounded-full px-1.5 py-0.5 text-[10px] font-bold">{{ $countCanceled }}</span></button>
                </div>

                @php
                    $allTickets = [];
                    foreach($orders as $order) {
                        foreach($order->items as $item) {
                            for($i = 0; $i < $item->quantity; $i++) {
                                $allTickets[] = (object)[
                                    'uid' => $item->id . '-' . $i,
                                    'order' => $order,
                                    'item' => $item,
                                    'ticket' => $item->ticket,
                                    'event' => $item->ticket->event,
                                    'ticket_number' => $i + 1,
                                ];
                            }
                        }
                    }
                @endphp

                @if(count($allTickets) > 0)
                    {{-- Success Flash --}}
                    @if(session('success'))
                    <div class="bg-green-50 border border-green-200 rounded-xl p-4 flex items-center gap-3 animate-pulse">
                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <p class="text-green-800 font-semibold text-sm">{{ session('success') }}</p>
                    </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($allTickets as $idx => $t)
                            <div x-show="filter === 'semua' || filter === '{{ $t->order->status }}'"
                                 x-transition:enter="transition ease-out duration-300"
                                 x-transition:enter-start="opacity-0 translate-y-2"
                                 x-transition:enter-end="opacity-100 translate-y-0"
                                 class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden hover:shadow-lg transition-all duration-300 group">
                                {{-- Event Image Header --}}
                                <div class="h-36 relative overflow-hidden">
                                    @if($t->event->image)
                                        <img src="{{ Storage::url($t->event->image) }}" alt="{{ $t->event->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                    @else
                                        <div class="w-full h-full bg-gradient-to-br from-[#4F46E5] via-[#6366F1] to-[#818CF8] flex items-center justify-center">
                                            <svg class="w-12 h-12 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                                        </div>
                                    @endif
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
                                    
                                    {{-- Status Badge --}}
                                    <div class="absolute top-3 right-3">
                                        @if($t->order->status === 'paid')
                                            <span class="bg-emerald-500 text-white text-[10px] font-bold px-3 py-1 rounded-full shadow-sm uppercase tracking-wide flex items-center gap-1">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                                Lunas
                                            </span>
                                        @elseif($t->order->status === 'pending')
                                            <span class="bg-amber-500 text-white text-[10px] font-bold px-3 py-1 rounded-full shadow-sm uppercase tracking-wide flex items-center gap-1">
                                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.828a1 1 0 101.415-1.414L11 9.586V6z" clip-rule="evenodd"/></svg>
                                                Pending
                                            </span>
                                        @else
                                            <span class="bg-red-500 text-white text-[10px] font-bold px-3 py-1 rounded-full shadow-sm uppercase tracking-wide">{{ $t->order->status }}</span>
                                        @endif
                                    </div>

                                    {{-- Ticket Type Badge --}}
                                    <div class="absolute top-3 left-3">
                                        <span class="bg-white/90 backdrop-blur-sm text-[#4F46E5] text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider">{{ $t->ticket->type }}</span>
                                    </div>
                                </div>
                                
                                <div class="p-5">
                                    <h3 class="font-bold text-gray-900 text-[15px] mb-3 line-clamp-1 group-hover:text-[#4F46E5] transition-colors">{{ $t->event->name }}</h3>
                                    
                                    <div class="space-y-2 mb-4 text-sm text-gray-500">
                                        <div class="flex items-center gap-2.5">
                                            <div class="w-7 h-7 bg-indigo-50 rounded-lg flex items-center justify-center shrink-0">
                                                <svg class="w-3.5 h-3.5 text-[#4F46E5]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            </div>
                                            <span class="font-medium truncate">{{ $t->event->date->format('d M Y, H:i') }} WIB</span>
                                        </div>
                                        <div class="flex items-center gap-2.5">
                                            <div class="w-7 h-7 bg-indigo-50 rounded-lg flex items-center justify-center shrink-0">
                                                <svg class="w-3.5 h-3.5 text-[#4F46E5]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                            </div>
                                            <span class="font-medium truncate">{{ $t->event->location }}</span>
                                        </div>
                                    </div>
                                    
                                    {{-- Dashed separator (ticket-style) --}}
                                    <div class="relative my-4">
                                        <div class="absolute -left-5 top-1/2 -translate-y-1/2 w-4 h-8 bg-[#f8fafc] rounded-r-full"></div>
                                        <div class="absolute -right-5 top-1/2 -translate-y-1/2 w-4 h-8 bg-[#f8fafc] rounded-l-full"></div>
                                        <div class="border-t-2 border-dashed border-gray-100"></div>
                                    </div>

                                    <div class="flex justify-between items-center">
                                        <div>
                                            <div class="text-[11px] text-gray-400 font-semibold uppercase tracking-wider">Order ID</div>
                                            <div class="text-sm font-bold text-gray-800">#{{ str_pad($t->order->id, 6, '0', STR_PAD_LEFT) }}</div>
                                        </div>
                                        @if($t->order->status === 'pending')
                                            <a href="{{ route('user.transactions.show', $t->order) }}" class="bg-amber-500 hover:bg-amber-600 text-white font-bold text-xs px-4 py-2.5 rounded-xl transition-all shadow-sm hover:shadow-md flex items-center gap-1.5">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                                                Selesaikan Bayar
                                            </a>
                                        @elseif($t->order->status === 'canceled')
                                            <span class="text-xs font-bold text-red-400 px-3 py-2 bg-red-50 rounded-xl">Dibatalkan</span>
                                        @else
                                            <a href="{{ route('user.tickets.show', $t->order) }}" class="bg-[#4F46E5] hover:bg-[#4338CA] text-white font-bold text-xs px-4 py-2.5 rounded-xl transition-all shadow-sm hover:shadow-md flex items-center gap-1.5">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/></svg>
                                                Lihat Tiket
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    {{-- Empty State --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-12 flex flex-col items-center justify-center text-center">
                        <div class="w-28 h-28 bg-gradient-to-br from-indigo-50 to-purple-50 rounded-full flex items-center justify-center mb-6 relative">
                            <div class="absolute inset-0 border-2 border-dashed border-indigo-200 rounded-full animate-spin" style="animation-duration: 20s;"></div>
                            <svg class="w-14 h-14 text-[#4F46E5]/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-[#0F172A] mb-2">Belum Ada Tiket</h3>
                        <p class="text-gray-500 max-w-md mx-auto mb-8">Anda belum memiliki tiket apapun. Silakan temukan dan beli tiket event menarik melalui halaman utama kami.</p>
                        <a href="/" class="bg-[#4F46E5] hover:bg-[#4338CA] text-white font-semibold py-3 px-8 rounded-xl transition-all shadow-md hover:shadow-lg inline-flex items-center gap-2 hover:scale-105 active:scale-95">
                            Cari Event
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                    </div>
                @endif
            </div>

        </div>
    </div>

</x-app-layout>
