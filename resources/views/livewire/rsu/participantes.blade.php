<div class="space-y-2">

    <div class="flex justify-between items-center">
        <h3 class="font-bold tracking-wide text-gray-600">
            Participantes
        </h3>

        @if($es_responsable and $rsu->participantes_count > 0)
            <x-utils.buttons.default class="text-sm">
                <x-icons.people class="h-4 w-4 mr-1" stroke="1.5"></x-icons.people>
                Añadir
            </x-utils.buttons.default>
        @endif
    </div>

    @if($rsu->participantes_count > 0)
        <x-utils.tables.table>
            @slot('head')
                <x-utils.tables.head>DNI Participante</x-utils.tables.head>
                <x-utils.tables.head>Cargo</x-utils.tables.head>
                <x-utils.tables.head>Tipo</x-utils.tables.head>
                <x-utils.tables.head>Incorporación</x-utils.tables.head>
            @endslot
            @slot('body')
                @foreach($rsu->participantes as $participante)
                    <x-utils.tables.row>
                        <x-utils.tables.body>
                            <x-utils.links.basic href="{{ route('rsu.show', [$participante->id]) }}" class="text-sm">
                                {{ $participante->dni_participante }}
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
                            {{$participante->fecha_incorporacion->format('d/m/Y') }}
                        </x-utils.tables.body>
                    </x-utils.tables.row>
                @endforeach
            @endslot
        </x-utils.tables.table>
    @else
        <div class="border border-gray-300 rounded-md">
            <x-utils.message-no-items
                title="Aún no hay ningún participante"
                text="Añada a más participantes de la Responsabilidad Social.">
                @slot('icon')
                    <svg class="text-gray-400" fill="currentColor" viewBox="0 0 24 24" width="24" height="24">
                        <path fill-rule="evenodd"
                              d="M3.5 8a5.5 5.5 0 118.596 4.547 9.005 9.005 0 015.9 8.18.75.75 0 01-1.5.045 7.5 7.5 0 00-14.993 0 .75.75 0 01-1.499-.044 9.005 9.005 0 015.9-8.181A5.494 5.494 0 013.5 8zM9 4a4 4 0 100 8 4 4 0 000-8z"></path>
                        <path
                            d="M17.29 8c-.148 0-.292.01-.434.03a.75.75 0 11-.212-1.484 4.53 4.53 0 013.38 8.097 6.69 6.69 0 013.956 6.107.75.75 0 01-1.5 0 5.193 5.193 0 00-3.696-4.972l-.534-.16v-1.676l.41-.209A3.03 3.03 0 0017.29 8z"></path>
                    </svg>
                @endslot

                @if($es_responsable)
                    <x-jet-button wire:click="openModal" class="text-sm">
                        Añadir participantes
                    </x-jet-button>
                @endif
            </x-utils.message-no-items>
        </div>
    @endif

</div>
