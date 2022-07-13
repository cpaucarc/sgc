@props(['active'])

@php
    $common_classes = "inline-flex pt-2 pb-2 px-4 text-sm text-center rounded-t-lg border-b-2 group soft-transition whitespace-nowrap ";
    $classes = ($active ?? false)
                ? $common_classes . 'font-bold text-sky-800 border-sky-600 bg-sky-500/10 active'
                : $common_classes . 'font-medium hover:bg-zinc-400/10 text-zinc-500 border-zinc-100 hover:text-zinc-600 hover:border-zinc-300';
@endphp

<li class="relative">
    <a {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
    @if(isset($otros))
        {{ $otros }}
    @endif
</li>
