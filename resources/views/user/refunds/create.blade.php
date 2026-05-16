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
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-8">
                    <div class="flex items-center gap-4 mb-8 p-4 bg-amber-50 rounded-2xl border border-amber-100">
                        <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center shrink-0">
                            <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-amber-900 text-sm">Informasi Refund</h4>
                            <p class="text-amber-800 text-xs">Refund akan ditinjau oleh EO. Pastikan alasan pembatalan jelas dan informasi rekening benar.</p>
                        </div>
                    </div>

                    <form action="{{ route('user.refunds.store', $order) }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <div>
                            <label for="reason" class="block text-sm font-bold text-gray-700 mb-2">Alasan Pembatalan</label>
                            <textarea name="reason" id="reason" rows="4" class="w-full rounded-2xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 transition-all" placeholder="Jelaskan alasan Anda mengajukan refund..." required>{{ old('reason') }}</textarea>
                            @error('reason') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="bank_info" class="block text-sm font-bold text-gray-700 mb-2">Informasi Rekening Pengembalian</label>
                            <textarea name="bank_info" id="bank_info" rows="3" class="w-full rounded-2xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 transition-all" placeholder="Contoh: BCA - 1234567890 - A/N Nama Anda" required>{{ old('bank_info') }}</textarea>
                            <p class="mt-2 text-xs text-gray-500 italic">* Dana akan dikembalikan ke rekening ini jika pengajuan disetujui.</p>
                            @error('bank_info') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div class="pt-4 flex flex-col sm:flex-row gap-3">
                            <button type="submit" class="flex-1 bg-red-500 hover:bg-red-600 text-white font-bold py-3 rounded-2xl transition-all shadow-lg shadow-red-500/20 active:scale-95">
                                Kirim Pengajuan Refund
                            </button>
                            <a href="{{ route('user.tickets.show', $order) }}" class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-3 rounded-2xl text-center transition-all">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
