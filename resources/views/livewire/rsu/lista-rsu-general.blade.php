<div class="space-y-4">

    <div class="flex justify-between items-center space-x-2">
        <div class="pr-4 flex-1">
            <h1 class="text-xl font-bold text-gray-700">
                Responsabilidad Social Universitario
            </h1>
        </div>

        <div class="inline-flex space-x-2 items-center">
            <x-utils.forms.select class="w-24" wire:model="semestre_seleccionado">
                @forelse($semestres as $semestre)
                    <option value="{{ $semestre->id }}">{{$semestre->nombre}}</option>
                @empty
                    <option value="0">No hay datos</option>
                @endforelse
            </x-utils.forms.select>

            @if(count($rsu) > 0)
                <x-utils.links.primary class="text-sm" href="{{ route('rsu.create') }}">
                    <x-icons.plus class="h-5 w-5 mr-1" stroke="1.5"></x-icons.plus>
                    Nuevo
                </x-utils.links.primary>
            @endif
        </div>
    </div>

    @if(count($rsu) > 0)
        <x-utils.tables.table>
            @slot('head')
                <x-utils.tables.head>Título</x-utils.tables.head>
                <x-utils.tables.head>Escuela</x-utils.tables.head>
                <x-utils.tables.head>Lugar</x-utils.tables.head>
                <x-utils.tables.head>Empresa</x-utils.tables.head>
                <x-utils.tables.head>Finalización</x-utils.tables.head>
            @endslot
            @slot('body')
                @foreach($rsu as $resp_social)
                    <x-utils.tables.row>
                        <x-utils.tables.body class="font-semibold">
                            <x-utils.links.basic href="{{ route('rsu.show', [$resp_social->uuid]) }}">
                                {{substr($resp_social->titulo, 0, 80)}}
                            </x-utils.links.basic>
                        </x-utils.tables.body>
                        <x-utils.tables.body>
                            {{ $resp_social->escuela->nombre }}
                        </x-utils.tables.body>
                        <x-utils.tables.body>
                            <p class="line-clamp-1">{{ $resp_social->lugar }}</p>
                        </x-utils.tables.body>
                        <x-utils.tables.body>
                            <p class="line-clamp-1">
                                {{ $resp_social->empresa_id ? $resp_social->empresa->nombre : '--'}}
                            </p>
                        </x-utils.tables.body>
                        <x-utils.tables.body>
                            <x-utils.badge
                                class="whitespace-nowrap {{$resp_social->fecha_fin ? '' : 'bg-rose-100 text-rose-700'}}">
                                {{ $resp_social->fecha_fin  ? $resp_social->fecha_fin->format('d/m/Y') : 'Sin completar' }}
                            </x-utils.badge>
                        </x-utils.tables.body>
                    </x-utils.tables.row>
                @endforeach
            @endslot
        </x-utils.tables.table>
    @else
        <div class="border border-gray-300 rounded-md">
            <x-utils.message-no-items
                title="Aún no se ha registrado ninguna Responsabilidad Social"
                text="Aquí podrá encontrar todas las Responsabilidades Sociales que hayan desarrollado los docentes y/o estudiantes.">
                @slot('icon')
                    <svg class="text-gray-400 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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


