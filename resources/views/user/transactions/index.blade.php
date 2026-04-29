<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-deep-navy leading-tight">
            {{ __('Riwayat Transaksi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Filter / Tabs -->
            <div x-data="{ filter: 'semua' }" class="mb-6">
                <div class="flex flex-wrap gap-3 mb-4">
                    <button @click="filter = 'semua'" :class="filter === 'semua' ? 'bg-electric-blue text-white shadow-md border-transparent' : 'bg-white text-gray-600 border-gray-200 hover:bg-gray-50 hover:text-deep-navy'" class="px-5 py-2.5 rounded-full text-sm font-semibold border transition-all duration-200">Semua Transaksi</button>
                    <button @click="filter = 'pending'" :class="filter === 'pending' ? 'bg-electric-blue text-white shadow-md border-transparent' : 'bg-white text-gray-600 border-gray-200 hover:bg-gray-50 hover:text-deep-navy'" class="px-5 py-2.5 rounded-full text-sm font-semibold border transition-all duration-200">Menunggu Pembayaran</button>
                    <button @click="filter = 'paid'" :class="filter === 'paid' ? 'bg-electric-blue text-white shadow-md border-transparent' : 'bg-white text-gray-600 border-gray-200 hover:bg-gray-50 hover:text-deep-navy'" class="px-5 py-2.5 rounded-full text-sm font-semibold border transition-all duration-200">Berhasil</button>
                    <button @click="filter = 'expired'" :class="filter === 'expired' ? 'bg-electric-blue text-white shadow-md border-transparent' : 'bg-white text-gray-600 border-gray-200 hover:bg-gray-50 hover:text-deep-navy'" class="px-5 py-2.5 rounded-full text-sm font-semibold border transition-all duration-200">Batal / Kadaluarsa</button>
                </div>

                @php
                    $transactions = []; // Dummy empty array for now
                @endphp

                @if(count($transactions) > 0)
                    <div class="mt-6 space-y-6">
                        @foreach($transactions as $transaction)
                            <!-- Transaction Card Loop placeholder -->
                        @endforeach
                    </div>
                @else
                    <!-- Empty State -->
                    <div class="mt-8 bg-white rounded-2xl shadow-sm border border-gray-100 p-12 flex flex-col items-center justify-center text-center">
                        <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mb-6">
                            <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-deep-navy mb-2">Belum Ada Transaksi</h3>
                        <p class="text-gray-500 max-w-md mx-auto mb-8">Anda belum melakukan transaksi apapun. Beli tiket event sekarang dan mulai pengalaman seru Anda.</p>
                        <a href="/" class="bg-electric-blue hover:bg-blue-700 text-white font-semibold py-3 px-8 rounded-xl transition-colors shadow-sm inline-flex items-center gap-2">
                            Cari Event
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
