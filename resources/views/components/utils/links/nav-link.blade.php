@props(['active'])

@php
    $classes = ($active ?? false)
                ? 'relative py-2 px-2 text-sm rounded-md flex flex-1 w-full items-center justify-between bg-zinc-100 text-stone-800 font-bold cursor-pointer tracking-wide'
                : 'py-2 px-2 text-sm rounded-md flex flex-1 w-full items-center justify-between bg-white hover:bg-zinc-100 text-gray-600 font-semibold hover:text-gray-700 cursor-pointer whitespace-nowrap';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    @if($active)
        <div class="absolute -left-2 h-6 w-1 bg-blue-600 rounded-lg"></div>
    @endif
    {{ $slot }}
</a>
