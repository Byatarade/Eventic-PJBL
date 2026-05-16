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
            <!-- Welcome Banner -->
            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 overflow-hidden shadow-lg rounded-2xl relative">
                <div class="p-8 sm:p-10 text-white relative z-10 flex flex-col sm:flex-row justify-between items-center gap-6">
                    <div class="max-w-xl">
                        <span class="inline-block px-3 py-1 bg-white/20 rounded-full text-xs font-semibold tracking-wider uppercase mb-4 border border-white/20 backdrop-blur-sm">Eventic Portal</span>
                        <h3 class="text-2xl sm:text-3xl font-bold mb-3">Selamat Datang kembali, {{ Auth::user()->name }}!</h3>
                        <p class="text-blue-100 text-sm sm:text-base leading-relaxed">
                            Temukan acara menarik di sekitarmu, kelola tiket dengan mudah, dan nikmati pengalaman tak terlupakan bersama Eventic. Mulai petualanganmu sekarang!
                        </p>
                    </div>
                    <div class="shrink-0">
                        <a href="{{ route('user.tickets.index') }}" class="group bg-white text-blue-600 px-6 py-3 rounded-xl font-semibold text-sm hover:bg-gray-50 hover:shadow-md transition-all duration-200 inline-flex items-center gap-2">
                            Lihat Tiket Saya
                            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    </div>
                </div>
                <!-- Decorative Elements -->
                <div class="absolute top-0 right-0 -mt-8 -mr-8 w-64 h-64 bg-white opacity-10 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute bottom-0 right-1/4 -mb-12 w-48 h-48 bg-indigo-400 opacity-20 rounded-full blur-2xl pointer-events-none"></div>
                <div class="absolute top-1/2 left-0 -mt-16 -ml-16 w-32 h-32 bg-blue-300 opacity-20 rounded-full blur-2xl pointer-events-none"></div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Stat Card 1 -->
                <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-blue-50 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-110"></div>
                    <div class="relative z-10 flex items-start justify-between mb-4">
                        <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center shadow-inner">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                        </div>
                        <span class="text-xs font-semibold text-gray-500 bg-gray-100 px-2.5 py-1 rounded-full">Bulan Ini</span>
                    </div>
                    <div class="relative z-10">
                        <p class="text-sm font-medium text-gray-500 mb-1">Tiket Aktif</p>
                        <h4 class="text-3xl font-bold text-gray-900">{{ $activeTicketsCount }}</h4>
                    </div>
                </div>

                <!-- Stat Card 2 -->
                <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-purple-50 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-110"></div>
                    <div class="relative z-10 flex items-start justify-between mb-4">
                        <div class="w-12 h-12 bg-purple-100 text-purple-600 rounded-xl flex items-center justify-center shadow-inner">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                        <span class="text-xs font-semibold text-gray-500 bg-gray-100 px-2.5 py-1 rounded-full">Total</span>
                    </div>
                    <div class="relative z-10">
                        <p class="text-sm font-medium text-gray-500 mb-1">Riwayat Transaksi</p>
                        <h4 class="text-3xl font-bold text-gray-900">{{ $transactionCount }}</h4>
                    </div>
                </div>

                <!-- Stat Card 3 -->
                <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-orange-50 rounded-bl-full -mr-4 -mt-4 transition-transform group-hover:scale-110"></div>
                    <div class="relative z-10 flex items-start justify-between mb-4">
                        <div class="w-12 h-12 bg-orange-100 text-orange-600 rounded-xl flex items-center justify-center shadow-inner">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <span class="text-xs font-semibold text-gray-500 bg-gray-100 px-2.5 py-1 rounded-full">Segera</span>
                    </div>
                    <div class="relative z-10">
                        <p class="text-sm font-medium text-gray-500 mb-1">Acara Terdekat</p>
                        <h4 class="text-3xl font-bold text-gray-900">
                            {{ $upcomingEvents->first() ? $upcomingEvents->first()->date->diffForHumans(['parts' => 1]) : '-' }}
                        </h4>
                    </div>
                </div>
            </div>

            <!-- Full Width Recent Activities -->
            <div class="bg-white rounded-[2.5rem] border border-gray-100 shadow-sm overflow-hidden">
                <div class="px-8 py-7 border-b border-gray-50 flex justify-between items-center bg-gray-50/30">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center shadow-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-black text-gray-900 uppercase tracking-tight leading-none mb-1">Aktivitas Terakhir</h3>
                            <p class="text-xs text-gray-400 font-bold uppercase tracking-widest">Riwayat transaksi terbaru Anda</p>
                        </div>
                    </div>
                    <a href="{{ route('user.transactions.index') }}" class="px-6 py-2.5 bg-gray-50 hover:bg-gray-100 text-gray-500 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all border border-gray-100 shadow-sm">
                        Lihat Semua
                    </a>
                </div>
                
                <div class="p-8 sm:p-12">
                    @if($recentActivities->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-10">
                            @foreach($recentActivities as $activity)
                                <div class="flex gap-5 group relative">
                                    <div class="w-14 h-14 rounded-[1.25rem] {{ $activity->status === 'paid' ? 'bg-emerald-50 text-emerald-500 shadow-emerald-100' : 'bg-amber-50 text-amber-500 shadow-amber-100' }} flex items-center justify-center shrink-0 z-10 shadow-lg border-2 border-white group-hover:scale-110 transition-transform duration-300">
                                        @if($activity->status === 'paid')
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                        @else
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        @endif
                                    </div>
                                    <div class="flex-1 min-w-0 pt-1">
                                        <div class="flex justify-between items-start mb-1">
                                            <div class="text-base font-black text-gray-900 leading-tight">
                                                {{ $activity->status === 'paid' ? 'Pembayaran Berhasil' : 'Menunggu Pembayaran' }}
                                            </div>
                                            <span class="text-[9px] font-black text-gray-300 uppercase tracking-widest">{{ $activity->created_at->diffForHumans() }}</span>
                                        </div>
                                        <p class="text-sm text-gray-500 font-bold mb-3 opacity-70 group-hover:opacity-100 transition-opacity truncate">{{ $activity->items->first()->ticket->event->name ?? 'Event Terkait' }}</p>
                                        <div class="flex items-center gap-2">
                                            <div class="px-2.5 py-1 bg-gray-50 rounded-lg text-[10px] text-gray-400 font-black uppercase tracking-tight border border-gray-100">
                                                Order #{{ str_pad($activity->id, 6, '0', STR_PAD_LEFT) }}
                                            </div>
                                            <div class="w-1 h-1 bg-gray-200 rounded-full"></div>
                                            <div class="text-[10px] font-black {{ $activity->status === 'paid' ? 'text-emerald-500' : 'text-amber-500' }} uppercase tracking-widest">
                                                Rp{{ number_format($activity->total_price, 0, ',', '.') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="flex flex-col justify-center items-center text-center py-16">
                            <div class="w-24 h-24 bg-gray-50 rounded-[2rem] rotate-6 flex items-center justify-center mb-6 border border-gray-100 shadow-inner relative">
                                <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 to-purple-500/5 rounded-[2rem]"></div>
                                <svg class="w-10 h-10 text-gray-200 -rotate-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                            </div>
                            <h4 class="text-gray-900 font-black text-xl mb-2 uppercase tracking-tight">Belum ada aktivitas</h4>
                            <p class="text-sm text-gray-400 font-bold uppercase tracking-wider max-w-xs mx-auto leading-relaxed">Semua riwayat pembelian tiket Anda akan muncul secara otomatis di sini.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
