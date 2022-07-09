<div class="space-y-6">

    <section class="flex items-center justify-between gap-x-2">
        <div class="space-y-2">
            <h1 class="text-zinc-800 text-xl font-bold">Docentes por semestre</h1>
            <p class="text-sm text-amber-700 bg-amber-100 rounded-md inline-flex px-3 py-1.5 font-semibold">
                <x-icons.info class="icon-5 mr-2" stroke="1.75"/>
                Se recomienda que esta sección sea atendida a inicios del semestre académico.
            </p>
        </div>

        <x-utils.forms.select wire:model="semestre">
            @forelse($semestres as $sm)
                <option value="{{ $sm->id }}">{{ $sm->nombre }}</option>
            @empty
                <option value="0">No hay datos</option>
            @endforelse
        </x-utils.forms.select>
    </section>

    @if(count($docentes))
        <x-utils.tables.table>
            @slot('head')
                <x-utils.tables.head>Nombre del docente</x-utils.tables.head>
                <x-utils.tables.head>Categoría - Condición - Dedicación</x-utils.tables.head>
                <x-utils.tables.head>¿Cumple 40h?</x-utils.tables.head>
                <x-utils.tables.head>Estado</x-utils.tables.head>
                <x-utils.tables.head><span class="sr-only">Acciones</span></x-utils.tables.head>
            @endslot
            @slot('body')
                @foreach($docentes as $docente)
                    <x-utils.tables.row>
                        <x-utils.tables.body class="text-xs font-bold">
                            {{ $docente->persona->apellido_paterno }} {{ $docente->persona->apellido_materno }} {{ $docente->persona->nombres }}
                        </x-utils.tables.body>
                        <x-utils.tables.body class="text-xs whitespace-nowrap">
                            {{ $docente->categoria->nombre }} - {{ $docente->condicion->nombre }}
                            - {{ $docente->dedicacion->nombre }}
                        </x-utils.tables.body>
                        <x-utils.tables.body>
                            @if(!is_null($docente->cumple_40h))
                                {{ $docente->cumple_40h ? 'SI' : 'NO' }}
                            @else
                                ---
                            @endif
                        </x-utils.tables.body>
                        <x-utils.tables.body class="text-xs">
                            @if(is_null($docente->cumple_40h))
                                <x-utils.badge class="whitespace-nowrap text-zinc-400 font-semibold">
                                    <svg class="fill-current mr-1" viewBox="0 0 16 16" width="16" height="16">
                                        <path fill-rule="evenodd"
                                              d="M3.404 12.596a6.5 6.5 0 119.192-9.192 6.5 6.5 0 01-9.192 9.192zM2.344 2.343a8 8 0 1011.313 11.314A8 8 0 002.343 2.343zM6.03 4.97a.75.75 0 00-1.06 1.06L6.94 8 4.97 9.97a.75.75 0 101.06 1.06L8 9.06l1.97 1.97a.75.75 0 101.06-1.06L9.06 8l1.97-1.97a.75.75 0 10-1.06-1.06L8 6.94 6.03 4.97z"></path>
                                    </svg>
                                    No dicta
                                </x-utils.badge>
                            @else
                                <x-utils.badge class="whitespace-nowrap bg-green-100 text-green-600 font-semibold">
                                    <svg class="fill-current mr-1" viewBox="0 0 16 16" width="16" height="16">
                                        <path fill-rule="evenodd"
                                              d="M1.5 8a6.5 6.5 0 1113 0 6.5 6.5 0 01-13 0zM0 8a8 8 0 1116 0A8 8 0 010 8zm11.78-1.72a.75.75 0 00-1.06-1.06L6.75 9.19 5.28 7.72a.75.75 0 00-1.06 1.06l2 2a.75.75 0 001.06 0l4.5-4.5z"></path>
                                    </svg>
                                    Dicta
                                </x-utils.badge>
                            @endif
                        </x-utils.tables.body>
                        <x-utils.tables.body class="text-xs">
                            @if($semestre == $semestre_activo)
                                @if(is_null($docente->cumple_40h))
                                    <x-utils.buttons.default onclick="agregarDocente({{ $docente->id }})">
                                        Agregar
                                    </x-utils.buttons.default>
                                @else
                                    <x-utils.buttons.danger onclick="quitarDocente({{ $docente->id }})">
                                        Quitar
                                    </x-utils.buttons.danger>
                                @endif
                            @else
                                <p class="inline-flex px-2 py-1 cursor-not-allowed bg-zinc-100 rounded text-zinc-600"
                                   title="No puede modificar los datos de este semestre">
                                    <svg class="fill-current" viewBox="0 0 16 16" width="16" height="16">
                                        <path fill-rule="evenodd"
                                              d="M1.5 8a6.5 6.5 0 0110.535-5.096l-9.131 9.131A6.472 6.472 0 011.5 8zm2.465 5.096a6.5 6.5 0 009.131-9.131l-9.131 9.131zM8 0a8 8 0 100 16A8 8 0 008 0z"></path>
                                    </svg>
                                </p>
                            @endif
                        </x-utils.tables.body>
                    </x-utils.tables.row>
                @endforeach
            @endslot
        </x-utils.tables.table>
    @else
        <div class="border border-gray-300 rounded-md">
            <x-utils.message-no-items title="No hay ningún docente registrado en este semestre" text="">
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

    @push('js')
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
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

            function agregarDocente(docente_id) {
                Swal.fire({
                    icon: 'question',
                    text: '¿El docente seleccionado debe cumplir con el formato de 40h?',
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: 'Si',
                    denyButtonText: `No`,
                    cancelButtonText: `Cancelar`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.livewire.emit('agregarDocente', docente_id, true);
                    } else if (result.isDenied) {
                        window.livewire.emit('agregarDocente', docente_id, false);
                    }
                })
            }

            function quitarDocente(docente_id) {
                Swal.fire({
                    text: "¿El docente seleccionado ya no dictará en este semestre?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Si, quitar',
                    cancelButtonText: `Cancelar`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.livewire.emit('quitarDocente', docente_id);
                    }
                })
            }

        </script>
    @endpush
</div>
