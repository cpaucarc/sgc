<div>
    @if($entidad and count($entidad->actividades) > 0)
        <div class="divide-y divide-dashed divide-gray-300">
            <div class="mb-3">
                <div class="flex items-end justify-between">
                    <h2 class="font-bold text-xl text-gray-600">
                        Responsable
                    </h2>
                    <x-utils.buttons.default wire:click="openModal" class="text-sm">
                        Agregar
                    </x-utils.buttons.default>
                </div>
                <p class="text-sm text-gray-500">
                    Dentro de su ámbito de correspondiencia, es responsable de las siguientes actividades:
                </p>
            </div>

            <div class="pt-4">
                <x-utils.tables.table>
                    @slot('head')
                        <x-utils.tables.head>N°</x-utils.tables.head>
                        <x-utils.tables.head>Actividad</x-utils.tables.head>
                        <x-utils.tables.head>Tipo</x-utils.tables.head>
                        <x-utils.tables.head>Proceso</x-utils.tables.head>
                        <x-utils.tables.head><span class="sr-only">Acciones</span></x-utils.tables.head>
                    @endslot
                    @slot('body')
                        @foreach($entidad->actividades as $i => $actividad)
                            <x-utils.tables.row>
                                <x-utils.tables.body>{{$i + 1}}</x-utils.tables.body>
                                <x-utils.tables.body>{{$actividad->nombre}}</x-utils.tables.body>
                                <x-utils.tables.body>
                                    <x-utils.badge
                                        class="font-semibold text-xs {{
                            $actividad->tipo->id === 1 ? 'bg-indigo-100 text-indigo-700' :
                            ($actividad->tipo->id === 2 ? 'bg-amber-100 text-amber-700' :
                            ($actividad->tipo->id === 3 ? 'bg-rose-100 text-rose-700' :'bg-lime-100 text-lime-700'))}}">
                                        {{ $actividad->tipo->nombre }}
                                    </x-utils.badge>
                                </x-utils.tables.body>
                                <x-utils.tables.body>{{$actividad->proceso->nombre}}</x-utils.tables.body>
                                <x-utils.tables.body>
                                    <x-utils.buttons.danger
                                        onclick="eliminar({{ $actividad->pivot->id }}, '{{$actividad->nombre}}')">
                                        <x-icons.delete class="h-4 w-4" stroke="1.5"/>
                                    </x-utils.buttons.danger>
                                </x-utils.tables.body>
                            </x-utils.tables.row>
                        @endforeach
                    @endslot
                </x-utils.tables.table>
            </div>
        </div>
    @else
        <div class="border border-gray-300 rounded-md">
            <x-utils.message-no-items
                title="Sin actividades asignadas"
                text="Asigne las actividades de las que se hará cargo.">
                @slot('icon')
                    <svg class="text-gray-400" fill="currentColor" viewBox="0 0 24 24" width="24" height="24">
                        <path fill-rule="evenodd"
                              d="M10 22a2 2 0 01-2-2V4a2 2 0 012-2h11a2 2 0 012 2v16a2 2 0 01-2 2H10zm-.5-2a.5.5 0 00.5.5h11a.5.5 0 00.5-.5V4a.5.5 0 00-.5-.5H10a.5.5 0 00-.5.5v16zM6.17 4.165a.75.75 0 01-.335 1.006c-.228.114-.295.177-.315.201a.037.037 0 00-.008.016.387.387 0 00-.012.112v13c0 .07.008.102.012.112a.03.03 0 00.008.016c.02.024.087.087.315.201a.75.75 0 11-.67 1.342c-.272-.136-.58-.315-.81-.598C4.1 19.259 4 18.893 4 18.5v-13c0-.393.1-.759.355-1.073.23-.283.538-.462.81-.598a.75.75 0 011.006.336zM2.15 5.624a.75.75 0 01-.274 1.025c-.15.087-.257.17-.32.245C1.5 6.96 1.5 6.99 1.5 7v10c0 .01 0 .04.056.106.063.074.17.158.32.245a.75.75 0 11-.752 1.298C.73 18.421 0 17.907 0 17V7c0-.907.73-1.42 1.124-1.65a.75.75 0 011.025.274z"></path>
                    </svg>
                @endslot

                <x-jet-button wire:click="openModal" class="text-sm">
                    Asignar actividades
                </x-jet-button>
            </x-utils.message-no-items>
        </div>
    @endif

    <livewire:admin.asignar-actividad-entidad entidad_id="{{$entidad_id}}"/>

    @push('js')
        <script>
            function eliminar(id, nombre) {
                let res = confirm('¿Desea quitar la actividad ' + nombre + ' de sus responsabilidades?')

                if (res) {
                    window.livewire.emit('eliminarActividad', id);
                }
            }
        </script>
    @endpush

</div>
