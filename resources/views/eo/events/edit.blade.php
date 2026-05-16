<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <h2 class="font-bold text-2xl text-slate-900 tracking-tight">
                {{ __('Edit Event') }}: {{ $event->name }}
            </h2>
            <a href="{{ route('eo.events.index') }}" class="w-full md:w-auto text-center text-slate-400 hover:text-blue-600 transition-colors text-sm font-bold uppercase tracking-widest">
                &larr; Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('eo.events.update', $event) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                @method('PUT')

                @if ($errors->any())
                    <div class="bg-red-50 border-l-4 border-red-500 p-6 rounded-2xl shadow-sm mb-6">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center text-red-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <h3 class="text-red-800 font-bold">Mohon perbaiki kesalahan berikut:</h3>
                        </div>
                        <ul class="list-disc pl-11 text-sm text-red-700 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <!-- Section 1: Informasi Event -->
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                    <div class="bg-slate-50/50 border-b border-slate-100 px-6 md:px-8 py-6">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center shrink-0 border border-blue-100">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-slate-900 tracking-tight">1. Informasi Event</h3>
                                <p class="text-[11px] text-slate-400 font-bold uppercase tracking-widest mt-1">Ubah detail utama mengenai event Anda.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-6 md:p-8 space-y-8">
                        <!-- Nama Event & Banner -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="input-group group">
                                <label for="name" class="premium-label">Nama Event</label>
                                <div class="relative">
                                    <span class="input-icon">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
                                        </svg>
                                    </span>
                                    <input type="text" id="name" name="name" class="premium-input-with-icon" value="{{ old('name', $event->name) }}" required placeholder="Contoh: Konser Musik Jazz 2024">
                                </div>
                            </div>
                            
                            <div class="input-group group">
                                <label for="banner" class="premium-label">Banner Event (Opsional)</label>
                                <div class="relative flex items-center gap-4">
                                    <div class="flex-1">
                                        <input type="file" id="banner" name="banner" class="hidden" accept="image/*" onchange="document.getElementById('file-name').textContent = this.files[0].name">
                                        <label for="banner" class="premium-input flex items-center justify-between cursor-pointer hover:bg-slate-50 transition-colors">
                                            <span id="file-name" class="text-slate-400 truncate font-medium">Pilih gambar baru...</span>
                                            <span class="bg-blue-600 text-white text-[10px] font-bold px-3 py-1.5 rounded-lg uppercase tracking-tight">Browse</span>
                                        </label>
                                    </div>
                                    @if($event->image)
                                        <a href="{{ Storage::url($event->image) }}" target="_blank" class="w-12 h-12 rounded-xl border border-slate-200 overflow-hidden flex-shrink-0 hover:border-electric-blue transition-colors group">
                                            <img src="{{ Storage::url($event->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform" alt="Current Banner">
                                        </a>
                                    @endif
                                </div>
                                <p class="mt-2 text-[10px] text-gray-400 font-medium uppercase tracking-wider ml-1 italic">
                                    Format: JPG, PNG (Maks. 2MB)
                                </p>
                            </div>
                        </div>

                        <!-- Tanggal, Lokasi & Kategori -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                            <div class="input-group group">
                                <label for="datetime" class="premium-label">Tanggal & Waktu Event</label>
                                <div class="relative">
                                    <span class="input-icon">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </span>
                                    <input type="datetime-local" id="datetime" name="datetime" class="premium-input-with-icon" value="{{ old('datetime', $event->date->format('Y-m-d\TH:i')) }}" required>
                                </div>
                            </div>
                            
                            <div class="input-group group">
                                <label for="location" class="premium-label">Lokasi Event</label>
                                <div class="relative">
                                    <span class="input-icon">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                    </span>
                                    <input type="text" id="location" name="location" class="premium-input-with-icon" value="{{ old('location', $event->location) }}" required placeholder="Contoh: Convention Center, Jakarta">
                                </div>
                            </div>

                            <div class="input-group group">
                                <label for="category" class="premium-label">Kategori Event</label>
                                <div class="relative">
                                    <span class="input-icon">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                        </svg>
                                    </span>
                                    <select id="category" name="category" class="premium-input-with-icon" required>
                                        <option value="" disabled {{ !$event->category ? 'selected' : '' }}>Pilih Kategori</option>
                                        <option value="musik" {{ old('category', $event->category) == 'musik' ? 'selected' : '' }}>Musik</option>
                                        <option value="olahraga" {{ old('category', $event->category) == 'olahraga' ? 'selected' : '' }}>Olahraga</option>
                                        <option value="wahana" {{ old('category', $event->category) == 'wahana' ? 'selected' : '' }}>Wahana</option>
                                        <option value="wisata" {{ old('category', $event->category) == 'wisata' ? 'selected' : '' }}>Wisata</option>
                                        <option value="lainnya" {{ old('category', $event->category) == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Keterangan, S&K & Fasilitas -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                            <div class="input-group group">
                                <label for="description" class="premium-label">Keterangan Event</label>
                                <textarea id="description" name="description" rows="5" class="premium-input resize-none" placeholder="Jelaskan detail event Anda di sini...">{{ old('description', $event->description) }}</textarea>
                            </div>
                            
                            <div class="input-group group">
                                <label for="terms" class="premium-label">Syarat dan Ketentuan</label>
                                <textarea id="terms" name="terms" rows="5" class="premium-input resize-none" placeholder="Aturan main untuk peserta...">{{ old('terms', $event->terms) }}</textarea>
                            </div>

                            <div class="input-group group">
                                <label for="facilities" class="premium-label">Fasilitas (Pisahkan dgn baris baru)</label>
                                <textarea id="facilities" name="facilities" rows="5" class="premium-input resize-none" placeholder="Area Parkir Luas&#10;Toilet Bersih&#10;Musholla">{{ old('facilities', $event->facilities) }}</textarea>
                            </div>
                        </div>

                        <!-- Penyelenggara -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="input-group group">
                                <label for="organizer_name" class="premium-label">Nama Penyelenggara (EO)</label>
                                <div class="relative">
                                    <span class="input-icon">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                        </svg>
                                    </span>
                                    <input type="text" id="organizer_name" name="organizer_name" class="premium-input-with-icon" value="{{ old('organizer_name', $event->organizer_name) }}" required>
                                </div>
                            </div>
                            
                            <div class="input-group group">
                                <label for="organizer_ig" class="premium-label">Instagram Penyelenggara</label>
                                <div class="relative">
                                    <span class="input-icon">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                                    </span>
                                    <input type="text" id="organizer_ig" name="organizer_ig" class="premium-input-with-icon" value="{{ old('organizer_ig', $event->organizer_ig) }}" placeholder="Contoh: @username_instagram">
                                </div>
                            </div>

                            <div class="input-group group">
                                <label for="organizer_tiktok" class="premium-label">TikTok Penyelenggara</label>
                                <div class="relative">
                                    <span class="input-icon">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.34 2.88 2.88 0 0 1 2.31-4.53 2.66 2.66 0 0 1 1.04.2v-3.24a5.28 5.28 0 0 0-1.04-.1 6.33 6.33 0 0 0-5.37 9.87 6.32 6.32 0 0 0 11.7-3.3V9.28a8.27 8.27 0 0 0 3.78 1.83V7.77a5.15 5.15 0 0 1-2.09-1.08z"/></svg>
                                    </span>
                                    <input type="text" id="organizer_tiktok" name="organizer_tiktok" class="premium-input-with-icon" value="{{ old('organizer_tiktok', $event->organizer_tiktok) }}" placeholder="Contoh: @username_tiktok">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 2: Pengaturan Tiket -->
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                    <div class="bg-slate-50/50 border-b border-slate-100 px-6 md:px-8 py-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-amber-50 flex items-center justify-center shrink-0 border border-amber-100">
                                <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-slate-900 tracking-tight">2. Pengaturan Tiket</h3>
                                <p class="text-[11px] text-slate-400 font-bold uppercase tracking-widest mt-1">Tentukan jenis, harga, dan kuota tiket.</p>
                            </div>
                        </div>
                        <span class="bg-blue-50 text-blue-600 text-[10px] font-bold px-4 py-2 rounded-xl border border-blue-100 uppercase tracking-tight">
                            Limit: 5 Tiket/User
                        </span>
                    </div>
                    
                    <div class="p-6 md:p-8" x-data="{ 
                        tickets: {{ $event->tickets->map(fn($t) => ['type' => $t->type, 'price' => $t->price, 'stock' => $t->stock])->toJson() }},
                        addTicket() {
                            this.tickets.push({ type: '', price: '', stock: '' });
                        },
                        removeTicket(index) {
                            if (this.tickets.length > 1) {
                                this.tickets.splice(index, 1);
                            }
                        }
                    }">
                        <!-- Peringatan Sistem -->
                        <div class="bg-amber-50 border border-amber-100 p-5 mb-8 rounded-2xl flex flex-col sm:flex-row gap-4">
                            <div class="flex-shrink-0 w-10 h-10 bg-amber-200/50 rounded-full flex items-center justify-center">
                                <svg class="h-6 w-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-amber-800 font-bold text-sm">Manajemen Tiket</h4>
                                <p class="text-xs text-amber-700 mt-1 leading-relaxed">
                                    Anda dapat menambah atau menghapus tipe tiket. Tiket yang dihapus akan hilang dari sistem secara permanen setelah Anda menyimpan perubahan.
                                </p>
                            </div>
                        </div>

                        <!-- Ticket List -->
                        <div class="space-y-6">
                            <template x-for="(ticket, index) in tickets" :key="index">
                                <div class="bg-slate-50 border border-slate-100 rounded-3xl p-6 md:p-8 relative overflow-hidden">
                                    <div class="absolute top-0 right-0 p-4 opacity-5 pointer-events-none">
                                        <svg class="w-32 h-32 text-slate-900" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                                        </svg>
                                    </div>
                                    
                                    <div class="flex justify-between items-center mb-6 relative z-10">
                                        <h4 class="text-xs font-bold text-slate-400 uppercase tracking-widest">Tipe Tiket #<span x-text="index + 1"></span></h4>
                                        <button type="button" @click="removeTicket(index)" x-show="tickets.length > 1" class="text-red-400 hover:text-red-600 transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 relative z-10">
                                        <div class="input-group group">
                                            <label class="premium-label">Tipe Tiket</label>
                                            <div class="relative">
                                                <span class="input-icon">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                </span>
                                                <input type="text" :name="`tickets[${index}][type]`" x-model="ticket.type" class="premium-input-with-icon" placeholder="Contoh: Reguler, VIP, VVIP" required>
                                            </div>
                                        </div>
                                        
                                        <div class="input-group group">
                                            <label class="premium-label">Harga Tiket (Rp)</label>
                                            <div class="relative">
                                                <span class="input-icon font-bold text-xs">Rp</span>
                                                <input type="number" :name="`tickets[${index}][price]`" x-model="ticket.price" class="premium-input-with-icon" min="0" required placeholder="0">
                                            </div>
                                        </div>
                                        
                                        <div class="input-group group">
                                            <label class="premium-label">Jumlah Stok</label>
                                            <div class="relative">
                                                <span class="input-icon">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                                    </svg>
                                                </span>
                                                <input type="number" :name="`tickets[${index}][stock]`" x-model="ticket.stock" class="premium-input-with-icon" min="1" required placeholder="100">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </template>

                            <button type="button" @click="addTicket()" class="w-full py-4 border-2 border-dashed border-slate-200 rounded-3xl text-slate-400 font-bold hover:border-electric-blue hover:text-electric-blue hover:bg-blue-50 transition-all duration-300 flex items-center justify-center gap-2">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                Tambah Tipe Tiket Lainnya
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex flex-col md:flex-row justify-end items-center gap-4 pt-4">
                    <button type="submit" name="draft" value="1" class="w-full md:w-auto px-8 py-4 border-2 border-slate-100 text-slate-400 rounded-2xl hover:bg-slate-50 hover:border-slate-200 font-bold text-xs uppercase tracking-widest transition-all duration-300 flex items-center justify-center gap-2 group active:scale-[0.98]">
                        <svg class="w-5 h-5 text-slate-300 group-hover:text-slate-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                        </svg>
                        Simpan Draft
                    </button>
                    <button type="submit" class="w-full md:w-auto px-12 py-4 bg-blue-600 text-white rounded-2xl hover:bg-blue-700 font-bold text-xs uppercase tracking-widest transition-all duration-300 shadow-lg shadow-blue-600/10 active:scale-[0.98] flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
