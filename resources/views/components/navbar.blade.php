<header class="w-full flex justify-center z-50 fixed top-6 left-0 right-0 px-4 md:px-8 transition-all duration-300"
        x-data="{ 
            activeSection: 'home',
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
    <div class="flex items-center justify-between w-full max-w-6xl bg-white/70 backdrop-blur-xl border border-white/60 rounded-full p-2 shadow-[0_8px_30px_rgb(0,0,0,0.06)]">
        
        <!-- Left: Logo & Brand -->
        <div class="flex items-center gap-2.5 pl-4 cursor-pointer" @click="scrollTo('home')">
            <img src="{{ asset('eventic.svg') }}" class="w-8 h-8" alt="Eventic Logo" />
            <span class="text-xl font-bold tracking-tight text-gray-900" style="font-family: 'Instrument Sans', sans-serif;">Eventic</span>
        </div>

        <!-- Center: Navigation -->
        <nav class="hidden lg:flex items-center justify-center p-1.5 bg-gray-50/80 rounded-full border border-gray-200/50">
            <a href="#home" @click.prevent="scrollTo('home')" 
               :class="activeSection === 'home' ? 'text-white bg-blue-900 shadow-md ring-1 ring-blue-900/20' : 'text-gray-500 hover:text-gray-900 hover:bg-gray-200/50'"
               class="px-6 py-2 rounded-full text-sm font-semibold transition-all duration-300 cursor-pointer">Beranda</a>
               
            <a href="#about" @click.prevent="scrollTo('about')" 
               :class="activeSection === 'about' ? 'text-white bg-blue-900 shadow-md ring-1 ring-blue-900/20' : 'text-gray-500 hover:text-gray-900 hover:bg-gray-200/50'"
               class="px-6 py-2 rounded-full text-sm font-semibold transition-all duration-300 cursor-pointer">Tentang Kami</a>
               
            <a href="#events" @click.prevent="scrollTo('events')" 
               :class="activeSection === 'events' ? 'text-white bg-blue-900 shadow-md ring-1 ring-blue-900/20' : 'text-gray-500 hover:text-gray-900 hover:bg-gray-200/50'"
               class="px-6 py-2 rounded-full text-sm font-semibold transition-all duration-300 cursor-pointer">Event</a>
               
            <a href="#contact" @click.prevent="scrollTo('contact')" 
               :class="activeSection === 'contact' ? 'text-white bg-blue-900 shadow-md ring-1 ring-blue-900/20' : 'text-gray-500 hover:text-gray-900 hover:bg-gray-200/50'"
               class="px-6 py-2 rounded-full text-sm font-semibold transition-all duration-300 cursor-pointer whitespace-nowrap">Hubungi Kami</a>
        </nav>

        <!-- Right: Auth Links -->
        <div class="flex items-center justify-end gap-1 pr-1.5">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="px-5 py-2.5 text-sm font-semibold text-gray-700 hover:text-[#4285F4] transition rounded-full hover:bg-blue-50/50">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="hidden sm:block px-5 py-2.5 text-sm font-semibold text-gray-600 hover:text-[#4285F4] transition rounded-full hover:bg-blue-50/50">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="px-6 py-2.5 bg-[#4285F4] text-white font-semibold rounded-full hover:bg-[#3b78e7] transition shadow-md shadow-blue-500/20 text-sm flex items-center gap-2">
                            Register
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    @endif
                @endauth
            @endif
        </div>
    </div>
</header>
