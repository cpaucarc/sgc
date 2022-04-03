<div
    class="group bg-white border border-stone-200 px-3 py-3 rounded-md transition hover:shadow-md">
    <x-utils.links.basic href="{{ $href }}" class="text-sm">
        Proceso de {{ $proceso }}
    </x-utils.links.basic>
    <div class="flex justify-between items-center">
        <div class="inline-flex gap-x-2 items-center text-gray-500 group-hover:text-gray-600">
            <svg fill="currentColor" viewBox="0 0 16 16" width="16" height="16">
                <path fill-rule="evenodd"
                      d="M7.122.392a1.75 1.75 0 011.756 0l5.003 2.902c.83.481.83 1.68 0 2.162L8.878 8.358a1.75 1.75 0 01-1.756 0L2.119 5.456a1.25 1.25 0 010-2.162L7.122.392zM8.125 1.69a.25.25 0 00-.25 0l-4.63 2.685 4.63 2.685a.25.25 0 00.25 0l4.63-2.685-4.63-2.685zM1.601 7.789a.75.75 0 011.025-.273l5.249 3.044a.25.25 0 00.25 0l5.249-3.044a.75.75 0 01.752 1.298l-5.248 3.044a1.75 1.75 0 01-1.756 0L1.874 8.814A.75.75 0 011.6 7.789zm0 3.5a.75.75 0 011.025-.273l5.249 3.044a.25.25 0 00.25 0l5.249-3.044a.75.75 0 01.752 1.298l-5.248 3.044a1.75 1.75 0 01-1.756 0l-5.248-3.044a.75.75 0 01-.273-1.025z"></path>
            </svg>
            <p class="text-sm font-light">
                {{ $cantidad }} indicadores
            </p>
        </div>
        <x-utils.links.default href="{{ $href }}" class="text-sm">
            Revisar
        </x-utils.links.default>
    </div>
</div>
