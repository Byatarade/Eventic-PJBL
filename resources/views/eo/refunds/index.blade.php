<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-deep-navy leading-tight">Manajemen Refund</h2>
        <p class="text-sm text-gray-500">Kelola pengajuan pembatalan dan refund dari peserta.</p>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($refunds->isEmpty())
                <div class="bg-white rounded-3xl p-12 text-center shadow-sm border border-gray-100">
                    <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Tidak Ada Pengajuan</h3>
                    <p class="text-gray-500 max-w-md mx-auto">Saat ini belum ada peserta yang mengajukan refund untuk event Anda.</p>
                </div>
            @else
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-gray-50 border-b border-gray-100">
                                <tr>
                                    <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">User / Order</th>
                                    <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Event / Tiket</th>
                                    <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Alasan & Rekening</th>
                                    <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($refunds as $refund)
                                    <tr>
                                        <td class="px-6 py-4">
                                            <div class="font-bold text-gray-900">{{ $refund->user->name }}</div>
                                            <div class="text-xs text-gray-500">Order #{{ str_pad($refund->order_id, 6, '0', STR_PAD_LEFT) }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="font-semibold text-gray-800 text-sm">{{ $refund->order->items->first()->ticket->event->name }}</div>
                                            <div class="text-xs text-indigo-600 font-bold">Rp{{ number_format($refund->order->total_price, 0, ',', '.') }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-xs text-gray-600 mb-1 line-clamp-2" title="{{ $refund->reason }}">"{{ $refund->reason }}"</div>
                                            <div class="text-[10px] text-gray-400 font-mono">{{ $refund->bank_info }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            @if($refund->status === 'pending')
                                                <span class="px-2.5 py-1 bg-amber-50 text-amber-600 text-[10px] font-bold rounded-full uppercase">Pending</span>
                                            @elseif($refund->status === 'approved')
                                                <span class="px-2.5 py-1 bg-emerald-50 text-emerald-600 text-[10px] font-bold rounded-full uppercase">Approved</span>
                                            @else
                                                <span class="px-2.5 py-1 bg-red-50 text-red-600 text-[10px] font-bold rounded-full uppercase">Rejected</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            @if($refund->status === 'pending')
                                                <div x-data="{ open: false }" class="relative inline-block text-left">
                                                    <button @click="open = !open" class="text-indigo-600 hover:text-indigo-900 font-bold text-sm">Proses</button>
                                                    
                                                    <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-64 bg-white rounded-2xl shadow-xl border border-gray-100 z-50 p-4 text-left">
                                                        <form action="{{ route('eo.refunds.update', $refund) }}" method="POST">
                                                            @csrf
                                                            @method('PATCH')
                                                            <div class="mb-3">
                                                                <label class="block text-xs font-bold text-gray-500 mb-1">Catatan Admin</label>
                                                                <textarea name="admin_notes" class="w-full text-xs rounded-xl border-gray-200" rows="2" placeholder="Alasan setuju/tolak..."></textarea>
                                                            </div>
                                                            <div class="flex gap-2">
                                                                <button type="submit" name="status" value="approved" class="flex-1 bg-emerald-500 text-white text-[10px] font-bold py-2 rounded-lg hover:bg-emerald-600">Setujui</button>
                                                                <button type="submit" name="status" value="rejected" class="flex-1 bg-red-500 text-white text-[10px] font-bold py-2 rounded-lg hover:bg-red-600">Tolak</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            @else
                                                <span class="text-xs text-gray-400 italic">Selesai</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
