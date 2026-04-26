<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 h-16 flex items-center shrink-0">
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

                @isset($header)
                    <div class="text-xl font-bold text-deep-navy">
                        {{ $header }}
                    </div>
                @endisset
            </div>

            <!-- Right Side: User Dropdown -->
            <div class="flex items-center">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-xl text-deep-navy bg-white hover:bg-slate-white transition ease-in-out duration-150">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-full bg-electric-blue/10 flex items-center justify-center text-electric-blue font-bold">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
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
    <div x-show="open" class="fixed inset-0 z-50 lg:hidden" style="display: none;">
        <div class="fixed inset-0 bg-deep-navy/80 backdrop-blur-sm" @click="open = false"></div>
        <div class="fixed inset-y-0 left-0 w-72 bg-electric-blue p-6 flex flex-col shadow-2xl">
            <div class="flex items-center justify-between mb-8">
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
            
            <nav class="space-y-2">
                <x-sidebar-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" @click="open = false">
                    <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span class="ml-3">{{ __('Dashboard') }}</span>
                </x-sidebar-link>
                <x-sidebar-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')" @click="open = false">
                    <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <span class="ml-3">{{ __('Profile') }}</span>
                </x-sidebar-link>
            </nav>
        </div>
    </div>
</nav>
