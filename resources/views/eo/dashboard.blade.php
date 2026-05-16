<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl text-slate-900 tracking-tight">
                    {{ __('EO Dashboard') }}
                </h2>
                <p class="text-slate-500 text-sm font-medium mt-1">Pantau performa event dan kelola transaksi Anda secara real-time.</p>
            </div>
            <div class="flex items-center gap-3 w-full md:w-auto">
                <a href="{{ route('eo.events.create') }}" class="w-full md:w-auto justify-center group bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl text-sm font-bold transition-all duration-300 shadow-sm active:scale-95 flex items-center gap-2">
                    <svg class="w-5 h-5 group-hover:rotate-90 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    {{ __('Buat Event') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6 space-y-8">
        
        <!-- Welcome & Quick Insights -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left: Welcome Banner (Compact) -->
            <div class="lg:col-span-2 relative overflow-hidden rounded-2xl bg-slate-900 p-8 md:p-10 text-white shadow-lg">
                <div class="absolute top-0 right-0 -translate-y-1/4 translate-x-1/4 w-64 h-64 bg-blue-500/10 rounded-full blur-[80px]"></div>
                <div class="relative z-10">
                    <span class="inline-block px-3 py-1 bg-white/10 backdrop-blur-md rounded-full text-[10px] font-bold uppercase tracking-widest text-blue-300 mb-4 border border-white/10">
                        Overview Performa
                    </span>
                    <h3 class="text-2xl md:text-3xl font-bold mb-2 tracking-tight">
                        Halo, <span class="text-blue-400">{{ explode(' ', Auth::user()->name)[0] }}</span>!
                    </h3>
                    <p class="text-slate-400 text-sm md:text-base max-w-md leading-relaxed font-medium">
                        Anda memiliki <span class="text-white font-bold">{{ $activeEvents }} event aktif</span>. Penjualan tiket Anda meningkat <span class="text-emerald-400 font-bold">+15%</span> minggu ini.
                    </p>
                    
                    <div class="mt-8 flex flex-wrap gap-4">
                        <div class="bg-white/5 border border-white/10 rounded-xl p-5 min-w-[140px]">
                            <p class="text-slate-400 text-[10px] font-bold uppercase tracking-wider mb-1">Tiket Terjual</p>
                            <p class="text-2xl font-bold text-white tracking-tight">{{ number_format($totalTicketsSold) }}</p>
                        </div>
                        <div class="bg-white/5 border border-white/10 rounded-xl p-5 min-w-[140px]">
                            <p class="text-slate-400 text-[10px] font-bold uppercase tracking-wider mb-1">Pendapatan</p>
                            <p class="text-2xl font-bold text-white tracking-tight">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Next Event Highlight -->
            <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm flex flex-col justify-between">
                <div>
                    <h4 class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-6">Event Terdekat</h4>
                    @if($upcomingEvents->count() > 0)
                        @php 
                            $nextEvent = $upcomingEvents->first(); 
                            $totalStock = $nextEvent->tickets->sum('stock');
                            $totalSold = $nextEvent->tickets->sum('sold_count');
                            $fillPercentage = $totalStock > 0 ? min(100, round(($totalSold / $totalStock) * 100)) : 0;
                        @endphp
                        <div class="flex gap-4 items-start mb-6">
                            <div class="w-14 h-14 rounded-xl bg-slate-50 flex flex-col items-center justify-center text-center shrink-0 border border-slate-100 shadow-sm">
                                <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">{{ \Carbon\Carbon::parse($nextEvent->date)->format('M') }}</span>
                                <span class="text-lg font-bold text-slate-900 leading-none mt-0.5">{{ \Carbon\Carbon::parse($nextEvent->date)->format('d') }}</span>
                            </div>
                            <div class="min-w-0">
                                <h5 class="font-bold text-slate-900 line-clamp-1 leading-tight">{{ $nextEvent->name }}</h5>
                                <p class="text-xs text-slate-500 mt-1.5 flex items-center gap-1.5 font-medium">
                                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    {{ $nextEvent->location }}
                                </p>
                            </div>
                        </div>
                        <div class="space-y-2 mb-6">
                            <div class="flex justify-between text-xs font-semibold">
                                <span class="text-slate-500">Kapasitas Terisi</span>
                                <span class="text-slate-900">{{ $fillPercentage }}%</span>
                            </div>
                            <div class="w-full bg-slate-100 h-1.5 rounded-full overflow-hidden">
                                <div class="bg-blue-600 h-full rounded-full" style="width: {{ $fillPercentage }}%"></div>
                            </div>
                        </div>
                        <a href="{{ route('eo.events.show', $nextEvent) }}" class="w-full py-3 bg-slate-50 hover:bg-slate-100 text-slate-900 rounded-xl text-xs font-bold transition-all text-center inline-block border border-slate-100 active:scale-[0.98]">
                            Kelola Event &rarr;
                        </a>
                    @else
                        <div class="flex flex-col items-center justify-center py-10 text-center">
                            <div class="w-12 h-12 rounded-full bg-slate-50 flex items-center justify-center mb-4">
                                <svg class="w-6 h-6 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                            <p class="text-xs text-slate-400 font-bold uppercase tracking-wider">No Upcoming Events</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Secondary Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition-all duration-300 group">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center transition-colors group-hover:bg-blue-600 group-hover:text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Total Event</p>
                        <p class="text-2xl font-bold text-slate-900 tracking-tight">{{ $totalEvents }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition-all duration-300 group">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center transition-colors group-hover:bg-emerald-600 group-hover:text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Event Aktif</p>
                        <p class="text-2xl font-bold text-slate-900 tracking-tight">{{ $activeEvents }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition-all duration-300 group">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center transition-colors group-hover:bg-purple-600 group-hover:text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Total Peserta</p>
                        <p class="text-2xl font-bold text-slate-900 tracking-tight">{{ number_format($totalTicketsSold) }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition-all duration-300 group">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center transition-colors group-hover:bg-amber-600 group-hover:text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Transaksi</p>
                        <p class="text-2xl font-bold text-slate-900 tracking-tight">{{ $recentOrders->count() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Area: Tables -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            
            <!-- Recent Transactions Table -->
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="px-8 py-6 border-b border-slate-50 flex items-center justify-between bg-slate-50/30">
                    <div>
                        <h4 class="font-bold text-lg text-slate-900 tracking-tight leading-none mb-1">Transaksi Terbaru</h4>
                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">Monitoring tiket terjual</p>
                    </div>
                    <a href="{{ route('eo.transactions.index') }}" class="text-xs font-bold text-blue-600 hover:text-blue-700 transition-all">Semua Transaksi &rarr;</a>
                </div>
                <div class="overflow-x-auto pb-4">
                    <table class="w-full text-left border-collapse whitespace-nowrap lg:whitespace-normal">
                        <thead>
                            <tr class="bg-slate-50/50">
                                <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-[0.1em]">Peserta</th>
                                <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-[0.1em]">Event</th>
                                <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-[0.1em]">Status</th>
                                <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-[0.1em]">Total</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse($recentOrders as $order)
                                <tr class="hover:bg-slate-50/50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-9 h-9 rounded-full bg-slate-100 flex items-center justify-center text-[11px] font-bold text-slate-500 shadow-sm">
                                                {{ strtoupper(substr($order->user->name, 0, 2)) }}
                                            </div>
                                            <div>
                                                <p class="text-xs font-bold text-slate-900 leading-tight">{{ $order->user->name }}</p>
                                                <p class="text-[10px] text-slate-400 font-medium mt-0.5">{{ \Carbon\Carbon::parse($order->created_at)->format('d M, H:i') }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <p class="text-xs font-medium text-slate-600 truncate max-w-[120px]">
                                            {{ $order->items->first()->ticket->event->name ?? '-' }}
                                        </p>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($order->status === 'paid')
                                            <span class="px-2.5 py-1 bg-emerald-50 text-emerald-600 rounded-lg text-[10px] font-bold uppercase tracking-tight">Sukses</span>
                                        @elseif($order->status === 'pending')
                                            <span class="px-2.5 py-1 bg-amber-50 text-amber-600 rounded-lg text-[10px] font-bold uppercase tracking-tight">Pending</span>
                                        @else
                                            <span class="px-2.5 py-1 bg-rose-50 text-rose-600 rounded-lg text-[10px] font-bold uppercase tracking-tight">Batal</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <p class="text-sm font-bold text-slate-900 tracking-tight">Rp{{ number_format($order->total_price, 0, ',', '.') }}</p>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center">
                                            <div class="w-12 h-12 bg-slate-50 rounded-full flex items-center justify-center mb-3">
                                                <svg class="w-6 h-6 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                            </div>
                                            <p class="text-xs text-slate-400 font-medium">Belum ada transaksi</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Upcoming Events Table -->
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-slate-50 flex items-center justify-between bg-slate-50/30">
                    <div>
                        <h4 class="font-bold text-lg text-slate-900 tracking-tight leading-none mb-1">Daftar Event</h4>
                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">Kelola semua event anda</p>
                    </div>
                    <a href="{{ route('eo.events.index') }}" class="text-xs font-bold text-blue-600 hover:text-blue-700 transition-all">Kelola Event &rarr;</a>
                </div>
                <div class="overflow-x-auto pb-4">
                    <table class="w-full text-left border-collapse whitespace-nowrap lg:whitespace-normal">
                        <thead>
                            <tr class="bg-slate-50/50">
                                <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-[0.1em]">Event</th>
                                <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-[0.1em]">Tanggal</th>
                                <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-[0.1em]">Kategori</th>
                                <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-[0.1em]">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse($upcomingEvents as $event)
                                <tr class="hover:bg-slate-50/50 transition-colors">
                                    <td class="px-6 py-4">
                                        <p class="text-xs font-bold text-slate-900 truncate max-w-[150px]">{{ $event->name }}</p>
                                    </td>
                                    <td class="px-6 py-4">
                                        <p class="text-xs text-slate-500 font-medium">{{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}</p>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-2.5 py-1 bg-slate-100 text-slate-600 rounded-lg text-[10px] font-bold uppercase tracking-tight">{{ $event->category }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($event->status === 'published')
                                            <span class="flex items-center gap-1.5 text-[10px] font-bold text-green-500">
                                                <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Aktif
                                            </span>
                                        @else
                                            <span class="flex items-center gap-1.5 text-[10px] font-bold text-slate-400">
                                                <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span> Draft
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center">
                                            <div class="w-12 h-12 bg-slate-50 rounded-full flex items-center justify-center mb-3">
                                                <svg class="w-6 h-6 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                            </div>
                                            <p class="text-xs text-slate-400 font-medium">Belum ada event</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
