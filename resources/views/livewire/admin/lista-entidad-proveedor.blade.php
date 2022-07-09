<div>
    @if(count($entradas) > 0)
        <div class="divide-y divide-dashed divide-gray-300">
            <div class="mb-3">
                <div class="flex items-end justify-between">
                    <h2 class="font-bold text-xl text-gray-600">Proveedor</h2>
                    <x-utils.buttons.default wire:click="openModal" class="text-sm">
                        Agregar
                    </x-utils.buttons.default>
                </div>
                <p class="text-sm text-gray-500">
                    Dentro de su ámbito de correspondiencia, es proveedor de las siguientes actividades:
                </p>
            </div>

            <div class="pt-4">
                <x-utils.tables.table>
                    @slot('head')
                        <x-utils.tables.head>N°</x-utils.tables.head>
                        <x-utils.tables.head>Entrada</x-utils.tables.head>
                        <x-utils.tables.head>Actividad</x-utils.tables.head>
                        <x-utils.tables.head><span class="sr-only">Acciones</span></x-utils.tables.head>
                    @endslot
                    @slot('body')
                        @foreach($entradas as $i => $entrada)
                            <x-utils.tables.row>
                                <x-utils.tables.body>{{$i + 1}}</x-utils.tables.body>
                                <x-utils.tables.body>
                                    {{$entrada->entrada->codigo}} - {{$entrada->entrada->nombre}}
                                </x-utils.tables.body>
                                <x-utils.tables.body class="whitespace-nowrap">
                                    <h3>{{$entrada->responsable->actividad->nombre}}</h3>
                                    <p class="text-xs text-gray-400">
                                        Responsable: {{$entrada->responsable->entidad->nombre}}</p>
                                </x-utils.tables.body>
                                <x-utils.tables.body>
                                    <x-utils.buttons.danger
                                        onclick="eliminar({{ $entrada->id }}, '{{$entrada->entrada->nombre}}')">
                                        <x-icons.delete class="h-4 w-4" stroke="1.5"/>
                                    </x-utils.buttons.danger>
                                </x-utils.tables.body>
                            </x-utils.tables.row>
                        @endforeach
                    @endslot
                </x-utils.tables.table>

                <div class="mt-4">
                    {{ $entradas->links() }}
                </div>
            </div>
        </div>
    @else
        <div class="border border-gray-300 rounded-md">
            <x-utils.message-no-items
                title="Sin entradas asignadas"
                text="Asigne las entradas que debe proveer a las distintas actividades.">
                @slot('icon')
                    <svg class="text-gray-400" fill="currentColor" viewBox="0 0 24 24" width="24" height="24">
                        <path fill-rule="evenodd"
                              d="M9.126.64a1.75 1.75 0 011.75 0l8.25 4.762c.103.06.199.128.286.206a.748.748 0 01.554.96c.023.113.035.23.035.35v3.332a.75.75 0 01-1.5 0V7.64l-7.75 4.474V22.36a.75.75 0 01-1.125.65l-8.75-5.052a1.75 1.75 0 01-.875-1.515V6.917c0-.119.012-.236.035-.35a.748.748 0 01.554-.96 1.75 1.75 0 01.286-.205L9.126.639zM1.501 7.638v8.803c0 .09.048.172.125.216l7.625 4.402v-8.947l-7.75-4.474zm8.5 3.175L2.251 6.34l7.625-4.402a.25.25 0 01.25 0l7.625 4.402-7.75 4.474z"></path>
                        <path
                            d="M21.347 17.5l-2.894-2.702a.75.75 0 111.023-1.096l4.286 4a.75.75 0 010 1.096l-4.286 4a.75.75 0 11-1.023-1.096L21.347 19h-6.633a.75.75 0 010-1.5h6.633z"></path>
                    </svg>
                @endslot

                <x-jet-button wire:click="openModal" class="text-sm">Asignar entradas</x-jet-button>

            </x-utils.message-no-items>
        </div>
    @endif

    <livewire:admin.asignar-entrada-entidad entidad_id="{{$entidad_id}}"/>

    @push('js')
        <script>
            function eliminar(id, nombre) {
                let res = confirm('¿Desea dejar de proveer la entrada ' + nombre + '?')

                if (res) {
                    window.livewire.emit('eliminarActividad', id);
                }
            }
        </script>
    @endpush

</div>
