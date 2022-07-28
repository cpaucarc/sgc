<div>

    <div class="flex items-center justify-end mb-4">
        <x-utils.buttons.default wire:click="openModal" class="text-sm">
            Asignar indicador
        </x-utils.buttons.default>
    </div>


    <div class="grid grid-cols-2 gap-x-4">
        {{-- Facultades --}}
        <div class="col-span-1">
            @if(count($indicador_en_facultades)>0)
                <x-utils.tables.table>
                    @slot('head')
                        <x-utils.tables.head>Código</x-utils.tables.head>
                        <x-utils.tables.head>Mínimo</x-utils.tables.head>
                        <x-utils.tables.head>Sobresaliente</x-utils.tables.head>
                        <x-utils.tables.head><span class="sr-only">Acciones</span></x-utils.tables.head>
                    @endslot
                    @slot('body')
                        @foreach($indicador_en_facultades as $ind_fac)
                            <x-utils.tables.row>
                                <x-utils.tables.body>{{ $ind_fac->cod_ind_final }}</x-utils.tables.body>
                                <x-utils.tables.body>{{ $ind_fac->minimo }}</x-utils.tables.body>
                                <x-utils.tables.body>{{ $ind_fac->sobresaliente }}</x-utils.tables.body>
                                <x-utils.tables.body>
                                    <x-utils.buttons.danger class="text-sm" onclick="">
                                        <x-icons.delete class="h-4 w-4"/>
                                    </x-utils.buttons.danger>
                                </x-utils.tables.body>
                            </x-utils.tables.row>
                        @endforeach
                    @endslot
                </x-utils.tables.table>
            @else
                <div class="border border-zinc-300 rounded-md">
                    <x-utils.message-no-items
                        text="Este indicador no está asignado a una facultad.">
                        @slot('icon')
                            <svg class="text-zinc-400" fill="currentColor" viewBox="0 0 24 24" width="24" height="24">
                                <path fill-rule="evenodd"
                                      d="M12.077 2.563a.25.25 0 00-.154 0L3.673 5.24a.249.249 0 00-.173.237V10.5c0 5.461 3.28 9.483 8.43 11.426a.2.2 0 00.14 0c5.15-1.943 8.43-5.965 8.43-11.426V5.476a.25.25 0 00-.173-.237l-8.25-2.676zm-.617-1.426a1.75 1.75 0 011.08 0l8.25 2.675A1.75 1.75 0 0122 5.476V10.5c0 6.19-3.77 10.705-9.401 12.83a1.699 1.699 0 01-1.198 0C5.771 21.204 2 16.69 2 10.5V5.476c0-.76.49-1.43 1.21-1.664l8.25-2.675zM13 12.232A2 2 0 0012 8.5a2 2 0 00-1 3.732V15a1 1 0 102 0v-2.768z"></path>
                            </svg>
                        @endslot
                    </x-utils.message-no-items>
                </div>
            @endif
        </div>

        {{-- Escuelas --}}
        <div class="col-span-1">
            @if(count($indicador_en_escuelas)>0)
                <x-utils.tables.table>
                    @slot('head')
                        <x-utils.tables.head>Código</x-utils.tables.head>
                        <x-utils.tables.head>Mínimo</x-utils.tables.head>
                        <x-utils.tables.head>Sobresaliente</x-utils.tables.head>
                        <x-utils.tables.head><span class="sr-only">Acciones</span></x-utils.tables.head>
                    @endslot
                    @slot('body')
                        @foreach($indicador_en_escuelas as $ind_esc)
                            <x-utils.tables.row>
                                <x-utils.tables.body>{{ $ind_esc->cod_ind_final }}</x-utils.tables.body>
                                <x-utils.tables.body>{{ $ind_esc->minimo }}</x-utils.tables.body>
                                <x-utils.tables.body>{{ $ind_esc->sobresaliente }}</x-utils.tables.body>
                                <x-utils.tables.body>
                                    <x-utils.buttons.danger class="text-sm" onclick="">
                                        <x-icons.delete class="h-4 w-4"/>
                                    </x-utils.buttons.danger>
                                </x-utils.tables.body>
                            </x-utils.tables.row>
                        @endforeach
                    @endslot
                </x-utils.tables.table>
            @else
                <div class="border border-zinc-300 rounded-md">
                    <x-utils.message-no-items
                        text="Este indicador no está asignado a un programa de estudios.">
                        @slot('icon')
                            <svg class="text-zinc-400" fill="currentColor" viewBox="0 0 24 24" width="24" height="24">
                                <path fill-rule="evenodd"
                                      d="M12.077 2.563a.25.25 0 00-.154 0L3.673 5.24a.249.249 0 00-.173.237V10.5c0 5.461 3.28 9.483 8.43 11.426a.2.2 0 00.14 0c5.15-1.943 8.43-5.965 8.43-11.426V5.476a.25.25 0 00-.173-.237l-8.25-2.676zm-.617-1.426a1.75 1.75 0 011.08 0l8.25 2.675A1.75 1.75 0 0122 5.476V10.5c0 6.19-3.77 10.705-9.401 12.83a1.699 1.699 0 01-1.198 0C5.771 21.204 2 16.69 2 10.5V5.476c0-.76.49-1.43 1.21-1.664l8.25-2.675zM13 12.232A2 2 0 0012 8.5a2 2 0 00-1 3.732V15a1 1 0 102 0v-2.768z"></path>
                            </svg>
                        @endslot
                    </x-utils.message-no-items>
                </div>
            @endif
        </div>
    </div>

    @if(!is_null($facultades_not_indicador) or !is_null($escuelas_not_indicador))
        <x-jet-dialog-modal wire:model="open" maxWidth="4xl">
            <x-slot name="title">
                <div class="flex justify-between w-full">
                    <h1 class="font-bold text-zinc-700">
                        Asignar el indicador a facultades y/o escuela
                    </h1>
                    <x-utils.buttons.close-button wire:click="$set('open', false)"/>
                </div>
            </x-slot>

            <x-slot name="content">

                <div class="grid grid-cols-2 gap-x-4 items-start">
                    {{-- Sección de facultad --}}
                    <section class="border border-zinc-300 divide-y divide-zinc-300 rounded-md text-zinc-700">
                        <header class="px-3 py-2 rounded-t-md bg-stone-100">
                            <h2 class="font-bold text-zinc-600 mr-1">Sección de Facultades</h2>
                            <p class="text-sm">
                                @if(count($facultades_selected))
                                    (
                                    {{ count($facultades_selected) }} {{ count($facultades_selected) == 1 ? 'facultad seleccionado' : 'facultades seleccionados' }}
                                    )
                                @else
                                    (No haz seleccionado ninguna facultad)
                                @endif
                            </p>
                        </header>

                        <div class="divide-y divide-zinc-300">
                            <table class="divide-y divide-zinc-300 w-full overflow-hidden">
                                <tbody class="text-sm text-zinc-700 divide-y divide-zinc-300">
                                @foreach($facultades_not_indicador as $facultad)
                                    <tr class="hover:bg-zinc-100 soft-transition">
                                        <td class="px-3 py-1.5 text-left ">
                                            <x-utils.forms.checkbox wire:model="facultades_selected"
                                                                    wire:loading.attr="disabled"
                                                                    value="{{ $facultad->id }}"/>
                                        </td>
                                        <td class="px-3 py-1.5 text-left">{{ $facultad->nombre }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </section>

                    {{-- Sección de entidades --}}
                    <section class="border border-zinc-300 divide-y divide-zinc-300 rounded-md text-zinc-700">
                        <header class="px-3 py-2 rounded-t-md bg-stone-100">
                            <h2 class="font-bold text-zinc-600 mr-1">Sección de Entidades</h2>
                            <p class="text-sm">
                                @if(count($escuelas_selected))
                                    (
                                    {{ count($escuelas_selected) }} {{ count($escuelas_selected) == 1 ? 'programa de estudio seleccionado' : 'programa des estudios seleccionados' }}
                                    )
                                @else
                                    (No haz seleccionado ninguna escuela)
                                @endif
                            </p>
                        </header>

                        <div class="divide-y divide-zinc-300">
                            @if($escuelas_not_indicador)
                                <table class="divide-y divide-zinc-300 w-full overflow-hidden">
                                    <tbody class="text-sm text-zinc-700 divide-y divide-zinc-300">
                                    @foreach($escuelas_not_indicador as $escuelas)
                                        <tr class="hover:bg-zinc-100 soft-transition">
                                            <td class="px-3 py-1.5 text-left">
                                                <x-utils.forms.checkbox wire:model="escuelas_selected"
                                                                        wire:loading.attr="disabled"
                                                                        value="{{ $escuelas->id }}"/>
                                            </td>
                                            <td class="px-3 py-1.5 text-left">{{ $escuelas->nombre }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="w-full grid place-items-center py-8">
                                    <div class="w-1/2 flex flex-col justify-between items-center">
                                        <svg class="text-zinc-500 fill-current mx-auto" viewBox="0 0 24 24" width="24"
                                             height="24">
                                            <path
                                                d="M3.5 3.75a.25.25 0 01.25-.25h13.5a.25.25 0 01.25.25v10a.75.75 0 001.5 0v-10A1.75 1.75 0 0017.25 2H3.75A1.75 1.75 0 002 3.75v16.5c0 .966.784 1.75 1.75 1.75h7a.75.75 0 000-1.5h-7a.25.25 0 01-.25-.25V3.75z"></path>
                                            <path
                                                d="M6.25 7a.75.75 0 000 1.5h8.5a.75.75 0 000-1.5h-8.5zm-.75 4.75a.75.75 0 01.75-.75h4.5a.75.75 0 010 1.5h-4.5a.75.75 0 01-.75-.75zm16.28 4.53a.75.75 0 10-1.06-1.06l-4.97 4.97-1.97-1.97a.75.75 0 10-1.06 1.06l2.5 2.5a.75.75 0 001.06 0l5.5-5.5z"></path>
                                        </svg>
                                        <p class="text-zinc-800 leading-5 text-center mt-2">
                                            Seleccione una facultad para visualizar escuelas
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
                    wire:click="asignarIndicador"
                    wire:target="asignarIndicador"
                    wire:loading.class="cursor-wait"
                    wire:loading.attr="disabled">
                    <x-icons.load wire:loading wire:target="asignarIndicador" class="icon-5"/>
                    Guardar
                </x-jet-button>
            </x-slot>
        </x-jet-dialog-modal>
    @endif


    @push('js')
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            function eliminarRol(rol_nombre, rol_id) {
                Swal.fire({
                    html: `<b>¿Desea quitar el rol ${rol_nombre} del usuario?</b><br/><small>Nota: Se eliminarán las entidades correspondientes</small>`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Si, eliminar',
                    cancelButtonText: `Cancelar`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.livewire.emit('eliminarRol', rol_nombre, rol_id);
                    }
                })
            }

            function eliminarEntidad(entidad_id, entidad_nombre, rol_nombre) {
                Swal.fire({
                    html: `<b>¿Desea quitar la entidad ${entidad_nombre} del usuario?</b><br/><small>Nota: Se eliminará el rol correspondientes</small>`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Si, eliminar',
                    cancelButtonText: `Cancelar`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.livewire.emit('eliminarEntidad', entidad_id, entidad_nombre, rol_nombre);
                    }
                })
            }

            Livewire.on('guardado', rspta => {
                Swal.fire({
                    html: `<b>!${rspta.titulo}!</b><br/><small>${rspta.mensaje}</small>`,
                    icon: 'success'
                });
            });

            Livewire.on('error', msg => {
                Swal.fire({
                    html: `<b>!Hubo un error!</b><br/><small>${msg}</small>`,
                    icon: 'error'
                });
            });
        </script>
    @endpush

</div>
