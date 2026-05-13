<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center gap-8">
            <div>
                <h2 class="font-bold text-2xl text-deep-navy leading-tight">
                    {{ __('Manajemen Transaksi') }}
                </h2>
                <p class="text-slate-500 text-sm font-medium mt-1">Kelola dan pantau seluruh transaksi tiket event Anda.</p>
            </div>
            <div class="flex items-center gap-3">
                <button class="bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 px-4 py-2 rounded-xl text-sm font-bold transition-colors shadow-sm flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                    Export CSV
                </button>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Filter & Search Bar -->
            <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm p-6">
                <form method="GET" action="{{ route('eo.transactions.index') }}" class="flex flex-col md:flex-row gap-4 items-end">
                    <div class="flex-1 w-full">
                        <label for="search" class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Pencarian</label>
                        <div class="relative">
                            <input type="text" id="search" name="search" value="{{ request('search') }}" placeholder="Cari nama pembeli, email, atau ID Order..." class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:border-electric-blue focus:ring-electric-blue transition-colors">
                            <svg class="w-5 h-5 text-slate-400 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                    </div>
                    <div class="w-full md:w-64">
                        <label for="status" class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Status Transaksi</label>
                        <select id="status" name="status" class="w-full py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:border-electric-blue focus:ring-electric-blue transition-colors">
                            <option value="">Semua Status</option>
                            <option value="paid" {{ request('status') === 'paid' ? 'selected' : '' }}>Lunas</option>
                            <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="canceled" {{ request('status') === 'canceled' ? 'selected' : '' }}>Batal</option>
                        </select>
                    </div>
                    <div>
                        <button type="submit" class="w-full md:w-auto px-8 py-3 bg-electric-blue hover:bg-blue-600 text-white rounded-xl font-bold transition-all shadow-sm flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                            Filter
                        </button>
                    </div>
                </form>
            </div>

            <!-- Transactions Table -->
            <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/50 border-b border-slate-100">
                                <th class="px-6 py-5 text-xs font-bold text-slate-400 uppercase tracking-widest">Order ID</th>
                                <th class="px-6 py-5 text-xs font-bold text-slate-400 uppercase tracking-widest">Pembeli</th>
                                <th class="px-6 py-5 text-xs font-bold text-slate-400 uppercase tracking-widest">Event & Tiket</th>
                                <th class="px-6 py-5 text-xs font-bold text-slate-400 uppercase tracking-widest">Tanggal</th>
                                <th class="px-6 py-5 text-xs font-bold text-slate-400 uppercase tracking-widest">Status</th>
                                <th class="px-6 py-5 text-xs font-bold text-slate-400 uppercase tracking-widest text-right">Total</th>
                                <th class="px-6 py-5 text-xs font-bold text-slate-400 uppercase tracking-widest text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse($orders as $order)
                                <tr class="hover:bg-slate-50/50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="font-bold text-deep-navy">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-full bg-indigo-50 flex items-center justify-center text-[10px] font-bold text-indigo-500 shrink-0">
                                                {{ strtoupper(substr($order->user->name, 0, 2)) }}
                                            </div>
                                            <div>
                                                <p class="text-xs font-bold text-deep-navy">{{ $order->user->name }}</p>
                                                <p class="text-[10px] text-slate-400">{{ $order->user->email }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        @php
                                            $firstItem = $order->items->first();
                                            $event = $firstItem ? $firstItem->ticket->event : null;
                                        @endphp
                                        @if($event)
                                            <p class="text-xs font-bold text-slate-700 truncate max-w-[200px]" title="{{ $event->name }}">{{ $event->name }}</p>
                                            <div class="flex flex-wrap gap-1 mt-1">
                                                @foreach($order->items as $item)
                                                    <span class="inline-block px-2 py-0.5 bg-slate-100 text-slate-600 rounded text-[9px] font-bold uppercase">{{ $item->quantity }}x {{ $item->ticket->type }}</span>
                                                @endforeach
                                            </div>
                                        @else
                                            <span class="text-xs text-slate-400">-</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <p class="text-xs text-slate-500 font-medium">{{ \Carbon\Carbon::parse($order->created_at)->format('d M Y, H:i') }}</p>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($order->status === 'paid')
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-emerald-50 text-emerald-600 rounded-lg text-[10px] font-bold uppercase tracking-wider">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Lunas
                                            </span>
                                        @elseif($order->status === 'pending')
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-amber-50 text-amber-600 rounded-lg text-[10px] font-bold uppercase tracking-wider">
                                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Pending
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-red-50 text-red-600 rounded-lg text-[10px] font-bold uppercase tracking-wider">
                                                <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span> Batal
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <p class="text-sm font-bold text-deep-navy">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <a href="{{ route('eo.transactions.show', $order) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-xl bg-slate-50 text-slate-400 hover:bg-electric-blue hover:text-white transition-colors" title="Detail Transaksi">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-16 text-center">
                                        <div class="flex flex-col items-center">
                                            <div class="w-16 h-16 bg-slate-50 rounded-2xl flex items-center justify-center mb-4">
                                                <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                            </div>
                                            <h3 class="text-sm font-bold text-slate-700 mb-1">Tidak ada transaksi ditemukan</h3>
                                            <p class="text-xs text-slate-400">Belum ada transaksi yang sesuai dengan filter Anda.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                @if($orders->hasPages())
                    <div class="px-6 py-4 border-t border-slate-100">
                        {{ $orders->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
