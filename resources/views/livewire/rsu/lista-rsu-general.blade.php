<div class="space-y-4">
    <x-utils.titulo
        titulo="Responsabilidad Social Universitario">
        @slot('items')
            @if(count($rsu) > 0)
                <x-utils.links.primary class="text-sm" href="{{ route('rsu.create') }}">
                    <x-icons.plus class="icon-5 mr-1" stroke="1.5"></x-icons.plus>
                    Nuevo
                </x-utils.links.primary>
            @endif
        @endslot
    </x-utils.titulo>

    <div class="flex items-center justify-between">
        <x-utils.forms.search-input wire:model.debounce.500ms="search"/>

        <div class="flex items-center gap-x-2">
            @if(count($entidad_facultad)>0)
                <x-utils.forms.select wire:model="escuela_seleccionado">
                    <option value="0">Todos los programas</option>
                    @foreach($escuelas as $esc)
                        <option value="{{$esc->id}}">{{$esc->nombre}}</option>
                    @endforeach
                </x-utils.forms.select>
            @endif

            <x-utils.forms.select wire:model="estado">
                <option value="0">Todos</option>
                <option value="1">Sin Iniciar</option>
                <option value="2">En progreso</option>
                <option value="3">Finalizado</option>
            </x-utils.forms.select>

            <x-utils.forms.select class="w-24" wire:model="semestre_seleccionado">
                @forelse($semestres as $semestre)
                    <option value="{{ $semestre->id }}">{{$semestre->nombre}}</option>
                @empty
                    <option value="0">No hay datos</option>
                @endforelse
            </x-utils.forms.select>
        </div>
    </div>

    @if(count($rsu) > 0)
        <x-utils.tables.table>
            @slot('head')
                <x-utils.tables.head>Título</x-utils.tables.head>
                <x-utils.tables.head>Programa</x-utils.tables.head>
                <x-utils.tables.head>Lugar</x-utils.tables.head>
                <x-utils.tables.head>Inicio</x-utils.tables.head>
                <x-utils.tables.head>Fin</x-utils.tables.head>
                <x-utils.tables.head>Estado</x-utils.tables.head>
            @endslot
            @slot('body')
                @foreach($rsu as $resp_social)
                    <x-utils.tables.row>
                        <x-utils.tables.body class="font-semibold">
                            <x-utils.links.basic href="{{ route('rsu.show', [$resp_social->uuid]) }}"
                                                 class="line-clamp-2" title="{{ $resp_social->titulo }}">
                                {{substr($resp_social->titulo, 0, 80)}}
                            </x-utils.links.basic>
                        </x-utils.tables.body>
                        <x-utils.tables.body>
                            {{ $resp_social->escuela->nombre }}
                        </x-utils.tables.body>
                        <x-utils.tables.body>
                            <p class="line-clamp-1" title="{{ $resp_social->lugar }}">
                                {{ $resp_social->lugar }}
                            </p>
                        </x-utils.tables.body>
                        <x-utils.tables.body class="text-xs whitespace-nowrap">
                            {{ $resp_social->fecha_inicio->format('d-m-Y') }}
                        </x-utils.tables.body>
                        <x-utils.tables.body class="text-xs whitespace-nowrap">
                            {{ $resp_social->fecha_fin->format('d-m-Y') }}
                        </x-utils.tables.body>
                        <x-utils.tables.body class="text-xs font-semibold">
                            @if( now() < $resp_social->fecha_inicio )
                                <span class="bg-amber-100 text-amber-800 whitespace-nowrap px-3 py-1 rounded font-bold">
                                    Sin iniciar
                                </span>
                            @endif

                            @if( now() > $resp_social->fecha_fin )
                                <span class="bg-gray-100 text-gray-800 whitespace-nowrap px-3 py-1 rounded font-bold">
                                    Finalizado
                                </span>
                            @endif

                            @if( now() >= $resp_social->fecha_inicio && now() <= $resp_social->fecha_fin )
                                <span class="bg-green-100 text-green-800 whitespace-nowrap px-3 py-1 rounded font-bold">
                                    En progreso
                                </span>
                            @endif
                        </x-utils.tables.body>
                    </x-utils.tables.row>
                @endforeach
            @endslot
        </x-utils.tables.table>
        <div class="mt-4">
            {{ $rsu->onEachSide(1)->links() }}
        </div>
    @else
        <div class="border border-gray-300 rounded-md mt-4">
            <x-utils.message-no-items
                title="Aún no se ha registrado ninguna Responsabilidad Social"
                text="Aquí podrá encontrar todas las Responsabilidades Sociales que hayan desarrollado los docentes y/o estudiantes.">
                @slot('icon')
                    <svg class="text-gray-400 icon-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                @endslot
                <x-utils.links.primary class="text-sm" href="{{ route('rsu.create') }}">
                    Registrar el primer RSU
                </x-utils.links.primary>
            </x-utils.message-no-items>
        </div>
    @endif
</div>


