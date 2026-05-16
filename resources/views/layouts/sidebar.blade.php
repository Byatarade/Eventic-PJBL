<div class="hidden lg:flex lg:flex-col bg-electric-blue text-slate-white shadow-xl relative z-20 w-64 shrink-0 h-screen">
    
    <!-- Sidebar Header: Logo -->
    <div class="flex items-center gap-3 p-6 border-b border-white/10 h-16 shrink-0 overflow-hidden">
        <div class="bg-white p-1.5 rounded-lg shadow-sm shrink-0">
            <x-application-logo class="w-6 h-6 text-electric-blue" />
        </div>
        <span class="text-xl font-bold tracking-tight text-white whitespace-nowrap">
            Eventic
        </span>
    </div>

    <!-- Sidebar Navigation -->
    <nav class="flex-grow px-3 space-y-2 mt-6 overflow-hidden">
        @php
            $dashboardRoute = auth()->user()->role === 'eo' ? route('eo.dashboard') : route('dashboard');
            $isDashboardActive = auth()->user()->role === 'eo' ? request()->routeIs('eo.dashboard') : request()->routeIs('dashboard');
        @endphp

        @if (auth()->user()->role !== 'eo')
            <x-sidebar-link :href="$dashboardRoute" :active="$isDashboardActive">
                <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <span class="ml-3 whitespace-nowrap">{{ __('Dashboard') }}</span>
            </x-sidebar-link>

            <!-- Tiket Saya -->
            <x-sidebar-link :href="route('user.tickets.index')" :active="request()->routeIs('user.tickets.*')">
                <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                </svg>
                <span class="ml-3 whitespace-nowrap">Tiket Saya</span>
            </x-sidebar-link>

            <!-- Transaksi -->
            <x-sidebar-link :href="route('user.transactions.index')" :active="request()->routeIs('user.transactions.*')">
                <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <span class="ml-3 whitespace-nowrap">Transaksi</span>
            </x-sidebar-link>

            <!-- Wishlist -->
            <x-sidebar-link :href="route('user.wishlist.index')" :active="request()->routeIs('user.wishlist.*')">
                <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
                <span class="ml-3 whitespace-nowrap">Wishlist Saya</span>
            </x-sidebar-link>
        @endif

        @if (auth()->user()->role === 'eo')
            <div class="pt-4 pb-2">
                <span class="px-3 text-xs font-semibold text-blue-200 uppercase tracking-wider">Manajemen EO</span>
            </div>

            <x-sidebar-link :href="$dashboardRoute" :active="$isDashboardActive">
                <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <span class="ml-3 whitespace-nowrap">{{ __('Dashboard') }}</span>
            </x-sidebar-link>

            <!-- Event Management -->
            <x-sidebar-link :href="route('eo.events.index')" :active="request()->routeIs('eo.events.*')">
                <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <span class="ml-3 whitespace-nowrap">Kelola Event</span>
            </x-sidebar-link>

            <!-- Transaksi -->
            <x-sidebar-link :href="route('eo.transactions.index')" :active="request()->routeIs('eo.transactions.*')">
                <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <span class="ml-3 whitespace-nowrap">Transaksi</span>
            </x-sidebar-link>

            <!-- Laporan/Analytics -->
            <x-sidebar-link :href="route('eo.analytics.index')" :active="request()->routeIs('eo.analytics.*')">
                <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
                <span class="ml-3 whitespace-nowrap">Keuntungan</span>
            </x-sidebar-link>

            <!-- Peserta -->
            <x-sidebar-link :href="route('eo.participants.index')" :active="request()->routeIs('eo.participants.*')">
                <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                <span class="ml-3 whitespace-nowrap">Peserta Event</span>
            </x-sidebar-link>

            <!-- Refund Management -->
            <x-sidebar-link :href="route('eo.refunds.index')" :active="request()->routeIs('eo.refunds.*')">
                <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 15v-1a4 4 0 00-4-4H8m0 0l3 3m-3-3l3-3m9 14V5a2 2 0 00-2-2H6a2 2 0 00-2 2v16l4-2 4 2 4-2 4 2z" />
                </svg>
                <span class="ml-3 whitespace-nowrap">Kelola Refund</span>
            </x-sidebar-link>
        @endif

        <x-sidebar-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
            <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            <span class="ml-3 whitespace-nowrap">{{ __('Profil') }}</span>
        </x-sidebar-link>
    </nav>

    <!-- Sidebar Footer -->
    <div class="p-4 mt-auto">
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
