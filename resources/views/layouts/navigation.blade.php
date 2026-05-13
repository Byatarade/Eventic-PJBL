<nav x-data="{ open: false }" class="bg-white/80 backdrop-blur-md border-b border-gray-100 h-24 flex items-center shrink-0 sticky top-0 z-40 shadow-sm shadow-blue-500/5">
    <!-- Primary Navigation Menu -->
    <div class="w-full px-6 lg:px-10">
        <div class="flex justify-between items-center">
            <!-- Left Side: Page Title -->
            <div class="flex items-center">
                <div class="lg:hidden mr-4">
                    <!-- Mobile Hamburger -->
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-deep-navy hover:bg-gray-100 transition-colors">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Right Side: User Dropdown -->
            <div class="flex items-center">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-xl text-deep-navy bg-white hover:bg-slate-white transition ease-in-out duration-150">
                            <div class="flex items-center gap-2">
                                @if(Auth::user()->avatar)
                                    <img src="{{ Storage::url(Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}" class="w-8 h-8 rounded-full object-cover">
                                @else
                                    <div class="w-8 h-8 rounded-full bg-electric-blue/10 flex items-center justify-center text-electric-blue font-bold">
                                        {{ substr(Auth::user()->name, 0, 1) }}
                                    </div>
                                @endif
                                <span class="hidden sm:inline">{{ Auth::user()->name }}</span>
                            </div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-2 border-b border-gray-100 mb-1">
                            <p class="text-[10px] uppercase tracking-widest text-gray-400 font-bold">Informasi Akun</p>
                            <p class="text-xs font-medium text-deep-navy truncate">{{ Auth::user()->email }}</p>
                        </div>

                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                 {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation Drawer -->
    <template x-teleport="body">
        <div x-show="open" class="fixed inset-0 z-[100] lg:hidden" style="display: none;">
            <!-- Backdrop -->
            <div x-show="open" 
                 x-transition:enter="transition-opacity ease-linear duration-300" 
                 x-transition:enter-start="opacity-0" 
                 x-transition:enter-end="opacity-100" 
                 x-transition:leave="transition-opacity ease-linear duration-300" 
                 x-transition:leave-start="opacity-100" 
                 x-transition:leave-end="opacity-0" 
                 class="fixed inset-0 bg-deep-navy/80 backdrop-blur-sm" @click="open = false"></div>
            
            <!-- Drawer Panel -->
            <div x-show="open" 
                 x-transition:enter="transition ease-in-out duration-300 transform" 
                 x-transition:enter-start="-translate-x-full" 
                 x-transition:enter-end="translate-x-0" 
                 x-transition:leave="transition ease-in-out duration-300 transform" 
                 x-transition:leave-start="translate-x-0" 
                 x-transition:leave-end="-translate-x-full" 
                 class="fixed inset-y-0 left-0 w-72 bg-electric-blue p-6 flex flex-col shadow-2xl overflow-y-auto">
            <div class="flex items-center justify-between mb-8 shrink-0">
                <div class="flex items-center gap-3">
                    <div class="bg-white p-2 rounded-lg">
                        <x-application-logo class="w-6 h-6 text-electric-blue" />
                    </div>
                    <span class="text-xl font-bold tracking-tight text-white">Eventic</span>
                </div>
                <button @click="open = false" class="text-white/60 hover:text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            
            <nav class="space-y-2 flex-grow">
                @php
                    $dashboardRoute = auth()->user()->role === 'eo' ? route('eo.dashboard') : route('dashboard');
                    $isDashboardActive = auth()->user()->role === 'eo' ? request()->routeIs('eo.dashboard') : request()->routeIs('dashboard');
                @endphp

                @if (auth()->user()->role !== 'eo')
                    <x-sidebar-link :href="$dashboardRoute" :active="$isDashboardActive" @click="open = false">
                        <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        <span class="ml-3">{{ __('Dashboard') }}</span>
                    </x-sidebar-link>

                    <!-- Tiket Saya -->
                    <x-sidebar-link :href="route('user.tickets.index')" :active="request()->routeIs('user.tickets.*')" @click="open = false">
                        <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                        </svg>
                        <span class="ml-3">Tiket Saya</span>
                    </x-sidebar-link>

                    <!-- Transaksi -->
                    <x-sidebar-link :href="route('user.transactions.index')" :active="request()->routeIs('user.transactions.*')" @click="open = false">
                        <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <span class="ml-3">Transaksi</span>
                    </x-sidebar-link>
                @endif

                @if (auth()->user()->role === 'eo')
                    <div class="pt-4 pb-2">
                        <span class="px-3 text-xs font-semibold text-blue-200 uppercase tracking-wider">Manajemen EO</span>
                    </div>

                    <x-sidebar-link :href="$dashboardRoute" :active="$isDashboardActive" @click="open = false">
                        <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        <span class="ml-3">{{ __('Dashboard') }}</span>
                    </x-sidebar-link>

                    <!-- Event Management -->
                    <x-sidebar-link :href="route('eo.events.index')" :active="request()->routeIs('eo.events.*')" @click="open = false">
                        <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span class="ml-3">Kelola Event</span>
                    </x-sidebar-link>

                    <!-- Transaksi -->
                    <x-sidebar-link :href="route('eo.transactions.index')" :active="request()->routeIs('eo.transactions.*')" @click="open = false">
                        <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <span class="ml-3">Transaksi</span>
                    </x-sidebar-link>

                    <!-- Laporan/Analytics -->
                    <x-sidebar-link :href="route('eo.analytics.index')" :active="request()->routeIs('eo.analytics.*')" @click="open = false">
                        <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                        <span class="ml-3">Keuntungan</span>
                    </x-sidebar-link>

                    <!-- Peserta -->
                    <x-sidebar-link :href="route('eo.participants.index')" :active="request()->routeIs('eo.participants.*')" @click="open = false">
                        <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <span class="ml-3">Peserta Event</span>
                    </x-sidebar-link>
                @endif

                <x-sidebar-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')" @click="open = false">
                    <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <span class="ml-3">{{ __('Profil') }}</span>
                </x-sidebar-link>
            </nav>
            
            <div class="mt-4 pt-4 border-t border-white/10 shrink-0">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full group outline-none">
                        <div class="px-4 py-4 flex items-center rounded-2xl bg-white/10 hover:bg-white/20 transition-all duration-200 border border-white/20 shadow-lg">
                            <div class="shrink-0">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                            </div>
                            <span class="ml-3 whitespace-nowrap text-base font-bold text-white">
                                {{ __('Keluar') }}
                            </span>
                        </div>
                    </button>
                </form>
            </div>
        </div>
    </template>
</nav>
