<div
    class="absolute -mt-1 pb-2 w-full z-30 max-h-64 overflow-y-scroll shadow-lg bg-white rounded-b-md border border-gray-300">
    <ul class="text-sm p-0 m-0 overflow-hidden">
        @if(count($facultades))
            @foreach($facultades as $facultad)
                @if(count($facultad->indicadores))
                    <li class="sticky top-0 bg-white py-2 px-2 backdrop-blur bg-opacity-75 text-gray-800 font-bold">
                        {{ $facultad->nombre }}
                    </li>
                    @foreach($facultad->indicadores as $indicador)
                        <li>
                            <x-indicador.link-buscador
                                href="{{ route('indicador.indicador', [$indicador->id, 2, $escuela->uuid]) }}"
                                :codigo="$indicador->cod_ind_inicial"
                                :objetivo="$indicador->objetivo"/>
                        </li>
                    @endforeach
                @else
                    <li class="py-2 px-2 text-gray-600 font-semibold">
                        😔 No se encontró ningún indicador
                    </li>
                @endif
            @endforeach
        @endif
        <hr>
        @if(count($escuelas))
            @foreach($escuelas as $escuela)
                @if(count($escuela->indicadores))
                    <li class="sticky top-0 bg-white py-2 px-2 backdrop-blur bg-opacity-75 text-gray-800 font-bold">
                        {{ $escuela->nombre }}
                    </li>
                    @foreach($escuela->indicadores as $indicador)
                        <li>
                            <x-indicador.link-buscador
                                href="{{ route('indicador.indicador', [$indicador->id, 1, $escuela->uuid]) }}"
                                :codigo="$indicador->cod_ind_inicial"
                                :objetivo="$indicador->objetivo"/>
                        </li>
                    @endforeach
                @else
                    <li class="py-2 px-2 text-gray-600 font-semibold">
                        😔 No se encontró ningún indicador
                    </li>
                @endif
            @endforeach
        @endif
    </ul>
</div>
