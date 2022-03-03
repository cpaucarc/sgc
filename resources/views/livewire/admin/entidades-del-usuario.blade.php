<div class="w-full md:w-2/3 mx-auto">

    @if(count($usuario->entidades) > 0)

        <div class="flex items-center justify-end mb-4">

            <x-utils.buttons.default wire:click="openModal" class="text-sm">
                Asignar entidades
            </x-utils.buttons.default>

        </div>

        <x-utils.tables.table>
            @slot('head')
                <x-utils.tables.head>N°</x-utils.tables.head>
                <x-utils.tables.head>Entidad</x-utils.tables.head>
                <x-utils.tables.head><span class="sr-only">Acciones</span></x-utils.tables.head>
            @endslot
            @slot('body')
                @foreach($usuario->entidades as $i => $entidad)
                    <x-utils.tables.row>
                        <x-utils.tables.body>{{ $i+1 }}</x-utils.tables.body>
                        <x-utils.tables.body>{{ $entidad->nombre }}</x-utils.tables.body>
                        <x-utils.tables.body>
                            <x-utils.buttons.danger class="text-sm"
                                                    onclick="eliminar('{{$entidad->nombre}}', {{$entidad->id}})">
                                <x-icons.delete class="h-4 w-4"/>
                            </x-utils.buttons.danger>
                        </x-utils.tables.body>
                    </x-utils.tables.row>
                @endforeach
            @endslot
        </x-utils.tables.table>
    @else
        <div class="border border-gray-300 rounded-md">
            <x-utils.message-no-items
                title="Este usuario no tiene entidades"
                text="Este usuario no tiene ninguna entidad asignada.">
                @slot('icon')
                    <svg class="text-gray-400" fill="currentColor" viewBox="0 0 24 24" width="24" height="24">
                        <path fill-rule="evenodd"
                              d="M3.5 8a5.5 5.5 0 118.596 4.547 9.005 9.005 0 015.9 8.18.75.75 0 01-1.5.045 7.5 7.5 0 00-14.993 0 .75.75 0 01-1.499-.044 9.005 9.005 0 015.9-8.181A5.494 5.494 0 013.5 8zM9 4a4 4 0 100 8 4 4 0 000-8z"></path>
                        <path
                            d="M17.29 8c-.148 0-.292.01-.434.03a.75.75 0 11-.212-1.484 4.53 4.53 0 013.38 8.097 6.69 6.69 0 013.956 6.107.75.75 0 01-1.5 0 5.193 5.193 0 00-3.696-4.972l-.534-.16v-1.676l.41-.209A3.03 3.03 0 0017.29 8z"></path>
                    </svg>
                @endslot

                <x-jet-button wire:click="openModal" class="text-sm">
                    Asignar entidades
                </x-jet-button>
            </x-utils.message-no-items>
        </div>
    @endif

    @if(!is_null($entidades))
        <x-jet-dialog-modal wire:model="open" maxWidth="lg">
            <x-slot name="title">
                <div class="flex justify-end w-full">
                    <x-utils.buttons.close-button wire:click="$set('open', false)"/>
                </div>
            </x-slot>

            <x-slot name="content">
                <div class="space-y-4">

                    <p class="font-light text-sm text-gray-600">
                        @if(count($selected))
                            {{ count($selected) }} {{ count($selected) == 1 ? 'entidad seleccionado' : 'entidades seleccionados' }}
                        @else
                            No haz seleccionado ninguna entidad
                        @endif
                    </p>

                    <x-utils.tables.table>
                        @slot('head')
                            <x-utils.tables.head>
                                <span class="sr-only">Seleccionar</span>
                            </x-utils.tables.head>
                            <x-utils.tables.head>Entidad</x-utils.tables.head>
                        @endslot
                        @slot('body')
                            @foreach($entidades as $entidad)
                                <x-utils.tables.row>
                                    <x-utils.tables.body>
                                        <x-utils.forms.checkbox wire:model="selected"
                                                                wire:loading.attr="disabled"
                                                                value="{{ $entidad->id }}"/>
                                    </x-utils.tables.body>
                                    <x-utils.tables.body class="text-xs">
                                        {{ $entidad->nombre }}
                                    </x-utils.tables.body>
                                </x-utils.tables.row>
                            @endforeach
                        @endslot
                    </x-utils.tables.table>
                    <x-jet-input-error for="selected"/>
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-jet-button
                    wire:click="asignarEntidades"
                    wire:target="asignarEntidades"
                    wire:loading.class="cursor-wait"
                    wire:loading.attr="disabled">
                    <x-icons.load wire:loading wire:target="asignarEntidades" class="h-5 w-5"/>
                    Guardar
                </x-jet-button>
            </x-slot>
        </x-jet-dialog-modal>
    @endif

</div>

@push('js')
    <script>
        function eliminar(nombre, id) {

            let res = confirm(`¿Desea quitar la entidad ${nombre} del usuario?`)

            if (res) {
                window.livewire.emit('eliminarEntidad', id);
            }
        }
    </script>
@endpush
