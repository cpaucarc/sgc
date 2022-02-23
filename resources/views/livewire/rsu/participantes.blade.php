<div class="space-y-2">

    <div class="flex justify-between items-center">
        <h3 class="font-semibold tracking-wide text-gray-400">
            Participantes
        </h3>

        @if($es_responsable)
            <x-utils.buttons.default class="text-xs">
                <x-icons.people class="h-4 w-4 mr-1" stroke="1.5"></x-icons.people>
                Añadir
            </x-utils.buttons.default>
        @endif
    </div>

    @if($rsu->participantes_count > 0)
        <x-utils.tables.table>
            @slot('head')
                <x-utils.tables.head>Código</x-utils.tables.head>
                <x-utils.tables.head>Cargo</x-utils.tables.head>
                <x-utils.tables.head>Tipo</x-utils.tables.head>
                <x-utils.tables.head>Incorporación</x-utils.tables.head>
            @endslot
            @slot('body')
                @foreach($rsu->participantes as $participante)
                    <x-utils.tables.row>
                        <x-utils.tables.body>
                            <x-utils.links.basic href="{{ route('rsu.show', [$participante->id]) }}" class="text-xs">
                                {{ $participante->codigo_participante }}
                            </x-utils.links.basic>
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
        <p class="font-bold">No hay participantes registrados</p>
    @endif

</div>
