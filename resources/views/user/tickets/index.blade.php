<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-deep-navy leading-tight">
            {{ __('Tiket Saya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Filter / Tabs -->
            <div x-data="{ filter: 'semua' }" class="mb-6">
                <div class="flex flex-wrap gap-3 mb-4">
                    <button @click="filter = 'semua'" :class="filter === 'semua' ? 'bg-electric-blue text-white shadow-md border-transparent' : 'bg-white text-gray-600 border-gray-200 hover:bg-gray-50 hover:text-deep-navy'" class="px-5 py-2.5 rounded-full text-sm font-semibold border transition-all duration-200">Semua Tiket</button>
                    <button @click="filter = 'pending'" :class="filter === 'pending' ? 'bg-electric-blue text-white shadow-md border-transparent' : 'bg-white text-gray-600 border-gray-200 hover:bg-gray-50 hover:text-deep-navy'" class="px-5 py-2.5 rounded-full text-sm font-semibold border transition-all duration-200">Pending</button>
                    <button @click="filter = 'paid'" :class="filter === 'paid' ? 'bg-electric-blue text-white shadow-md border-transparent' : 'bg-white text-gray-600 border-gray-200 hover:bg-gray-50 hover:text-deep-navy'" class="px-5 py-2.5 rounded-full text-sm font-semibold border transition-all duration-200">Lunas (Paid)</button>
                    <button @click="filter = 'expired'" :class="filter === 'expired' ? 'bg-electric-blue text-white shadow-md border-transparent' : 'bg-white text-gray-600 border-gray-200 hover:bg-gray-50 hover:text-deep-navy'" class="px-5 py-2.5 rounded-full text-sm font-semibold border transition-all duration-200">Kadaluarsa</button>
                </div>

                @php
                    $tickets = []; // Dummy empty array for now
                @endphp

                @if(count($tickets) > 0)
                    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($tickets as $ticket)
                            <!-- Ticket Card Loop placeholder -->
                        @endforeach
                    </div>
                @else
                    <!-- Empty State -->
                    <div class="mt-8 bg-white rounded-2xl shadow-sm border border-gray-100 p-12 flex flex-col items-center justify-center text-center">
                        <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mb-6">
                            <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-deep-navy mb-2">Belum Ada Tiket</h3>
                        <p class="text-gray-500 max-w-md mx-auto mb-8">Anda belum memiliki tiket apapun. Silakan temukan dan beli tiket event menarik melalui halaman utama kami.</p>
                        <a href="/" class="bg-electric-blue hover:bg-blue-700 text-white font-semibold py-3 px-8 rounded-xl transition-colors shadow-sm inline-flex items-center gap-2">
                            Cari Event
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                    </div>
                @endif
            </div>

        </div>
    </div>

    <!-- E-Ticket Modal Placeholder -->
    <x-modal name="eticket-modal" focusable>
        <div class="p-6">
            <h2 class="text-xl font-bold text-deep-navy mb-4 text-center">E-Ticket Detail</h2>
            <div class="text-center py-8">
                <p class="text-gray-500">QR Code will be rendered here dynamically.</p>
            </div>
            <div class="mt-8 flex justify-end">
                <button x-on:click="$dispatch('close')" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-6 rounded-xl transition-colors">
                    Tutup
                </button>
            </div>
        </div>
    </x-modal>

</x-app-layout>
