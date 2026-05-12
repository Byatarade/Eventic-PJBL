<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-deep-navy leading-tight">
            {{ __('Tiket Saya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Filter / Tabs -->
            <div x-data="{ filter: 'semua' }" class="mb-6">
                <div class="flex flex-wrap gap-3 mb-4">
                    <button @click="filter = 'semua'" :class="filter === 'semua' ? 'bg-electric-blue text-white shadow-md border-transparent' : 'bg-white text-gray-600 border-gray-200 hover:bg-gray-50 hover:text-deep-navy'" class="px-5 py-2.5 rounded-full text-sm font-semibold border transition-all duration-200">Semua Tiket</button>
                    <button @click="filter = 'pending'" :class="filter === 'pending' ? 'bg-electric-blue text-white shadow-md border-transparent' : 'bg-white text-gray-600 border-gray-200 hover:bg-gray-50 hover:text-deep-navy'" class="px-5 py-2.5 rounded-full text-sm font-semibold border transition-all duration-200">Pending</button>
                    <button @click="filter = 'paid'" :class="filter === 'paid' ? 'bg-electric-blue text-white shadow-md border-transparent' : 'bg-white text-gray-600 border-gray-200 hover:bg-gray-50 hover:text-deep-navy'" class="px-5 py-2.5 rounded-full text-sm font-semibold border transition-all duration-200">Lunas (Paid)</button>
                    <button @click="filter = 'expired'" :class="filter === 'expired' ? 'bg-electric-blue text-white shadow-md border-transparent' : 'bg-white text-gray-600 border-gray-200 hover:bg-gray-50 hover:text-deep-navy'" class="px-5 py-2.5 rounded-full text-sm font-semibold border transition-all duration-200">Kadaluarsa</button>
                </div>

                @php
                    $allTickets = [];
                    foreach($orders as $order) {
                        foreach($order->items as $item) {
                            for($i = 0; $i < $item->quantity; $i++) {
                                $allTickets[] = (object)[
                                    'id' => $item->id . '-' . $i,
                                    'order' => $order,
                                    'ticket' => $item->ticket,
                                    'event' => $item->ticket->event,
                                ];
                            }
                        }
                    }
                @endphp

                @if(count($allTickets) > 0)
                    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($allTickets as $t)
                            <div x-show="filter === 'semua' || filter === '{{ $t->order->status }}'" class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden hover:shadow-md transition-all group">
                                <!-- Event Image Header -->
                                <div class="h-32 bg-gray-200 relative overflow-hidden">
                                    @if($t->event->banner)
                                        <img src="{{ Storage::url($t->event->banner) }}" alt="{{ $t->event->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    @else
                                        <div class="w-full h-full bg-gradient-to-r from-[#4F46E5] to-[#2D336B]"></div>
                                    @endif
                                    <div class="absolute top-3 right-3">
                                        @if($t->order->status === 'paid')
                                            <span class="bg-green-500 text-white text-[11px] font-bold px-2.5 py-1 rounded-full shadow-sm">LUNAS</span>
                                        @else
                                            <span class="bg-amber-500 text-white text-[11px] font-bold px-2.5 py-1 rounded-full shadow-sm uppercase">{{ $t->order->status }}</span>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="p-5">
                                    <div class="text-xs font-bold text-[#4F46E5] mb-1 uppercase tracking-wider">{{ $t->ticket->type }}</div>
                                    <h3 class="font-bold text-gray-900 text-lg mb-3 line-clamp-1">{{ $t->event->name }}</h3>
                                    
                                    <div class="space-y-2 mb-4 text-sm text-gray-600">
                                        <div class="flex items-center gap-2">
                                            <svg class="w-4 h-4 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            <span class="truncate">{{ $t->event->date->format('d M Y, H:i') }}</span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <svg class="w-4 h-4 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                            <span class="truncate">{{ $t->event->location }}</span>
                                        </div>
                                    </div>
                                    
                                    <div class="pt-4 border-t border-gray-100 flex justify-between items-center">
                                        <div class="text-xs text-gray-500 font-medium">Order ID: #{{ str_pad($t->order->id, 5, '0', STR_PAD_LEFT) }}</div>
                                        <button x-data x-on:click="$dispatch('open-modal', 'eticket-modal')" class="text-[#4F46E5] hover:text-[#4338CA] font-bold text-sm flex items-center gap-1 transition-colors">
                                            Lihat E-Ticket
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <!-- Empty State -->
                    <div class="mt-8 bg-white rounded-2xl shadow-sm border border-gray-100 p-12 flex flex-col items-center justify-center text-center">
                        <div class="w-24 h-24 bg-indigo-50 rounded-full flex items-center justify-center mb-6">
                            <svg class="w-12 h-12 text-[#4F46E5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-[#2D336B] mb-2">Belum Ada Tiket</h3>
                        <p class="text-gray-500 max-w-md mx-auto mb-8">Anda belum memiliki tiket apapun. Silakan temukan dan beli tiket event menarik melalui halaman utama kami.</p>
                        <a href="/" class="bg-[#4F46E5] hover:bg-[#4338CA] text-white font-semibold py-3 px-8 rounded-xl transition-colors shadow-sm inline-flex items-center gap-2">
                            Cari Event
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                    </div>
                @endif
            </div>

        </div>
    </div>

    <!-- E-Ticket Modal Placeholder -->
    <x-modal name="eticket-modal" focusable>
        <div class="p-6">
            <h2 class="text-xl font-bold text-deep-navy mb-4 text-center">E-Ticket Detail</h2>
            <div class="text-center py-8">
                <p class="text-gray-500">QR Code will be rendered here dynamically.</p>
            </div>
            <div class="mt-8 flex justify-end">
                <button x-on:click="$dispatch('close')" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-6 rounded-xl transition-colors">
                    Tutup
                </button>
            </div>
        </div>
    </x-modal>

</x-app-layout>
