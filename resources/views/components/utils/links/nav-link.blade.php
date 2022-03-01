@props(['active'])

@php
    $classes = ($active ?? false)
                ? 'relative py-2 px-2 text-sm rounded-md flex flex-1 w-full items-center justify-between bg-stone-100 text-stone-700 font-bold cursor-pointer tracking-wide'
                : 'py-2 px-2 text-sm rounded-md flex flex-1 w-full items-center justify-between bg-white hover:bg-stone-100 text-gray-500 hover:text-gray-600 cursor-pointer whitespace-nowrap';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    @if($active)
        <div class="absolute -left-2 h-6 w-1 bg-sky-600 rounded-lg"></div>
    @endif
    {{ $slot }}
</a>
