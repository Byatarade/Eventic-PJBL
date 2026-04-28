<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-deep-navy leading-tight">
                {{ __('Edit Event') }}: {{ $event->name }}
            </h2>
            <a href="{{ route('eo.events.index') }}" class="text-gray-500 hover:text-electric-blue transition-colors text-sm font-semibold">
                &larr; Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('eo.events.update', $event) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                @method('PUT')
                
                <!-- Section 1: Informasi Event -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="bg-slate-white border-b border-gray-100 px-6 py-4">
                        <h3 class="text-lg font-bold text-deep-navy">1. Informasi Event</h3>
                        <p class="text-sm text-gray-500">Ubah detail utama mengenai event Anda.</p>
                    </div>
                    <div class="p-6 space-y-6">
                        
                        <!-- Nama Event & Banner -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="name" :value="__('Nama Event')" class="text-deep-navy" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" value="{{ old('name', $event->name) }}" required />
                            </div>
                            <div>
                                <x-input-label for="banner" :value="__('Banner Event (Biarkan kosong jika tidak diubah)')" class="text-deep-navy" />
                                <input type="file" id="banner" name="banner" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-electric-blue hover:file:bg-blue-100 transition-colors" accept="image/*" />
                                @if($event->image)
                                    <p class="mt-2 text-xs text-gray-400 italic">Banner saat ini: <a href="{{ Storage::url($event->image) }}" target="_blank" class="text-electric-blue hover:underline">Lihat Gambar</a></p>
                                @endif
                            </div>
                        </div>

                        <!-- Tanggal & Lokasi -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="datetime" :value="__('Tanggal & Waktu Event')" class="text-deep-navy" />
                                <x-text-input id="datetime" name="datetime" type="datetime-local" class="mt-1 block w-full" value="{{ old('datetime', $event->date->format('Y-m-d\TH:i')) }}" required />
                            </div>
                            <div>
                                <x-input-label for="location" :value="__('Lokasi Event')" class="text-deep-navy" />
                                <x-text-input id="location" name="location" type="text" class="mt-1 block w-full" value="{{ old('location', $event->location) }}" required />
                            </div>
                        </div>

                        <!-- Keterangan & S&K -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="description" :value="__('Keterangan Event')" class="text-deep-navy" />
                                <textarea id="description" name="description" rows="4" class="mt-1 block w-full border-gray-300 focus:border-electric-blue focus:ring-electric-blue rounded-xl shadow-sm">{{ old('description', $event->description) }}</textarea>
                            </div>
                            <div>
                                <x-input-label for="terms" :value="__('Syarat dan Ketentuan')" class="text-deep-navy" />
                                <textarea id="terms" name="terms" rows="4" class="mt-1 block w-full border-gray-300 focus:border-electric-blue focus:ring-electric-blue rounded-xl shadow-sm">{{ old('terms', $event->terms) }}</textarea>
                            </div>
                        </div>

                        <!-- Penyelenggara -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="organizer_name" :value="__('Nama Penyelenggara (EO)')" class="text-deep-navy" />
                                <x-text-input id="organizer_name" name="organizer_name" type="text" class="mt-1 block w-full" value="{{ old('organizer_name', $event->organizer_name) }}" required />
                            </div>
                            <div>
                                <x-input-label for="organizer_social" :value="__('Sosial Media Penyelenggara')" class="text-deep-navy" />
                                <x-text-input id="organizer_social" name="organizer_social" type="text" class="mt-1 block w-full" value="{{ old('organizer_social', $event->organizer_social) }}" />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 2: Pengaturan Tiket -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="bg-slate-white border-b border-gray-100 px-6 py-4 flex justify-between items-center">
                        <div>
                            <h3 class="text-lg font-bold text-deep-navy">2. Pengaturan Tiket</h3>
                            <p class="text-sm text-gray-500">Tentukan jenis, harga, dan kuota tiket.</p>
                        </div>
                        <span class="bg-blue-100 text-electric-blue text-xs font-bold px-3 py-1 rounded-full">
                            Maks 5 Tiket/Akun
                        </span>
                    </div>
                    <div class="p-6">
                        
                        <!-- Peringatan Sistem -->
                        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6 rounded-r-xl">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-yellow-700 font-medium">
                                        Sistem menerapkan aturan <strong>1 Akun 1 Identitas</strong>. Setiap pembelian tiket dibatasi maksimal <strong>5 tiket per akun</strong>.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Ticket Box (Assuming single ticket for simplicity based on current controller) -->
                        @php
                            $ticket = $event->tickets->first();
                        @endphp
                        <div class="border border-gray-200 rounded-xl p-5 bg-gray-50/50">
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                                <div class="md:col-span-1">
                                    <x-input-label for="ticket_type" :value="__('Tipe Tiket')" class="text-deep-navy" />
                                    <select id="ticket_type" name="ticket_type" class="mt-1 block w-full border-gray-300 focus:border-electric-blue focus:ring-electric-blue rounded-xl shadow-sm">
                                        <option value="reguler" {{ old('ticket_type', optional($ticket)->type) == 'regular' ? 'selected' : '' }}>Reguler</option>
                                        <option value="vip" {{ old('ticket_type', optional($ticket)->type) == 'vip' ? 'selected' : '' }}>VIP</option>
                                        <option value="vvip" {{ old('ticket_type', optional($ticket)->type) == 'vvip' ? 'selected' : '' }}>VVIP</option>
                                    </select>
                                </div>
                                <div class="md:col-span-1">
                                    <x-input-label for="ticket_price" :value="__('Harga Tiket (Rp)')" class="text-deep-navy" />
                                    <x-text-input id="ticket_price" name="ticket_price" type="number" class="mt-1 block w-full" value="{{ old('ticket_price', optional($ticket)->price) }}" min="0" required />
                                </div>
                                <div class="md:col-span-1">
                                    <x-input-label for="ticket_qty" :value="__('Jumlah Tiket')" class="text-deep-navy" />
                                    <x-text-input id="ticket_qty" name="ticket_qty" type="number" class="mt-1 block w-full" value="{{ old('ticket_qty', optional($ticket)->stock) }}" min="1" required />
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end gap-3">
                    <button type="submit" name="draft" value="1" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 font-semibold transition-colors">
                        Simpan sebagai Draft
                    </button>
                    <button type="submit" class="px-6 py-3 bg-electric-blue text-white rounded-xl hover:bg-blue-600 font-semibold transition-colors shadow-md">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
