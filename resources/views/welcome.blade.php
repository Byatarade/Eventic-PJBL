<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Eventic - Events</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('eventic.svg') }}">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600|playfair-display:400,500,600,700" rel="stylesheet" />
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        .hero-bg {
            background-image: url('https://images.unsplash.com/photo-1540039155732-68473678d4dd?q=80&w=2070&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
        }

        .text-shadow {
            text-shadow: 0px 4px 15px rgba(0, 0, 0, 0.6);
        }
    </style>
</head>
<body class="bg-white font-sans text-gray-900 antialiased relative">
    
    <!-- Navbar Component -->
    <x-navbar />

    <!-- Main Content -->
    <main class="w-full">
        <!-- Hero Section Container -->
        <div class="p-4 pt-[8rem] pb-4 w-full h-screen flex flex-col">
            <div class="w-full flex-grow relative rounded-[2.5rem] overflow-hidden hero-bg flex items-center shadow-2xl">
            <!-- Dark Overlay -->
            <div class="absolute inset-0 bg-black/45"></div>
            
            <!-- Text Content -->
            <div class="relative z-10 px-12 md:px-24 w-full text-white">
                <div class="flex flex-col max-w-3xl">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="bg-black/70 rounded-full p-2.5 flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        </div>
                        <div>
                            <p class="font-bold text-sm tracking-wide text-shadow">5.0 Rated</p>
                            <a href="#" class="text-sm underline underline-offset-4 opacity-90 hover:opacity-100 transition text-shadow">Read Our Success Stories</a>
                        </div>
                    </div>

                    <h1 class="text-7xl md:text-[8rem] lg:text-[10rem] font-bold mb-4 tracking-tighter text-shadow" style="font-family: 'Playfair Display', serif; line-height: 1;">
                        Events
                    </h1>
                    
                    <p class="text-xl md:text-2xl font-medium max-w-xl leading-relaxed opacity-95 text-shadow" style="font-family: 'Instrument Sans', sans-serif;">
                        Easily Add And Organize Events, With Notifications To Keep Everyone Engaged
                    </p>
                </div>
            </div>
        </div>
        </div>
        
        <!-- About Section -->
        <section id="about" class="w-full py-24 px-8 lg:px-24 flex flex-col items-center">
            <div class="max-w-7xl w-full flex flex-col lg:flex-row gap-16 items-center">
                <!-- Visual -->
                <div class="w-full lg:w-1/2 relative">
                    <div class="aspect-[4/3] rounded-[2.5rem] overflow-hidden shadow-2xl relative z-10">
                        <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?q=80&w=2070&auto=format&fit=crop" alt="Conference" class="w-full h-full object-cover" />
                    </div>
                    <div class="absolute -bottom-8 -left-8 w-48 h-48 bg-[#4285F4]/10 rounded-full z-0"></div>
                    <div class="absolute -top-8 -right-8 w-32 h-32 bg-blue-100 rounded-full z-0"></div>
                </div>
                
                <!-- Text -->
                <div class="w-full lg:w-1/2">
                    <div class="text-[#4285F4] font-semibold tracking-wider uppercase text-sm mb-3">About Eventic</div>
                    <h2 class="text-4xl md:text-5xl font-bold mb-6 text-gray-900 leading-tight" style="font-family: 'Playfair Display', serif;">
                        Elevate Your Event Experience
                    </h2>
                    <p class="text-gray-600 text-lg leading-relaxed mb-6 font-medium" style="font-family: 'Instrument Sans', sans-serif;">
                        Eventic is a modern, intuitive platform designed to bridge the gap between event organizers and attendees. We provide seamless ticketing, real-time updates, and an elegant experience from start to finish.
                    </p>
                    <p class="text-gray-500 text-lg leading-relaxed mb-8">
                        Whether you're hosting an intimate workshop or a massive conference, our tools are crafted to make your job effortless, letting you focus on what truly matters: creating unforgettable moments.
                    </p>
                    
                    <div class="flex items-center gap-6">
                        <a href="#" class="px-8 py-3.5 bg-gray-900 text-white font-semibold rounded-full hover:bg-gray-800 transition shadow-lg shadow-gray-900/20">
                            Learn More
                        </a>
                        <div class="flex -space-x-4">
                            <img class="w-12 h-12 rounded-full border-4 border-white object-cover" src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=100&auto=format&fit=crop" alt="User" />
                            <img class="w-12 h-12 rounded-full border-4 border-white object-cover" src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=100&auto=format&fit=crop" alt="User" />
                            <img class="w-12 h-12 rounded-full border-4 border-white object-cover" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=100&auto=format&fit=crop" alt="User" />
                            <div class="w-12 h-12 rounded-full border-4 border-white bg-gray-100 flex items-center justify-center text-xs font-bold text-gray-600">
                                +2k
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

</body>
</html>
