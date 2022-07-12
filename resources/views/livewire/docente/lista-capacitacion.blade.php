<div>
    <div class="flex justify-between items-center gap-x-8 mb-4">
        <h1 class="text-zinc-800 text-xl font-bold">Información de capacitaciones</h1>
        <div class="flex justify-between items-center gap-x-2">
            <x-utils.forms.select class="w-52" wire:model="semestre">
                <option value="0">Todos las semestres</option>
                @foreach($semestres as $smt)
                    <option value="{{ $smt->id }}">{{$smt->nombre}}</option>
                @endforeach
            </x-utils.forms.select>

            @if(count($capacitaciones))
                <livewire:docente.agregar-capacitacion/>
            @endif
        </div>
    </div>

    @if(count($capacitaciones))
        <x-utils.tables.table>
            @slot('head')
                <x-utils.tables.head>N°</x-utils.tables.head>
                <x-utils.tables.head>Nombre</x-utils.tables.head>
                <x-utils.tables.head>Inicio</x-utils.tables.head>
                <x-utils.tables.head>Fin</x-utils.tables.head>
                <x-utils.tables.head>Departamento</x-utils.tables.head>
                <x-utils.tables.head>Semestre</x-utils.tables.head>
                <x-utils.tables.head><span class="sr-only">Acciones</span></x-utils.tables.head>
            @endslot
            @slot('body')
                @foreach($capacitaciones as $i=>$capacitacion)
                    <x-utils.tables.row>
                        <x-utils.tables.body>
                            {{($i+1)}}
                        </x-utils.tables.body>
                        <x-utils.tables.body>
                            {{$capacitacion->nombre}}
                        </x-utils.tables.body>
                        <x-utils.tables.body class="whitespace-nowrap">
                            {{$capacitacion->fecha_inicio}}
                        </x-utils.tables.body>
                        <x-utils.tables.body class="whitespace-nowrap">
                            {{$capacitacion->fecha_fin}}
                        </x-utils.tables.body>
                        <x-utils.tables.body>
                            {{$capacitacion->departamento->nombre}}
                        </x-utils.tables.body>
                        <x-utils.tables.body class="text-center">
                            {{$capacitacion->semestre->nombre}}
                        </x-utils.tables.body>
                        <x-utils.tables.body>
                            <x-utils.buttons.danger class="text-sm"
                                                    onclick="eliminar({{ $capacitacion->id }},'{{$capacitacion->nombre}}')">
                                <x-icons.delete class="h-4 w-4" stroke="1.5"/>
                            </x-utils.buttons.danger>
                        </x-utils.tables.body>
                    </x-utils.tables.row>
                @endforeach
            @endslot
        </x-utils.tables.table>
        <div class="mt-4">
            {{ $capacitaciones->links() }}
        </div>
    @else
        <div class="border border-gray-300 rounded-md">
            <x-utils.message-no-items
                title="Aún no hay ninguna capacitación registrada"
                text="Aqui podrá ver la lista de capacitaciones realizadas a los docentes.">
                @slot('icon')
                    <svg class="text-gray-400 fill-current" viewBox="0 0 24 24" width="24" height="24">
                        <path fill-rule="evenodd"
                              d="M3.5 8a5.5 5.5 0 118.596 4.547 9.005 9.005 0 015.9 8.18.75.75 0 01-1.5.045 7.5 7.5 0 00-14.993 0 .75.75 0 01-1.499-.044 9.005 9.005 0 015.9-8.181A5.494 5.494 0 013.5 8zM9 4a4 4 0 100 8 4 4 0 000-8z"></path>
                        <path
                            d="M17.29 8c-.148 0-.292.01-.434.03a.75.75 0 11-.212-1.484 4.53 4.53 0 013.38 8.097 6.69 6.69 0 013.956 6.107.75.75 0 01-1.5 0 5.193 5.193 0 00-3.696-4.972l-.534-.16v-1.676l.41-.209A3.03 3.03 0 0017.29 8z"></path>
                    </svg>
                @endslot
                <div class="text-left">
                    <livewire:docente.agregar-capacitacion/>
                </div>
            </x-utils.message-no-items>
        </div>
    @endif

    @push('js')
        <script>
            function eliminar(id, name) {
                let res = confirm('¿Desea eliminar el registro de capacitaciones ' + name + '?')

                if (res) {
                    window.livewire.emit('eliminar', id);
                }
            }

            Livewire.on('error', function eliminar(msg) {
                alert(msg)
            });
        </script>
    @endpush
</div>
