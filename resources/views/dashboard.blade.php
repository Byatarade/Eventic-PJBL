<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <h2 class="font-bold text-2xl text-deep-navy leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <p class="text-sm text-gray-500 font-medium">{{ now()->translatedFormat('l, d F Y') }}</p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <!-- Minimalist Welcome Banner -->
            <div class="relative overflow-hidden rounded-3xl bg-slate-900 p-8 md:p-10 text-white shadow-2xl">
                <div class="absolute top-0 right-0 -translate-y-1/2 translate-x-1/2 w-96 h-96 bg-blue-500/10 rounded-full blur-[100px]"></div>
                <div class="relative z-10 flex flex-col md:flex-row justify-between items-center gap-8">
                    <div class="max-w-xl text-center md:text-left">
                        <span class="inline-block px-3 py-1 bg-white/10 backdrop-blur-md rounded-full text-[10px] font-bold uppercase tracking-[0.2em] text-blue-300 mb-4 border border-white/10">
                            Member Area
                        </span>
                        <h3 class="text-3xl md:text-4xl font-bold mb-3 tracking-tight">
                            Halo, <span class="text-blue-400">{{ explode(' ', Auth::user()->name)[0] }}</span>!
                        </h3>
                        <p class="text-slate-400 text-sm md:text-base leading-relaxed font-medium">
                            Temukan berbagai event menarik dan kelola tiket Anda dengan pengalaman yang lebih sederhana.
                        </p>
                    </div>
                    <div class="shrink-0 flex gap-3">
                        <a href="{{ route('user.tickets.index') }}" class="bg-white text-slate-900 px-6 py-3 rounded-2xl font-bold text-sm hover:bg-slate-50 transition-all active:scale-95 shadow-lg shadow-white/5">
                            Tiket Saya
                        </a>
                    </div>
                </div>
            </div>

            <!-- Minimalist Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white rounded-[2rem] p-6 border border-slate-100 shadow-sm hover:shadow-md transition-all duration-300 group">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center transition-colors group-hover:bg-blue-600 group-hover:text-white">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                        </div>
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Tiket Aktif</span>
                    </div>
                    <h4 class="text-4xl font-bold text-slate-900 tracking-tight">{{ $activeTicketsCount }}</h4>
                </div>

                <div class="bg-white rounded-[2rem] p-6 border border-slate-100 shadow-sm hover:shadow-md transition-all duration-300 group">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-purple-50 text-purple-600 rounded-2xl flex items-center justify-center transition-colors group-hover:bg-purple-600 group-hover:text-white">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Transaksi</span>
                    </div>
                    <h4 class="text-4xl font-bold text-slate-900 tracking-tight">{{ $transactionCount }}</h4>
                </div>

                <div class="bg-white rounded-[2rem] p-6 border border-slate-100 shadow-sm hover:shadow-md transition-all duration-300 group">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-orange-50 text-orange-600 rounded-2xl flex items-center justify-center transition-colors group-hover:bg-orange-600 group-hover:text-white">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Next Event</span>
                    </div>
                    <h4 class="text-lg font-bold text-slate-900 tracking-tight leading-tight pt-2">
                        {{ $upcomingEvents->first() ? $upcomingEvents->first()->date->diffForHumans(['parts' => 1]) : '-' }}
                    </h4>
                </div>
            </div>

            <!-- Clean Recent Activities -->
            <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden">
                <div class="px-8 py-6 border-b border-slate-50 flex justify-between items-center bg-slate-50/30">
                    <div>
                        <h3 class="font-bold text-slate-900 tracking-tight leading-none mb-1">Aktivitas Terakhir</h3>
                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">Ringkasan transaksi terbaru Anda</p>
                    </div>
                    <a href="{{ route('user.transactions.index') }}" class="text-xs font-bold text-blue-600 hover:text-blue-700 transition-colors">
                        Semua Aktivitas &rarr;
                    </a>
                </div>
                
                <div class="divide-y divide-slate-50">
                    @forelse($recentActivities as $activity)
                        <div class="px-8 py-5 flex items-center justify-between hover:bg-slate-50/50 transition-colors group">
                            <div class="flex items-center gap-5 min-w-0">
                                <div class="w-10 h-10 rounded-2xl flex items-center justify-center shrink-0 {{ $activity->status === 'paid' ? 'bg-emerald-50 text-emerald-500' : 'bg-amber-50 text-amber-500' }}">
                                    @if($activity->status === 'paid')
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                    @else
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    @endif
                                </div>
                                <div class="min-w-0">
                                    <h4 class="text-sm font-bold text-slate-800 truncate group-hover:text-blue-600 transition-colors">
                                        {{ $activity->items->first()->ticket->event->name ?? 'Event Terkait' }}
                                    </h4>
                                    <div class="flex items-center gap-2 mt-0.5">
                                        <span class="text-[11px] text-slate-400 font-medium tracking-tight">ID: #{{ str_pad($activity->id, 6, '0', STR_PAD_LEFT) }}</span>
                                        <span class="w-1 h-1 bg-slate-200 rounded-full"></span>
                                        <span class="text-[11px] font-bold {{ $activity->status === 'paid' ? 'text-emerald-600' : 'text-amber-600' }}">
                                            {{ $activity->status === 'paid' ? 'Sukses' : 'Menunggu' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right shrink-0 ml-4">
                                <div class="text-sm font-bold text-slate-900 tracking-tight">
                                    Rp{{ number_format($activity->total_price, 0, ',', '.') }}
                                </div>
                                <div class="text-[10px] text-slate-400 font-bold uppercase tracking-tight">
                                    {{ $activity->created_at->diffForHumans() }}
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="py-16 text-center">
                            <p class="text-sm text-slate-400 font-bold uppercase tracking-widest">Belum ada aktivitas</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
