<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('user.tickets.show', $order) }}" class="w-9 h-9 bg-gray-100 hover:bg-gray-200 rounded-xl flex items-center justify-center transition-colors">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <h2 class="font-bold text-2xl text-deep-navy leading-tight">Ajukan Refund</h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            
            {{-- TICKET SUMMARY CARD --}}
            <div class="bg-[#4F46E5] rounded-3xl p-8 mb-8 text-white shadow-xl shadow-indigo-100 relative overflow-hidden">
                <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div>
                        <div class="inline-flex items-center gap-2 px-3 py-1 bg-white/20 rounded-full text-[10px] font-black uppercase tracking-widest mb-3 backdrop-blur-md">
                            Tiket yang di-refund
                        </div>
                        <h3 class="text-2xl font-black mb-1 leading-tight">{{ $order->items->first()->ticket->event->name }}</h3>
                        <p class="text-white/70 text-sm font-bold flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                            Order #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}
                        </p>
                    </div>
                    <div class="md:text-right border-t md:border-t-0 border-white/10 pt-6 md:pt-0">
                        <p class="text-white/60 text-[11px] font-black uppercase tracking-widest mb-1">Potensi Pengembalian</p>
                        <p class="text-3xl font-black">Rp{{ number_format($order->total_price, 0, ',', '.') }}</p>
                    </div>
                </div>
                
                {{-- Decorative circles --}}
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/10 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-indigo-400/20 rounded-full blur-3xl"></div>
            </div>

            <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-8 sm:p-10">
                    
                    {{-- INFORMATION BOX --}}
                    <div class="flex items-start gap-5 mb-10 p-6 bg-amber-50 rounded-3xl border border-amber-100/50">
                        <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center shrink-0 shadow-sm shadow-amber-200">
                            <svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <h4 class="font-black text-amber-900 text-sm mb-1 uppercase tracking-wide">Informasi Refund</h4>
                            <p class="text-amber-800/80 text-sm leading-relaxed">Permintaan refund Anda akan ditinjau secara manual oleh Event Organizer (EO). Pastikan alasan pembatalan jelas dan informasi rekening benar untuk mempercepat proses verifikasi.</p>
                        </div>
                    </div>

                    <form action="{{ route('user.refunds.store', $order) }}" method="POST" class="space-y-10">
                        @csrf
                        
                        {{-- REASON FIELD --}}
                        <div class="space-y-4">
                            <div class="flex items-center gap-2">
                                <div class="w-1.5 h-6 bg-red-500 rounded-full"></div>
                                <label for="reason" class="text-base font-black text-gray-900 uppercase tracking-tight">Alasan Pembatalan</label>
                            </div>
                            <textarea name="reason" id="reason" rows="4" 
                                class="w-full rounded-2xl border-gray-200 bg-gray-50/50 focus:border-[#4F46E5] focus:ring focus:ring-[#4F46E5] focus:ring-opacity-20 transition-all px-5 py-4 text-gray-700 font-medium placeholder:text-gray-400" 
                                placeholder="Jelaskan secara detail alasan Anda mengajukan pengembalian dana..." required>{{ old('reason') }}</textarea>
                            @error('reason') <p class="mt-1 text-sm text-red-500 font-bold">{{ $message }}</p> @enderror
                        </div>

                        {{-- BANK INFO FIELD --}}
                        <div class="space-y-4">
                            <div class="flex items-center gap-2">
                                <div class="w-1.5 h-6 bg-[#4F46E5] rounded-full"></div>
                                <label for="bank_info" class="text-base font-black text-gray-900 uppercase tracking-tight">Informasi Rekening</label>
                            </div>
                            <textarea name="bank_info" id="bank_info" rows="3" 
                                class="w-full rounded-2xl border-gray-200 bg-gray-50/50 focus:border-[#4F46E5] focus:ring focus:ring-[#4F46E5] focus:ring-opacity-20 transition-all px-5 py-4 text-gray-700 font-medium placeholder:text-gray-400" 
                                placeholder="Contoh: BCA - 1234567890 - A/N Nama Lengkap Anda" required>{{ old('bank_info') }}</textarea>
                            <div class="flex items-center gap-2 p-3 bg-gray-50 rounded-xl">
                                <svg class="w-4 h-4 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <p class="text-[11px] text-gray-500 font-bold uppercase tracking-wide">Dana akan dikirimkan ke rekening ini setelah disetujui oleh pihak EO.</p>
                            </div>
                            @error('bank_info') <p class="mt-1 text-sm text-red-500 font-bold">{{ $message }}</p> @enderror
                        </div>

                        {{-- BUTTONS --}}
                        <div class="pt-6 flex flex-col sm:flex-row gap-4">
                            <button type="submit" class="flex-[2] bg-red-500 hover:bg-red-600 text-white font-black py-4 rounded-2xl transition-all shadow-xl shadow-red-500/20 active:scale-[0.98] flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                                Kirim Pengajuan Refund
                            </button>
                            <a href="{{ route('user.tickets.show', $order) }}" class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-black py-4 rounded-2xl text-center transition-all flex items-center justify-center gap-2 active:scale-[0.98]">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
