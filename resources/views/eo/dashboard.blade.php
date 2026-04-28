<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center gap-8">
            <div>
                <h2 class="font-bold text-3xl text-deep-navy leading-tight tracking-tight">
                    {{ __('EO Dashboard') }}
                </h2>
                <p class="text-gray-400 text-sm font-medium mt-1">Overview performa bisnis dan manajemen event Anda.</p>
            </div>
            <a href="{{ route('eo.events.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-2xl text-sm font-bold transition-all duration-300 shadow-lg shadow-blue-500/30 active:scale-95 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                {{ __('Buat Event Baru') }}
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10">
            
            <!-- Hero Section with Glassmorphism -->
            <div class="relative overflow-hidden rounded-[2.5rem] bg-gradient-to-br from-slate-900 via-blue-900 to-indigo-900 p-10 text-white shadow-2xl">
                <!-- Abstract Background Patterns -->
                <div class="absolute top-0 right-0 -translate-y-1/4 translate-x-1/4 w-96 h-96 bg-blue-500/20 rounded-full blur-[100px]"></div>
                <div class="absolute bottom-0 left-0 translate-y-1/4 -translate-x-1/4 w-80 h-80 bg-indigo-500/20 rounded-full blur-[80px]"></div>
                <div class="absolute right-20 bottom-10 opacity-10">
                    <svg class="w-64 h-64" fill="currentColor" viewBox="0 0 24 24"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm0 10.99h7c-.47 4.09-3.09 7.61-7 8.9v-8.9z"/></svg>
                </div>

                <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-8">
                    <div class="max-w-2xl">
                        <span class="inline-block px-4 py-1.5 bg-white/10 backdrop-blur-md rounded-full text-xs font-bold uppercase tracking-widest text-blue-300 mb-6 border border-white/10">
                            Organizer Panel
                        </span>
                        <h3 class="text-4xl md:text-5xl font-black mb-4 leading-tight">
                            Selamat Datang, <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-300">{{ Auth::user()->name }}</span>!
                        </h3>
                        <p class="text-lg text-blue-100/80 max-w-xl leading-relaxed">
                            Siap untuk menyelenggarakan event spektakuler hari ini? Kelola tiket, pantau pendapatan, dan berikan pengalaman terbaik bagi peserta Anda.
                        </p>
                    </div>
                    <div class="shrink-0 flex gap-4">
                        <div class="bg-white/10 backdrop-blur-xl p-6 rounded-3xl border border-white/10 shadow-xl text-center min-w-[140px]">
                            <p class="text-blue-300 text-xs font-bold uppercase tracking-wider mb-2">Peringkat EO</p>
                            <p class="text-3xl font-black">Top 5%</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Grid - Premium Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                
                <!-- Card: Revenue -->
                <div class="group bg-white rounded-[2rem] p-8 border border-gray-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 lg:col-span-2 relative overflow-hidden">
                    <div class="absolute top-0 right-0 p-4 opacity-[0.03] group-hover:opacity-[0.08] transition-opacity">
                        <svg class="w-32 h-32 text-blue-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <div class="relative z-10 flex flex-col h-full justify-between">
                        <div>
                            <div class="w-14 h-14 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center mb-6 group-hover:scale-110 group-hover:bg-blue-600 group-hover:text-white transition-all duration-500 shadow-inner">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            </div>
                            <p class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-1">Total Pendapatan</p>
                            <h4 class="text-5xl font-black text-deep-navy tracking-tighter">Rp 0</h4>
                        </div>
                        <div class="mt-8 pt-6 border-t border-gray-50 flex items-center justify-between">
                            <span class="text-xs font-bold text-green-500 bg-green-50 px-3 py-1 rounded-full">+12.5% vs bulan lalu</span>
                            <a href="#" class="text-blue-600 text-xs font-bold hover:underline">Lihat Laporan &rarr;</a>
                        </div>
                    </div>
                </div>

                <!-- Card: Transactions -->
                <div class="group bg-white rounded-[2rem] p-8 border border-gray-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500">
                    <div class="w-14 h-14 rounded-2xl bg-green-50 text-green-600 flex items-center justify-center mb-6 group-hover:scale-110 group-hover:bg-green-600 group-hover:text-white transition-all duration-500">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                    </div>
                    <p class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-1">Transaksi</p>
                    <h4 class="text-4xl font-black text-deep-navy">0</h4>
                    <p class="text-xs text-gray-400 mt-4 flex items-center gap-1 font-medium">
                        <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> 100% Berhasil
                    </p>
                </div>

                <!-- Card: Tickets -->
                <div class="group bg-white rounded-[2rem] p-8 border border-gray-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500">
                    <div class="w-14 h-14 rounded-2xl bg-orange-50 text-orange-600 flex items-center justify-center mb-6 group-hover:scale-110 group-hover:bg-orange-600 group-hover:text-white transition-all duration-500">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" /></svg>
                    </div>
                    <p class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-1">Tiket Terjual</p>
                    <h4 class="text-4xl font-black text-deep-navy">0</h4>
                    <p class="text-xs text-gray-400 mt-4 font-medium">Dari total 0 kuota</p>
                </div>
            </div>

            <!-- Second Row: Event Status & Quick Actions -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- Event Status Area -->
                <div class="lg:col-span-2 space-y-6">
                    <div class="flex items-center justify-between">
                        <h4 class="text-xl font-bold text-deep-navy">Status Event</h4>
                        <a href="{{ route('eo.events.index') }}" class="text-blue-600 text-sm font-bold hover:underline">Semua Event &rarr;</a>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div class="bg-indigo-50/50 rounded-3xl p-8 border border-indigo-100 flex items-center gap-6 group hover:bg-indigo-600 transition-all duration-500">
                            <div class="w-16 h-16 rounded-2xl bg-white shadow-sm flex items-center justify-center text-indigo-600 shrink-0 group-hover:scale-110 transition-transform">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                            </div>
                            <div>
                                <h5 class="text-3xl font-black text-indigo-900 group-hover:text-white transition-colors">0</h5>
                                <p class="text-indigo-600/60 font-bold text-sm uppercase tracking-wider group-hover:text-indigo-100 transition-colors">Event Aktif</p>
                            </div>
                        </div>
                        <div class="bg-slate-100/50 rounded-3xl p-8 border border-slate-200 flex items-center gap-6 group hover:bg-slate-800 transition-all duration-500">
                            <div class="w-16 h-16 rounded-2xl bg-white shadow-sm flex items-center justify-center text-slate-600 shrink-0 group-hover:scale-110 transition-transform">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </div>
                            <div>
                                <h5 class="text-3xl font-black text-slate-900 group-hover:text-white transition-colors">0</h5>
                                <p class="text-slate-600/60 font-bold text-sm uppercase tracking-wider group-hover:text-slate-100 transition-colors">Event Draft</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Activity/Actions -->
                <div class="bg-white rounded-[2.5rem] p-8 border border-gray-100 shadow-sm">
                    <h4 class="text-xl font-bold text-deep-navy mb-8">Aksi Cepat</h4>
                    <div class="space-y-4">
                        <button class="w-full flex items-center gap-4 p-4 rounded-2xl bg-blue-50 text-blue-700 hover:bg-blue-100 transition-colors group">
                            <div class="w-10 h-10 rounded-xl bg-white flex items-center justify-center group-hover:scale-110 transition-transform">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2-8H7a2 2 0 00-2 2v14a2 2 0 002 2h10a2 2 0 002-2V9l-5-5z"/></svg>
                            </div>
                            <span class="font-bold text-sm">Unduh Laporan Bulanan</span>
                        </button>
                        <button class="w-full flex items-center gap-4 p-4 rounded-2xl bg-purple-50 text-purple-700 hover:bg-purple-100 transition-colors group">
                            <div class="w-10 h-10 rounded-xl bg-white flex items-center justify-center group-hover:scale-110 transition-transform">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                            </div>
                            <span class="font-bold text-sm">Kelola Database Peserta</span>
                        </button>
                    </div>

                    <div class="mt-10 p-6 bg-slate-900 rounded-3xl text-white relative overflow-hidden">
                        <div class="absolute -right-4 -bottom-4 opacity-10">
                            <svg class="w-20 h-20" fill="currentColor" viewBox="0 0 24 24"><path d="M13 2L3 14h9v8l10-12h-9z"/></svg>
                        </div>
                        <p class="text-xs font-bold text-blue-400 uppercase tracking-widest mb-2">Pusat Bantuan</p>
                        <h5 class="font-bold text-sm mb-4">Butuh bantuan mengelola event?</h5>
                        <a href="#" class="inline-block px-4 py-2 bg-white text-slate-900 rounded-xl text-xs font-bold hover:bg-blue-50 transition-colors">Tanya CS &rarr;</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
