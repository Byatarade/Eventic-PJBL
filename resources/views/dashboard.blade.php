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

            <!-- Two Column Layout for Content -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Upcoming Events -->
                <div class="lg:col-span-2 flex flex-col">
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden flex-1 flex flex-col">
                        <div class="px-6 py-5 border-b border-gray-50 flex justify-between items-center bg-gray-50/50">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z"></path></svg>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900">Rekomendasi Acara</h3>
                            </div>
                            <a href="/" class="text-sm text-blue-600 hover:text-blue-700 font-medium hover:underline decoration-blue-200 underline-offset-4 transition-all">Jelajahi Semua</a>
                        </div>
                        
                        <div class="p-6">
                            @if($upcomingEvents->count() > 0)
                                <div class="space-y-4">
                                    @foreach($upcomingEvents as $event)
                                        <a href="{{ route('events.show', $event) }}" class="flex gap-4 p-3 rounded-xl hover:bg-gray-50 transition-colors group">
                                            <div class="w-24 h-16 rounded-lg overflow-hidden bg-gray-100 shrink-0">
                                                @if($event->image)
                                                    <img src="{{ Storage::url($event->image) }}" class="w-full h-full object-cover">
                                                @else
                                                    <div class="w-full h-full bg-indigo-500"></div>
                                                @endif
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <h4 class="font-bold text-gray-900 truncate group-hover:text-blue-600 transition-colors">{{ $event->name }}</h4>
                                                <div class="flex items-center gap-3 mt-1">
                                                    <span class="text-xs text-gray-500 flex items-center gap-1">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                        {{ $event->date->format('d M Y') }}
                                                    </span>
                                                    <span class="text-xs text-gray-500 flex items-center gap-1">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                                                        {{ Str::limit($event->location, 20) }}
                                                    </span>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            @else
                                <div class="p-8 flex-1 flex flex-col justify-center items-center text-center">
                                    <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mb-5 relative">
                                        <div class="absolute inset-0 border-2 border-dashed border-gray-200 rounded-full"></div>
                                        <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                                    </div>
                                    <h4 class="text-gray-900 font-bold text-lg mb-2">Belum ada acara mendatang</h4>
                                    <p class="text-gray-500 max-w-sm mx-auto mb-6 text-sm">Temukan acara menarik di sekitarmu sekarang!</p>
                                    <a href="/" class="inline-flex items-center justify-center px-5 py-2.5 bg-gray-900 text-white rounded-xl text-sm font-medium hover:bg-gray-800 transition-colors shadow-sm gap-2">
                                        Cari Event
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Recent Activities -->
                <div class="flex flex-col">
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden flex-1 flex flex-col">
                        <div class="px-6 py-5 border-b border-gray-50 flex justify-between items-center bg-gray-50/50">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-green-100 text-green-600 flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900">Aktivitas Terakhir</h3>
                            </div>
                            <a href="{{ route('user.transactions.index') }}" class="text-sm text-gray-500 hover:text-gray-700 font-medium">Lihat Semua</a>
                        </div>
                        
                        <div class="p-6">
                            @if($recentActivities->count() > 0)
                                <div class="space-y-6">
                                    @foreach($recentActivities as $activity)
                                        <div class="flex gap-4 relative">
                                            @if(!$loop->last)
                                                <div class="absolute left-4 top-10 bottom-0 w-px bg-gray-100"></div>
                                            @endif
                                            <div class="w-8 h-8 rounded-full {{ $activity->status === 'paid' ? 'bg-emerald-50 text-emerald-500' : 'bg-amber-50 text-amber-500' }} flex items-center justify-center shrink-0 z-10 border-4 border-white">
                                                @if($activity->status === 'paid')
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                                @else
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.828a1 1 0 101.415-1.414L11 9.586V6z" clip-rule="evenodd"></path></svg>
                                                @endif
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <div class="text-sm font-bold text-gray-900 leading-tight">
                                                    {{ $activity->status === 'paid' ? 'Pembayaran Berhasil' : 'Menunggu Pembayaran' }}
                                                </div>
                                                <div class="text-[11px] text-gray-500 mt-0.5">{{ $activity->items->first()->ticket->event->name ?? 'Event' }}</div>
                                                <div class="text-[10px] text-gray-400 mt-1 font-medium">{{ $activity->created_at->diffForHumans() }}</div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="p-8 flex-1 flex flex-col justify-center items-center text-center">
                                    <div class="w-20 h-20 bg-gray-50 rounded-2xl rotate-3 flex items-center justify-center mb-5 border border-gray-100">
                                        <svg class="w-8 h-8 text-gray-300 -rotate-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                                    </div>
                                    <h4 class="text-gray-900 font-bold mb-2 text-sm">Belum ada aktivitas</h4>
                                    <p class="text-[11px] text-gray-500 max-w-xs mx-auto">Riwayat transaksi Anda akan muncul di sini.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
