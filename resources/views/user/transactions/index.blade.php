<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-900 tracking-tight">
            {{ __('Riwayat Transaksi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Filter / Tabs -->
            @php
                $countAll = $orders->count();
                $countPaid = $orders->where('status', 'paid')->count();
                $countPending = $orders->where('status', 'pending')->count();
                $countCanceled = $orders->where('status', 'canceled')->count();
            @endphp
            <div x-data="{ filter: 'semua' }" class="mb-10">
                <div class="flex flex-wrap gap-3 mb-10">
                    <button @click="filter = 'semua'" :class="filter === 'semua' ? 'bg-slate-900 text-white shadow-lg shadow-slate-900/10 border-transparent' : 'bg-white text-slate-600 border-slate-100 hover:bg-slate-50'" class="px-6 py-3 rounded-xl text-sm font-bold border transition-all duration-200 inline-flex items-center gap-2">
                        Semua <span class="bg-white/20 rounded-full px-2 py-0.5 text-[10px]">{{ $countAll }}</span>
                    </button>
                    <button @click="filter = 'paid'" :class="filter === 'paid' ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/10 border-transparent' : 'bg-white text-slate-600 border-slate-100 hover:bg-slate-50'" class="px-6 py-3 rounded-xl text-sm font-bold border transition-all duration-200 inline-flex items-center gap-2">
                        Berhasil <span class="bg-white/20 rounded-full px-2 py-0.5 text-[10px] font-bold">{{ $countPaid }}</span>
                    </button>
                    <button @click="filter = 'pending'" :class="filter === 'pending' ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/10 border-transparent' : 'bg-white text-slate-600 border-slate-100 hover:bg-slate-50'" class="px-6 py-3 rounded-xl text-sm font-bold border transition-all duration-200 inline-flex items-center gap-2">
                        Menunggu @if($countPending > 0)<span class="bg-white/20 rounded-full px-2 py-0.5 text-[10px] font-bold animate-pulse">{{ $countPending }}</span>@endif
                    </button>
                    <button @click="filter = 'canceled'" :class="filter === 'canceled' ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/10 border-transparent' : 'bg-white text-slate-600 border-slate-100 hover:bg-slate-50'" class="px-6 py-3 rounded-xl text-sm font-bold border transition-all duration-200 inline-flex items-center gap-2">
                        Batal <span class="bg-white/20 rounded-full px-2 py-0.5 text-[10px] font-bold">{{ $countCanceled }}</span>
                    </button>
                </div>

                @if($orders->count() > 0)
                    <div class="mt-6 space-y-4">
                        @foreach($orders as $order)
                            <div x-show="filter === 'semua' || filter === '{{ $order->status }}'" 
                                 class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden hover:shadow-md transition-all group">
                                <div class="p-5 sm:p-6 flex flex-col md:flex-row md:items-center justify-between gap-6">
                                    {{-- Left: Transaction Info --}}
                                    <div class="flex items-center gap-5">
                                        <div class="w-14 h-14 rounded-xl bg-slate-50 flex items-center justify-center shrink-0 border border-slate-100 group-hover:bg-blue-50 transition-colors">
                                            <svg class="w-7 h-7 text-slate-400 group-hover:text-blue-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                        </div>
                                        <div>
                                            <div class="flex items-center gap-2 mb-1.5">
                                                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</span>
                                                <span class="text-xs text-slate-200 font-medium">•</span>
                                                <span class="text-[11px] text-slate-400 font-bold uppercase tracking-wider">{{ $order->created_at->format('d M Y, H:i') }}</span>
                                            </div>
                                            <h4 class="font-bold text-slate-900 group-hover:text-blue-600 transition-colors truncate max-w-[200px] sm:max-w-xs text-lg tracking-tight">
                                                {{ $order->items->first()->ticket->event->name ?? 'Event' }}
                                                @if($order->items->count() > 1)
                                                    <span class="text-slate-400 text-xs font-medium ml-1">+{{ $order->items->count() - 1 }} item lainnya</span>
                                                @endif
                                            </h4>
                                        </div>
                                    </div>

                                    {{-- Middle: Status & Price --}}
                                    <div class="flex items-center justify-between md:justify-center gap-8 md:gap-16 flex-1">
                                        <div class="text-left md:text-center">
                                            <div class="text-[10px] text-slate-400 font-bold uppercase tracking-[0.1em] mb-1.5">Total Bayar</div>
                                            <div class="text-base font-bold text-slate-900 tracking-tight">Rp{{ number_format($order->total_price, 0, ',', '.') }}</div>
                                        </div>
                                        <div class="text-right md:text-center">
                                            <div class="text-[10px] text-slate-400 font-bold uppercase tracking-[0.1em] mb-1.5">Status</div>
                                            @if($order->status === 'paid')
                                                <span class="inline-flex items-center px-3 py-1 rounded-lg text-[10px] font-bold bg-emerald-50 text-emerald-600 uppercase tracking-tight">Lunas</span>
                                            @elseif($order->status === 'pending')
                                                <span class="inline-flex items-center px-3 py-1 rounded-lg text-[10px] font-bold bg-amber-50 text-amber-600 uppercase tracking-tight">Pending</span>
                                            @else
                                                <span class="inline-flex items-center px-3 py-1 rounded-lg text-[10px] font-bold bg-rose-50 text-rose-600 uppercase tracking-tight">{{ $order->status }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- Right: Actions --}}
                                    <div class="flex items-center justify-end">
                                        <a href="{{ route('user.transactions.show', $order) }}" class="inline-flex items-center justify-center px-6 py-3 bg-slate-900 text-white text-xs font-bold rounded-xl hover:bg-slate-800 transition-all active:scale-95 shadow-sm">
                                            Detail Transaksi
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <!-- Empty State -->
                    <div class="mt-8 bg-white rounded-2xl shadow-sm border border-slate-100 p-20 flex flex-col items-center justify-center text-center">
                        <div class="w-24 h-24 bg-slate-50 rounded-3xl flex items-center justify-center mb-8 border border-slate-100 shadow-inner">
                            <svg class="w-12 h-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-900 mb-2 tracking-tight">Belum Ada Transaksi</h3>
                        <p class="text-slate-400 max-w-md mx-auto mb-10 font-medium">Anda belum melakukan transaksi apapun. Beli tiket event sekarang dan mulai pengalaman seru Anda.</p>
                        <a href="/" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3.5 px-8 rounded-xl transition-all shadow-lg shadow-blue-600/10 inline-flex items-center gap-2 active:scale-95">
                            Cari Event Sekarang
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
