<div class="space-y-6">

    <div class="flex justify-between items-center">
        <x-utils.forms.search-input wire:model.debounce.500ms="search"/>

        @if(count($investigaciones) > 0)
            <x-utils.links.primary class="text-sm" href="{{ route('investigacion.crear') }}">
                <x-icons.plus class="icon-5 mr-1" stroke="1.5"/>
                Nuevo
            </x-utils.links.primary>
        @endif

    </div>

    @if(count($investigaciones) > 0)
        <x-utils.tables.table>
            @slot('head')
                <x-utils.tables.head>Título</x-utils.tables.head>
                <x-utils.tables.head>Presupuesto</x-utils.tables.head>
                <x-utils.tables.head>Investigadores</x-utils.tables.head>
                <x-utils.tables.head>Programa</x-utils.tables.head>
                <x-utils.tables.head>Estado</x-utils.tables.head>
                <x-utils.tables.head>Publicación</x-utils.tables.head>
                <x-utils.tables.head>Creación</x-utils.tables.head>
            @endslot
            @slot('body')
                @foreach($investigaciones as $investigacion)
                    <x-utils.tables.row>
                        <x-utils.tables.body>
                            <x-utils.links.basic href="{{ route('investigacion.show', $investigacion->uuid) }}">
                                {{substr($investigacion->titulo, 0, 80)}}
                            </x-utils.links.basic>
                        </x-utils.tables.body>
                        <x-utils.tables.body class="text-right">
                            {{'S/. '.number_format((float)$investigacion->presupuesto_sum, 2)}}
                        </x-utils.tables.body>
                        <x-utils.tables.body>
                            @if( $investigacion->investigadores_count > 1)
                                Tú y {{ ($investigacion->investigadores_count - 1) }} más
                            @else
                                Solo tú
                            @endif
                        </x-utils.tables.body>
                        <x-utils.tables.body>
                            {{ $investigacion->escuela->nombre }}
                        </x-utils.tables.body>
                        <x-utils.tables.body>
                            <x-utils.badge
                                class="bg-{{$investigacion->estado->color}}-100 text-{{$investigacion->estado->color}}-700">
                                {{ $investigacion->estado->nombre }}
                            </x-utils.badge>
                        </x-utils.tables.body>
                        <x-utils.tables.body class="text-xs">
                            {{ $investigacion->fecha_publicacion ? $investigacion->fecha_publicacion->format('d-m-Y') : '--' }}
                        </x-utils.tables.body>
                        <x-utils.tables.body class="whitespace-nowrap text-xs">
                            {{ $investigacion->created_at->format('d-m-Y h:i a') }}
                        </x-utils.tables.body>
                    </x-utils.tables.row>
                @endforeach
            @endslot
        </x-utils.tables.table>
    @else
        <div class="border border-gray-300 rounded-md">
            <x-utils.message-no-items
                title="Aún no hay ninguna investigación registrada"
                text="Aquí podrás encontrar todos tus Proyectos de Investigaciones en los cuales participaste.">
                @slot('icon')
                    <svg class="text-gray-400" fill="currentColor" viewBox="0 0 24 24" width="24" height="24">
                        <path fill-rule="evenodd"
                              d="M0 3.75A.75.75 0 01.75 3h7.497c1.566 0 2.945.8 3.751 2.014A4.496 4.496 0 0115.75 3h7.5a.75.75 0 01.75.75v15.063a.75.75 0 01-.755.75l-7.682-.052a3 3 0 00-2.142.878l-.89.891a.75.75 0 01-1.061 0l-.902-.901a3 3 0 00-2.121-.879H.75a.75.75 0 01-.75-.75v-15zm11.247 3.747a3 3 0 00-3-2.997H1.5V18h6.947a4.5 4.5 0 012.803.98l-.003-11.483zm1.503 11.485V7.5a3 3 0 013-3h6.75v13.558l-6.927-.047a4.5 4.5 0 00-2.823.971z"></path>
                    </svg>
                @endslot

                <x-utils.links.primary class="text-sm" href="{{ route('investigacion.crear') }}">
                    Registrar la primera investigación
                </x-utils.links.primary>
            </x-utils.message-no-items>
        </div>
    @endif
</div>
