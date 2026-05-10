<header class="w-full flex justify-center z-[100] fixed top-4 md:top-6 left-0 right-0 px-4 md:px-8 transition-all duration-300"
        x-data="{ 
            activeSection: 'home',
            mobileMenuOpen: false,
            sections: ['home', 'about', 'events', 'contact'],
            init() {
                window.addEventListener('scroll', () => {
                    let current = 'home';
                    for (let section of this.sections) {
                        const el = document.getElementById(section);
                        if (el) {
                            const rect = el.getBoundingClientRect();
                            if (rect.top <= window.innerHeight / 3) {
                                current = section;
                            }
                        }
                    }
                    this.activeSection = current;
                });
            },
            scrollTo(section) {
                const el = document.getElementById(section);
                if (el) {
                    el.scrollIntoView({ behavior: 'smooth' });
                    this.activeSection = section;
                }
            }
        }">
    <div class="flex items-center justify-between w-full max-w-6xl bg-white/70 backdrop-blur-xl border border-white/60 rounded-full p-2 shadow-[0_8px_30px_rgb(0,0,0,0.06)] relative">
        
        <!-- Left: Logo & Brand -->
        <div class="flex items-center gap-2.5 pl-4 cursor-pointer shrink-0" @click="scrollTo('home')">
            <img src="{{ asset('eventic.svg') }}" class="w-7 h-7 md:w-8 md:h-8" alt="Eventic Logo" />
            <span class="text-lg md:text-xl font-bold tracking-tight text-gray-900" style="font-family: 'Instrument Sans', sans-serif;">Eventic</span>
        </div>

        <!-- Center: Navigation -->
        <nav class="hidden lg:flex items-center justify-center p-1.5 bg-gray-50/80 rounded-full border border-gray-200/50">
            <a href="#home" @click.prevent="scrollTo('home')" 
               :class="activeSection === 'home' ? 'text-white bg-[#4285F4] shadow-md ring-1 ring-[#4285F4]/20' : 'text-gray-500 hover:text-gray-900 hover:bg-gray-200/50'"
               class="px-6 py-2 rounded-full text-sm font-semibold transition-all duration-300 cursor-pointer">Beranda</a>
               
            <a href="#about" @click.prevent="scrollTo('about')" 
               :class="activeSection === 'about' ? 'text-white bg-[#4285F4] shadow-md ring-1 ring-[#4285F4]/20' : 'text-gray-500 hover:text-gray-900 hover:bg-gray-200/50'"
               class="px-6 py-2 rounded-full text-sm font-semibold transition-all duration-300 cursor-pointer">Tentang Kami</a>
               
            <a href="#events" @click.prevent="scrollTo('events')" 
               :class="activeSection === 'events' ? 'text-white bg-[#4285F4] shadow-md ring-1 ring-[#4285F4]/20' : 'text-gray-500 hover:text-gray-900 hover:bg-gray-200/50'"
               class="px-6 py-2 rounded-full text-sm font-semibold transition-all duration-300 cursor-pointer">Event</a>
               
            <a href="#contact" @click.prevent="scrollTo('contact')" 
               :class="activeSection === 'contact' ? 'text-white bg-[#4285F4] shadow-md ring-1 ring-[#4285F4]/20' : 'text-gray-500 hover:text-gray-900 hover:bg-gray-200/50'"
               class="px-6 py-2 rounded-full text-sm font-semibold transition-all duration-300 cursor-pointer whitespace-nowrap">Hubungi Kami</a>
        </nav>

        <!-- Right: Auth & Mobile Menu Toggle -->
        <div class="flex items-center justify-end gap-1 pr-1.5 shrink-0">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="hidden lg:block px-5 py-2.5 text-sm font-semibold text-gray-700 hover:text-[#4285F4] transition rounded-full hover:bg-blue-50/50">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="hidden lg:block px-5 py-2.5 text-sm font-semibold text-gray-600 hover:text-[#4285F4] transition rounded-full hover:bg-blue-50/50">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="hidden sm:flex px-6 py-2.5 bg-[#4285F4] text-white font-semibold rounded-full hover:bg-[#3b78e7] transition shadow-md shadow-[#4285F4]/20 text-sm items-center gap-2">
                            Register
                            <svg class="w-4 h-4 hidden lg:block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    @endif
                @endauth
            @endif

            <!-- Hamburger Button -->
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden p-2 ml-1 rounded-full text-gray-700 hover:bg-gray-100 focus:outline-none transition-colors">
                <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                <svg x-show="mobileMenuOpen" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        <!-- Mobile Menu Dropdown -->
        <div x-show="mobileMenuOpen" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-4 scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
             x-transition:leave-end="opacity-0 -translate-y-4 scale-95"
             @click.away="mobileMenuOpen = false"
             class="absolute top-full left-0 right-0 mt-3 bg-white/95 backdrop-blur-2xl border border-gray-100/50 rounded-3xl shadow-[0_20px_40px_rgba(0,0,0,0.1)] lg:hidden overflow-hidden origin-top"
             x-cloak
             style="display: none;">
            <div class="flex flex-col p-3 gap-1">
                <a href="#home" @click.prevent="scrollTo('home'); mobileMenuOpen = false" 
                   :class="activeSection === 'home' ? 'bg-[#4285F4]/10 text-[#4285F4]' : 'text-gray-600 hover:bg-gray-50'"
                   class="px-5 py-3.5 rounded-2xl text-sm font-bold transition-colors">Beranda</a>
                   
                <a href="#about" @click.prevent="scrollTo('about'); mobileMenuOpen = false" 
                   :class="activeSection === 'about' ? 'bg-[#4285F4]/10 text-[#4285F4]' : 'text-gray-600 hover:bg-gray-50'"
                   class="px-5 py-3.5 rounded-2xl text-sm font-bold transition-colors">Tentang Kami</a>
                   
                <a href="#events" @click.prevent="scrollTo('events'); mobileMenuOpen = false" 
                   :class="activeSection === 'events' ? 'bg-[#4285F4]/10 text-[#4285F4]' : 'text-gray-600 hover:bg-gray-50'"
                   class="px-5 py-3.5 rounded-2xl text-sm font-bold transition-colors">Event</a>
                   
                <a href="#contact" @click.prevent="scrollTo('contact'); mobileMenuOpen = false" 
                   :class="activeSection === 'contact' ? 'bg-[#4285F4]/10 text-[#4285F4]' : 'text-gray-600 hover:bg-gray-50'"
                   class="px-5 py-3.5 rounded-2xl text-sm font-bold transition-colors">Hubungi Kami</a>
                   
                <div class="h-px bg-gray-100 my-2 mx-2"></div>
                
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-5 py-3.5 text-center text-sm font-bold text-gray-700 bg-gray-50 rounded-2xl hover:bg-gray-100">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="sm:hidden px-5 py-3.5 text-center text-sm font-bold text-gray-700 bg-gray-50 rounded-2xl hover:bg-gray-100">Login</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="sm:hidden px-5 py-3.5 text-center text-sm font-bold text-white bg-[#4285F4] rounded-2xl hover:bg-[#3b78e7] mt-2 shadow-md shadow-[#4285F4]/20">Register</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </div>
</header>
