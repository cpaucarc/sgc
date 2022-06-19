<div>
    <div class="flex justify-between items-center mb-4">
        <x-utils.forms.search-input wire:model.debounce.500ms="search"/>
        @if(!is_null($escuelas))
            <x-utils.forms.select wire:model="escuela_seleccionado">
                <option value="0">Todos</option>
                @foreach($escuelas as $esc)
                    <option value="{{$esc->id}}">{{$esc->nombre}}</option>
                @endforeach
            </x-utils.forms.select>
        @endif
    </div>
    @if(count($titulados))
        <x-utils.tables.table>
            @slot('head')
                <x-utils.tables.head>N°</x-utils.tables.head>
                <x-utils.tables.head>DNI del Estudiante</x-utils.tables.head>
                <x-utils.tables.head>Programa</x-utils.tables.head>
                <x-utils.tables.head>Fecha de Registro</x-utils.tables.head>
            @endslot
            @slot('body')
                @foreach($titulados as $i => $titulado)
                    <x-utils.tables.row>
                        <x-utils.tables.body>
                            {{$i+1}}
                        </x-utils.tables.body>
                        <x-utils.tables.body>
                            <x-utils.buttons.invisible
                                wire:click="mostrarDatos('{{ $titulado->dni_estudiante }}')"
                                class="text-sm">
                                {{ $titulado->dni_estudiante }}
                            </x-utils.buttons.invisible>
                        </x-utils.tables.body>
                        <x-utils.tables.body>
                            {{ $titulado->escuela->nombre }}
                        </x-utils.tables.body>
                        <x-utils.tables.body>
                            {{ $titulado->created_at->format('d-m-Y h:i a') }}
                        </x-utils.tables.body>
                    </x-utils.tables.row>
                @endforeach
            @endslot
        </x-utils.tables.table>

        <div class="mt-4">
            {{ $titulados->links() }}
        </div>
    @else
        <div class="border border-gray-300 rounded-md">
            <x-utils.message-no-items
                title="Aún no hay ningún bachiller"
                text="No se ha encontrado ningún dato que mostrar.">
                @slot('icon')
                    <svg class="text-gray-400" fill="currentColor" viewBox="0 0 24 24" width="24" height="24">
                        <path fill-rule="evenodd"
                              d="M3.5 8a5.5 5.5 0 118.596 4.547 9.005 9.005 0 015.9 8.18.75.75 0 01-1.5.045 7.5 7.5 0 00-14.993 0 .75.75 0 01-1.499-.044 9.005 9.005 0 015.9-8.181A5.494 5.494 0 013.5 8zM9 4a4 4 0 100 8 4 4 0 000-8z"></path>
                        <path
                            d="M17.29 8c-.148 0-.292.01-.434.03a.75.75 0 11-.212-1.484 4.53 4.53 0 013.38 8.097 6.69 6.69 0 013.956 6.107.75.75 0 01-1.5 0 5.193 5.193 0 00-3.696-4.972l-.534-.16v-1.676l.41-.209A3.03 3.03 0 0017.29 8z"></path>
                    </svg>
                @endslot
            </x-utils.message-no-items>
        </div>
    @endif

    <x-jet-dialog-modal wire:model="open" maxWidth="xl">
        <x-slot name="title">
            <h1 class="font-bold text-gray-700">
                Datos del estudiante
            </h1>
            <x-utils.buttons.close-button wire:click="$set('open', false)"/>
        </x-slot>

        <x-slot name="content">
            @if($datos_estudiante)
                <x-utils.oge-datos-basicos :persona="$datos_estudiante"/>
            @else
                <x-utils.oge-no-datos/>
            @endif
        </x-slot>
    </x-jet-dialog-modal>
</div>
