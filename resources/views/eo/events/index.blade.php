<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <h2 class="font-bold text-2xl text-deep-navy leading-tight">
                {{ __('Kelola Event') }}
            </h2>
            <a href="{{ route('eo.events.create') }}" class="w-full sm:w-auto text-center bg-electric-blue hover:bg-blue-600 text-white px-5 py-2.5 rounded-xl text-sm font-bold transition-colors shadow-sm">
                + Buat Event Baru
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Success Message --}}
            @if (session('success'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-400 p-4 rounded-r-xl">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                        <p class="text-sm font-semibold text-green-700">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="p-8">
                    
                    {{-- Search & Filter --}}
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-6">
                        <div class="relative w-full md:w-80">
                            <input type="text" placeholder="Cari event..." class="w-full pl-11 pr-4 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:bg-white focus:border-blue-600 focus:ring-4 focus:ring-blue-600/5 text-sm transition-all outline-none">
                            <svg class="w-5 h-5 text-slate-400 absolute left-4 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                        </div>
                        <div class="flex gap-3 w-full md:w-auto">
                            <select class="w-full md:w-auto rounded-xl bg-slate-50 border-slate-200 text-sm font-semibold text-slate-700 focus:bg-white focus:border-blue-600 focus:ring-4 focus:ring-blue-600/5 transition-all outline-none py-3 px-4">
                                <option value="">Semua Status</option>
                                <option value="published">Published</option>
                                <option value="draft">Draft</option>
                                <option value="selesai">Selesai</option>
                            </select>
                        </div>
                    </div>
                </div>

                {{-- Table List --}}
                <div class="overflow-x-auto scrollbar-hide pb-4">
                    <table class="w-full text-left border-collapse whitespace-nowrap lg:whitespace-normal">
                        <thead>
                            <tr class="bg-slate-50/50">
                                <th class="px-8 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Nama Event</th>
                                <th class="px-8 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Tanggal</th>
                                <th class="px-8 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Status</th>
                                <th class="px-8 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Tiket</th>
                                <th class="px-8 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse ($events as $event)
                                <tr class="hover:bg-slate-50/50 transition-colors group">
                                    <td class="px-8 py-5">
                                        <div class="flex items-center gap-4">
                                            @if ($event->image)
                                                <img src="{{ Storage::url($event->image) }}" alt="{{ $event->name }}" class="w-12 h-12 rounded-xl object-cover border border-slate-100 shadow-sm group-hover:scale-105 transition-transform">
                                            @else
                                                <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center border border-blue-100 group-hover:scale-105 transition-transform">
                                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                                </div>
                                            @endif
                                            <div class="min-w-0">
                                                <div class="font-bold text-slate-900 group-hover:text-blue-600 transition-colors leading-tight">{{ $event->name }}</div>
                                                <div class="text-[11px] text-slate-400 font-medium mt-1 uppercase tracking-tight flex items-center gap-1.5">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                                    {{ $event->location }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-5 text-sm text-slate-600 font-bold tracking-tight">
                                        {{ $event->date->translatedFormat('d M Y, H:i') }}
                                    </td>
                                    <td class="px-8 py-5">
                                        @if ($event->status === 'published')
                                            <span class="bg-emerald-50 text-emerald-600 px-3 py-1.5 rounded-lg text-[10px] font-bold uppercase tracking-tight">Published</span>
                                        @elseif ($event->status === 'draft')
                                            <span class="bg-amber-50 text-amber-600 px-3 py-1.5 rounded-lg text-[10px] font-bold uppercase tracking-tight">Draft</span>
                                        @else
                                            <span class="bg-slate-100 text-slate-600 px-3 py-1.5 rounded-lg text-[10px] font-bold uppercase tracking-tight">Selesai</span>
                                        @endif
                                    </td>
                                    <td class="px-8 py-5">
                                        <span class="text-sm font-bold text-slate-800">{{ $event->tickets_count }}</span>
                                        <span class="text-[10px] text-slate-400 font-bold uppercase ml-1">Tipe</span>
                                    </td>
                                    <td class="px-8 py-5 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="{{ route('eo.events.show', $event) }}" class="p-2 text-slate-400 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-all" title="Lihat Detail">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                            </a>
                                            <a href="{{ route('eo.events.edit', $event) }}" class="p-2 text-slate-400 hover:bg-amber-50 hover:text-amber-600 rounded-lg transition-all" title="Edit Event">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                            </a>
                                            <form action="{{ route('eo.events.destroy', $event) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus event ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 text-slate-400 hover:bg-rose-50 hover:text-rose-600 rounded-lg transition-all" title="Hapus Event">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="p-20 text-center">
                                        <div class="flex flex-col items-center gap-4">
                                            <div class="w-20 h-20 rounded-3xl bg-slate-50 flex items-center justify-center border border-slate-100 shadow-inner">
                                                <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                            </div>
                                            <div class="space-y-1">
                                                <p class="text-slate-900 font-bold text-lg">Belum ada event</p>
                                                <p class="text-slate-400 text-sm max-w-xs mx-auto">Mulai buat event pertama Anda untuk menarik lebih banyak audiens.</p>
                                            </div>
                                            <a href="{{ route('eo.events.create') }}" class="mt-2 bg-blue-600 text-white px-6 py-2.5 rounded-xl font-bold text-sm hover:bg-blue-700 transition-all shadow-lg shadow-blue-600/10 active:scale-95">
                                                + Buat Event Pertama
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
