<x-guest-layout>
    <div class="flex h-screen overflow-hidden">
        <!-- Left Side: Form -->
        <div class="w-full lg:w-1/2 flex flex-col p-6 lg:p-12 bg-white overflow-y-auto">
            <div class="mb-8">
                <a href="/" class="flex items-center gap-2">
                    <x-application-logo class="w-8 h-8 text-electric-blue" />
                    <span class="text-xl font-bold text-deep-navy tracking-tight">Eventic</span>
                </a>
            </div>

            <div class="flex-grow flex flex-col justify-center max-w-sm mx-auto w-full">
                <h1 class="text-3xl font-bold text-deep-navy mb-1">Selamat Datang Kembali</h1>
                <p class="text-gray-500 mb-6 text-base">Masukkan detail Anda untuk mengakses akun.</p>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" class="text-deep-navy font-semibold mb-1.5 text-sm" />
                        <x-text-input id="email" class="block w-full px-4 py-2.5 border-gray-200 text-sm" type="email" name="email" :value="old('email')" placeholder="name@company.com" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs" />
                    </div>

                    <!-- Password -->
                    <div>
                        <x-input-label for="password" :value="__('Kata Sandi')" class="text-deep-navy font-semibold mb-1.5 text-sm" />
                        <x-text-input id="password" class="block w-full px-4 py-2.5 border-gray-200 text-sm"
                                        type="password"
                                        name="password"
                                        placeholder="••••••••"
                                        required autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs" />
                    </div>

                    <div class="flex items-center mt-2">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-electric-blue shadow-sm focus:ring-electric-blue w-4 h-4" name="remember">
                            <span class="ms-2 text-xs text-gray-600">{{ __('Ingat Saya') }}</span>
                        </label>
                    </div>

                    <div class="pt-2">
                        <x-primary-button class="w-full text-base py-3">
                            {{ __('Masuk') }}
                        </x-primary-button>
                    </div>
                </form>

                <div class="mt-8 text-center text-sm">
                    <p class="text-gray-600">
                        Belum Punya Akun? 
                        <a href="{{ route('register') }}" class="text-electric-blue font-bold hover:underline ml-1">Daftar Sekarang.</a>
                    </p>
                </div>
            </div>

            <div class="mt-auto pt-6 border-t border-gray-100 flex justify-between text-[10px] uppercase tracking-widest text-gray-400 font-medium">
                <p>© {{ date('Y') }} Eventic</p>
                <div class="flex gap-4">
                    <a href="#" class="hover:text-gray-600">Kebijakan Privasi</a>
                </div>
            </div>
        </div>

        <!-- Right Side: Decorative -->
        <div class="hidden lg:flex lg:w-1/2 bg-electric-blue p-12 items-center justify-center relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-600 to-electric-blue opacity-90"></div>
            
            <div class="relative z-10 text-white max-w-md text-center">
                <h2 class="text-4xl font-bold leading-tight mb-4">Kelola event Anda dengan mudah.</h2>
                <p class="text-lg text-blue-100 leading-relaxed mb-8">
                    Akses dashboard terpadu dan kelola proyek Anda dengan lancar.
                </p>
                
                <!-- More compact decorative element -->
                <div class="p-6 bg-white/10 backdrop-blur-md rounded-2xl border border-white/20 shadow-xl scale-90">
                    <div class="flex flex-col gap-3">
                        <div class="h-3 w-3/4 bg-white/20 rounded-full"></div>
                        <div class="h-3 w-1/2 bg-white/20 rounded-full"></div>
                        <div class="grid grid-cols-3 gap-3 mt-2">
                            <div class="h-16 bg-white/20 rounded-xl"></div>
                            <div class="h-16 bg-white/20 rounded-xl"></div>
                            <div class="h-16 bg-white/20 rounded-xl"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
