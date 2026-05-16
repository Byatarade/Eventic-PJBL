<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pilih Metode Pembayaran - {{ $event->name }}</title>
    
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
                <span class="hidden sm:inline">Pilih Kategori</span>
            </a>
            <svg class="w-4 h-4 text-[#4F46E5]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            
            <!-- Step 2 -->
            <a href="{{ route('user.checkout.details', $event) }}" class="flex items-center gap-2 text-[#4F46E5] hover:opacity-80">
                <span class="w-6 h-6 rounded-full bg-[#4F46E5] text-white flex items-center justify-center text-xs">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                </span>
                <span class="hidden sm:inline">Detail Pesanan</span>
            </a>
            <svg class="w-4 h-4 text-gray-300 hidden sm:block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            
            <!-- Step 3 (Active) -->
            <div class="flex items-center gap-2 text-[#4F46E5]">
                <span class="w-6 h-6 rounded-full border-2 border-[#4F46E5] flex items-center justify-center text-xs">3</span>
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
    <div class="py-10" x-data="{ selectedMethod: '' }">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                
                <!-- Left Column -->
                <div class="lg:col-span-8 space-y-6">
                    <div class="mb-8">
                        <h1 class="text-2xl font-black text-gray-900 mb-2 uppercase">Pilih Metode Pembayaran</h1>
                        <p class="text-gray-500 font-medium text-sm">Silakan pilih metode pembayaran yang Anda inginkan untuk menyelesaikan pesanan.</p>
                    </div>

                    <form action="{{ route('user.checkout.process_payment', $event) }}" method="POST" id="checkoutPaymentForm">
                        @csrf
                        <input type="hidden" name="payment_method" x-model="selectedMethod">

                        <!-- E-Wallet Section -->
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 mb-6">
                            <h3 class="text-[17px] font-bold text-[#2D336B] mb-6 flex items-center gap-2 border-b border-gray-100 pb-4">
                                <svg class="w-5 h-5 text-[#4F46E5]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                E-Wallet
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- GoPay -->
                                <label class="relative flex items-center p-4 border rounded-xl cursor-pointer transition-all hover:bg-gray-50"
                                       :class="selectedMethod === 'gopay' ? 'border-[#4F46E5] ring-1 ring-[#4F46E5] bg-indigo-50/30' : 'border-gray-200'">
                                    <input type="radio" name="method" value="gopay" class="sr-only" @click="selectedMethod = 'gopay'">
                                    <div class="flex-1 flex items-center gap-4">
                                        <div class="w-16 h-10 bg-white rounded flex items-center justify-center p-1 border border-gray-100">
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/8/86/Gopay_logo.svg" alt="GoPay" class="max-h-full max-w-full object-contain">
                                        </div>
                                        <span class="font-bold text-gray-800">GoPay</span>
                                    </div>
                                    <div class="w-5 h-5 rounded-full border flex items-center justify-center"
                                         :class="selectedMethod === 'gopay' ? 'border-[#4F46E5] bg-[#4F46E5]' : 'border-gray-300'">
                                        <svg x-show="selectedMethod === 'gopay'" class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                    </div>
                                </label>

                                <!-- OVO -->
                                <label class="relative flex items-center p-4 border rounded-xl cursor-pointer transition-all hover:bg-gray-50"
                                       :class="selectedMethod === 'ovo' ? 'border-[#4F46E5] ring-1 ring-[#4F46E5] bg-indigo-50/30' : 'border-gray-200'">
                                    <input type="radio" name="method" value="ovo" class="sr-only" @click="selectedMethod = 'ovo'">
                                    <div class="flex-1 flex items-center gap-4">
                                        <div class="w-16 h-10 bg-white rounded flex items-center justify-center p-1 border border-gray-100">
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/e/eb/Logo_ovo_purple.svg" alt="OVO" class="max-h-full max-w-full object-contain">
                                        </div>
                                        <span class="font-bold text-gray-800">OVO</span>
                                    </div>
                                    <div class="w-5 h-5 rounded-full border flex items-center justify-center"
                                         :class="selectedMethod === 'ovo' ? 'border-[#4F46E5] bg-[#4F46E5]' : 'border-gray-300'">
                                        <svg x-show="selectedMethod === 'ovo'" class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                    </div>
                                </label>
                                
                                <!-- Dana -->
                                <label class="relative flex items-center p-4 border rounded-xl cursor-pointer transition-all hover:bg-gray-50"
                                       :class="selectedMethod === 'dana' ? 'border-[#4F46E5] ring-1 ring-[#4F46E5] bg-indigo-50/30' : 'border-gray-200'">
                                    <input type="radio" name="method" value="dana" class="sr-only" @click="selectedMethod = 'dana'">
                                    <div class="flex-1 flex items-center gap-4">
                                        <div class="w-16 h-10 bg-white rounded flex items-center justify-center p-1 border border-gray-100">
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/7/72/Logo_dana_blue.svg" alt="DANA" class="max-h-full max-w-full object-contain">
                                        </div>
                                        <span class="font-bold text-gray-800">DANA</span>
                                    </div>
                                    <div class="w-5 h-5 rounded-full border flex items-center justify-center"
                                         :class="selectedMethod === 'dana' ? 'border-[#4F46E5] bg-[#4F46E5]' : 'border-gray-300'">
                                        <svg x-show="selectedMethod === 'dana'" class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                    </div>
                                </label>
                                
                                <!-- ShopeePay -->
                                <label class="relative flex items-center p-4 border rounded-xl cursor-pointer transition-all hover:bg-gray-50"
                                       :class="selectedMethod === 'shopeepay' ? 'border-[#4F46E5] ring-1 ring-[#4F46E5] bg-indigo-50/30' : 'border-gray-200'">
                                    <input type="radio" name="method" value="shopeepay" class="sr-only" @click="selectedMethod = 'shopeepay'">
                                    <div class="flex-1 flex items-center gap-4">
                                        <div class="w-16 h-10 bg-white rounded flex items-center justify-center p-1 border border-gray-100">
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/fe/Shopee_Pay_logo.svg/512px-Shopee_Pay_logo.svg.png" alt="ShopeePay" class="max-h-full max-w-full object-contain">
                                        </div>
                                        <span class="font-bold text-gray-800">ShopeePay</span>
                                    </div>
                                    <div class="w-5 h-5 rounded-full border flex items-center justify-center"
                                         :class="selectedMethod === 'shopeepay' ? 'border-[#4F46E5] bg-[#4F46E5]' : 'border-gray-300'">
                                        <svg x-show="selectedMethod === 'shopeepay'" class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Virtual Account Section -->
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                            <h3 class="text-[17px] font-bold text-[#2D336B] mb-6 flex items-center gap-2 border-b border-gray-100 pb-4">
                                <svg class="w-5 h-5 text-[#4F46E5]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                                Virtual Account (Transfer Bank)
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- BCA VA -->
                                <label class="relative flex items-center p-4 border rounded-xl cursor-pointer transition-all hover:bg-gray-50"
                                       :class="selectedMethod === 'bca_va' ? 'border-[#4F46E5] ring-1 ring-[#4F46E5] bg-indigo-50/30' : 'border-gray-200'">
                                    <input type="radio" name="method" value="bca_va" class="sr-only" @click="selectedMethod = 'bca_va'">
                                    <div class="flex-1 flex items-center gap-4">
                                        <div class="w-16 h-10 bg-white rounded flex items-center justify-center p-1 border border-gray-100">
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/5/5c/Bank_Central_Asia.svg" alt="BCA" class="max-h-full max-w-full object-contain">
                                        </div>
                                        <span class="font-bold text-gray-800">BCA Virtual Account</span>
                                    </div>
                                    <div class="w-5 h-5 rounded-full border flex items-center justify-center"
                                         :class="selectedMethod === 'bca_va' ? 'border-[#4F46E5] bg-[#4F46E5]' : 'border-gray-300'">
                                        <svg x-show="selectedMethod === 'bca_va'" class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                    </div>
                                </label>

                                <!-- Mandiri VA -->
                                <label class="relative flex items-center p-4 border rounded-xl cursor-pointer transition-all hover:bg-gray-50"
                                       :class="selectedMethod === 'mandiri_va' ? 'border-[#4F46E5] ring-1 ring-[#4F46E5] bg-indigo-50/30' : 'border-gray-200'">
                                    <input type="radio" name="method" value="mandiri_va" class="sr-only" @click="selectedMethod = 'mandiri_va'">
                                    <div class="flex-1 flex items-center gap-4">
                                        <div class="w-16 h-10 bg-white rounded flex items-center justify-center p-1 border border-gray-100">
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a8/Bank_Mandiri_logo_2016.svg/1024px-Bank_Mandiri_logo_2016.svg.png" alt="Mandiri" class="max-h-full max-w-full object-contain">
                                        </div>
                                        <span class="font-bold text-gray-800">Mandiri Virtual Account</span>
                                    </div>
                                    <div class="w-5 h-5 rounded-full border flex items-center justify-center"
                                         :class="selectedMethod === 'mandiri_va' ? 'border-[#4F46E5] bg-[#4F46E5]' : 'border-gray-300'">
                                        <svg x-show="selectedMethod === 'mandiri_va'" class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                    </div>
                                </label>

                                <!-- BNI VA -->
                                <label class="relative flex items-center p-4 border rounded-xl cursor-pointer transition-all hover:bg-gray-50"
                                       :class="selectedMethod === 'bni_va' ? 'border-[#4F46E5] ring-1 ring-[#4F46E5] bg-indigo-50/30' : 'border-gray-200'">
                                    <input type="radio" name="method" value="bni_va" class="sr-only" @click="selectedMethod = 'bni_va'">
                                    <div class="flex-1 flex items-center gap-4">
                                        <div class="w-16 h-10 bg-white rounded flex items-center justify-center p-1 border border-gray-100">
                                            <img src="https://upload.wikimedia.org/wikipedia/id/thumb/5/55/BNI_logo.svg/1024px-BNI_logo.svg.png" alt="BNI" class="max-h-full max-w-full object-contain">
                                        </div>
                                        <span class="font-bold text-gray-800">BNI Virtual Account</span>
                                    </div>
                                    <div class="w-5 h-5 rounded-full border flex items-center justify-center"
                                         :class="selectedMethod === 'bni_va' ? 'border-[#4F46E5] bg-[#4F46E5]' : 'border-gray-300'">
                                        <svg x-show="selectedMethod === 'bni_va'" class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                    </div>
                                </label>

                                <!-- BRI VA -->
                                <label class="relative flex items-center p-4 border rounded-xl cursor-pointer transition-all hover:bg-gray-50"
                                       :class="selectedMethod === 'bri_va' ? 'border-[#4F46E5] ring-1 ring-[#4F46E5] bg-indigo-50/30' : 'border-gray-200'">
                                    <input type="radio" name="method" value="bri_va" class="sr-only" @click="selectedMethod = 'bri_va'">
                                    <div class="flex-1 flex items-center gap-4">
                                        <div class="w-16 h-10 bg-white rounded flex items-center justify-center p-1 border border-gray-100">
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/2/2e/BRI_2020.svg" alt="BRI" class="max-h-full max-w-full object-contain">
                                        </div>
                                        <span class="font-bold text-gray-800">BRI Virtual Account</span>
                                    </div>
                                    <div class="w-5 h-5 rounded-full border flex items-center justify-center"
                                         :class="selectedMethod === 'bri_va' ? 'border-[#4F46E5] bg-[#4F46E5]' : 'border-gray-300'">
                                        <svg x-show="selectedMethod === 'bri_va'" class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Right Column (Sticky Box) -->
                <div class="lg:col-span-4 relative">
                    
                    <!-- Timer Box -->
                    <div class="bg-[#FFC107] rounded-xl mb-4 p-4 text-center font-bold text-gray-900 shadow-sm flex items-center justify-center gap-3"
                         x-data="{ 
                            time: 86400, 
                            format() {
                                let h = Math.floor(this.time / 3600);
                                let m = Math.floor((this.time % 3600) / 60);
                                let s = this.time % 60;
                                return (h < 10 ? '0' : '') + h + ':' + (m < 10 ? '0' : '') + m + ':' + (s < 10 ? '0' : '') + s;
                            },
                            init() {
                                let timer = setInterval(() => { 
                                    if(this.time > 0) {
                                        this.time--;
                                    } else {
                                        clearInterval(timer);
                                        alert('Waktu pembayaran telah habis. Silakan pilih tiket kembali.');
                                        window.location.href = '{{ url("/") }}';
                                    }
                                }, 1000);
                            }
                         }">
                        <span class="text-xl" x-text="format()">24:00:00</span>
                        <div class="w-px h-5 bg-black/20"></div>
                        <span>Batas Waktu Tersisa</span>
                    </div>

                    <div class="sticky top-24 bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        
                        <h3 class="text-[15px] font-bold text-gray-800 mb-5 pb-3 border-b border-gray-100 flex items-center gap-2">
                            <svg class="w-5 h-5 text-[#4F46E5]" fill="currentColor" viewBox="0 0 24 24"><path d="M19 6h-2c0-2.76-2.24-5-5-5S7 3.24 7 6H5c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2zm-7-3c1.66 0 3 1.34 3 3H9c0-1.66 1.34-3 3-3zm7 17H5V8h14v12zm-7-8c-1.66 0-3-1.34-3-3H7c0 2.76 2.24 5 5 5s5-2.24 5-5h-2c0 1.66-1.34 3-3 3z"/></svg>
                            Rincian Pembayaran
                        </h3>
                        
                        @php
                            $totalPrice = 0;
                            $totalQty = 0;
                        @endphp
                        <div class="space-y-4 mb-5 max-h-[30vh] overflow-y-auto pr-2">
                            @foreach($selectedTickets as $selection)
                                @php
                                    $ticketData = $tickets->firstWhere('id', $selection['id']);
                                    $subtotal = $ticketData->price * $selection['quantity'];
                                    $totalPrice += $subtotal;
                                    $totalQty += $selection['quantity'];
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
                                <span class="font-semibold text-gray-500">Total Tiket</span>
                                <span class="font-semibold text-gray-800">{{ $totalQty }} Tiket</span>
                            </div>
                            <div class="flex justify-between items-center text-[13px]">
                                <span class="font-semibold text-gray-500">Biaya Layanan</span>
                                <span class="font-semibold text-green-600">Gratis</span>
                            </div>
                            <div class="flex justify-between items-center pt-2 border-t border-gray-100">
                                <span class="font-bold text-gray-800 text-[14px]">Total Bayar</span>
                                <span class="text-xl font-black text-[#4F46E5]">Rp{{ number_format($totalPrice, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <!-- Error Message if empty -->
                        <div x-show="selectedMethod === ''" class="mb-4 text-xs font-semibold text-amber-600 bg-amber-50 p-3 rounded-lg border border-amber-100 flex items-center gap-2">
                            <svg class="w-4 h-4 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                            Pilih metode pembayaran terlebih dahulu
                        </div>

                        <div class="flex flex-col sm:flex-row gap-3">
                            <a href="{{ route('user.checkout.details', $event) }}" class="w-full sm:w-12 h-12 flex items-center justify-center rounded-xl border border-gray-300 text-gray-600 hover:bg-gray-50 transition-colors shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                                <span class="sm:hidden ml-2 font-bold text-sm">Kembali</span>
                            </a>
                            <button type="button" 
                                    :disabled="selectedMethod === ''"
                                    :class="selectedMethod === '' ? 'opacity-50 cursor-not-allowed bg-gray-400' : 'bg-[#4F46E5] hover:bg-[#4338CA] shadow-md shadow-indigo-500/20 active:scale-95'"
                                    onclick="if(document.getElementById('checkoutPaymentForm').elements['payment_method'].value !== '') document.getElementById('checkoutPaymentForm').submit()" 
                                    class="w-full sm:flex-1 h-12 text-white rounded-xl font-bold text-base transition-all flex justify-center items-center">
                                Bayar Sekarang
                            </button>
                        </div>

                        <p class="text-center text-[11px] font-medium text-gray-400 mt-4 flex items-center justify-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path></svg>
                            Pembayaran Aman & Terenkripsi
                        </p>

                    </div>
                </div>

            </div>
        </div>
    </div>

</body>
</html>
