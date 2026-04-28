<section>
    <div class="mb-4">
        <h2 class="text-xl font-bold text-gray-900">
            {{ __('Informasi Profil') }}
        </h2>
    </div>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6" enctype="multipart/form-data" x-data="{ avatarPreview: '{{ $user->avatar ? asset('storage/' . $user->avatar) : '' }}', deleteAvatar: false }">
        @csrf
        @method('patch')

        <input type="hidden" name="delete_avatar" :value="deleteAvatar ? '1' : '0'">

        <!-- Gambar Profil -->
        <div class="grid grid-cols-1 md:grid-cols-4 items-center gap-4">
            <x-input-label class="text-sm font-bold text-slate-900" for="avatar" :value="__('Foto Profil')" />
            <div class="md:col-span-3 flex items-center gap-4">
                <div class="relative group">
                    <div class="w-14 h-14 rounded-xl bg-slate-100 flex items-center justify-center text-slate-400 overflow-hidden shadow-inner border-2 border-white ring-1 ring-gray-200 transition-all duration-300">
                        <template x-if="avatarPreview">
                            <img :src="avatarPreview" alt="Avatar" class="w-full h-full object-cover">
                        </template>
                        <template x-if="!avatarPreview">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </template>
                    </div>
                </div>
                
                <input type="file" id="avatar" name="avatar" class="hidden" accept="image/*" @change="const file = $event.target.files[0]; if (file) { deleteAvatar = false; const reader = new FileReader(); reader.onload = (e) => { avatarPreview = e.target.result; }; reader.readAsDataURL(file); }">
                
                <div class="flex items-center gap-2 bg-gray-100/50 p-1 rounded-xl border border-gray-100">
                    <button type="button" @click="document.getElementById('avatar').click()" class="flex items-center gap-2 px-4 py-2 bg-white text-blue-600 rounded-lg font-bold text-xs shadow-sm hover:shadow-md hover:scale-[1.02] transition-all duration-200 border border-gray-100">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1m-4-8l-4-4m0 0L8 8m4-4v12" /></svg>
                        Upload
                    </button>
                    <button type="button" @click="avatarPreview = ''; document.getElementById('avatar').value = ''; deleteAvatar = true" class="flex items-center gap-2 px-4 py-2 text-red-500 rounded-lg font-bold text-xs hover:bg-red-50 transition-all duration-200">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                        Hapus
                    </button>
                </div>
            </div>
        </div>

        <!-- Nama Lengkap -->
        <div class="grid grid-cols-1 md:grid-cols-4 items-center gap-4 pt-1">
            <x-input-label class="text-sm font-bold text-slate-900" for="name" :value="__('Nama Lengkap')" />
            <div class="md:col-span-3">
                <x-text-input id="name" name="name" type="text" class="block w-full border-gray-200 focus:border-blue-500 focus:ring-blue-500 rounded-xl py-2.5 px-4 shadow-sm bg-gray-50/30 transition-all duration-200 text-sm" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                <x-input-error class="mt-1" :messages="$errors->get('name')" />
            </div>
        </div>

        <!-- Email -->
        <div class="grid grid-cols-1 md:grid-cols-4 items-center gap-4">
            <x-input-label class="text-sm font-bold text-slate-900" for="email" :value="__('Email')" />
            <div class="md:col-span-3">
                <x-text-input id="email" name="email" type="email" class="block w-full border-gray-200 focus:border-blue-500 focus:ring-blue-500 rounded-xl py-2.5 px-4 bg-gray-50/50 shadow-sm transition-all duration-200 text-sm" :value="old('email', $user->email)" required autocomplete="username" />
                <x-input-error class="mt-1" :messages="$errors->get('email')" />
            </div>
        </div>

        <!-- Nomor Telepon -->
        <div class="grid grid-cols-1 md:grid-cols-4 items-center gap-4">
            <x-input-label class="text-sm font-bold text-slate-900" for="phone" :value="__('Nomor Telepon')" />
            <div class="md:col-span-3">
                <x-text-input id="phone" name="phone" type="text" class="block w-full border-gray-200 focus:border-blue-500 focus:ring-blue-500 rounded-xl py-2.5 px-4 shadow-sm bg-gray-50/30 transition-all duration-200 text-sm" :value="old('phone', $user->phone)" placeholder="08123456789" />
                <x-input-error class="mt-1" :messages="$errors->get('phone')" />
            </div>
        </div>

        <!-- Role Akun -->
        <div class="grid grid-cols-1 md:grid-cols-4 items-center gap-4">
            <x-input-label class="text-sm font-bold text-slate-900" :value="__('Role Akun')" />
            <div class="md:col-span-3">
                <div class="inline-flex items-center gap-2 bg-blue-50 px-3 py-1.5 rounded-lg">
                    <div class="w-1.5 h-1.5 rounded-full bg-blue-500 animate-pulse"></div>
                    <span class="text-sm font-bold text-blue-700">
                        {{ $user->role === 'eo' ? 'Event Organizer' : $user->role }}
                    </span>
                </div>
            </div>
        </div>

        <div class="pt-6 border-t border-gray-100 flex justify-end items-center gap-4">
            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-xs text-green-600 font-bold"
                >{{ __('Berhasil disimpan.') }}</p>
            @endif

            <button type="submit" class="px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-bold text-[11px] uppercase tracking-widest transition-all duration-200 shadow-lg shadow-blue-500/25 active:scale-95">
                {{ __('Simpan') }}
            </button>
        </div>
    </form>
</section>
