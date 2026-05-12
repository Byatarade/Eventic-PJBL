<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-deep-navy leading-tight">
            {{ __('Riwayat Transaksi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Filter / Tabs -->
            <div x-data="{ filter: 'semua' }" class="mb-6">
                <div class="flex flex-wrap gap-3 mb-8">
                    <button @click="filter = 'semua'" :class="filter === 'semua' ? 'bg-[#4F46E5] text-white shadow-md' : 'bg-white text-gray-600 border-gray-200 hover:bg-gray-50'" class="px-5 py-2.5 rounded-full text-sm font-semibold border transition-all duration-200">Semua Transaksi</button>
                    <button @click="filter = 'paid'" :class="filter === 'paid' ? 'bg-[#4F46E5] text-white shadow-md' : 'bg-white text-gray-600 border-gray-200 hover:bg-gray-50'" class="px-5 py-2.5 rounded-full text-sm font-semibold border transition-all duration-200">Berhasil</button>
                    <button @click="filter = 'pending'" :class="filter === 'pending' ? 'bg-[#4F46E5] text-white shadow-md' : 'bg-white text-gray-600 border-gray-200 hover:bg-gray-50'" class="px-5 py-2.5 rounded-full text-sm font-semibold border transition-all duration-200">Menunggu</button>
                    <button @click="filter = 'canceled'" :class="filter === 'canceled' ? 'bg-[#4F46E5] text-white shadow-md' : 'bg-white text-gray-600 border-gray-200 hover:bg-gray-50'" class="px-5 py-2.5 rounded-full text-sm font-semibold border transition-all duration-200">Batal</button>
                </div>

                @if($orders->count() > 0)
                    <div class="mt-6 space-y-4">
                        @foreach($orders as $order)
                            <div x-show="filter === 'semua' || filter === '{{ $order->status }}'" 
                                 class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden hover:shadow-md transition-all">
                                <div class="p-5 sm:p-6 flex flex-col md:flex-row md:items-center justify-between gap-6">
                                    {{-- Left: Transaction Info --}}
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 rounded-xl bg-indigo-50 flex items-center justify-center shrink-0">
                                            <svg class="w-6 h-6 text-[#4F46E5]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                        </div>
                                        <div>
                                            <div class="flex items-center gap-2 mb-0.5">
                                                <span class="text-sm font-bold text-gray-900">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</span>
                                                <span class="text-xs text-gray-400 font-medium">•</span>
                                                <span class="text-xs text-gray-500 font-medium">{{ $order->created_at->format('d M Y, H:i') }}</span>
                                            </div>
                                            <h4 class="font-bold text-gray-900 truncate max-w-[200px] sm:max-w-xs">
                                                {{ $order->items->first()->ticket->event->name ?? 'Event' }}
                                                @if($order->items->count() > 1)
                                                    <span class="text-gray-400 text-xs font-medium ml-1">+{{ $order->items->count() - 1 }} item lainnya</span>
                                                @endif
                                            </h4>
                                        </div>
                                    </div>

                                    {{-- Middle: Status & Price --}}
                                    <div class="flex items-center justify-between md:justify-center gap-8 md:gap-12 flex-1">
                                        <div class="text-left md:text-center">
                                            <div class="text-[10px] text-gray-400 font-bold uppercase tracking-wider mb-1">Total Bayar</div>
                                            <div class="text-sm font-black text-gray-900">Rp{{ number_format($order->total_price, 0, ',', '.') }}</div>
                                        </div>
                                        <div class="text-right md:text-center">
                                            <div class="text-[10px] text-gray-400 font-bold uppercase tracking-wider mb-1">Status</div>
                                            @if($order->status === 'paid')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700 uppercase">Lunas</span>
                                            @elseif($order->status === 'pending')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-amber-100 text-amber-700 uppercase">Pending</span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-red-100 text-red-700 uppercase">{{ $order->status }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- Right: Actions --}}
                                    <div class="flex items-center justify-end">
                                        <a href="{{ route('user.transactions.show', $order) }}" class="inline-flex items-center justify-center px-5 py-2.5 bg-gray-900 text-white text-xs font-bold rounded-xl hover:bg-gray-800 transition-all active:scale-95 shadow-sm">
                                            Detail Transaksi
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <!-- Empty State -->
                    <div class="mt-8 bg-white rounded-2xl shadow-sm border border-gray-100 p-12 flex flex-col items-center justify-center text-center">
                        <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mb-6">
                            <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-deep-navy mb-2">Belum Ada Transaksi</h3>
                        <p class="text-gray-500 max-w-md mx-auto mb-8">Anda belum melakukan transaksi apapun. Beli tiket event sekarang dan mulai pengalaman seru Anda.</p>
                        <a href="/" class="bg-[#4F46E5] hover:bg-blue-700 text-white font-semibold py-3 px-8 rounded-xl transition-colors shadow-sm inline-flex items-center gap-2">
                            Cari Event
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
