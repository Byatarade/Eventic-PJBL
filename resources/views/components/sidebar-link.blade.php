@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex items-center px-4 py-3 text-sm font-bold bg-slate-white text-electric-blue rounded-xl shadow-lg transition-all duration-200'
            : 'flex items-center px-4 py-3 text-sm font-medium text-white/70 hover:bg-white/10 hover:text-white rounded-xl transition-all duration-200';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    <div class="flex items-center min-w-[1.5rem] justify-center">
        {{ $slot }}
    </div>
</a>
