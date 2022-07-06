<div class="space-y-6">

    <section class="flex items-center justify-between gap-x-2">
        <div class="">
            <h1 class="text-zinc-800 text-xl font-bold">Docentes por semestre</h1>
            <p class="text-sm text-zinc-700 bg-zinc-100 rounded-md inline-flex px-3 py-1">
                <x-icons.info class="icon-5 mr-2"/>
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

    <x-utils.tables.table>
        @slot('head')
            <x-utils.tables.head>Nombre del docente</x-utils.tables.head>
            <x-utils.tables.head>Categoría - Condición - Dedicación</x-utils.tables.head>
            <x-utils.tables.head>¿Cumple 40h?</x-utils.tables.head>
            <x-utils.tables.head>Estado</x-utils.tables.head>
            <x-utils.tables.head>Accion</x-utils.tables.head>
        @endslot
        @slot('body')
            @foreach($docentes as $docente)
                <x-utils.tables.row>
                    <x-utils.tables.body class="text-xs font-bold">
                        {{ $docente->persona->apellido_paterno }} {{ $docente->persona->apellido_materno }} {{ $docente->persona->nombres }}
                        <a href="mailto:{{ $docente->persona->correo }}"
                           class="hover:text-blue-600 soft-transition block font-normal text-sm">
                            {{ $docente->persona->correo }}
                        </a>
                    </x-utils.tables.body>
                    <x-utils.tables.body class="text-xs whitespace-nowrap">
                        {{ $docente->categoria->nombre }} - {{ $docente->condicion->nombre }}
                        - {{ $docente->dedicacion->nombre }}
                    </x-utils.tables.body>
                    <x-utils.tables.body>
                        @if(!is_null($docente->cumple_40h))
                            @if($docente->cumple_40h)
                                SI
                            @else
                                NO
                            @endif
                        @else
                            ---
                        @endif
                    </x-utils.tables.body>
                    <x-utils.tables.body class="text-xs">
                        @if(is_null($docente->cumple_40h))
                            <x-utils.badge class="whitespace-nowrap bg-zinc-100 text-zinc-600 font-semibold">
                                No dicta
                            </x-utils.badge>
                        @else
                            <x-utils.badge class="whitespace-nowrap bg-green-100 text-green-600 font-semibold">
                                Dicta
                            </x-utils.badge>
                        @endif
                    </x-utils.tables.body>
                    <x-utils.tables.body class="text-xs">
                        @if($semestre === $semestre_activo)
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
                            <p class="inline-flex px-2 py-1 cursor-help bg-zinc-100 rounded text-zinc-600"
                               title="No puede modificar los datos de este semestre">
                                <x-icons.info class="icon-5"/>
                            </p>
                        @endif
                    </x-utils.tables.body>
                </x-utils.tables.row>
            @endforeach
        @endslot
    </x-utils.tables.table>


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
