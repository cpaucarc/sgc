<div>

    @if(count($usuario->roles) > 0)

        <div class="flex items-center justify-end mb-4">

            <x-utils.buttons.default wire:click="openModal" class="text-sm">
                Asignar roles
            </x-utils.buttons.default>

        </div>

        <x-utils.tables.table>
            @slot('head')
                <x-utils.tables.head>N°</x-utils.tables.head>
                <x-utils.tables.head>Rol</x-utils.tables.head>
                <x-utils.tables.head><span class="sr-only">Acciones</span></x-utils.tables.head>
            @endslot
            @slot('body')
                @foreach($usuario->roles as $i => $rol)
                    <x-utils.tables.row>
                        <x-utils.tables.body>{{ $i+1 }}</x-utils.tables.body>
                        <x-utils.tables.body>{{ $rol->name }}</x-utils.tables.body>
                        <x-utils.tables.body>
                            <x-utils.buttons.danger class="text-sm"
                                                    onclick="eliminarRol('{{$rol->name}}')">
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
                text="Este usuario no tiene ningún rol asignado.">
                @slot('icon')
                    <svg class="text-gray-400" fill="currentColor" viewBox="0 0 24 24" width="24" height="24">
                        <path fill-rule="evenodd"
                              d="M12.077 2.563a.25.25 0 00-.154 0L3.673 5.24a.249.249 0 00-.173.237V10.5c0 5.461 3.28 9.483 8.43 11.426a.2.2 0 00.14 0c5.15-1.943 8.43-5.965 8.43-11.426V5.476a.25.25 0 00-.173-.237l-8.25-2.676zm-.617-1.426a1.75 1.75 0 011.08 0l8.25 2.675A1.75 1.75 0 0122 5.476V10.5c0 6.19-3.77 10.705-9.401 12.83a1.699 1.699 0 01-1.198 0C5.771 21.204 2 16.69 2 10.5V5.476c0-.76.49-1.43 1.21-1.664l8.25-2.675zM13 12.232A2 2 0 0012 8.5a2 2 0 00-1 3.732V15a1 1 0 102 0v-2.768z"></path>
                    </svg>
                @endslot

                <x-jet-button wire:click="openModal" class="text-sm">
                    Asignar roles
                </x-jet-button>
            </x-utils.message-no-items>
        </div>
    @endif

    @if(!is_null($roles))
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
                            No haz seleccionado ningún rol
                        @endif
                    </p>

                    <x-utils.tables.table>
                        @slot('head')
                            <x-utils.tables.head>
                                <span class="sr-only">Seleccionar</span>
                            </x-utils.tables.head>
                            <x-utils.tables.head>Rol</x-utils.tables.head>
                        @endslot
                        @slot('body')
                            @foreach($roles as $rol)
                                <x-utils.tables.row>
                                    <x-utils.tables.body>
                                        <x-utils.forms.checkbox wire:model="selected"
                                                                wire:loading.attr="disabled"
                                                                value="{{ $rol->name }}"/>
                                    </x-utils.tables.body>
                                    <x-utils.tables.body class="text-xs">
                                        {{ $rol->name }}
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
                    wire:click="asignarRol"
                    wire:target="asignarRol"
                    wire:loading.class="cursor-wait"
                    wire:loading.attr="disabled">
                    <x-icons.load wire:loading wire:target="asignarRol" class="h-5 w-5"/>
                    Guardar
                </x-jet-button>
            </x-slot>
        </x-jet-dialog-modal>
    @endif

</div>

@push('js')
    <script>
        function eliminarRol(nombre) {

            let res = confirm(`¿Desea quitar el rol ${nombre} del usuario?\nNota: Se eliminarán las entidades correspondientes`)
            console.log(res, nombre)
            if (res) {
                window.livewire.emit('eliminarRol', nombre);
                alert('eliminado')
            }
        }
    </script>
@endpush
