<x-utils.card>
    @slot('header')
        <div class="flex justify-between items-center space-x-2">
            <div class="pr-4 flex-1">
                <h1 class="text-xl font-bold text-gray-800">
                    Mis actividades
                </h1>
                <p class="text-sm text-gray-400">
                    En esta sección usted podrá ver la lista de actividades que le corresponde realizar
                    durante el semestre.
                </p>
            </div>

            <x-utils.forms.select class="w-24" wire:model="semestre_seleccionado">
                @forelse($semestres as $semestre)
                    <option value="{{ $semestre->id }}">{{$semestre->nombre}}</option>
                @empty
                    <option value="0">No hay datos</option>
                @endforelse
            </x-utils.forms.select>

            <x-utils.forms.select wire:model="proceso_seleccionado">
                @forelse($procesos as $proceso)
                    <option value="{{ $proceso->id }}">Proceso {{$proceso->nombre}}</option>
                @empty
                    <option value="0">No hay datos</option>
                @endforelse
            </x-utils.forms.select>
        </div>
    @endslot

    {{--    <x-utils.dd>--}}
    {{--        {{$actividades}}--}}
    {{--    </x-utils.dd>--}}

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
                    <x-utils.tables.body class="font-semibold">
                        {{ $actividad->actividad->nombre }}
                        <x-utils.badge
                            class="ml-1 text-xs {{
                            $actividad->actividad->tipo->id === 1 ? 'bg-indigo-100 text-indigo-700' :
                            ($actividad->actividad->tipo->id === 2 ? 'bg-amber-100 text-amber-700' :
                            ($actividad->actividad->tipo->id === 3 ? 'bg-rose-100 text-rose-700' :'bg-lime-100 text-lime-700'))}}">
                            {{ $actividad->actividad->tipo->nombre }}
                        </x-utils.badge>
                    </x-utils.tables.body>
                    <x-utils.tables.body>
                        {{ $actividad->entidad->nombre }}
                    </x-utils.tables.body>
                    <x-utils.tables.body>
                        <x-utils.badge
                            class="whitespace-nowrap text-xs {{$actividad->estado ? 'bg-green-100 text-green-700' : 'bg-rose-100 text-rose-700'}}">
                            {{ $actividad->estado ? 'Completado' : 'Sin completar' }}
                        </x-utils.badge>
                    </x-utils.tables.body>
                    <x-utils.tables.body>
                        <x-utils.links.invisible class="text-xs"
                                                 href="{{ route('actividad.show', [$actividad->id, $semestre_seleccionado]) }}">
                            Revisar
                        </x-utils.links.invisible>
                    </x-utils.tables.body>
                </x-utils.tables.row>
            @endforeach
        @endslot
    </x-utils.tables.table>
</x-utils.card>
