@props(['active'])

@php
    $classes = ($active ?? false)
                ? 'inline-flex items-center px-3 pt-1 border-b-4 border-rose-500 text-sm font-bold leading-5 text-gray-100 focus:outline-none transition'
                : 'inline-flex items-center px-3 pt-1 border-b-2 border-transparent text-sm leading-5 text-gray-400 hover:text-gray-300 hover:border-gray-600 focus:outline-none focus:border-stone-300 transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
