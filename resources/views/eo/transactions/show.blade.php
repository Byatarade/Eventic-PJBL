<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <h2 class="font-bold text-2xl text-deep-navy leading-tight">
                {{ __('Detail Transaksi') }}
            </h2>
            <div class="flex gap-3 w-full md:w-auto">
                <a href="{{ route('eo.transactions.index') }}" class="w-full md:w-auto justify-center px-4 py-2 text-gray-500 hover:text-electric-blue transition-colors text-sm font-semibold flex items-center bg-white md:bg-transparent rounded-xl border border-slate-200 md:border-transparent">
                    &larr; Kembali
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left: Order Details & Items -->
                <div class="lg:col-span-2 space-y-8">
                    
                    <!-- Order Status Header -->
                    <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm p-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6">
                        <div>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Order ID</p>
                            <h3 class="text-2xl font-bold text-deep-navy">#{{ str_pad($transaction->id, 6, '0', STR_PAD_LEFT) }}</h3>
                            <p class="text-sm text-slate-500 mt-2">{{ \Carbon\Carbon::parse($transaction->created_at)->format('d M Y, H:i') }} WIB</p>
                        </div>
                        
                        <div class="text-right">
                            @if($transaction->status === 'paid')
                                <span class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-50 text-emerald-600 rounded-xl text-sm font-bold uppercase tracking-wider">
                                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span> Lunas
                                </span>
                            @elseif($transaction->status === 'pending')
                                <span class="inline-flex items-center gap-2 px-4 py-2 bg-amber-50 text-amber-600 rounded-xl text-sm font-bold uppercase tracking-wider">
                                    <span class="w-2 h-2 rounded-full bg-amber-500"></span> Pending
                                </span>
                            @else
                                <span class="inline-flex items-center gap-2 px-4 py-2 bg-red-50 text-red-600 rounded-xl text-sm font-bold uppercase tracking-wider">
                                    <span class="w-2 h-2 rounded-full bg-red-500"></span> Batal
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Items Purchased -->
                    <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden">
                        <div class="p-6 border-b border-slate-50">
                            <h4 class="font-bold text-lg text-deep-navy">Rincian Pembelian</h4>
                        </div>
                        <div class="p-6 space-y-6">
                            @php
                                $firstItem = $transaction->items->first();
                                $event = $firstItem ? $firstItem->ticket->event : null;
                            @endphp
                            
                            @if($event)
                            <div class="flex items-center gap-4 p-4 bg-slate-50 rounded-2xl border border-slate-100">
                                @if($event->image)
                                    <img src="{{ Storage::url($event->image) }}" alt="{{ $event->name }}" class="w-16 h-16 rounded-xl object-cover">
                                @else
                                    <div class="w-16 h-16 rounded-xl bg-blue-100 flex items-center justify-center">
                                        <svg class="w-8 h-8 text-electric-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                @endif
                                <div>
                                    <h5 class="font-bold text-deep-navy text-lg">{{ $event->name }}</h5>
                                    <p class="text-xs text-slate-500">{{ $event->date->format('d M Y, H:i') }} • {{ $event->location }}</p>
                                </div>
                            </div>
                            @endif

                            <div class="space-y-4">
                                @foreach($transaction->items as $item)
                                    <div class="flex justify-between items-center py-2">
                                        <div>
                                            <p class="font-bold text-slate-800">{{ $item->ticket->type }}</p>
                                            <p class="text-sm text-slate-500">{{ $item->quantity }}x @ Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                        </div>
                                        <p class="font-bold text-deep-navy">Rp {{ number_format($item->quantity * $item->price, 0, ',', '.') }}</p>
                                    </div>
                                @endforeach
                            </div>
                            
                            <div class="border-t border-slate-100 pt-4 flex justify-between items-center">
                                <p class="text-sm font-bold text-slate-500 uppercase tracking-widest">Total Bayar</p>
                                <p class="text-2xl font-bold text-electric-blue">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right: Customer Info & Actions -->
                <div class="space-y-8">
                    
                    <!-- Customer Details -->
                    <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm p-6">
                        <h4 class="font-bold text-lg text-deep-navy mb-6">Informasi Pembeli</h4>
                        
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-14 h-14 bg-electric-blue text-white rounded-2xl flex items-center justify-center text-xl font-bold shadow-sm">
                                {{ strtoupper(substr($transaction->user->name, 0, 1)) }}
                            </div>
                            <div>
                                <h5 class="font-bold text-deep-navy">{{ $transaction->user->name }}</h5>
                                <p class="text-xs text-slate-500">{{ $transaction->user->email }}</p>
                            </div>
                        </div>

                        <div class="space-y-4 pt-4 border-t border-slate-50">
                            <div>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Status Akun</p>
                                <p class="text-sm font-semibold text-slate-700">Terdaftar</p>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Details (Dummy info for now if order is paid, usually there's a payment gateway response) -->
                    <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm p-6">
                        <h4 class="font-bold text-lg text-deep-navy mb-4">Metode Pembayaran</h4>
                        @if($transaction->status === 'paid')
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-slate-50 border border-slate-100 rounded-xl flex items-center justify-center">
                                        <svg class="w-5 h-5 text-electric-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-slate-800">Online Payment</p>
                                        <p class="text-[10px] text-slate-400">Telah Diverifikasi</p>
                                    </div>
                                </div>
                            </div>
                        @elseif($transaction->status === 'pending')
                            <p class="text-sm text-slate-500 italic">Menunggu pembayaran dari pembeli.</p>
                        @else
                            <p class="text-sm text-slate-500 italic">Transaksi dibatalkan sebelum pembayaran.</p>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
