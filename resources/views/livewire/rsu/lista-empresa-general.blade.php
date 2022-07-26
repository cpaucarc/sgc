<div>
    <x-utils.titulo
        titulo="Registros de Empresas">
        @slot('items')
            @if(count($empresas) > 0)
                <x-utils.links.primary class="text-sm" href="{{ route('rsu.business.create') }}">
                    <x-icons.plus class="h-5 w-5 mr-1" stroke="1.5"></x-icons.plus>
                    Nuevo
                </x-utils.links.primary>
            @endif
        @endslot
    </x-utils.titulo>

    <div class="flex justify-between mt-4">
        <x-utils.forms.search-input wire:model.debounce.500ms="search"/>
    </div>

    @if(count($empresas)>0)
        <div class="py-4">
            <x-utils.tables.table>
                @slot('head')
                    <x-utils.tables.head>N°</x-utils.tables.head>
                    <x-utils.tables.head>Nombre</x-utils.tables.head>
                    <x-utils.tables.head>RUC</x-utils.tables.head>
                    {{--                    <x-utils.tables.head>Telefono</x-utils.tables.head>--}}
                    {{--                    <x-utils.tables.head>Correo</x-utils.tables.head>--}}
                    <x-utils.tables.head>Dirección</x-utils.tables.head>
                    <x-utils.tables.head>Ubicación</x-utils.tables.head>
                    <x-utils.tables.head><span class="sr-only">Acciones</span></x-utils.tables.head>
                @endslot
                @slot('body')
                    @foreach($empresas as $i=>$empresa)
                        <x-utils.tables.row>
                            <x-utils.tables.body>{{($i+1)}}</x-utils.tables.body>
                            <x-utils.tables.body>{{ $empresa->nombre }}</x-utils.tables.body>
                            <x-utils.tables.body>{{ $empresa->ruc }}</x-utils.tables.body>
                            {{--                            <x-utils.tables.body>{{ $empresa->telefono }}</x-utils.tables.body>--}}
                            {{--                            <x-utils.tables.body>{{ $empresa->correo }}</x-utils.tables.body>--}}
                            <x-utils.tables.body>{{ $empresa->direccion }}</x-utils.tables.body>
                            <x-utils.tables.body>{{ $empresa->ubicacion }}</x-utils.tables.body>
                            <x-utils.tables.body>
                                @if($empresa->user_id === \Illuminate\Support\Facades\Auth::user()->id)
                                    <x-utils.buttons.danger class="text-sm"
                                                            onclick="eliminar({{ $empresa->id }},'{{ $empresa->nombre }}')">
                                        <x-icons.delete class="h-4 w-4" stroke="1.5"/>
                                    </x-utils.buttons.danger>
                                @endif
                            </x-utils.tables.body>
                        </x-utils.tables.row>
                    @endforeach
                @endslot
            </x-utils.tables.table>

            <div class="mt-4">
                {{ $empresas->onEachSide(1)->links() }}
            </div>
        </div>
    @else
        <div class="w-full border border-gray-300 rounded-md mt-4">
            <x-utils.message-no-items
                title="Aún no hay datos sobre empresas"
                text="Aquí podrá encontrar la información de empresas para la Responsabilidad Social.">
                @slot('icon')
                    <svg class="text-gray-400" width="24" height="24" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                @endslot
                <x-utils.links.primary class="text-sm" href="{{ route('rsu.business.create') }}">
                    Nuevo
                </x-utils.links.primary>
            </x-utils.message-no-items>
        </div>
    @endif

    @push('js')
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            function eliminar(id, nombre) {
                Swal.fire({
                    text: "¿Desea eliminar la empresa con nombre " + nombre + " ?",
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
