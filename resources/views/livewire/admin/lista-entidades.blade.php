<div>
    <div class="flex justify-between mb-4 gap-x-2">
        <x-utils.forms.search-input wire:model.debounce.500ms="search"/>
    </div>

    @if(count($entidades) > 0)
        <x-utils.tables.table>
            @slot('head')
                <x-utils.tables.head>Nombre</x-utils.tables.head>
                <x-utils.tables.head>Pertenencia</x-utils.tables.head>
                <x-utils.tables.head>Responsabilidad</x-utils.tables.head>
                <x-utils.tables.head>Proveedor</x-utils.tables.head>
                <x-utils.tables.head>Cliente</x-utils.tables.head>
            @endslot
            @slot('body')
                @foreach($entidades as $entidad)
                    <x-utils.tables.row>
                        <x-utils.tables.body>
                            <x-utils.links.basic href="{{route('admin.entidad.responsable', $entidad->id)}}">
                                {{$entidad->nombre}}
                            </x-utils.links.basic>
                        </x-utils.tables.body>
                        <x-utils.tables.body class="text-xs">
                            {{$entidad->pertenencia ? $entidad->pertenencia->entidadable->nombre : '---'}}
                        </x-utils.tables.body>
                        <x-utils.tables.body class="text-xs">
                            <a class="hover:underline hover:text-sky-700"
                               href="{{route('admin.entidad.responsable', $entidad->id)}}">
                                {{$entidad->actividades_count > 0 ? 'de '.$entidad->actividades_count.' actividades' : '---'}}
                            </a>
                        </x-utils.tables.body>
                        <x-utils.tables.body class="text-xs">
                            <a class="hover:underline hover:text-sky-700"
                               href="{{route('admin.entidad.proveedor', $entidad->id)}}">
                                {{$entidad->entradas_count > 0 ? 'de '.$entidad->entradas_count.' entradas' : '---'}}
                            </a>
                        </x-utils.tables.body>
                        <x-utils.tables.body class="text-xs">
                            <a class="hover:underline hover:text-sky-700"
                               href="{{route('admin.entidad.cliente', $entidad->id)}}">
                                {{$entidad->salidas_count > 0 ? 'de '.$entidad->salidas_count.' salidas' : '---'}}
                            </a>
                        </x-utils.tables.body>
                    </x-utils.tables.row>
                @endforeach
            @endslot
        </x-utils.tables.table>
    @else
        <br>
        <div class="border border-gray-300 rounded-md">
            <x-utils.message-no-items
                title="Aún no hay ninguna entidad registrada">
                @slot('icon')
                    <svg class="text-gray-400" fill="currentColor" viewBox="0 0 24 24" width="24" height="24">
                        <path fill-rule="evenodd"
                              d="M7.5 1.75C7.5.784 8.284 0 9.25 0h5.5c.966 0 1.75.784 1.75 1.75V4h4.75c.966 0 1.75.784 1.75 1.75v14.5A1.75 1.75 0 0121.25 22H2.75A1.75 1.75 0 011 20.25V5.75C1 4.784 1.784 4 2.75 4H7.5V1.75zm-5 10.24v8.26c0 .138.112.25.25.25h18.5a.25.25 0 00.25-.25v-8.26A4.233 4.233 0 0118.75 13H5.25a4.233 4.233 0 01-2.75-1.01zm19-3.24a2.75 2.75 0 01-2.75 2.75H5.25A2.75 2.75 0 012.5 8.75v-3a.25.25 0 01.25-.25h18.5a.25.25 0 01.25.25v3zm-6.5-7V4H9V1.75a.25.25 0 01.25-.25h5.5a.25.25 0 01.25.25z"></path>
                    </svg>
                @endslot
            </x-utils.message-no-items>
        </div>
    @endif
</div>
