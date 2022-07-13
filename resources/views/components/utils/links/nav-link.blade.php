@props(['active'])

@php
    $common_clases = 'py-2 px-2 text-sm rounded-md flex flex-1 w-full items-center justify-between whitespace-nowrap cursor-pointer soft-transition ';
    $classes = $common_clases . (($active ?? false)
                ? 'relative bg-sky-500/10 text-sky-800 font-bold tracking-wide'
                : 'bg-transparent hover:bg-zinc-400/10 text-zinc-600 font-semibold hover:text-zinc-700');
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    @if($active)
        <div class="absolute -left-2 h-6 w-1 bg-sky-500 rounded-md"></div>
    @endif
    {{ $slot }}
</a>
