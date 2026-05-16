<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Detail Pesanan - {{ $event->name }}</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900|montserrat:400,500,600,700,800,900" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-[#F4F7FB]">
    
    <!-- Navbar -->
    <nav class="bg-white border-b border-gray-100 py-4 px-6 md:px-12 flex justify-between items-center sticky top-0 z-50">
        <a href="{{ url('/') }}" class="flex items-center gap-2 hover:opacity-80 transition-opacity">
            <img src="{{ asset('eventic.svg') }}" alt="Eventic Logo" class="h-8 w-auto">
            <span class="font-extrabold text-xl text-[#0F172A] tracking-tight" style="font-family: 'Montserrat', sans-serif;">Eventic</span>
        </a>
    </nav>

    <!-- Stepper -->
    <div class="py-6 border-b border-gray-100 bg-white">
        <div class="max-w-5xl mx-auto px-4 flex items-center justify-center gap-3 md:gap-5 text-[13px] md:text-sm font-semibold">
            <!-- Step 1 -->
            <a href="{{ route('user.checkout.index', $event) }}" class="flex items-center gap-2 text-[#4F46E5] hover:opacity-80">
                <span class="w-6 h-6 rounded-full bg-[#4F46E5] text-white flex items-center justify-center text-xs">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                </span>
                <span>Pilih Kategori</span>
            </a>
            <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            
            <!-- Step 2 (Active) -->
            <div class="flex items-center gap-2 text-[#4F46E5]">
                <span class="w-6 h-6 rounded-full border-2 border-[#4F46E5] flex items-center justify-center text-xs">2</span>
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
    <div class="py-10">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <form action="{{ route('user.checkout.process_details', $event) }}" method="POST" id="checkoutDetailsForm">
                @csrf
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                
                <!-- Left Column -->
                <div class="lg:col-span-8 space-y-6">
                    
                    @if ($errors->any())
                        <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-6 rounded-r-xl">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-bold text-red-800">Terdapat kesalahan pada data Anda:</h3>
                                    <ul class="mt-1 text-sm text-red-700 list-disc list-inside">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    
                    <!-- Event Info Header -->
                    <div class="mb-8">
                        <h1 class="text-2xl font-black text-gray-900 mb-2 uppercase">{{ $event->name }}</h1>
                        <div class="text-gray-500 font-medium text-sm space-y-1">
                            <p>{{ $event->date->format('d F Y') }} • {{ $event->date->format('H:i') }} - Selesai</p>
                            <p>{{ $event->location }}</p>
                        </div>
                    </div>


                        
                        <div class="space-y-6">
                            <!-- Data Pemesan (Satu Kali) -->
                            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                                <h3 class="text-[17px] font-bold text-[#2D336B] mb-6 flex items-center gap-2 border-b border-gray-100 pb-4">
                                    <svg class="w-5 h-5 text-[#4F46E5]" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                                    Data Pemesan
                                </h3>

                                <div class="space-y-5">
                                    <!-- Nama Lengkap Pemesan -->
                                    <div>
                                        <label class="block text-sm font-bold text-gray-800 mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                                        <input type="text" name="orderer[name]" required placeholder="Masukkan nama lengkap Anda" value="{{ auth()->check() ? auth()->user()->name : '' }}" class="w-full rounded-lg border-gray-200 focus:border-[#4F46E5] focus:ring focus:ring-[#4F46E5] focus:ring-opacity-20 shadow-sm transition-colors px-4 py-3 text-sm">
                                    </div>

                                    <!-- Email Pemesan -->
                                    <div>
                                        <label class="block text-sm font-bold text-gray-800 mb-2">Email <span class="text-red-500">*</span></label>
                                        <input type="email" name="orderer[email]" required placeholder="Masukkan email Anda" value="{{ auth()->check() ? auth()->user()->email : '' }}" class="w-full rounded-lg border-gray-200 focus:border-[#4F46E5] focus:ring focus:ring-[#4F46E5] focus:ring-opacity-20 shadow-sm transition-colors px-4 py-3 text-sm">
                                    </div>

                                    <!-- No WhatsApp Pemesan -->
                                    <div>
                                        <label class="block text-sm font-bold text-gray-800 mb-2">No. WhatsApp <span class="text-red-500">*</span></label>
                                        <div class="flex items-stretch border border-gray-200 rounded-lg shadow-sm focus-within:border-[#4F46E5] focus-within:ring-1 focus-within:ring-[#4F46E5] transition-colors overflow-hidden">
                                            <div class="flex items-center gap-2 px-3 bg-gray-50 border-r border-gray-200">
                                                <svg class="w-5 h-3.5 border border-gray-300 rounded-sm" viewBox="0 0 3 2" preserveAspectRatio="none">
                                                    <rect width="3" height="1" fill="#ce1126"/>
                                                    <rect width="3" height="1" y="1" fill="#ffffff"/>
                                                </svg>
                                                <span class="text-sm font-semibold text-gray-700">+62</span>
                                            </div>
                                    <input type="tel" name="orderer[whatsapp]" required placeholder="81234567890" class="flex-1 border-0 focus:ring-0 px-4 py-3 text-sm text-gray-900 w-full min-w-0">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Detail Tiket (Looping) -->
                            @php $ticketCounter = 1; @endphp
                            @foreach($selectedTickets as $selection)
                                @php
                                    $ticketData = $tickets->firstWhere('id', $selection['id']);
                                    $qty = $selection['quantity'];
                                @endphp
                                
                                @for($i = 0; $i < $qty; $i++)
                                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                                        <h3 class="text-[17px] font-bold text-[#2D336B] mb-6 flex items-center justify-between border-b border-gray-100 pb-4">
                                            <div class="flex items-center gap-2">
                                                <svg class="w-5 h-5 text-[#4F46E5]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                                                Detail Tiket {{ $ticketCounter }}
                                            </div>
                                            <span class="text-xs font-bold bg-indigo-50 text-indigo-600 px-3 py-1 rounded-full uppercase tracking-wide border border-indigo-100">{{ $ticketData->type }}</span>
                                        </h3>

                                        <div class="space-y-5">
                                            <input type="hidden" name="tickets[{{$ticketCounter}}][ticket_id]" value="{{ $ticketData->id }}">
                                            
                                            <!-- Nama Lengkap Tiket -->
                                            <div>
                                                <label class="block text-sm font-bold text-gray-800 mb-2">Nama Lengkap Pemegang Tiket <span class="text-red-500">*</span></label>
                                                <input type="text" name="tickets[{{$ticketCounter}}][name]" required placeholder="Masukkan nama sesuai identitas" class="w-full rounded-lg border-gray-200 focus:border-[#4F46E5] focus:ring focus:ring-[#4F46E5] focus:ring-opacity-20 shadow-sm transition-colors px-4 py-3 text-sm">
                                            </div>

                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                                <!-- Tipe Identitas -->
                                                <div>
                                                    <label class="block text-sm font-bold text-gray-800 mb-2">Tipe Identitas <span class="text-red-500">*</span></label>
                                                    <select name="tickets[{{$ticketCounter}}][identity_type]" required class="w-full rounded-lg border-gray-200 focus:border-[#4F46E5] focus:ring focus:ring-[#4F46E5] focus:ring-opacity-20 shadow-sm transition-colors px-4 py-3 text-sm text-gray-600">
                                                        <option value="">Pilih tipe identitas</option>
                                                        <option value="KTP">KTP</option>
                                                        <option value="KIA">KIA</option>
                                                        <option value="KTM">Kartu Pelajar / Mahasiswa</option>
                                                    </select>
                                                </div>

                                                <!-- Nomor Identitas -->
                                                <div>
                                                    <label class="block text-sm font-bold text-gray-800 mb-2">Nomor Identitas <span class="text-red-500">*</span></label>
                                                    <input type="text" name="tickets[{{$ticketCounter}}][identity_number]" required placeholder="Masukkan nomor identitas" class="w-full rounded-lg border-gray-200 focus:border-[#4F46E5] focus:ring focus:ring-[#4F46E5] focus:ring-opacity-20 shadow-sm transition-colors px-4 py-3 text-sm">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @php $ticketCounter++; @endphp
                                @endfor
                            @endforeach
                        </div>

                </div>

                <!-- Right Column (Sticky Box) -->
                <div class="lg:col-span-4 relative">
                    
                    <!-- Timer Box -->
                    <div class="bg-[#FFC107] rounded-xl mb-4 p-4 text-center font-bold text-gray-900 shadow-sm flex items-center justify-center gap-3"
                         x-data="{ 
                            time: 30, 
                            format() {
                                let m = Math.floor(this.time / 60);
                                let s = this.time % 60;
                                return (m < 10 ? '0' : '') + m + ':' + (s < 10 ? '0' : '') + s;
                            },
                            init() {
                                setInterval(() => { if(this.time > 0) this.time-- }, 1000);
                            }
                         }">
                        <span class="text-xl" x-text="format()">10:00</span>
                        <div class="w-px h-5 bg-black/20"></div>
                        <span>Batas Waktu Tersisa</span>
                    </div>

                    <div class="sticky top-24 bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        
                        <h3 class="text-[15px] font-bold text-gray-800 mb-5 pb-3 border-b border-gray-100 flex items-center gap-2">
                            <svg class="w-5 h-5 text-[#4F46E5]" fill="currentColor" viewBox="0 0 24 24"><path d="M19 6h-2c0-2.76-2.24-5-5-5S7 3.24 7 6H5c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2zm-7-3c1.66 0 3 1.34 3 3H9c0-1.66 1.34-3 3-3zm7 17H5V8h14v12zm-7-8c-1.66 0-3-1.34-3-3H7c0 2.76 2.24 5 5 5s5-2.24 5-5h-2c0 1.66-1.34 3-3 3z"/></svg>
                            Rincian Pesanan
                        </h3>
                        
                        @php
                            $totalPrice = 0;
                        @endphp
                        <div class="space-y-4 mb-5 max-h-[40vh] overflow-y-auto pr-2">
                            @foreach($selectedTickets as $selection)
                                @php
                                    $ticketData = $tickets->firstWhere('id', $selection['id']);
                                    $subtotal = $ticketData->price * $selection['quantity'];
                                    $totalPrice += $subtotal;
                                @endphp
                                <div class="flex justify-between items-start text-[13px] mb-3">
                                    <div class="pr-4">
                                        <div class="font-bold text-gray-800 uppercase leading-snug">{{ $ticketData->type }}</div>
                                        <div class="text-xs font-semibold text-gray-400 mt-1">x{{ $selection['quantity'] }}</div>
                                    </div>
                                    <div class="font-semibold text-gray-800 shrink-0">Rp{{ number_format($subtotal, 0, ',', '.') }}</div>
                                </div>
                            @endforeach
                        </div>

                        <div class="border-t border-gray-100 pt-4 mb-6 space-y-3">
                            <div class="flex justify-between items-center text-[13px]">
                                <span class="font-semibold text-gray-500">Subtotal</span>
                                <span class="font-semibold text-gray-800">Rp{{ number_format($totalPrice, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="font-bold text-gray-800 text-[14px]">Total Bayar</span>
                                <span class="text-lg font-bold text-gray-800">Rp{{ number_format($totalPrice, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-3">
                            <a href="{{ route('user.checkout.index', $event) }}" class="w-full sm:w-12 h-12 flex items-center justify-center rounded-xl border border-gray-300 text-gray-600 hover:bg-gray-50 transition-colors shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                                <span class="sm:hidden ml-2 font-bold text-sm">Kembali</span>
                            </a>
                            <button type="submit" form="checkoutDetailsForm" class="w-full sm:flex-1 bg-[#4F46E5] hover:bg-[#4338CA] text-white h-12 rounded-xl font-bold text-base transition-all shadow-md shadow-indigo-500/20 active:scale-95 flex justify-center items-center">
                                Lanjutkan
                            </button>
                        </div>

                    </div>
                </div>

            </div>
            </form>
        </div>
    </div>

</body>
</html>
