<div>
    <div class="flex justify-between mb-4">
        <x-utils.forms.search-input wire:model.debounce.500ms="search"/>
    </div>

    @if($procesos and count($procesos) > 0)
        <x-utils.tables.table>
            @slot('head')
                <x-utils.tables.head>N°</x-utils.tables.head>
                <x-utils.tables.head>Nombre</x-utils.tables.head>
                <x-utils.tables.head>Actividades</x-utils.tables.head>
                <x-utils.tables.head><span class="sr-only">Acciones</span></x-utils.tables.head>
            @endslot
            @slot('body')
                @foreach($procesos as $i => $proceso)
                    <x-utils.tables.row>
                        <x-utils.tables.body>{{($i + 1)}}</x-utils.tables.body>
                        <x-utils.tables.body class="font-semibold">{{$proceso->nombre}}</x-utils.tables.body>
                        <x-utils.tables.body>
                            @if($proceso->actividades_count)
                                {{$proceso->actividades_count}} actividades
                            @else
                                <p class="text-rose-400 font-semibold">Sin actividades</p>
                            @endif
                        </x-utils.tables.body>
                        <x-utils.tables.body>
                            <x-utils.buttons.danger class="text-sm"
                                                    onclick="eliminar({{ $proceso->id }}, '{{$proceso->nombre}}')">
                                <x-icons.delete class="h-4 w-4" stroke="1.5"/>
                            </x-utils.buttons.danger>
                        </x-utils.tables.body>
                    </x-utils.tables.row>
                @endforeach
            @endslot
        </x-utils.tables.table>
    @else
        <div class="border border-gray-300 rounded-md">
            <x-utils.message-no-items
                title="Aún no hay procesos registrados">
                @slot('icon')
                    <svg class="text-gray-400" fill="currentColor" viewBox="0 0 24 24" width="24" height="24">
                        <path
                            d="M2.5 10.5a8 8 0 1116 0 .75.75 0 001.5 0 9.5 9.5 0 10-9.5 9.5h10.94l-2.72 2.72a.75.75 0 101.06 1.06l3.735-3.735c.44-.439.44-1.151 0-1.59L19.78 14.72a.75.75 0 00-1.06 1.06l2.72 2.72H10.5a8 8 0 01-8-8z"></path>
                    </svg>
                @endslot
            </x-utils.message-no-items>
        </div>
    @endif

    @push('js')
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            function eliminar(id, nombre) {
                Swal.fire({
                    text: "¿Desea eliminar el proceso " + nombre + " ?",
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

            Livewire.on('error', msg => {
                Swal.fire({
                    html: `<b>!Hubo un error!</b><br/><small>${msg}</small>`,
                    icon: 'error'
                });
            });
        </script>
    @endpush
</div>
