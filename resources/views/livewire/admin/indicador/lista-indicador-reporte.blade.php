<div>
    <div class="col-span-3 space-y-4 divide-gray-300 divide-dashed mb-6">
        <div class="flex justify-between items-center">
            <h1 class="font-bold text-xl text-black">
                Reporte Indicadores
            </h1>
            @if(!is_null($entidad) and $entidad->indicadores_count)
                <div class="flex items-center gap-x-2">
                    <x-utils.links.danger class="text-xs" target="_blank"
                                          href="{{ route('reporte.indicador.pdf', [
                                                    'semestre' => $semestre,
                                                    'facultad' => $facultad,
                                                    'escuela' => $escuela
                                                ]) }}">
                        <x-icons.document class="h-5 w-5 mr-1"/>
                        PDF
                    </x-utils.links.danger>

                    <x-utils.links.success class="text-xs" target="_blank"
                                           href="{{ route('reporte.indicador.excel', ['semestre' => $semestre,'facultad' => $facultad,'escuela' => $escuela]) }}">
                        <x-icons.excel class="h-5 w-5 mr-1"/>
                        Excel
                    </x-utils.links.success>
                </div>
            @endif
        </div>
        <hr/>
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-x-2">
                <x-utils.forms.select wire:model="facultad">
                    @foreach($facultades as $fac)
                        <option value="{{$fac->id}}">{{$fac->nombre}}</option>
                    @endforeach
                </x-utils.forms.select>
                @if(!is_null($escuelas))
                    <x-utils.forms.select wire:model="escuela">
                        <option value="0">Solo de la facultad</option>
                        @foreach($escuelas as $esc)
                            <option value="{{$esc->id}}">De {{$esc->nombre}}</option>
                        @endforeach
                    </x-utils.forms.select>
                @endif
            </div>

            <x-utils.forms.select wire:model="semestre">
                <option value="0">Todos los semestres</option>
                @foreach($semestres as $semt)
                    <option value="{{$semt->id}}">{{$semt->nombre}}</option>
                @endforeach
            </x-utils.forms.select>
        </div>
    </div>

    <div class="mt-4">

        @if(!is_null($entidad))

            <h1 class="font-bold text-xl text-gray-800">{{ $entidad->nombre }}</h1>

            @if($entidad->indicadores_count)
                <h2 class="text-gray-600 text-sm mb-4">
                    Se encontró un total de {{$entidad->indicadores_count}} indicadores asignados
                </h2>

                <x-utils.tables.table>
                    @slot('head')
                        <x-utils.tables.head>N°</x-utils.tables.head>
                        <x-utils.tables.head>Código</x-utils.tables.head>
                        <x-utils.tables.head>Objetivo</x-utils.tables.head>
                        <x-utils.tables.head>Proceso</x-utils.tables.head>
                        <x-utils.tables.head>Medición</x-utils.tables.head>
                        <x-utils.tables.head>Realizado</x-utils.tables.head>
                    @endslot
                    @slot('body')
                        @foreach($entidad->indicadores as $i => $indicador)
                            <x-utils.tables.row>
                                <x-utils.tables.body class="text-xs">{{($i+1)}}</x-utils.tables.body>
                                <x-utils.tables.body class="text-xs">
                                    {{ $indicador->cod_ind_inicial }}
                                </x-utils.tables.body>
                                <x-utils.tables.body
                                    class="text-xs">{{ $indicador->objetivo }}</x-utils.tables.body>
                                <x-utils.tables.body
                                    class="text-xs">{{ $indicador->proceso->nombre }}</x-utils.tables.body>
                                <x-utils.tables.body class="whitespace-nowrap text-xs">
                                    {{ $indicador->medicion->nombre }}
                                </x-utils.tables.body>
                                <x-utils.tables.body class="whitespace-nowrap flex items-center text-center text-xs">
                                    {{ count($indicador->analisis) }} de {{ (6/$indicador->medicion->tiempo_meses) }}
                                    {{--                                    @if(count($indicador->analisis))--}}
                                    {{--                                        <a class="text-xs" target="_blank"--}}
                                    {{--                                           href="{{ route('reporte.detalle.pdf', [--}}
                                    {{--                                                    'indicadorable_id' => $indicador->pivot->indicadorable_id,--}}
                                    {{--                                                    'semestre' => $semestre,--}}
                                    {{--                                                    'facultad' => $facultad,--}}
                                    {{--                                                    'escuela' => $escuela--}}
                                    {{--                                                ]) }}">--}}
                                    {{--                                            <x-icons.document class="h-4 w-4mr-1 text-rose-600" stroke="1.5"/>--}}
                                    {{--                                        </a>--}}
                                    {{--                                    @endif--}}
                                </x-utils.tables.body>
                            </x-utils.tables.row>
                        @endforeach
                    @endslot
                </x-utils.tables.table>

            @else
                <div class="border border-gray-300 rounded-md mt-6">
                    <x-utils.message-no-items
                        title="No tiene indicadores asignados">
                        @slot('icon')
                            <svg class="text-gray-400" fill="currentColor" viewBox="0 0 24 24" width="24" height="24">
                                <path
                                    d="M3.604 3.089A.75.75 0 014 3.75V8.5h.75a.75.75 0 010 1.5h-3a.75.75 0 110-1.5h.75V5.151l-.334.223a.75.75 0 01-.832-1.248l1.5-1a.75.75 0 01.77-.037zM8.75 5.5a.75.75 0 000 1.5h11.5a.75.75 0 000-1.5H8.75zm0 6a.75.75 0 000 1.5h11.5a.75.75 0 000-1.5H8.75zm0 6a.75.75 0 000 1.5h11.5a.75.75 0 000-1.5H8.75zM5.5 15.75c0-.704-.271-1.286-.72-1.686a2.302 2.302 0 00-1.53-.564c-.535 0-1.094.178-1.53.565-.449.399-.72.982-.72 1.685a.75.75 0 001.5 0c0-.296.104-.464.217-.564A.805.805 0 013.25 15c.215 0 .406.072.533.185.113.101.217.268.217.565 0 .332-.069.48-.21.657-.092.113-.216.24-.403.419l-.147.14c-.152.144-.33.313-.52.504l-1.5 1.5a.75.75 0 00-.22.53v.25c0 .414.336.75.75.75H5A.75.75 0 005 19H3.31l.47-.47c.176-.176.333-.324.48-.465l.165-.156a5.98 5.98 0 00.536-.566c.358-.447.539-.925.539-1.593z"></path>
                            </svg>
                        @endslot
                    </x-utils.message-no-items>
                </div>
            @endif
        @else
            <div class="border border-gray-300 rounded-md">
                <x-utils.message-no-items
                    title="Aún no hay ningún registro que mostrar">
                    @slot('icon')
                        <svg class="text-gray-400" fill="currentColor" viewBox="0 0 24 24" width="24" height="24">
                            <path
                                d="M3.604 3.089A.75.75 0 014 3.75V8.5h.75a.75.75 0 010 1.5h-3a.75.75 0 110-1.5h.75V5.151l-.334.223a.75.75 0 01-.832-1.248l1.5-1a.75.75 0 01.77-.037zM8.75 5.5a.75.75 0 000 1.5h11.5a.75.75 0 000-1.5H8.75zm0 6a.75.75 0 000 1.5h11.5a.75.75 0 000-1.5H8.75zm0 6a.75.75 0 000 1.5h11.5a.75.75 0 000-1.5H8.75zM5.5 15.75c0-.704-.271-1.286-.72-1.686a2.302 2.302 0 00-1.53-.564c-.535 0-1.094.178-1.53.565-.449.399-.72.982-.72 1.685a.75.75 0 001.5 0c0-.296.104-.464.217-.564A.805.805 0 013.25 15c.215 0 .406.072.533.185.113.101.217.268.217.565 0 .332-.069.48-.21.657-.092.113-.216.24-.403.419l-.147.14c-.152.144-.33.313-.52.504l-1.5 1.5a.75.75 0 00-.22.53v.25c0 .414.336.75.75.75H5A.75.75 0 005 19H3.31l.47-.47c.176-.176.333-.324.48-.465l.165-.156a5.98 5.98 0 00.536-.566c.358-.447.539-.925.539-1.593z"></path>
                        </svg>
                    @endslot
                </x-utils.message-no-items>
            </div>
        @endif

        {{--        @if(count($indicadores))--}}


        {{--        @else--}}
        {{--                    <div class="border border-gray-300 rounded-md">--}}
        {{--                        <x-utils.message-no-items--}}
        {{--                            title="Aún no hay ningún registro que mostrar">--}}
        {{--                            @slot('icon')--}}
        {{--                                <svg class="text-gray-400" fill="currentColor" viewBox="0 0 24 24" width="24" height="24">--}}
        {{--                                    <path--}}
        {{--                                        d="M3.604 3.089A.75.75 0 014 3.75V8.5h.75a.75.75 0 010 1.5h-3a.75.75 0 110-1.5h.75V5.151l-.334.223a.75.75 0 01-.832-1.248l1.5-1a.75.75 0 01.77-.037zM8.75 5.5a.75.75 0 000 1.5h11.5a.75.75 0 000-1.5H8.75zm0 6a.75.75 0 000 1.5h11.5a.75.75 0 000-1.5H8.75zm0 6a.75.75 0 000 1.5h11.5a.75.75 0 000-1.5H8.75zM5.5 15.75c0-.704-.271-1.286-.72-1.686a2.302 2.302 0 00-1.53-.564c-.535 0-1.094.178-1.53.565-.449.399-.72.982-.72 1.685a.75.75 0 001.5 0c0-.296.104-.464.217-.564A.805.805 0 013.25 15c.215 0 .406.072.533.185.113.101.217.268.217.565 0 .332-.069.48-.21.657-.092.113-.216.24-.403.419l-.147.14c-.152.144-.33.313-.52.504l-1.5 1.5a.75.75 0 00-.22.53v.25c0 .414.336.75.75.75H5A.75.75 0 005 19H3.31l.47-.47c.176-.176.333-.324.48-.465l.165-.156a5.98 5.98 0 00.536-.566c.358-.447.539-.925.539-1.593z"></path>--}}
        {{--                                </svg>--}}
        {{--                            @endslot--}}
        {{--                        </x-utils.message-no-items>--}}
        {{--                    </div>--}}
        {{--        @endif--}}
    </div>
</div>
