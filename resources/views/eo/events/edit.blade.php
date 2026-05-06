<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center gap-8">
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
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="bg-slate-50 border-b border-gray-100 px-8 py-6">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-electric-blue/10 flex items-center justify-center">
                                <svg class="w-6 h-6 text-electric-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-deep-navy">1. Informasi Event</h3>
                                <p class="text-sm text-gray-500">Ubah detail utama mengenai event Anda.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-8 space-y-8">
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
                                        <label for="banner" class="premium-input flex items-center justify-between cursor-pointer hover:bg-slate-100">
                                            <span id="file-name" class="text-slate-500 truncate">Pilih gambar baru...</span>
                                            <span class="bg-electric-blue text-white text-xs font-bold px-3 py-1 rounded-lg">Browse</span>
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

                        <!-- Keterangan & S&K -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="input-group group">
                                <label for="description" class="premium-label">Keterangan Event</label>
                                <textarea id="description" name="description" rows="5" class="premium-input resize-none" placeholder="Jelaskan detail event Anda di sini...">{{ old('description', $event->description) }}</textarea>
                            </div>
                            
                            <div class="input-group group">
                                <label for="terms" class="premium-label">Syarat dan Ketentuan</label>
                                <textarea id="terms" name="terms" rows="5" class="premium-input resize-none" placeholder="Aturan main untuk peserta...">{{ old('terms', $event->terms) }}</textarea>
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
                                <label for="organizer_social" class="premium-label">Sosial Media Penyelenggara</label>
                                <div class="relative">
                                    <span class="input-icon">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                                        </svg>
                                    </span>
                                    <input type="text" id="organizer_social" name="organizer_social" class="premium-input-with-icon" value="{{ old('organizer_social', $event->organizer_social) }}" placeholder="Contoh: @username_instagram">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 2: Pengaturan Tiket -->
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="bg-slate-50 border-b border-gray-100 px-8 py-6 flex justify-between items-center">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-orange-500/10 flex items-center justify-center">
                                <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-deep-navy">2. Pengaturan Tiket</h3>
                                <p class="text-sm text-gray-500">Tentukan jenis, harga, dan kuota tiket.</p>
                            </div>
                        </div>
                        <span class="bg-blue-50 text-electric-blue text-xs font-bold px-4 py-2 rounded-full border border-blue-100">
                            Limit: 5 Tiket/User
                        </span>
                    </div>
                    
                    <div class="p-8" x-data="{ 
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
                        <div class="bg-amber-50 border border-amber-100 p-5 mb-8 rounded-2xl flex gap-4">
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
                                <div class="bg-slate-50 border border-slate-100 rounded-3xl p-8 relative overflow-hidden">
                                    <div class="absolute top-0 right-0 p-4 opacity-5 pointer-events-none">
                                        <svg class="w-32 h-32 text-slate-900" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                                        </svg>
                                    </div>
                                    
                                    <div class="flex justify-between items-center mb-6 relative z-10">
                                        <h4 class="text-sm font-bold text-slate-400 uppercase tracking-widest">Tipe Tiket #<span x-text="index + 1"></span></h4>
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
                    <button type="submit" name="draft" value="1" class="w-full md:w-auto px-8 py-4 border-2 border-slate-200 text-slate-600 rounded-2xl hover:bg-slate-50 hover:border-slate-300 font-bold transition-all duration-300 flex items-center justify-center gap-2 group">
                        <svg class="w-5 h-5 text-slate-400 group-hover:text-slate-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                        </svg>
                        Simpan Draft
                    </button>
                    <button type="submit" class="w-full md:w-auto px-10 py-4 bg-electric-blue text-white rounded-2xl hover:bg-blue-600 font-bold transition-all duration-300 shadow-lg shadow-blue-500/30 hover:shadow-blue-500/40 transform hover:-translate-y-1 flex items-center justify-center gap-2">
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
