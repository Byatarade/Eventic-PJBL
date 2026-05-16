<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <a href="{{ route('user.tickets.index') }}" class="w-9 h-9 bg-gray-100 hover:bg-gray-200 rounded-xl flex items-center justify-center transition-colors">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </a>
                <h2 class="font-bold text-2xl text-deep-navy leading-tight">Detail Tiket</h2>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @php $event = $order->items->first()->ticket->event ?? null; @endphp

            {{-- EVENT BANNER --}}
            @if($event)
            <div class="relative rounded-2xl overflow-hidden shadow-lg h-[200px] sm:h-[260px]">
                @if($event->image)
                    <img src="{{ Storage::url($event->image) }}" alt="{{ $event->name }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full bg-gradient-to-br from-[#4F46E5] via-[#6366F1] to-[#818CF8]"></div>
                @endif
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent"></div>
                <div class="absolute bottom-0 left-0 right-0 p-6 sm:p-8">
                    <h2 class="text-white font-bold text-xl sm:text-2xl mb-1">{{ $event->name }}</h2>
                    <div class="flex flex-wrap items-center gap-4 text-white/80 text-sm">
                        <span class="flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            {{ $event->date->format('d M Y, H:i') }} WIB
                        </span>
                        <span class="flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                            {{ $event->location }}
                        </span>
                    </div>
                </div>
                <div class="absolute top-4 right-4">
                    @if($order->status === 'paid')
                        <span class="bg-emerald-500 text-white text-xs font-bold px-4 py-2 rounded-full shadow-lg uppercase">Lunas</span>
                    @elseif($order->status === 'pending')
                        <span class="bg-amber-500 text-white text-xs font-bold px-4 py-2 rounded-full shadow-lg uppercase">Pending</span>
                    @else
                        <span class="bg-red-500 text-white text-xs font-bold px-4 py-2 rounded-full shadow-lg uppercase">{{ ucfirst($order->status) }}</span>
                    @endif
                </div>
            </div>
            @endif

            {{-- ORDER INFO --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="px-6 py-5 bg-gray-50/70 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-indigo-100 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-[#4F46E5]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Informasi Pesanan</h3>
                            <p class="text-sm text-gray-500">Order #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</p>
                        </div>
                    </div>
                    <div class="text-sm text-gray-500 font-medium">Dipesan pada {{ $order->created_at->format('d M Y, H:i') }} WIB</div>
                </div>
                <div class="p-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div class="bg-gray-50 rounded-xl p-4">
                        <div class="text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1">Status</div>
                        <div class="text-sm font-bold {{ $order->status === 'paid' ? 'text-emerald-600' : ($order->status === 'pending' ? 'text-amber-600' : 'text-red-600') }}">{{ $order->status === 'paid' ? 'Lunas' : ($order->status === 'pending' ? 'Menunggu' : ucfirst($order->status)) }}</div>
                    </div>
                    <div class="bg-gray-50 rounded-xl p-4">
                        <div class="text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1">Total Tiket</div>
                        <div class="text-gray-900 font-bold text-sm">{{ $order->items->sum('quantity') }} Tiket</div>
                    </div>
                    <div class="bg-gray-50 rounded-xl p-4">
                        <div class="text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1">Total Bayar</div>
                        <div class="text-[#4F46E5] font-bold text-lg">Rp{{ number_format($order->total_price, 0, ',', '.') }}</div>
                    </div>
                    <div class="bg-gray-50 rounded-xl p-4">
                        <div class="text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1">Batas Bayar</div>
                        <div class="text-gray-900 font-bold text-sm">{{ $order->expired_at ? \Carbon\Carbon::parse($order->expired_at)->format('d M Y, H:i') : '-' }}</div>
                    </div>
                </div>
            </div>

            {{-- REFUND STATUS --}}
            @if($order->refundRequest)
            <div class="bg-blue-50 border border-blue-200 rounded-2xl p-5 flex items-center gap-4">
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div class="flex-1">
                    <h4 class="font-bold text-blue-800 mb-1">Permintaan Refund Sedang Diproses</h4>
                    <p class="text-blue-700 text-sm">Status: <span class="font-bold uppercase">{{ $order->refundRequest->status }}</span>. {{ $order->refundRequest->admin_notes ?: 'EO sedang meninjau pengajuan Anda.' }}</p>
                </div>
            </div>
            @endif

            @if($order->status === 'pending')
            <div class="bg-amber-50 border border-amber-200 rounded-2xl p-5 flex flex-col sm:flex-row items-start sm:items-center gap-4">
                <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div class="flex-1">
                    <h4 class="font-bold text-amber-800 mb-1">Pembayaran Belum Selesai</h4>
                    <p class="text-amber-700 text-sm">Anda sudah mengisi data pesanan namun belum menyelesaikan pembayaran. Selesaikan sebelum <span class="font-bold">{{ $order->expired_at ? \Carbon\Carbon::parse($order->expired_at)->format('d M Y, H:i') : '-' }} WIB</span> agar tiket tidak hangus.</p>
                </div>
                <a href="{{ route('user.transactions.show', $order) }}" class="shrink-0 bg-amber-500 hover:bg-amber-600 text-white font-bold text-sm px-5 py-2.5 rounded-xl transition-all shadow-sm">
                    Selesaikan Pembayaran
                </a>
            </div>
            @elseif($order->status === 'canceled')
            <div class="bg-red-50 border border-red-200 rounded-2xl p-5 flex items-center gap-4">
                <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </div>
                <div>
                    <h4 class="font-bold text-red-700 mb-1">Pesanan Dibatalkan</h4>
                    <p class="text-red-600 text-sm">Pesanan ini telah dibatalkan karena batas waktu pembayaran telah habis atau dibatalkan secara manual.</p>
                </div>
            </div>
            @endif

            {{-- E-TICKET CARDS --}}
            <div class="space-y-4">
                <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                    <svg class="w-5 h-5 text-[#4F46E5]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/></svg>
                    {{ $order->status === 'paid' ? 'E-Ticket' : 'Tiket (Belum Aktif)' }} ({{ $order->items->sum('quantity') }})
                </h3>

                @php $ticketNum = 0; @endphp
                @foreach($order->items as $item)
                    @for($i = 0; $i < $item->quantity; $i++)
                    @php $ticketNum++; @endphp
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden hover:shadow-md transition-shadow">
                        <div class="flex flex-col sm:flex-row">
                            <div class="flex-1 p-6">
                                <div class="flex items-start justify-between mb-4">
                                    <div>
                                        <div class="text-[11px] font-bold text-[#4F46E5] uppercase tracking-wider mb-1">{{ $item->ticket->type }} — Tiket #{{ $ticketNum }}</div>
                                        <h4 class="text-lg font-bold text-gray-900">{{ $item->ticket->event->name }}</h4>
                                    </div>
                                    <span class="bg-indigo-50 text-[#4F46E5] text-xs font-bold px-3 py-1.5 rounded-lg">Rp{{ number_format($item->price, 0, ',', '.') }}</span>
                                </div>
                                <div class="grid grid-cols-2 gap-4 text-sm">
                                    <div>
                                        <div class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider mb-0.5">Tanggal</div>
                                        <div class="text-gray-800 font-medium">{{ $item->ticket->event->date->format('d M Y') }}</div>
                                    </div>
                                    <div>
                                        <div class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider mb-0.5">Waktu</div>
                                        <div class="text-gray-800 font-medium">{{ $item->ticket->event->date->format('H:i') }} WIB</div>
                                    </div>
                                    <div>
                                        <div class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider mb-0.5">Lokasi</div>
                                        <div class="text-gray-800 font-medium">{{ $item->ticket->event->location }}</div>
                                    </div>
                                    <div>
                                        <div class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider mb-0.5">Pemesan</div>
                                        <div class="text-gray-800 font-medium">{{ Auth::user()->name }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="sm:w-44 bg-gray-50 border-t sm:border-t-0 sm:border-l border-dashed border-gray-200 p-6 flex flex-col items-center justify-center">
                                <div class="w-28 h-28 bg-white rounded-xl border border-gray-100 flex items-center justify-center mb-2 p-2 shadow-sm">
                                    {!! SimpleSoftwareIO\QrCode\Facades\QrCode::size(100)->generate(route('user.tickets.download', $order)) !!}
                                </div>
                                <span class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">TKT-{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}-{{ $ticketNum }}</span>
                            </div>
                        </div>
                    </div>
                    @endfor
                @endforeach
            </div>

            {{-- ACTIONS --}}
            <div class="flex flex-col md:flex-row items-center justify-between gap-6 pt-10 border-t border-gray-100">
                <a href="{{ route('user.tickets.index') }}" class="group flex items-center gap-3 text-gray-500 hover:text-gray-900 font-bold transition-all shrink-0">
                    <div class="w-10 h-10 rounded-2xl bg-white border border-gray-200 flex items-center justify-center group-hover:bg-gray-50 group-hover:border-gray-300 shadow-sm transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                    </div>
                    <span>Kembali ke Daftar</span>
                </a>

                <div class="flex flex-wrap items-center justify-center md:justify-end gap-3 w-full">
                    @if($order->status === 'pending')
                        <a href="{{ route('user.transactions.show', $order) }}" class="w-full sm:w-auto px-8 py-3.5 bg-amber-500 hover:bg-amber-600 text-white rounded-2xl font-black text-sm transition-all shadow-lg shadow-amber-200 active:scale-95 flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                            Selesaikan Pembayaran
                        </a>
                    @elseif($order->status === 'paid')
                        {{-- Refund (Only if not requested) --}}
                        @if(!$order->refundRequest)
                        <a href="{{ route('user.refunds.create', $order) }}" class="w-full sm:w-auto px-5 py-3.5 bg-red-50 text-red-600 border border-red-100 rounded-2xl font-bold text-sm hover:bg-red-100 transition-all flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Ajukan Refund
                        </a>
                        @endif

                        {{-- View Transaction --}}
                        <a href="{{ route('user.transactions.show', $order) }}" class="w-full sm:w-auto px-6 py-3.5 bg-indigo-50 text-[#4F46E5] rounded-2xl font-bold text-sm hover:bg-indigo-100 transition-all flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            Lihat Transaksi
                        </a>

                        {{-- Download PDF (Primary) --}}
                        <a href="{{ route('user.tickets.download', $order) }}" class="w-full sm:w-auto px-8 py-3.5 bg-[#4F46E5] hover:bg-[#4338CA] text-white rounded-2xl font-black text-sm transition-all shadow-lg shadow-indigo-200 active:scale-95 flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                            Download E-Ticket
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
