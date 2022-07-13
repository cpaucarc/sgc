<div class="space-y-6">

    <section class="flex items-center justify-between gap-x-2">
        <div class="space-y-2">
            <h1 class="text-zinc-800 text-xl font-bold">Evaluación de los docentes</h1>
            <p class="text-sm text-indigo-700 bg-indigo-100 rounded-md inline-flex px-3 py-1.5 font-semibold">
                <x-icons.info class="icon-5 mr-2" stroke="1.75"/>
                Se recomienda que esta sección sea atendida al final del semestre académico.
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

    @if(count($docentes_semestre))
        <x-utils.tables.table>
            @slot('head')
                <x-utils.tables.head>Nombre del docente</x-utils.tables.head>
                <x-utils.tables.head>¿Cumplió 40h?</x-utils.tables.head>
                <x-utils.tables.head>¿Cumplió sus labores?</x-utils.tables.head>
                <x-utils.tables.head>Semestre</x-utils.tables.head>
            @endslot
            @slot('body')
                @foreach($docentes_semestre as $dcsm)
                    <x-utils.tables.row>
                        <x-utils.tables.body class="text-xs font-bold">
                            {{ $dcsm->docente->persona->apellido_paterno }} {{ $dcsm->docente->persona->apellido_materno }} {{ $dcsm->docente->persona->nombres }}
                        </x-utils.tables.body>
                        <x-utils.tables.body class="text-xs whitespace-nowrap">
                            @if($dcsm->cumple_40h)
                                @if(is_null($dcsm->cumplio_40h))
                                    <x-utils.buttons.success onclick="cumplimiento40h({{ $dcsm->id }}, true)">
                                        <svg class="fill-current mr-1" viewBox="0 0 16 16" width="16" height="16">
                                            <path fill-rule="evenodd"
                                                  d="M1.5 8a6.5 6.5 0 1113 0 6.5 6.5 0 01-13 0zM0 8a8 8 0 1116 0A8 8 0 010 8zm11.78-1.72a.75.75 0 00-1.06-1.06L6.75 9.19 5.28 7.72a.75.75 0 00-1.06 1.06l2 2a.75.75 0 001.06 0l4.5-4.5z"></path>
                                        </svg>
                                        Si
                                    </x-utils.buttons.success>
                                    <x-utils.buttons.danger onclick="cumplimiento40h({{ $dcsm->id }}, false)">
                                        <svg class="fill-current mr-1" viewBox="0 0 16 16" width="16" height="16">
                                            <path fill-rule="evenodd"
                                                  d="M3.404 12.596a6.5 6.5 0 119.192-9.192 6.5 6.5 0 01-9.192 9.192zM2.344 2.343a8 8 0 1011.313 11.314A8 8 0 002.343 2.343zM6.03 4.97a.75.75 0 00-1.06 1.06L6.94 8 4.97 9.97a.75.75 0 101.06 1.06L8 9.06l1.97 1.97a.75.75 0 101.06-1.06L9.06 8l1.97-1.97a.75.75 0 10-1.06-1.06L8 6.94 6.03 4.97z"></path>
                                        </svg>
                                        No
                                    </x-utils.buttons.danger>
                                @else
                                    @if($dcsm->cumplio_40h)
                                        <x-utils.badge class="bg-green-100 text-green-600">
                                            Cumplió
                                        </x-utils.badge>
                                    @else
                                        <x-utils.badge class="bg-rose-100 text-rose-600">
                                            No cumplió
                                        </x-utils.badge>
                                    @endif
                                @endif
                            @else
                                <x-utils.badge class="bg-zinc-100 text-zinc-600">
                                    No le corresponde
                                </x-utils.badge>
                            @endif
                        </x-utils.tables.body>
                        <x-utils.tables.body class="text-xs whitespace-nowrap">
                            @if(is_null($dcsm->cumplio_labores))
                                <x-utils.buttons.success onclick="cumplimientoLabores({{ $dcsm->id }}, true)">
                                    <svg class="fill-current mr-1" viewBox="0 0 16 16" width="16" height="16">
                                        <path fill-rule="evenodd"
                                              d="M1.5 8a6.5 6.5 0 1113 0 6.5 6.5 0 01-13 0zM0 8a8 8 0 1116 0A8 8 0 010 8zm11.78-1.72a.75.75 0 00-1.06-1.06L6.75 9.19 5.28 7.72a.75.75 0 00-1.06 1.06l2 2a.75.75 0 001.06 0l4.5-4.5z"></path>
                                    </svg>
                                    Si
                                </x-utils.buttons.success>
                                <x-utils.buttons.danger onclick="cumplimientoLabores({{ $dcsm->id }}, false)">
                                    <svg class="fill-current mr-1" viewBox="0 0 16 16" width="16" height="16">
                                        <path fill-rule="evenodd"
                                              d="M3.404 12.596a6.5 6.5 0 119.192-9.192 6.5 6.5 0 01-9.192 9.192zM2.344 2.343a8 8 0 1011.313 11.314A8 8 0 002.343 2.343zM6.03 4.97a.75.75 0 00-1.06 1.06L6.94 8 4.97 9.97a.75.75 0 101.06 1.06L8 9.06l1.97 1.97a.75.75 0 101.06-1.06L9.06 8l1.97-1.97a.75.75 0 10-1.06-1.06L8 6.94 6.03 4.97z"></path>
                                    </svg>
                                    No
                                </x-utils.buttons.danger>
                            @else
                                @if($dcsm->cumplio_labores)
                                    <x-utils.badge class="bg-green-100 text-green-600">
                                        Cumplió
                                    </x-utils.badge>
                                @else
                                    <x-utils.badge class="bg-rose-100 text-rose-600">
                                        No cumplió
                                    </x-utils.badge>
                                @endif
                            @endif
                        </x-utils.tables.body>
                        <x-utils.tables.body>
                            {{ $dcsm->semestre->nombre }}
                        </x-utils.tables.body>
                    </x-utils.tables.row>
                @endforeach
            @endslot
        </x-utils.tables.table>
    @else
        <div class="border border-zinc-300 rounded-md">
            <x-utils.message-no-items
                title="No hay ningún docentre registrado"
                text="Debe añadir los docentes que dictaron durante este semestre.">
                @slot('icon')
                    <svg class="text-zinc-400 fill-current" viewBox="0 0 24 24" width="24" height="24">
                        <path fill-rule="evenodd"
                              d="M3.5 8a5.5 5.5 0 118.596 4.547 9.005 9.005 0 015.9 8.18.75.75 0 01-1.5.045 7.5 7.5 0 00-14.993 0 .75.75 0 01-1.499-.044 9.005 9.005 0 015.9-8.181A5.494 5.494 0 013.5 8zM9 4a4 4 0 100 8 4 4 0 000-8z"></path>
                        <path
                            d="M17.29 8c-.148 0-.292.01-.434.03a.75.75 0 11-.212-1.484 4.53 4.53 0 013.38 8.097 6.69 6.69 0 013.956 6.107.75.75 0 01-1.5 0 5.193 5.193 0 00-3.696-4.972l-.534-.16v-1.676l.41-.209A3.03 3.03 0 0017.29 8z"></path>
                    </svg>
                @endslot

                <x-utils.links.primary href="{{ route('docente.por_semestre') }}" class="text-sm">
                    Añadir docentes
                </x-utils.links.primary>
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

            function cumplimiento40h(docente_semestre_id, cumplio) {
                if (cumplio) {
                    window.livewire.emit('cumplimiento40h', docente_semestre_id, cumplio);
                } else {
                    Swal.fire({
                        icon: 'question',
                        html: '¿Está seguro de que desea declarar que el <br/>docente <b>NO</b> cumplió con el formato de 40h?',
                        showCancelButton: true,
                        confirmButtonText: 'Si',
                        cancelButtonText: `Cancelar`,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.livewire.emit('cumplimiento40h', docente_semestre_id, cumplio);
                        }
                    })
                }
            }

            function cumplimientoLabores(docente_semestre_id, cumplio) {
                if (cumplio) {
                    window.livewire.emit('cumplimientoLabores', docente_semestre_id, cumplio);
                } else {
                    Swal.fire({
                        icon: 'question',
                        html: '¿Está seguro de que desea declarar que el <br/>docente <b>NO</b> cumplió con sus labores?',
                        showCancelButton: true,
                        confirmButtonText: 'Si',
                        cancelButtonText: `Cancelar`,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.livewire.emit('cumplimientoLabores', docente_semestre_id, cumplio);
                        }
                    })
                }
            }

        </script>
    @endpush
</div>
