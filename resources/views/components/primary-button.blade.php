<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-4 py-3 bg-electric-blue border border-transparent rounded-xl font-semibold text-sm text-white uppercase tracking-widest hover:bg-electric-blue/90 focus:bg-electric-blue active:bg-electric-blue/80 focus:outline-none focus:ring-2 focus:ring-electric-blue focus:ring-offset-2 transition ease-in-out duration-150 shadow-lg shadow-electric-blue/20']) }}>
    {{ $slot }}
</button>
