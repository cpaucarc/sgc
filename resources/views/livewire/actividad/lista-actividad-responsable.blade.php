<div class="space-y-4">

    <x-utils.titulo
        titulo="Mis actividades"
        subtitulo="En esta sección usted podrá ver la lista de actividades que le corresponde realizar durante el semestre.">
        @slot('items')
            <x-utils.forms.select class="w-24" wire:model="semestre_seleccionado">
                @forelse($semestres as $semestre)
                    <option value="{{ $semestre->id }}">{{$semestre->nombre}}</option>
                @empty
                    <option value="0">No hay datos</option>
                @endforelse
            </x-utils.forms.select>

            @if(count($procesos))
                <x-utils.forms.select wire:model="proceso_seleccionado">
                    @forelse($procesos as $proceso)
                        <option value="{{ $proceso->id }}">Proceso {{$proceso->nombre}}</option>
                    @empty
                        <option value="0">No hay datos</option>
                    @endforelse
                </x-utils.forms.select>
            @endif
        @endslot
    </x-utils.titulo>

    @if(count($procesos))
        <x-utils.tables.table>
            @slot('head')
                <x-utils.tables.head>Actividad - PHVA</x-utils.tables.head>
                <x-utils.tables.head>Responsable</x-utils.tables.head>
                <x-utils.tables.head>Estado</x-utils.tables.head>
                <x-utils.tables.head>
                    <span class=" sr-only">Ver</span>
                </x-utils.tables.head>
            @endslot
            @slot('body')
                @foreach($actividades as $actividad)
                    <x-utils.tables.row>
                        <x-utils.tables.body class="font-bold">
                            {{ $actividad->actividad->nombre }}
                            <x-utils.badge
                                class="ml-1 {{
                            $actividad->actividad->tipo->id === 1 ? 'bg-indigo-100 text-indigo-600' :
                            ($actividad->actividad->tipo->id === 2 ? 'bg-amber-100 text-amber-600' :
                            ($actividad->actividad->tipo->id === 3 ? 'bg-rose-100 text-rose-600' :'bg-lime-100 text-lime-600'))}}">
                                {{ $actividad->actividad->tipo->nombre }}
                            </x-utils.badge>
                        </x-utils.tables.body>
                        <x-utils.tables.body>
                            {{ $actividad->entidad->nombre }}
                        </x-utils.tables.body>
                        <x-utils.tables.body>
                            <x-utils.badge
                                class="{{$actividad->estado ? 'bg-green-100 text-green-600' : 'bg-rose-100 text-rose-600'}}">
                                {{ $actividad->estado ? 'Completado' : 'Sin completar' }}
                            </x-utils.badge>
                        </x-utils.tables.body>
                        <x-utils.tables.body>
                            <x-utils.links.invisible
                                href="{{ route('actividad.show', [$actividad->id, $semestre_seleccionado]) }}">
                                Revisar
                            </x-utils.links.invisible>
                        </x-utils.tables.body>
                    </x-utils.tables.row>
                @endforeach
            @endslot
        </x-utils.tables.table>
    @else
        <div class="w-full border border-gray-300 rounded-md">
            <x-utils.message-no-items
                title="Usted no es responsable de ninguna actividad"
                text="No tiene asignado ninguna actividad como responsable.">
                @slot('icon')
                    <svg class="text-gray-400" fill="currentColor" viewBox="0 0 24 24" width="24" height="24">
                        <path
                            d="M17.28 9.28a.75.75 0 00-1.06-1.06l-5.97 5.97-2.47-2.47a.75.75 0 00-1.06 1.06l3 3a.75.75 0 001.06 0l6.5-6.5z"></path>
                        <path fill-rule="evenodd"
                              d="M3.75 2A1.75 1.75 0 002 3.75v16.5c0 .966.784 1.75 1.75 1.75h16.5A1.75 1.75 0 0022 20.25V3.75A1.75 1.75 0 0020.25 2H3.75zM3.5 3.75a.25.25 0 01.25-.25h16.5a.25.25 0 01.25.25v16.5a.25.25 0 01-.25.25H3.75a.25.25 0 01-.25-.25V3.75z"></path>
                    </svg>
                @endslot
            </x-utils.message-no-items>
        </div>
    @endif
</div>
