<x-guest-layout>
    <div class="flex h-screen overflow-hidden">
        <!-- Left Side: Form -->
        <div class="w-full lg:w-1/2 flex flex-col p-4 lg:p-8 bg-white overflow-y-auto">
            <div class="mb-6">
                <a href="/" class="flex items-center gap-3">
                    <x-application-logo class="w-10 h-10" />
                    <span class="text-xl font-bold text-deep-navy tracking-tight">Eventic</span>
                </a>
            </div>

            <div class="flex-grow flex flex-col justify-center max-w-lg mx-auto w-full py-2">
                <h1 class="text-xl font-bold text-deep-navy">Buat Akun</h1>
                <p class="text-gray-500 mb-4 text-[13px]">Bergabunglah dengan kami dan mulai kelola event Anda hari ini.</p>

                <form method="POST" action="{{ route('register') }}" class="space-y-2.5">
                    @csrf

                    <div class="grid grid-cols-2 gap-3">
                        <!-- Full Name -->
                        <div>
                            <x-input-label for="name" :value="__('Nama Lengkap')" class="text-deep-navy font-semibold mb-0.5 text-[11px]" />
                            <x-text-input id="name" class="block w-full px-3 py-1.5 border-gray-200 text-xs" type="text" name="name" :value="old('name')" placeholder="John Doe" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-0.5 text-[10px]" />
                        </div>

                        <!-- Username -->
                        <div>
                            <x-input-label for="username" :value="__('Username')" class="text-deep-navy font-semibold mb-0.5 text-[11px]" />
                            <x-text-input id="username" class="block w-full px-3 py-1.5 border-gray-200 text-xs" type="text" name="username" :value="old('username')" placeholder="johndoe" required />
                            <x-input-error :messages="$errors->get('username')" class="mt-0.5 text-[10px]" />
                        </div>
                    </div>

                    <!-- Email -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" class="text-deep-navy font-semibold mb-0.5 text-[11px]" />
                        <x-text-input id="email" class="block w-full px-3 py-1.5 border-gray-200 text-xs" type="email" name="email" :value="old('email')" placeholder="name@company.com" required />
                        <x-input-error :messages="$errors->get('email')" class="mt-0.5 text-[10px]" />
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <!-- Password -->
                        <div>
                            <x-input-label for="password" :value="__('Kata Sandi')" class="text-deep-navy font-semibold mb-0.5 text-[11px]" />
                            <x-text-input id="password" class="block w-full px-3 py-1.5 border-gray-200 text-xs" type="password" name="password" required autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-0.5 text-[10px]" />
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <x-input-label for="password_confirmation" :value="__('Konfirmasi Kata Sandi')" class="text-deep-navy font-semibold mb-0.5 text-[11px]" />
                            <x-text-input id="password_confirmation" class="block w-full px-3 py-1.5 border-gray-200 text-xs" type="password" name="password_confirmation" required autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-0.5 text-[10px]" />
                        </div>
                    </div>

                    <!-- Nomor Telepon -->
                    <div>
                        <x-input-label for="phone" :value="__('Nomor Telepon')" class="text-deep-navy font-semibold mb-0.5 text-[11px]" />
                        <x-text-input id="phone" class="block w-full px-3 py-1.5 border-gray-200 text-xs" 
                                        type="text" 
                                        name="phone" 
                                        :value="old('phone')" 
                                        placeholder="0812..." 
                                        required 
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '');" />
                        <x-input-error :messages="$errors->get('phone')" class="mt-0.5 text-[10px]" />
                    </div>

                    <!-- Role Selection -->
                    <div>
                        <x-input-label :value="__('Daftar Sebagai')" class="text-deep-navy font-semibold mb-1.5 text-[11px]" />
                        <div class="grid grid-cols-2 gap-3">
                            <label class="relative flex flex-col p-2 border rounded-xl cursor-pointer hover:border-electric-blue transition-colors group">
                                <input type="radio" name="role" value="user" class="absolute opacity-0 peer" {{ old('role', 'user') == 'user' ? 'checked' : '' }}>
                                <div class="peer-checked:border-electric-blue peer-checked:bg-blue-50 absolute inset-0 border-2 border-transparent rounded-xl transition-all"></div>
                                <span class="relative text-xs font-bold text-deep-navy leading-tight">User</span>
                                <span class="relative text-[9px] text-gray-500 leading-tight">Mencari Event</span>
                            </label>
                            <label class="relative flex flex-col p-2 border rounded-xl cursor-pointer hover:border-electric-blue transition-colors group">
                                <input type="radio" name="role" value="eo" class="absolute opacity-0 peer" {{ old('role') == 'eo' ? 'checked' : '' }}>
                                <div class="peer-checked:border-electric-blue peer-checked:bg-blue-50 absolute inset-0 border-2 border-transparent rounded-xl transition-all"></div>
                                <span class="relative text-xs font-bold text-deep-navy leading-tight">EO</span>
                                <span class="relative text-[9px] text-gray-500 leading-tight">Penyelenggara</span>
                            </label>
                        </div>
                        <x-input-error :messages="$errors->get('role')" class="mt-0.5 text-[10px]" />
                    </div>

                    <div class="pt-1.5">
                        <x-primary-button class="w-full py-2 text-xs uppercase tracking-widest">
                            {{ __('Buat Akun') }}
                        </x-primary-button>
                    </div>
                </form>

                <div class="mt-4 text-center text-[11px]">
                    <p class="text-gray-600">
                        Sudah Punya Akun? 
                        <a href="{{ route('login') }}" class="text-electric-blue font-bold hover:underline ml-1">Masuk.</a>
                    </p>
                </div>
            </div>

            <div class="mt-auto pt-3 border-t border-gray-100 flex justify-between text-[9px] uppercase tracking-widest text-gray-400 font-medium">
                <p>© {{ date('Y') }} Eventic</p>
                <div class="flex gap-4">
                    <a href="#" class="hover:text-gray-600">Kebijakan Privasi</a>
                </div>
            </div>
        </div>

        <!-- Right Side: Decorative -->
        <div class="hidden lg:flex lg:w-1/2 bg-electric-blue p-10 items-center justify-center relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-600 to-electric-blue opacity-90"></div>
            
            <div class="relative z-10 text-white max-w-sm text-center">
                <h2 class="text-3xl font-bold leading-tight mb-3">Mulai perjalanan Anda bersama kami.</h2>
                <p class="text-[15px] text-blue-100 leading-relaxed mb-6">
                    Bergabunglah dengan ribuan penyelenggara event dan peserta di platform terpadu kami.
                </p>
                
                <div class="p-5 bg-white/10 backdrop-blur-md rounded-2xl border border-white/20 shadow-xl scale-75">
                    <div class="flex flex-col gap-2 text-left">
                        <div class="h-2 w-3/4 bg-white/20 rounded-full"></div>
                        <div class="h-12 bg-white/20 rounded-xl"></div>
                        <div class="grid grid-cols-2 gap-2">
                            <div class="h-10 bg-white/20 rounded-xl"></div>
                            <div class="h-10 bg-white/20 rounded-xl"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
