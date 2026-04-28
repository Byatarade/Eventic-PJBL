<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center gap-8">
            <h2 class="font-bold text-2xl text-deep-navy leading-tight">
                {{ __('EO Dashboard') }}
            </h2>
            <button class="bg-electric-blue hover:bg-blue-600 text-white px-4 py-2 rounded-xl text-sm font-semibold transition-colors shadow-sm">
                + Buat Event Baru
            </button>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Welcome Banner -->
            <div class="bg-gradient-to-r from-deep-navy to-blue-900 rounded-2xl p-8 text-white shadow-lg overflow-hidden relative">
                <div class="absolute -right-20 -top-20 opacity-20">
                    <svg class="w-64 h-64" fill="currentColor" viewBox="0 0 24 24"><path d="M11 2v20c-5.07-.5-9-4.79-9-10s3.93-9.5 9-10zm2 0v8h8c-.5-4.25-3.75-7.5-8-8zm0 10v10c4.25-.5 7.5-3.75 8-8h-8z"/></svg>
                </div>
                <div class="relative z-10">
                    <h3 class="text-2xl font-bold mb-2">Selamat Datang di Panel EO, {{ Auth::user()->name }}!</h3>
                    <p class="text-blue-100 max-w-xl">Pantau performa event Anda, kelola penjualan tiket, dan lihat ringkasan transaksi dalam satu tempat.</p>
                </div>
            </div>

            <!-- Main Metrics Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                
                <!-- Total Pendapatan (Penjualan) -->
                <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition-shadow lg:col-span-2">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 rounded-xl bg-blue-50 text-electric-blue flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Uang Hasil Penjualan</p>
                            <h4 class="text-3xl font-bold text-deep-navy">Rp 0</h4>
                        </div>
                    </div>
                    <div class="w-full bg-gray-100 rounded-full h-1.5 mt-4">
                        <div class="bg-electric-blue h-1.5 rounded-full" style="width: 0%"></div>
                    </div>
                </div>

                <!-- Total Transaksi -->
                <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 rounded-xl bg-green-50 text-green-500 flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Transaksi</p>
                            <h4 class="text-3xl font-bold text-deep-navy">0</h4>
                        </div>
                    </div>
                    <p class="text-xs text-gray-400 mt-4 flex items-center gap-1">
                        <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        Transaksi berhasil
                    </p>
                </div>

                <!-- Total Tiket Terjual -->
                <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 rounded-xl bg-orange-50 text-orange-500 flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" /></svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Tiket Terjual</p>
                            <h4 class="text-3xl font-bold text-deep-navy">0</h4>
                        </div>
                    </div>
                    <p class="text-xs text-gray-400 mt-4 flex items-center gap-1">
                        <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        Tiket terdistribusi
                    </p>
                </div>

                <!-- Event Aktif -->
                <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-500 flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Event Aktif</p>
                            <h4 class="text-3xl font-bold text-deep-navy">0</h4>
                        </div>
                    </div>
                    <p class="text-xs text-gray-400 mt-4 flex items-center gap-1">
                        <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        Event sedang berlangsung
                    </p>
                </div>

                <!-- Event Draft -->
                <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 rounded-xl bg-gray-100 text-gray-500 flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Event Draft</p>
                            <h4 class="text-3xl font-bold text-deep-navy">0</h4>
                        </div>
                    </div>
                    <p class="text-xs text-gray-400 mt-4 flex items-center gap-1">
                        <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        Belum dipublikasikan
                    </p>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
