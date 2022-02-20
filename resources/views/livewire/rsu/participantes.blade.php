<x-utils.card>
    @slot('header')
        <div class="flex justify-between items-center">
            <h3 class="font-bold tracking-wide text-gray-400">
                Participantes
            </h3>

            @if($es_responsable)
                <x-utils.buttons.ghost-button class="text-gray-500 hover:text-gray-700">
                    <x-icons.people class="h-5 w-5 mr-2" stroke="1.55"></x-icons.people>
                    Añadir
                </x-utils.buttons.ghost-button>
            @endif
        </div>
    @endslot


    @if($rsu->participantes_count > 0)
        <x-utils.tables.table>
            @slot('head')
                <x-utils.tables.head>Código</x-utils.tables.head>
                <x-utils.tables.head>Nombre</x-utils.tables.head>
                <x-utils.tables.head>Cargo</x-utils.tables.head>
                <x-utils.tables.head>Tipo</x-utils.tables.head>
                <x-utils.tables.head>Incorporación</x-utils.tables.head>
            @endslot
            @slot('body')
                @foreach($rsu->participantes as $participante)
                    <x-utils.tables.row>
                        <x-utils.tables.body class="font-semibold">
                            <a href="{{ route('rsu.show', [$participante->id]) }}"
                               class="hover:text-sky-600 hover:underline line-clamp-1">
                                {{ $participante->codigo_participante }}
                            </a>
                        </x-utils.tables.body>
                        <x-utils.tables.body>
                            Nombre Generico
                        </x-utils.tables.body>
                        <x-utils.tables.body>
                            <p class="{{ $participante->es_responsable ? 'font-bold':'' }}">
                                {{ $participante->es_responsable ? 'Responsable':'Participante' }}
                            </p>
                        </x-utils.tables.body>
                        <x-utils.tables.body>
                            {{ $participante->es_estudiante ? 'Estudiante':'Docente' }}
                        </x-utils.tables.body>
                        <x-utils.tables.body>
                            {{$participante->fecha_incorporacion->format('d-m-Y') }}
                        </x-utils.tables.body>
                    </x-utils.tables.row>
                @endforeach
            @endslot
        </x-utils.tables.table>
    @else
        <p>No hay participantes registrados</p>
    @endif

</x-utils.card>
