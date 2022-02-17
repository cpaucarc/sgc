@props(['active'])

@php
    $classes = ($active ?? false)
                ? 'p-2 rounded flex flex-1 w-full items-center justify-between bg-purple-50 text-purple-600 font-bold cursor-pointer tracking-wide'
                : 'p-2 rounded flex flex-1 w-full items-center justify-between bg-white hover:bg-purple-50 text-gray-600 hover:text-gray-800 cursor-pointer whitespace-nowrap';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
    @if($active)
        <div class="h-2 w-2 bg-purple-700 rounded-full"></div>
    @endif
</a>
