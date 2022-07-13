@props(['active'])

@php

    $common_classes = 'inline-flex items-center px-3 pt-1 text-sm soft-transition border-b-[3px] ';
    $classes = $common_classes . (($active ?? false)
                ? 'border-sky-500 font-bold leading-5 text-sky-500 focus:outline-none'
                : 'border-transparent leading-5 text-zinc-400 hover:text-zinc-300 hover:border-zinc-600 focus:outline-none focus:border-zinc-500');
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
