<div class="space-y-6">

    <div class="flex justify-between items-center">
        <x-utils.forms.search-input wire:model.debounce.500ms="search" class="w-56"/>

        <div class="flex items-center gap-x-2">
            <x-utils.forms.labeled-input title="Desde:" wire:model="inicio" type="date"
                                         class="cursor-pointer w-32 text-sm"/>
            <x-utils.forms.labeled-input title="Hasta:" wire:model="fin" type="date"
                                         class="cursor-pointer w-32 text-sm"/>
        </div>
    </div>

    <x-utils.tables.table>
        @slot('head')
            <x-utils.tables.head>Título</x-utils.tables.head>
            <x-utils.tables.head>Presupuesto</x-utils.tables.head>
            <x-utils.tables.head>Escuela</x-utils.tables.head>
            <x-utils.tables.head>Estado</x-utils.tables.head>
            <x-utils.tables.head>Publicación</x-utils.tables.head>
        @endslot
        @slot('body')
            @foreach($investigaciones as $investigacion)
                <x-utils.tables.row>
                    <x-utils.tables.body>
                        <x-utils.links.basic href="{{ route('investigacion.show', $investigacion->uuid) }}">
                            {{substr($investigacion->titulo, 0, 80)}}
                        </x-utils.links.basic>
                    </x-utils.tables.body>
                    <x-utils.tables.body>{{'S/. '.number_format((float)$investigacion->financiaciones->sum('pivot.presupuesto'), 2)}}</x-utils.tables.body>
                    <x-utils.tables.body>{{$investigacion->escuela->nombre}}</x-utils.tables.body>
                    <x-utils.tables.body>
                        <x-utils.badge
                            class="bg-{{$investigacion->estado->color}}-100 text-{{$investigacion->estado->color}}-700">
                            {{$investigacion->estado->nombre}}
                        </x-utils.badge>
                    </x-utils.tables.body>
                    <x-utils.tables.body>{{$investigacion->fecha_publicacion->format('d-m-Y')}}</x-utils.tables.body>
                </x-utils.tables.row>
            @endforeach
        @endslot
    </x-utils.tables.table>

</div>
