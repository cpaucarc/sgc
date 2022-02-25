<x-app-layout>

    <div class="grid grid-cols-6 gap-12">

        <div class="col-span-2 text-right space-y-4">

            <div class="pt-2">
                <p class="text-gray-500">Indicadores de</p>
                <h1 class="font-bold text-2xl text-gray-700">
                    {{ $proceso->nombre }}
                </h1>
                <h2 class="font-bold text-lg text-stone-500 mt-1">
                    {{isset($escuela) ? $escuela->nombre : $facultad->nombre}}
                </h2>
            </div>

            <hr>

            <p class="text-gray-500 font-semibold text-sm">
                {{ count($indicadores) }} indicadores en este proceso
            </p>

        </div>

        <div class="col-span-3">

            <div class="space-y-4 divide-y divide-dashed divide-stone-300">
                @foreach($indicadores as $indicador)
                    <x-indicador.card-indicador
                        :codigo="$indicador->cod_ind_inicial"
                        :objetivo="$indicador->objetivo"
                        :medicion="$indicador->medicion->nombre"
                        :reporte="$indicador->reporte->nombre"
                        href="{{ route('indicador.indicador', [$indicador->id, $tipo, $uuid]) }}"
                    />
                @endforeach
            </div>

        </div>
    </div>

</x-app-layout>
