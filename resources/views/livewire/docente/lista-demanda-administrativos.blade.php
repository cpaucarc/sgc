<div class="space-y-6">
    <section class="flex justify-between items-center gap-x-8 mb-4">
        <h1 class="text-zinc-800 text-xl font-bold">Información de Demanda Administrativo</h1>
        <div class="flex justify-between items-center gap-x-2">
            <x-utils.forms.select class="w-52" wire:model="semestre">
                <option value="0">Todos los semestres</option>
                @foreach($semestres as $smt)
                    <option value="{{ $smt->id }}">{{$smt->nombre}}</option>
                @endforeach
            </x-utils.forms.select>

            @if(count($demanda_administrativos))
                <div class="text-left">
                    <livewire:docente.agregar-demanda-administrativos/>
                </div>
            @endif

        </div>
    </section>

    <hr class="border-dashed border-zinc-300"/>

    @if(count($demanda_administrativos))
        <x-utils.tables.table>
            @slot('head')
                <x-utils.tables.head>N°</x-utils.tables.head>
                <x-utils.tables.head>Docentes</x-utils.tables.head>
                <x-utils.tables.head>Administrativos</x-utils.tables.head>
                <x-utils.tables.head>Departamento</x-utils.tables.head>
                <x-utils.tables.head>Semestre</x-utils.tables.head>
                <x-utils.tables.head><span class="sr-only">Acciones</span></x-utils.tables.head>
            @endslot
            @slot('body')
                @foreach($demanda_administrativos as $i=>$demanda_admin)
                    <x-utils.tables.row>
                        <x-utils.tables.body>
                            {{($i+1)}}
                        </x-utils.tables.body>
                        <x-utils.tables.body  class="whitespace-nowrap text-zinc-400">
                            {{$demanda_admin->num_docentes}} docentes
                        </x-utils.tables.body>
                        <x-utils.tables.body  class="whitespace-nowrap text-zinc-400">
                            {{$demanda_admin->num_administrativos}} administrativos
                        </x-utils.tables.body>
                        <x-utils.tables.body>
                            {{$demanda_admin->departamento->nombre}}
                        </x-utils.tables.body>
                        <x-utils.tables.body class="text-center">
                            {{$demanda_admin->semestre->nombre}}
                        </x-utils.tables.body>
                        <x-utils.tables.body>
                            <x-utils.buttons.danger class="text-sm"
                                                    onclick="eliminar({{ $demanda_admin->id }})">
                                <x-icons.delete class="h-4 w-4" stroke="1.5"/>
                            </x-utils.buttons.danger>
                        </x-utils.tables.body>
                    </x-utils.tables.row>
                @endforeach
            @endslot
        </x-utils.tables.table>
        <div class="mt-4">
            {{ $demanda_administrativos->links() }}
        </div>
    @else
        <div class="border border-gray-300 rounded-md">
            <x-utils.message-no-items
                title="Aún no hay ningun demanda administrativo registrada"
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
                    <livewire:docente.agregar-demanda-administrativos/>
                </div>
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

            function eliminar(id) {
                Swal.fire({
                    text: "¿Esta seguro de eliminar la información de demanda administrativo?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Si, eliminar',
                    cancelButtonText: `Cancelar`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.livewire.emit('eliminar', id);
                    }
                })
            }

        </script>
    @endpush

</div>
