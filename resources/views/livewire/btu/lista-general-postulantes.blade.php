<div class="space-y-4">

    <x-utils.titulo
        titulo="Postulantes y Beneficiarios en Bolsa de Trabajo">
        @slot('items')
            <x-utils.forms.select class="w-52" wire:model="semestre">
                <option value="0">Todos los semestres</option>
                @foreach($semestres as $sm)
                    <option value="{{ $sm->id }}">{{$sm->nombre}}</option>
                @endforeach
            </x-utils.forms.select>

            <x-utils.forms.select class="w-52" wire:model="escuela">
                <option value="0">Todos los programas</option>
                @foreach($escuelas as $esc)
                    <option value="{{ $esc->id }}">{{$esc->nombre}}</option>
                @endforeach
            </x-utils.forms.select>

            @if(count($postulantes) > 0)
                <x-utils.links.primary class="text-sm" href="{{ route('btu.registrar.postulante') }}">
                    <x-icons.plus class="h-5 w-5 mr-1" stroke="1.5"></x-icons.plus>
                    Nuevo
                </x-utils.links.primary>
            @endif
        @endslot
    </x-utils.titulo>

    @if(count($postulantes) > 0)
        <div class="py-4">
            <x-utils.tables.table>
                @slot('head')
                    <x-utils.tables.head>N°</x-utils.tables.head>
                    <x-utils.tables.head>Inicio</x-utils.tables.head>
                    <x-utils.tables.head>Finalización</x-utils.tables.head>
                    <x-utils.tables.head>Postulantes</x-utils.tables.head>
                    <x-utils.tables.head>Beneficiados</x-utils.tables.head>
                    <x-utils.tables.head>Semestre</x-utils.tables.head>
                    <x-utils.tables.head>Programa</x-utils.tables.head>
                    <x-utils.tables.head>Facultad</x-utils.tables.head>
                    <x-utils.tables.head>Acciones</x-utils.tables.head>
                @endslot
                @slot('body')
                    @foreach($postulantes as $i=>$postulante)
                        <x-utils.tables.row>
                            <x-utils.tables.body>{{ ($i+1) }}</x-utils.tables.body>
                            <x-utils.tables.body>{{ $postulante->fecha_inicio->format('d-m-Y') }}</x-utils.tables.body>
                            <x-utils.tables.body>{{ $postulante->fecha_fin->format('d-m-Y') }}</x-utils.tables.body>
                            <x-utils.tables.body>{{ $postulante->postulantes }}</x-utils.tables.body>
                            <x-utils.tables.body>{{ $postulante->beneficiados }}</x-utils.tables.body>
                            <x-utils.tables.body>{{ $postulante->semestre->nombre }}</x-utils.tables.body>
                            <x-utils.tables.body>{{ $postulante->escuela->nombre }}</x-utils.tables.body>
                            <x-utils.tables.body>{{ $postulante->escuela->facultad->abrev }}</x-utils.tables.body>
                            <x-utils.tables.body>
                                <x-utils.buttons.danger class="text-sm"
                                                        onclick="eliminar({{ $postulante->id }},{{$i+1}})">
                                    <x-icons.delete class="h-4 w-4" stroke="1.5"/>
                                </x-utils.buttons.danger>
                            </x-utils.tables.body>
                        </x-utils.tables.row>
                    @endforeach
                @endslot
            </x-utils.tables.table>
        </div>

    @else
        <div class="w-full border border-gray-300 rounded-md">
            <x-utils.message-no-items
                title="Aún no hay datos sobre los postulantes y los beneficiarios"
                text="Aquí podrá encontrar la información de los postulantes y los beneficiarios del Bolsa de Trabajo Universitario.">
                @slot('icon')
                    <svg class="text-gray-400" fill="currentColor" viewBox="0 0 24 24" width="24" height="24">
                        <path fill-rule="evenodd"
                              d="M3.5 8a5.5 5.5 0 118.596 4.547 9.005 9.005 0 015.9 8.18.75.75 0 01-1.5.045 7.5 7.5 0 00-14.993 0 .75.75 0 01-1.499-.044 9.005 9.005 0 015.9-8.181A5.494 5.494 0 013.5 8zM9 4a4 4 0 100 8 4 4 0 000-8z"></path>
                        <path
                            d="M17.29 8c-.148 0-.292.01-.434.03a.75.75 0 11-.212-1.484 4.53 4.53 0 013.38 8.097 6.69 6.69 0 013.956 6.107.75.75 0 01-1.5 0 5.193 5.193 0 00-3.696-4.972l-.534-.16v-1.676l.41-.209A3.03 3.03 0 0017.29 8z"></path>
                    </svg>
                @endslot
                <x-utils.links.primary class="text-sm" href="{{ route('btu.registrar.postulante') }}">
                    Registrar
                </x-utils.links.primary>
            </x-utils.message-no-items>
        </div>
    @endif

    @push('js')
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            function eliminar(id, row) {
                Swal.fire({
                    text: "¿Desea eliminar el registro número (" + row + ") de Bolsa de Trabajo?",
                    icon: 'warning',
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
