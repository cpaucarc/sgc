<div class="w-full">
    <div class="flex flex-col gap-y-4 items-center w-3/5 text-center mx-auto my-8">

        {{ $icon }}

        <div class="space-y-1">
            @if(isset($title))
                <h2 class="font-bold text-zinc-800 leading-snug">
                    {{ $title }}
                </h2>
            @endif
            @if(isset($text))
                <h3 class="text-zinc-900 text-sm mt-1 leading-snug">
                    {{ $text }}
                </h3>
            @endif
        </div>

        {{ $slot }}

    </div>

</div>

