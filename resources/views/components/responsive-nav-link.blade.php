@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-electric-blue text-start text-base font-bold text-electric-blue bg-electric-blue/10 focus:outline-none focus:text-electric-blue focus:bg-electric-blue/20 focus:border-electric-blue transition duration-150 ease-in-out'
            : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-gray-600 hover:text-deep-navy hover:bg-slate-white hover:border-gray-300 focus:outline-none focus:text-deep-navy focus:bg-slate-white focus:border-gray-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
