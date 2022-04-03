<x-app-layout>

    <div class="flex justify-end mb-6 items-start">
        <livewire:indicador.buscador-indicadores/>
    </div>

    <div class="grid grid-cols-6 gap-12">

        <div class="col-span-2 text-right space-y-4">
            <div>
                <p class="text-gray-500">Indicadores de</p>
                <h1 class="font-bold text-2xl text-gray-700">
                    {{ isset($facultad) ? $facultad->nombre : $escuela->nombre }}
                </h1>
            </div>

            <hr>

            <p class="text-gray-500 font-semibold text-sm">
                {{ isset($facultad) ? $facultad->indicadores_count
                                    : $escuela->indicadores_count }}
                indicadores en total
            </p>

        </div>

        <div class="col-span-4 space-y-6">

            @if(isset($escuela))
                <div class="grid grid-cols-2 gap-y-6 gap-x-8">
                    @foreach($escuela_indicadores as $proceso_id => $cantidad)
                        <x-indicador.card-proceso-indicador
                            :proceso="App\Models\Proceso::getNombreById($proceso_id)"
                            :cantidad="$cantidad"
                            :href=" route('indicador.proceso', [$proceso_id, 1,$escuela->uuid]) "
                        />
                    @endforeach
                </div>
            @endif

            @if(isset($facultad))
                <div class="grid grid-cols-2 gap-y-4 gap-x-6">
                    @foreach($facultad_indicadores as $proceso_id => $cantidad)
                        <x-indicador.card-proceso-indicador
                            :proceso="App\Models\Proceso::getNombreById($proceso_id)"
                            :cantidad="$cantidad"
                            :href=" route('indicador.proceso', [$proceso_id, 2,$facultad->uuid]) "
                        />
                    @endforeach
                </div>
            @endif
        </div>

    </div>

</x-app-layout>
