<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-deep-navy leading-tight">
                {{ __('Kelola Event') }}
            </h2>
            <a href="{{ route('eo.events.create') }}" class="bg-electric-blue hover:bg-blue-600 text-white px-4 py-2 rounded-xl text-sm font-semibold transition-colors shadow-sm">
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

            <div class="bg-white overflow-hidden shadow-sm rounded-2xl border border-gray-100">
                <div class="p-6">
                    
                    {{-- Search & Filter --}}
                    <div class="flex justify-between items-center mb-6">
                        <div class="relative w-64">
                            <input type="text" placeholder="Cari event..." class="w-full pl-10 pr-4 py-2 rounded-xl border border-gray-200 focus:border-electric-blue focus:ring-electric-blue text-sm">
                            <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                        </div>
                        <div class="flex gap-2">
                            <select class="rounded-xl border-gray-200 text-sm focus:border-electric-blue focus:ring-electric-blue">
                                <option value="">Semua Status</option>
                                <option value="published">Published</option>
                                <option value="draft">Draft</option>
                                <option value="selesai">Selesai</option>
                            </select>
                        </div>
                    </div>

                    {{-- Table List --}}
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider">
                                    <th class="p-4 font-semibold rounded-tl-xl">Nama Event</th>
                                    <th class="p-4 font-semibold">Tanggal</th>
                                    <th class="p-4 font-semibold">Status</th>
                                    <th class="p-4 font-semibold">Tiket</th>
                                    <th class="p-4 font-semibold text-right rounded-tr-xl">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse ($events as $event)
                                    <tr class="hover:bg-gray-50/50 transition-colors">
                                        <td class="p-4">
                                            <div class="flex items-center gap-3">
                                                @if ($event->image)
                                                    <img src="{{ Storage::url($event->image) }}" alt="{{ $event->name }}" class="w-10 h-10 rounded-lg object-cover border border-gray-100">
                                                @else
                                                    <div class="w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center">
                                                        <svg class="w-5 h-5 text-electric-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                                    </div>
                                                @endif
                                                <div>
                                                    <div class="font-bold text-deep-navy">{{ $event->name }}</div>
                                                    <div class="text-xs text-gray-500">{{ $event->location }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="p-4 text-sm text-gray-600">
                                            {{ $event->date->translatedFormat('d M Y, H:i') }}
                                        </td>
                                        <td class="p-4">
                                            @if ($event->status === 'published')
                                                <span class="bg-green-100 text-green-700 px-2.5 py-0.5 rounded-full text-xs font-semibold">Published</span>
                                            @elseif ($event->status === 'draft')
                                                <span class="bg-yellow-100 text-yellow-700 px-2.5 py-0.5 rounded-full text-xs font-semibold">Draft</span>
                                            @else
                                                <span class="bg-gray-100 text-gray-600 px-2.5 py-0.5 rounded-full text-xs font-semibold">Selesai</span>
                                            @endif
                                        </td>
                                        <td class="p-4 text-sm text-gray-600">
                                            {{ $event->tickets_count }} tipe
                                        </td>
                                        <td class="p-4 text-right space-x-2">
                                            <a href="{{ route('eo.events.show', $event) }}" class="text-gray-400 hover:text-electric-blue transition-colors group relative inline-block" title="Lihat Event">
                                                <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                                <span class="absolute -top-8 left-1/2 -translate-x-1/2 bg-gray-800 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none z-10 shadow-sm">Lihat Detail</span>
                                            </a>
                                            <a href="{{ route('eo.events.edit', $event) }}" class="text-gray-400 hover:text-yellow-500 transition-colors group relative inline-block" title="Edit Event">
                                                <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                                <span class="absolute -top-8 left-1/2 -translate-x-1/2 bg-gray-800 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none z-10 shadow-sm">Edit Event</span>
                                            </a>
                                            <form action="{{ route('eo.events.destroy', $event) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus event ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-gray-400 hover:text-red-500 transition-colors group relative" title="Hapus Event">
                                                    <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                                    <span class="absolute -top-8 left-1/2 -translate-x-1/2 bg-gray-800 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none z-10 shadow-sm">Hapus Event</span>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="p-8 text-center">
                                            <div class="flex flex-col items-center gap-3">
                                                <div class="w-16 h-16 rounded-2xl bg-gray-100 flex items-center justify-center">
                                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                                </div>
                                                <p class="text-gray-500 font-medium">Belum ada event.</p>
                                                <a href="{{ route('eo.events.create') }}" class="text-electric-blue hover:underline text-sm font-semibold">
                                                    + Buat event pertama Anda
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
