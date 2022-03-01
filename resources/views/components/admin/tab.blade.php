@props(['active'])

@php
    $classes = ($active ?? false)
                ? 'inline-flex pt-2 pb-2 px-6 text-sm font-bold text-center text-blue-600 rounded-t-lg border-b-2 border-blue-600 active group'
                : 'inline-flex pt-2 pb-2 px-6 text-sm font-medium text-center text-gray-500 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 group';
@endphp

<li>
    <a {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
</li>
