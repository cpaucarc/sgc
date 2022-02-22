@props(['active'])

@php
    $classes = ($active ?? false)
                ? 'py-2 px-2 text-sm rounded-md flex flex-1 w-full items-center justify-between bg-indigo-50 text-indigo-600 font-bold cursor-pointer tracking-wide'
                : 'py-2 px-2 text-sm rounded-md flex flex-1 w-full items-center justify-between bg-white hover:bg-gray-100 text-gray-500 hover:text-gray-600 cursor-pointer whitespace-nowrap';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
    @if($active)
        <div class="h-2 w-2 bg-indigo-600 rounded-full"></div>
    @endif
</a>
