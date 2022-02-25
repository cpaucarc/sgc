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

            <x-utils.links.primary class="text-sm" href="{{ route('rsu.create') }}">
                <x-icons.plus class="h-5 w-5 mr-1" stroke="1.5"></x-icons.plus>
                Nuevo
            </x-utils.links.primary>
        </div>
    </div>

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

</div>


