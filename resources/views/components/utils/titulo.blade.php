<div class="mb-8 -mt-2 border-b border-dashed border-zinc-300 pb-4">
    <div class="flex items-center justify-between gap-x-6">
        <div>
            <h1 class="font-bold text-zinc-900 text-xl">
                {{ $titulo }}
            </h1>
            @if(isset($subtitulo))
                <p class="text-zinc-500 text-sm">
                    {{ $subtitulo }}
                </p>
            @endif
        </div>
        @if(isset($items))
            <div class="flex items-center gap-x-2 justify-end">
                {{ $items }}
            </div>
        @endif
    </div>
</div>
