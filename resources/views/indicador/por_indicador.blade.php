<x-app-layout>

    <div class="space-y-8">
        <div class="space-y-4">
            <div class="flex-1">
                <h2 class="font-semibold text-lg text-gray-600">
                    {{ $indicadorable->indicador->cod_ind_inicial }}
                </h2>
                <h3 class="font-bold text-gray-800 text-2xl leading-6">
                    {{ $indicadorable->indicador->objetivo }}
                </h3>
            </div>

            <p class="flex items-center text-sm text-gray-600">
                <svg class="icon-5 mr-2" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75"
                          d="M4.871 4A17.926 17.926 0 003 12c0 2.874.673 5.59 1.871 8m14.13 0a17.926 17.926 0 001.87-8c0-2.874-.673-5.59-1.87-8M9 9h1.246a1 1 0 01.961.725l1.586 5.55a1 1 0 00.961.725H15m1-7h-.08a2 2 0 00-1.519.698L9.6 15.302A2 2 0 018.08 16H8"/>
                </svg>
                <span class="font-bold">Fórmula:</span>
                <span class="italic mx-1 tracking-wide">
                    {{ $indicadorable->indicador->formula }}
                </span>
            </p>

            <div class="flex items-center flex-wrap divide-x divide-gray-200 space-x-4">
                <ul class="flex gap-2 font-semibold text-sm">
                    <li>
                        <x-utils.links.basic href="{{ route('indicador.index') }}">
                            <x-utils.badge
                                class="bg-sky-50 text-sky-600 hover:underline soft-transition">
                                Oficina:&nbsp;<strong> {{ $nombre }}  </strong>
                            </x-utils.badge>
                        </x-utils.links.basic>
                    </li>

                    <li>
                        <x-utils.links.basic
                            href="{{ route('indicador.proceso', [$indicadorable->indicador->proceso_id, $tipo, $uuid]) }}">
                            <x-utils.badge
                                class="bg-sky-50 text-sky-600 hover:underline soft-transition">
                                Proceso:&nbsp;<strong>{{ $indicadorable->indicador->proceso->nombre }}</strong>
                            </x-utils.badge>
                        </x-utils.links.basic>
                    </li>
                </ul>
                <ul class="flex gap-2 pl-4 font-semibold text-sm">
                    <li>
                        <x-utils.badge class="bg-stone-100 text-stone-700">
                            Medición: {{ $indicadorable->indicador->medicion->nombre }}
                        </x-utils.badge>
                    </li>
                    <li>
                        <x-utils.badge class="bg-stone-100 text-stone-700">
                            Reporte: {{ $indicadorable->indicador->reporte->nombre }}
                        </x-utils.badge>
                    </li>
                </ul>
            </div>
        </div>

        <hr/>

        <livewire:indicador.tabla-analisis
            indicadorable_id="{{ $indicadorable->id }}"
            oficina="{{ $nombre }}"
            tipo="{{ $tipo }}"
            uuid="{{ $uuid }}"
        />

    </div>

</x-app-layout>
