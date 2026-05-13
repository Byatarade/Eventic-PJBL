<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center gap-8">
            <div>
                <h2 class="font-bold text-2xl text-deep-navy leading-tight">
                    {{ __('Daftar Peserta') }}
                </h2>
                <p class="text-slate-500 text-sm font-medium mt-1">Kelola data peserta yang telah membeli tiket untuk event Anda.</p>
            </div>
            <div class="flex items-center gap-3">
                <button onclick="window.print()" class="bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 px-4 py-2 rounded-xl text-sm font-bold transition-colors shadow-sm flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Export CSV
                </button>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Filter & Search Bar -->
            <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm p-6">
                <form method="GET" action="{{ route('eo.participants.index') }}" class="flex flex-col md:flex-row gap-4 items-end">
                    <div class="flex-1 w-full">
                        <label for="search" class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Pencarian</label>
                        <div class="relative">
                            <input type="text" id="search" name="search" value="{{ request('search') }}" placeholder="Cari nama peserta atau email..." class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:border-electric-blue focus:ring-electric-blue transition-colors">
                            <svg class="w-5 h-5 text-slate-400 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                    </div>
                    <div class="w-full md:w-64">
                        <label for="event_id" class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Pilih Event</label>
                        <select id="event_id" name="event_id" class="w-full py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:border-electric-blue focus:ring-electric-blue transition-colors truncate">
                            <option value="">Semua Event</option>
                            @foreach($events as $event)
                                <option value="{{ $event->id }}" {{ request('event_id') == $event->id ? 'selected' : '' }}>
                                    {{ $event->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <button type="submit" class="w-full md:w-auto px-8 py-3 bg-electric-blue hover:bg-blue-600 text-white rounded-xl font-bold transition-all shadow-sm flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                            Filter
                        </button>
                    </div>
                </form>
            </div>

            <!-- Participants Table -->
            <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/50 border-b border-slate-100">
                                <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-widest">Peserta</th>
                                <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-widest">Event</th>
                                <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-widest">Tiket</th>
                                <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-widest text-center">Jumlah</th>
                                <th class="px-6 py-4 text-xs font-bold text-slate-400 uppercase tracking-widest text-right">Tgl Beli</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse($participants as $item)
                                <tr class="hover:bg-slate-50/50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-2xl bg-indigo-50 flex items-center justify-center text-xs font-bold text-indigo-500 shrink-0">
                                                {{ strtoupper(substr($item->order->user->name, 0, 2)) }}
                                            </div>
                                            <div>
                                                <p class="text-sm font-bold text-deep-navy">{{ $item->order->user->name }}</p>
                                                <p class="text-[10px] text-slate-400">{{ $item->order->user->email }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <p class="text-sm font-bold text-slate-700 truncate max-w-[200px]" title="{{ $item->ticket->event->name }}">
                                            {{ $item->ticket->event->name }}
                                        </p>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-block px-3 py-1 bg-slate-100 text-slate-600 rounded-lg text-[10px] font-bold uppercase tracking-wider">
                                            {{ $item->ticket->type }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <p class="text-sm font-bold text-deep-navy">{{ $item->quantity }} <span class="text-[10px] text-slate-400 font-medium">Tiket</span></p>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <p class="text-sm text-slate-500 font-medium">{{ \Carbon\Carbon::parse($item->order->created_at)->format('d M Y') }}</p>
                                        <p class="text-[10px] text-slate-400">{{ \Carbon\Carbon::parse($item->order->created_at)->format('H:i') }} WIB</p>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-16 text-center">
                                        <div class="flex flex-col items-center">
                                            <div class="w-16 h-16 bg-slate-50 rounded-2xl flex items-center justify-center mb-4">
                                                <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                            </div>
                                            <h3 class="text-sm font-bold text-slate-700 mb-1">Tidak ada peserta ditemukan</h3>
                                            <p class="text-xs text-slate-400">Belum ada peserta yang sesuai dengan filter Anda.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                @if($participants->hasPages())
                    <div class="px-6 py-4 border-t border-slate-100">
                        {{ $participants->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
