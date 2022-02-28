@if($entidad and count($entidad->salidas) > 0)
    <div class="divide-y divide-dashed divide-gray-300">
        <div class="mb-2">
            <div class="flex items-center justify-between">
                <h2 class="font-bold text-xl text-gray-600">
                    Proveedor
                </h2>
                <x-utils.buttons.default class="text-sm">
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
                    <x-utils.tables.head>Salida</x-utils.tables.head>
                    <x-utils.tables.head>Actividad</x-utils.tables.head>
                    <x-utils.tables.head><span class="sr-only">Acciones</span></x-utils.tables.head>
                @endslot
                @slot('body')
                    @foreach($entidad->salidas as $i => $salida)
                        <x-utils.tables.row>
                            <x-utils.tables.body>{{$i + 1}}</x-utils.tables.body>
                            <x-utils.tables.body>{{$salida->salida->nombre}}</x-utils.tables.body>
                            <x-utils.tables.body>
                                <h3>{{$salida->responsable->actividad->nombre}}</h3>
                                <p class="text-xs">Responsable: {{$salida->responsable->entidad->nombre}}</p>
                            </x-utils.tables.body>
                            <x-utils.tables.body>
                                <x-utils.buttons.danger>
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
            text="Asigne las actividades en los que debe actuar como cliente.">
            @slot('icon')
                <svg class="text-gray-400" fill="currentColor" viewBox="0 0 24 24" width="24" height="24">
                    <path fill-rule="evenodd"
                          d="M13.152.682a2.25 2.25 0 012.269 0l.007.004 6.957 4.276a2.276 2.276 0 011.126 1.964v7.516c0 .81-.432 1.56-1.133 1.968l-.002.001-11.964 7.037-.004.003a2.276 2.276 0 01-2.284 0l-.026-.015-6.503-4.502a2.268 2.268 0 01-1.096-1.943V9.438c0-.392.1-.77.284-1.1l.003-.006.014-.026a2.28 2.28 0 01.82-.827h.002L13.152.681zm.757 1.295h-.001L2.648 8.616l6.248 4.247a.776.776 0 00.758-.01h.001l11.633-6.804-6.629-4.074a.75.75 0 00-.75.003zM18 9.709l-3.25 1.9v7.548L18 17.245V9.709zm1.5-.878v7.532l2.124-1.25a.777.777 0 00.387-.671V7.363L19.5 8.831zm-9.09 5.316l2.84-1.66v7.552l-3.233 1.902v-7.612c.134-.047.265-.107.391-.18l.002-.002zm-1.893 7.754V14.33a2.277 2.277 0 01-.393-.18l-.023-.014-6.102-4.147v7.003c0 .275.145.528.379.664l.025.014 6.114 4.232z"></path>
                </svg>
            @endslot

            <x-jet-button class="text-sm">
                Asignar actividades
            </x-jet-button>
        </x-utils.message-no-items>
    </div>
@endif
