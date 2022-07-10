@props(['active'])

@php
    $common_classes = "inline-flex pt-2 pb-2 px-4 text-sm text-center rounded-t-lg border-b-2 group soft-transition whitespace-nowrap ";
    $classes = ($active ?? false)
                ? $common_classes . 'font-bold text-blue-600 border-blue-600 bg-blue-500/10 active'
                : $common_classes . 'font-medium text-gray-500 border-zinc-100 hover:text-zinc-600 hover:border-zinc-300';
@endphp

<li class="relative">
    <a {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
    @if(isset($otros))
        {{ $otros }}
    @endif
</li>
