@props(['active'])

@php
    $classes = ($active ?? false)
                ? 'inline-flex items-center px-3 pt-1 border-b-2 border-orange-400 text-sm font-semibold leading-5 text-gray-900 focus:outline-none transition'
                : 'inline-flex items-center px-3 pt-1 border-b-2 border-transparent text-sm leading-5 text-stone-500 hover:text-stone-700 hover:border-stone-200 focus:outline-none focus:border-stone-300 transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
