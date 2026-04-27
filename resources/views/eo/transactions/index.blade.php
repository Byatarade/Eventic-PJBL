<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-deep-navy leading-tight">
            {{ __('Manajemen Transaksi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-2xl border border-gray-100 p-6">
                <p class="text-gray-500">Halaman ini akan berisi daftar transaksi, filter, export ke CSV, dan detail pembeli.</p>
            </div>
        </div>
    </div>
</x-app-layout>
