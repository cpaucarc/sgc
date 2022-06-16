<div>
    @if(count($usuario->entidades) > 0)

        <div class="flex items-center justify-end mb-4">
            <x-utils.buttons.default wire:click="openModal" class="text-sm">
                Asignar roles y entidades
            </x-utils.buttons.default>
        </div>

        <x-utils.tables.table>
            @slot('head')
                <x-utils.tables.head>N°</x-utils.tables.head>
                <x-utils.tables.head>Rol</x-utils.tables.head>
                <x-utils.tables.head>Entidad</x-utils.tables.head>
                <x-utils.tables.head><span class="sr-only">Acciones</span></x-utils.tables.head>
            @endslot
            @slot('body')
                @foreach($usuario->entidades as $i => $entidad)
                    <x-utils.tables.row>
                        <x-utils.tables.body>{{ $i+1 }}</x-utils.tables.body>
                        <x-utils.tables.body>{{ $entidad->rol->name }}</x-utils.tables.body>
                        <x-utils.tables.body>{{ $entidad->nombre }}</x-utils.tables.body>
                        <x-utils.tables.body>
                            <x-utils.buttons.danger class="text-sm"
                                                    onclick="eliminarRol({{ $entidad->id }}, '{{ $entidad->nombre }}', {{ $entidad->role_id }}, '{{ $entidad->rol->name }}')">
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
                    Asignar roles y entidades
                </x-jet-button>
            </x-utils.message-no-items>
        </div>
    @endif

    @if(!is_null($roles))
        <x-jet-dialog-modal wire:model="open" maxWidth="4xl">
            <x-slot name="title">
                <div class="flex justify-between w-full">
                    <h1 class="font-bold text-gray-700">
                        Asignar roles y entidades al usuario
                    </h1>
                    <x-utils.buttons.close-button wire:click="$set('open', false)"/>
                </div>
            </x-slot>

            <x-slot name="content">

                <div class="grid grid-cols-2 gap-x-4 items-start">
                    {{-- Sección de roles --}}
                    <section class="border border-gray-300 divide-y divide-gray-300 rounded-md text-gray-700">
                        <header class="px-3 py-2 rounded-t-md bg-stone-100">
                            <h2 class="font-bold text-gray-600 mr-1">Sección de Roles</h2>
                            <p class="text-sm">
                                @if(count($roles_selected))
                                    (
                                    {{ count($roles_selected) }} {{ count($roles_selected) == 1 ? 'rol seleccionado' : 'roles seleccionados' }}
                                    )
                                @else
                                    (No haz seleccionado ningún rol)
                                @endif
                            </p>
                        </header>

                        <div class="divide-y divide-gray-300">
                            <table class="divide-y divide-gray-300 w-full overflow-hidden">
                                <tbody class="text-sm text-gray-700 divide-y divide-gray-300">
                                @foreach($roles as $rol)
                                    <tr class="hover:bg-gray-100 soft-transition">
                                        <td class="px-3 py-1.5 text-left ">
                                            <x-utils.forms.checkbox wire:model="roles_selected"
                                                                    wire:loading.attr="disabled"
                                                                    value="{{ $rol->name }}"/>
                                        </td>
                                        <td class="px-3 py-1.5 text-left">{{ $rol->name }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </section>

                    {{-- Sección de entidades --}}
                    <section class="border border-gray-300 divide-y divide-gray-300 rounded-md text-gray-700">
                        <header class="px-3 py-2 rounded-t-md bg-stone-100">
                            <h2 class="font-bold text-gray-600 mr-1">Sección de Entidades</h2>
                            <p class="text-sm">
                                @if(count($entidades_selected))
                                    (
                                    {{ count($entidades_selected) }} {{ count($entidades_selected) == 1 ? 'entidad seleccionado' : 'entidades seleccionados' }}
                                    )
                                @else
                                    (No haz seleccionado ninguna entidad)
                                @endif
                            </p>
                        </header>

                        <div class="divide-y divide-gray-300">
                            @if($entidades)
                                <table class="divide-y divide-gray-300 w-full overflow-hidden">
                                    <tbody class="text-sm text-gray-700 divide-y divide-gray-300">
                                    @foreach($entidades as $ent)
                                        <tr class="hover:bg-gray-100 soft-transition">
                                            <td class="px-3 py-1.5 text-left">
                                                <x-utils.forms.checkbox wire:model="entidades_selected"
                                                                        wire:loading.attr="disabled"
                                                                        value="{{ $ent->id }}"/>
                                            </td>
                                            <td class="px-3 py-1.5 text-left">{{ $ent->nombre }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="w-full grid place-items-center py-8">
                                    <div class="w-1/2 flex flex-col justify-between items-center">
                                        <svg class="text-gray-500 fill-current mx-auto" viewBox="0 0 24 24" width="24"
                                             height="24">
                                            <path
                                                d="M3.5 3.75a.25.25 0 01.25-.25h13.5a.25.25 0 01.25.25v10a.75.75 0 001.5 0v-10A1.75 1.75 0 0017.25 2H3.75A1.75 1.75 0 002 3.75v16.5c0 .966.784 1.75 1.75 1.75h7a.75.75 0 000-1.5h-7a.25.25 0 01-.25-.25V3.75z"></path>
                                            <path
                                                d="M6.25 7a.75.75 0 000 1.5h8.5a.75.75 0 000-1.5h-8.5zm-.75 4.75a.75.75 0 01.75-.75h4.5a.75.75 0 010 1.5h-4.5a.75.75 0 01-.75-.75zm16.28 4.53a.75.75 0 10-1.06-1.06l-4.97 4.97-1.97-1.97a.75.75 0 10-1.06 1.06l2.5 2.5a.75.75 0 001.06 0l5.5-5.5z"></path>
                                        </svg>
                                        <p class="text-gray-800 leading-5 text-center mt-2">
                                            Seleccione uno o más roles para ver las entidades.
                                        </p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </section>
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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function eliminarRol(entidad_id, entidad_nombre, rol_id, rol_nombre) {
            let res = confirm(`¿Desea quitar la entidad ${entidad_nombre} del usuario?\nNota: Se eliminarán los roles correspondientes`)
            if (res) {
                window.livewire.emit('eliminarRol', entidad_id, entidad_nombre, rol_id, rol_nombre);
            }
        }

        Livewire.on('guardado', msg => {
            Swal.fire({
                icon: 'success',
                title: '',
                text: msg,
            });
        });

        Livewire.on('error', msg => {
            Swal.fire({
                icon: 'error',
                title: '',
                text: msg,
            });
        });
    </script>
@endpush
