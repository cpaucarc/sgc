<x-utils.card>

    <div class="flex justify-between items-center">
        <div class="flex-col lg:flex-row justify-between items-start px-6 lg:px-0">
            <h1 class="flex-1 lg:text-2xl font-bold text-gray-700 truncate">
                {{ $responsable->actividad->nombre }}
            </h1>
            <h2 class="flex-1 text-sm lg:text-base font-semibold text-gray-400 truncate">
                Responsable: {{ $responsable->entidad->nombre }}
            </h2>
            <div class="flex gap-x-6 mt-0">
                <div class="mt-2 flex items-center text-sm text-gray-500">
                    <svg class="flex-shrink-0 mr-1 h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"/>
                    </svg>
                    {{ $responsable->actividad->proceso->nombre }}

                </div>
                <div class="mt-2 items-center text-sm text-gray-500 hidden sm:flex">
                    <svg class="flex-shrink-0 mr-1 h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    {{ $responsable->actividad->tipo->nombre }}
                </div>
                <div class="mt-2 flex items-center text-sm font-bold text-indigo-500">
                    <x-icons.calendar :stroke="2" class="h-5 w-5 mr-1 text-indigo-400"></x-icons.calendar>
                    {{ $semestre->nombre }}
                </div>
            </div>
        </div>

        @if(!$responsable->estado)
            <x-utils.buttons.default class="text-sm" wire:click="completarActividad">
                <x-icons.load class="h-4 w-4 text-gray-600" wire:loading wire:target="completarActividad"/>
                Marcar como completado
            </x-utils.buttons.default>
        @else
            <div class="flex flex-col items-end w-48 space-y-2">
                <buttons
                    class="cursor-wait inline-flex items-center text-green-700 border border-green-200 bg-green-100 rounded-lg text-sm px-3 py-1">
                    <x-icons.check :stroke="2" class="h-5 w-5 mr-1" />
                    Completado
                </buttons>
                <span class="text-xs">
                    Completado el {{ date('h:m a d M', strtotime($responsable->estado)) }}
                </span>
            </div>
        @endif
    </div>
</x-utils.card>
