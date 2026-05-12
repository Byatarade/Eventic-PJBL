<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('user.transactions.index') }}" class="w-9 h-9 bg-gray-100 hover:bg-gray-200 rounded-xl flex items-center justify-center transition-colors">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <h2 class="font-bold text-2xl text-deep-navy leading-tight">Detail Transaksi</h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                {{-- Left: Transaction Summary --}}
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                        <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
                            <h3 class="font-bold text-gray-900">Rincian Produk</h3>
                            <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</span>
                        </div>
                        <div class="p-6 space-y-6">
                            @foreach($order->items as $item)
                                <div class="flex gap-4">
                                    <div class="w-20 h-20 rounded-xl bg-gray-100 overflow-hidden shrink-0">
                                        @if($item->ticket->event->image)
                                            <img src="{{ Storage::url($item->ticket->event->image) }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full bg-gradient-to-br from-indigo-500 to-purple-500 flex items-center justify-center">
                                                <svg class="w-8 h-8 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/></svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h4 class="font-bold text-gray-900 mb-1 truncate">{{ $item->ticket->event->name }}</h4>
                                        <div class="text-xs font-bold text-[#4F46E5] uppercase tracking-wider mb-2">{{ $item->ticket->type }}</div>
                                        <div class="flex items-center justify-between">
                                            <span class="text-sm text-gray-500 font-medium">{{ $item->quantity }} x Rp{{ number_format($item->price, 0, ',', '.') }}</span>
                                            <span class="text-sm font-black text-gray-900">Rp{{ number_format($item->quantity * $item->price, 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="bg-gray-50/50 p-6 space-y-3">
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-gray-500 font-medium">Subtotal</span>
                                <span class="text-gray-900 font-bold">Rp{{ number_format($order->total_price, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-gray-500 font-medium">Biaya Layanan</span>
                                <span class="text-emerald-600 font-bold">Gratis</span>
                            </div>
                            <div class="pt-3 border-t border-gray-100 flex justify-between items-center">
                                <span class="font-bold text-gray-900">Total Bayar</span>
                                <span class="text-xl font-black text-[#4F46E5]">Rp{{ number_format($order->total_price, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- Order Information --}}
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                        <h3 class="font-bold text-gray-900 mb-6 flex items-center gap-2">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Informasi Transaksi
                        </h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-6 gap-x-4">
                            <div>
                                <div class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-1">Metode Pembayaran</div>
                                <div class="text-sm font-bold text-gray-800">Transfer Bank / E-Wallet</div>
                            </div>
                            <div>
                                <div class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-1">Status Transaksi</div>
                                @if($order->status === 'paid')
                                    <span class="inline-flex items-center gap-1 text-emerald-600 font-bold text-sm uppercase">Lunas</span>
                                @elseif($order->status === 'pending')
                                    <span class="inline-flex items-center gap-1 text-amber-600 font-bold text-sm uppercase">Menunggu</span>
                                @else
                                    <span class="text-red-600 font-bold text-sm uppercase">{{ $order->status }}</span>
                                @endif
                            </div>
                            <div>
                                <div class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-1">Waktu Pembelian</div>
                                <div class="text-sm font-bold text-gray-800">{{ $order->created_at->format('d M Y, H:i') }} WIB</div>
                            </div>
                            <div>
                                <div class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-1">Batas Pembayaran</div>
                                <div class="text-sm font-bold text-gray-800">{{ $order->expired_at ? \Carbon\Carbon::parse($order->expired_at)->format('d M Y, H:i') : '-' }} WIB</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right: Status & Action --}}
                <div class="space-y-6">
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 text-center">
                        <div class="mb-4">
                            @if($order->status === 'paid')
                                <div class="w-16 h-16 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                </div>
                                <h4 class="font-bold text-gray-900 text-lg mb-1">Pembayaran Berhasil</h4>
                                <p class="text-xs text-gray-500 font-medium">Terima kasih atas pembelian Anda!</p>
                            @elseif($order->status === 'pending')
                                <div class="w-16 h-16 bg-amber-100 text-amber-600 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                </div>
                                <h4 class="font-bold text-gray-900 text-lg mb-1">Menunggu Pembayaran</h4>
                                <p class="text-xs text-gray-500 font-medium">Segera selesaikan pembayaran sebelum batas waktu berakhir.</p>
                            @else
                                <div class="w-16 h-16 bg-red-100 text-red-600 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                </div>
                                <h4 class="font-bold text-gray-900 text-lg mb-1">Transaksi {{ ucfirst($order->status) }}</h4>
                            @endif
                        </div>
                        
                        @if($order->status === 'paid')
                            <a href="{{ route('user.tickets.show', $order) }}" class="w-full inline-flex items-center justify-center px-6 py-3 bg-[#4F46E5] text-white font-bold rounded-xl hover:bg-indigo-700 shadow-md transition-all active:scale-95 gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/></svg>
                                Lihat Tiket
                            </a>
                        @endif
                    </div>

                    <div class="bg-[#4F46E5]/5 border border-[#4F46E5]/10 rounded-2xl p-6">
                        <h5 class="text-sm font-bold text-[#4F46E5] mb-2 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Butuh Bantuan?
                        </h5>
                        <p class="text-xs text-indigo-900/60 leading-relaxed mb-4">Jika Anda mengalami kendala pada transaksi ini, hubungi tim support kami melalui WhatsApp atau Email.</p>
                        <a href="#" class="text-xs font-bold text-[#4F46E5] hover:underline">Hubungi Kami</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
