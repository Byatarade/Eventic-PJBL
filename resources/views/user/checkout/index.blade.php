<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pilih Kategori - {{ $event->name }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900|montserrat:400,500,600,700,800,900" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-[#F4F7FB]">
    
    <!-- Navbar -->
    <nav class="bg-white border-b border-gray-100 py-4 px-6 md:px-12 flex justify-between items-center sticky top-0 z-50">
        <a href="{{ url('/') }}" class="flex items-center gap-2 hover:opacity-80 transition-opacity">
            <img src="{{ asset('eventic.svg') }}" alt="Eventic Logo" class="h-8 w-auto">
            <span class="font-extrabold text-xl text-[#2D336B] tracking-tight" style="font-family: 'Montserrat', sans-serif;">Eventic</span>
        </a>
    </nav>

    <!-- Stepper -->
    <div class="py-6 border-b border-gray-100 bg-white">
        <div class="max-w-5xl mx-auto px-4 flex items-center justify-center gap-3 md:gap-5 text-[13px] md:text-sm font-semibold">
            <!-- Step 1 (Active) -->
            <div class="flex items-center gap-2 text-indigo-600">
                <span class="w-6 h-6 rounded-full border-2 border-indigo-600 flex items-center justify-center text-xs">1</span>
                <span>Pilih Kategori</span>
            </div>
            <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            
            <!-- Step 2 -->
            <div class="flex items-center gap-2 text-gray-400">
                <span class="w-6 h-6 rounded-full border-2 border-gray-300 flex items-center justify-center text-xs">2</span>
                <span class="hidden sm:inline">Detail Pesanan</span>
            </div>
            <svg class="w-4 h-4 text-gray-300 hidden sm:block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            
            <!-- Step 3 -->
            <div class="flex items-center gap-2 text-gray-400 hidden sm:flex">
                <span class="w-6 h-6 rounded-full border-2 border-gray-300 flex items-center justify-center text-xs">3</span>
                <span>Metode Pembayaran</span>
            </div>
            <svg class="w-4 h-4 text-gray-300 hidden md:block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            
            <!-- Step 4 -->
            <div class="flex items-center gap-2 text-gray-400 hidden md:flex">
                <span class="w-6 h-6 rounded-full border-2 border-gray-300 flex items-center justify-center text-xs">4</span>
                <span>Pembayaran</span>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="py-10" x-data="checkoutProcess({{ $event->tickets->map(fn($t) => ['id' => $t->id, 'type' => $t->type, 'price' => $t->price, 'stock' => $t->stock, 'max' => 5, 'quantity' => 0])->toJson() }})">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                
                <!-- Left Column -->
                <div class="lg:col-span-8 space-y-6">
                    <!-- Banner Event -->
                    <div class="rounded-2xl overflow-hidden shadow-sm border border-gray-100 bg-gray-200">
                        <img src="{{ $event->image ? asset('storage/' . $event->image) : 'https://images.unsplash.com/photo-1540039155732-68473678d4dd?q=80&w=2070' }}" 
                             alt="{{ $event->name }}" 
                             class="w-full aspect-[21/9] object-cover">
                    </div>

                    <!-- Kategori Tiket Section -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                        <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center gap-3">
                            <div class="w-7 h-7 rounded-md bg-[#4F46E5] text-white flex items-center justify-center">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                            </div>
                            Kategori Tiket
                        </h3>

                        <div class="space-y-4">
                            <template x-for="(ticket, index) in tickets" :key="ticket.id">
                                <div class="border border-gray-200 rounded-xl p-5 transition-all duration-300 relative overflow-hidden group"
                                     :class="ticket.quantity > 0 ? 'border-indigo-500 shadow-md ring-1 ring-indigo-500 bg-[#F8FAFC]' : 'hover:border-gray-300 bg-white'">
                                    
                                    <div class="flex flex-col sm:flex-row justify-between gap-4">
                                        <!-- Info -->
                                        <div class="flex-1">
                                            <div class="flex items-center gap-3 mb-1.5">
                                                <h4 class="text-base font-bold text-gray-900" x-text="ticket.type"></h4>
                                                <span x-show="ticket.stock > 0" class="text-[10px] font-bold text-indigo-500 bg-indigo-50 px-2 py-0.5 rounded-full uppercase tracking-wider">
                                                    On Sale
                                                </span>
                                            </div>
                                            <!-- Harga diletakkan di bawah deskripsi/info tiket -->
                                            <div class="text-sm font-semibold text-gray-500 mb-3">
                                                Berlaku untuk 1 orang • <span x-text="ticket.stock + ' tiket tersisa'"></span>
                                            </div>
                                            <div class="text-lg font-black text-[#4F46E5]" x-text="formatRupiah(ticket.price)"></div>
                                        </div>

                                        <!-- Counter -->
                                        <div class="flex items-end justify-between sm:flex-col sm:justify-end shrink-0">
                                            <div x-show="ticket.stock > 0" class="flex items-center bg-white border border-gray-200 rounded-lg h-10 shadow-sm overflow-hidden">
                                                <button @click="decrement(index)" type="button"
                                                        class="w-10 h-full flex items-center justify-center transition-colors"
                                                        :class="ticket.quantity > 0 ? 'text-[#4F46E5] hover:bg-indigo-50' : 'text-gray-300 cursor-not-allowed'"
                                                        :disabled="ticket.quantity === 0">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M20 12H4"></path></svg>
                                                </button>
                                                
                                                <div class="w-10 h-full flex items-center justify-center border-x border-gray-100 font-bold text-gray-900 text-sm" x-text="ticket.quantity"></div>
                                                
                                                <button @click="increment(index)" type="button"
                                                        class="w-10 h-full flex items-center justify-center transition-colors"
                                                        :class="ticket.quantity < Math.min(ticket.max, ticket.stock) ? 'text-[#4F46E5] hover:bg-indigo-50' : 'text-gray-300 cursor-not-allowed'"
                                                        :disabled="ticket.quantity >= Math.min(ticket.max, ticket.stock)">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                                                </button>
                                            </div>

                                            <div x-show="ticket.stock <= 0" class="bg-red-50 text-red-600 font-bold px-4 py-2 rounded-lg text-sm border border-red-100">
                                                Habis
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </template>
                        </div>
                    </div>
                </div>

                <!-- Right Column (Sticky Box) -->
                <div class="lg:col-span-4 relative">
                    <div class="sticky top-24 bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        
                        <!-- Default View (No tickets) -->
                        <div x-show="totalQuantity === 0">
                            <div class="flex justify-between items-center mb-5">
                                <span class="text-sm font-semibold text-gray-500">Harga mulai dari</span>
                                <span class="text-lg font-black text-gray-900">Rp{{ number_format($event->tickets->min('price') ?? 0, 0, ',', '.') }}</span>
                            </div>
                            <button disabled class="w-full bg-[#9DA4F2] text-white py-3.5 rounded-xl font-bold text-base cursor-not-allowed transition-all">
                                Beli Sekarang
                            </button>
                        </div>

                        <!-- Active View (Tickets Selected) -->
                        <div x-show="totalQuantity > 0" style="display: none;">
                            <h3 class="font-bold text-gray-900 mb-4 pb-3 border-b border-gray-100">Detail Pesanan</h3>
                            
                            <div class="space-y-3 mb-5 max-h-[30vh] overflow-y-auto pr-2">
                                <template x-for="ticket in tickets.filter(t => t.quantity > 0)" :key="'sum-'+ticket.id">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <div class="font-bold text-sm text-gray-900" x-text="ticket.type"></div>
                                            <div class="text-xs font-semibold text-gray-500 mt-0.5"><span x-text="ticket.quantity"></span>x <span x-text="formatRupiah(ticket.price)"></span></div>
                                        </div>
                                        <div class="font-bold text-sm text-gray-900" x-text="formatRupiah(ticket.price * ticket.quantity)"></div>
                                    </div>
                                </template>
                            </div>

                            <div class="border-t border-gray-100 pt-4 mb-6">
                                <div class="flex justify-between items-center">
                                    <span class="font-bold text-gray-500 text-sm">Total Pembayaran</span>
                                    <span class="text-xl font-black text-[#4F46E5]" x-text="formatRupiah(totalPrice)"></span>
                                </div>
                            </div>

                            <button @click="alert('Proses ke halaman Detail Pesanan')" class="w-full bg-[#4F46E5] hover:bg-[#4338CA] text-white py-3.5 rounded-xl font-bold text-base transition-all shadow-md shadow-indigo-500/20 active:scale-95 flex justify-center items-center gap-2">
                                Beli Sekarang
                            </button>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Alpine.js logic -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('checkoutProcess', (initialTickets) => ({
                tickets: initialTickets,
                
                get totalQuantity() {
                    return this.tickets.reduce((sum, ticket) => sum + ticket.quantity, 0);
                },

                get totalPrice() {
                    return this.tickets.reduce((sum, ticket) => sum + (ticket.price * ticket.quantity), 0);
                },

                increment(index) {
                    let ticket = this.tickets[index];
                    if (ticket.quantity < Math.min(ticket.max, ticket.stock)) {
                        ticket.quantity++;
                    }
                },

                decrement(index) {
                    let ticket = this.tickets[index];
                    if (ticket.quantity > 0) {
                        ticket.quantity--;
                    }
                },

                formatRupiah(number) {
                    return new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR',
                        minimumFractionDigits: 0,
                        maximumFractionDigits: 0
                    }).format(number);
                }
            }));
        });
    </script>
</body>
</html>
