<x-app-layout>

    <div class="space-y-4">
        <x-utils.card>
            <div class="flex items-start justify-between gap-8 my-2">
                <div class="flex-1">
                    <h2 class="font-bold text-lg text-gray-400">
                        {{ $indicadorable->indicador->cod_ind_inicial }}
                    </h2>
                    <h2 class="font-bold text-gray-700 max-w-6xl text-2xl leading-6">
                        {{ $indicadorable->indicador->objetivo }}
                    </h2>
                    <p class="flex items-center text-sm mt-4 text-gray-500">
                        <svg class="flex-shrink-0 h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75"
                                  d="M4.871 4A17.926 17.926 0 003 12c0 2.874.673 5.59 1.871 8m14.13 0a17.926 17.926 0 001.87-8c0-2.874-.673-5.59-1.87-8M9 9h1.246a1 1 0 01.961.725l1.586 5.55a1 1 0 00.961.725H15m1-7h-.08a2 2 0 00-1.519.698L9.6 15.302A2 2 0 018.08 16H8"/>
                        </svg>
                        <span class="font-bold">Fórmula:</span>
                        <span class="italic mx-1 tracking-wide">
                            {{ $indicadorable->indicador->formula }}
                        </span>
                    </p>
                </div>
                <div class="flex flex-col divide-y divide-gray-200 space-y-4">
                    <div class="flex flex-col space-y-2 font-semibold">
                        <x-utils.links.basic href="{{ route('indicador.proceso', [$indicadorable->indicador->proceso_id, $tipo, $uuid]) }}" class="text-sm">
                            <x-utils.badge
                                class="bg-sky-50 text-sky-700 hover:underline hover:text-sky-700">
                                Proceso:&nbsp;<strong>{{ $indicadorable->indicador->proceso->nombre }}</strong>
                            </x-utils.badge>
                        </x-utils.links.basic>

                        <x-utils.links.basic href="{{ route('indicador.index') }}" class="text-sm">
                            <x-utils.badge
                                class="bg-sky-50 text-sky-700 hover:underline hover:text-sky-700">
                                Oficina:&nbsp;<strong>
                                    {{ isset($escuela) ? $escuela->nombre : $facultad->nombre }}
                                </strong>
                            </x-utils.badge>
                        </x-utils.links.basic>
                    </div>
                    <ul class="flex flex-wrap gap-2 pt-4 font-semibold">
                        <li>
                            <x-utils.badge class="bg-gray-50 text-gray-600 font-semibold">
                                Medición: {{ $indicadorable->indicador->medicion->nombre }}
                            </x-utils.badge>
                        </li>
                        <li>
                            <x-utils.badge class="bg-gray-50 text-gray-600 font-semibold">
                                Reporte: {{ $indicadorable->indicador->reporte->nombre }}
                            </x-utils.badge>
                        </li>
                    </ul>
                </div>
            </div>
        </x-utils.card>

        <livewire:indicador.tabla-analisis
            indicadorable_id="{{ $indicadorable->id }}"
            tipo="{{ $tipo }}"
            uuid="{{ $uuid }}"
        />

    </div>

</x-app-layout>
