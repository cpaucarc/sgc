<div>

    @if(count($indicadorable->analisis) !== 0)
        <div class="flex items-center justify-between mb-4">
            <p class="ml-1 text-gray-600 text-sm">
                Hay&nbsp;<strong>{{ count($indicadorable->analisis) }}</strong>&nbsp;análisis de este
                indicador
            </p>

            <x-jet-button wire:click="openModal">
                <x-icons.plus class="flex-shrink-0 h-5 w-5 mr-1" stroke="1.5"/>
                Nuevo
            </x-jet-button>
        </div>
    @endif

    @if(count($indicadorable->analisis) === 0)
        <x-indicador.mensaje-no-analisis>
            <x-jet-button wire:click="openModal">
                Crear el primer análisis
            </x-jet-button>
        </x-indicador.mensaje-no-analisis>
    @else
        <x-utils.tables.table>
            @slot('head')
                <x-utils.tables.head>Periodo</x-utils.tables.head>
                @if($indicadorable->indicador->titulo_interes)
                    <x-utils.tables.head>{{ $indicadorable->indicador->titulo_interes }}</x-utils.tables.head>
                @endif
                @if($indicadorable->indicador->titulo_total)
                    <x-utils.tables.head>{{ $indicadorable->indicador->titulo_total }}</x-utils.tables.head>
                @endif
                <x-utils.tables.head>
                    {{ $indicadorable->indicador->titulo_total
                            ? 'Resultado'
                            : $indicadorable->indicador->titulo_resultado
                    }}
                </x-utils.tables.head>
                <x-utils.tables.head>Mínimo</x-utils.tables.head>
                <x-utils.tables.head>Satisfactorio</x-utils.tables.head>
                <x-utils.tables.head>Sobresaliente</x-utils.tables.head>
                <x-utils.tables.head>Creación</x-utils.tables.head>
                <x-utils.tables.head>
                    <span class=" sr-only">Acciones</span>
                </x-utils.tables.head>
            @endslot
            @slot('body')
                @foreach($indicadorable->analisis as $analisis)
                    <x-utils.tables.row>
                        <x-utils.tables.body class="whitespace-nowrap">
                            {{ $analisis->fecha_medicion_inicio->format('d/m/Y') }}
                            a
                            {{ $analisis->fecha_medicion_fin->format('d/m/Y') }}
                        </x-utils.tables.body>
                        @if($indicadorable->indicador->titulo_interes)
                            <x-utils.tables.body>
                                {{ $analisis->interes }}
                            </x-utils.tables.body>
                        @endif
                        @if($indicadorable->indicador->titulo_total)
                            <x-utils.tables.body>
                                {{ $analisis->total }}
                            </x-utils.tables.body>
                        @endif
                        <x-utils.tables.body class="font-bold">
                            {{ $analisis->resultado }}
                        </x-utils.tables.body>
                        <x-utils.tables.body>
                            {{ floatval($analisis->minimo) }}
                        </x-utils.tables.body>
                        <x-utils.tables.body>
                            {{ floatval($analisis->satisfactorio) }}
                        </x-utils.tables.body>
                        <x-utils.tables.body>
                            {{ floatval($analisis->sobresaliente) }}
                        </x-utils.tables.body>
                        <x-utils.tables.body class="whitespace-nowrap">
                            @if(today()->diffInDays($analisis->created_at) <= 7)
                                {{ $analisis->created_at->diffForHumans() }}
                            @else
                                {{ $analisis->created_at->format('d/m/Y') }}
                            @endif
                        </x-utils.tables.body>
                        <x-utils.tables.body>
                            abc
                        </x-utils.tables.body>
                    </x-utils.tables.row>
                @endforeach
            @endslot
        </x-utils.tables.table>

        <div class="mt-4 flex justify-end">
            <x-utils.buttons.default wire:click="openGraph" class="group text-sm">
                <svg class="h-5 w-5 mr-1 group-hover:text-gray-600" viewBox="0 0 20 20" fill="currentColor">
                    <path
                        d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"/>
                </svg>
                Mostrar gráfico
            </x-utils.buttons.default>
        </div>

        <livewire:indicador.grafico-general indicadorable_id="{{ $indicadorable->id }}"/>

    @endif

    <livewire:indicador.nuevo-analisis indicadorable_id="{{ $indicadorable->id }}"
                                       tipo="{{ $tipo }}"
                                       uuid="{{$uuid}}"
    />

</div>
