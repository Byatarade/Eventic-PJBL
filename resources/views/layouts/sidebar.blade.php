<div x-data="{ expanded: false }" 
     @mouseenter="expanded = true" 
     @mouseleave="expanded = false"
     :class="expanded ? 'w-64' : 'w-20'"
     class="hidden lg:flex lg:flex-col bg-electric-blue text-slate-white shadow-xl relative z-20 transition-all duration-300 ease-in-out shrink-0 h-screen">
    
    <!-- Sidebar Header: Logo -->
    <div class="flex items-center gap-3 p-6 border-b border-white/10 h-16 shrink-0 overflow-hidden">
        <div class="bg-white p-1.5 rounded-lg shadow-sm shrink-0">
            <x-application-logo class="w-6 h-6 text-electric-blue" />
        </div>
        <span x-show="expanded" x-transition:enter="transition ease-out duration-200 delay-100" x-transition:enter-start="opacity-0 -translate-x-4" x-transition:enter-end="opacity-100 translate-x-0" class="text-xl font-bold tracking-tight text-white whitespace-nowrap">
            Eventic
        </span>
    </div>

    <!-- Sidebar Navigation -->
    <nav class="flex-grow px-3 space-y-2 mt-6 overflow-hidden">
        <x-sidebar-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            <span x-show="expanded" x-transition:enter="transition ease-out duration-200 delay-100" x-transition:enter-start="opacity-0 -translate-x-4" x-transition:enter-end="opacity-100 translate-x-0" class="ml-3 whitespace-nowrap">{{ __('Dashboard') }}</span>
        </x-sidebar-link>

        <x-sidebar-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
            <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            <span x-show="expanded" x-transition:enter="transition ease-out duration-200 delay-100" x-transition:enter-start="opacity-0 -translate-x-4" x-transition:enter-end="opacity-100 translate-x-0" class="ml-3 whitespace-nowrap">{{ __('Profil') }}</span>
        </x-sidebar-link>
    </nav>

    <!-- Sidebar Footer -->
    <div class="p-4 mt-auto">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full group outline-none">
                <div :class="expanded ? 'px-4 py-4' : 'p-4 justify-center'" 
                     class="flex items-center rounded-2xl bg-white/10 hover:bg-white/20 transition-all duration-200 border border-white/20 shadow-lg">
                    <div class="shrink-0">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                    </div>
                    <span x-show="expanded" 
                          x-transition:enter="transition ease-out duration-200 delay-100" 
                          x-transition:enter-start="opacity-0 -translate-x-4" 
                          x-transition:enter-end="opacity-100 translate-x-0" 
                          class="ml-3 whitespace-nowrap text-base font-bold text-white">
                        {{ __('Keluar') }}
                    </span>
                </div>
            </button>
        </form>
    </div>
</div>
