<x-app-layout>
    <x-slot name="header">
        <span class="text-deep-navy font-bold">Profil Akun</span>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white shadow-sm rounded-2xl border border-gray-100 overflow-hidden">
                <div class="max-w-4xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
