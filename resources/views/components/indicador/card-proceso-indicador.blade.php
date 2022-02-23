<div
    class="group bg-white border border-stone-200 px-3 py-3 rounded-md transition hover:shadow-md">
    <x-utils.links.basic href="{{ $href }}" class="text-sm">
        Proceso de {{ $proceso }}
    </x-utils.links.basic>
    <div class="flex justify-between items-center">
        <div class="inline-flex items-center text-gray-500 group-hover:text-gray-600">
            <svg class="h-4 w-4 flex-shrink-0 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                      d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
            </svg>
            <p class="text-xs">
                {{ $cantidad }} indicadores
            </p>
        </div>
        <x-utils.links.default href="{{ $href }}" class="text-xs">
            Revisar
        </x-utils.links.default>
    </div>
</div>
