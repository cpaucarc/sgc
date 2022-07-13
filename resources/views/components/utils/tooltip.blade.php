<div x-data="{ tooltip: false }" class="relative z-30 inline-flex">
    <div x-on:mouseover="tooltip = true" x-on:mouseleave="tooltip = false">
        {{ $slot }}
    </div>
    <div class="relative" x-cloak x-show.transition.origin.top="tooltip">
        <div
            class="absolute whitespace-nowrap top-0 z-10 p-2 -mt-1 text-xs leading-tight text-white transform -translate-x-1/2 -translate-y-full bg-zinc-700 rounded-lg shadow-lg">
            {{ $message }}
        </div>
        <svg
            class="absolute z-10 w-6 h-6 text-zinc-700 transform -translate-x-12 -translate-y-3 fill-current stroke-current"
            width="8" height="8">
            <rect x="12" y="-10" width="8" height="8" transform="rotate(45)"/>
        </svg>
    </div>
</div>
