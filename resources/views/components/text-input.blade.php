@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 focus:border-electric-blue focus:ring-electric-blue rounded-xl shadow-sm']) }}>
