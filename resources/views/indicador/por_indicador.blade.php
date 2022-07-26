<x-app-layout>

    <div class="space-y-8">
        <div class="space-y-4">
            <div class="flex-1">
                <h2 class="font-semibold text-lg text-zinc-600">
                    {{ $indicadorable->cod_ind_final }}
                </h2>
                <h3 class="font-bold text-zinc-800 text-2xl leading-6">
                    {{ $indicadorable->indicador->objetivo }}
                </h3>
            </div>

            <p class="flex items-center text-sm text-zinc-600">
                <span class="font-bold">Fórmula:</span>
                <span class="italic mx-1 tracking-wide">
                    {{ $indicadorable->indicador->formula }}
                </span>
            </p>

            <div class="flex items-center flex-wrap divide-x divide-zinc-200 space-x-4">
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
