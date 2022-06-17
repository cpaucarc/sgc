<div>
    @if(!is_null($docentes) && count($docentes))
        <x-utils.tables.table>
            @slot('head')
                <x-utils.tables.head><span class="sr-only">Seleccionar</span></x-utils.tables.head>
                <x-utils.tables.head>DNI</x-utils.tables.head>
                <x-utils.tables.head>Nombre completo</x-utils.tables.head>
                <x-utils.tables.head>Condición</x-utils.tables.head>
                <x-utils.tables.head>Departamento</x-utils.tables.head>
            @endslot

            @slot('body')
                @foreach($docentes as $doc)
                    <x-utils.tables.row>
                        <x-utils.tables.body>
                            <x-utils.forms.checkbox wire:model="docentes_seleccionados"
                                                    wire:loading.attr="disabled"
                                                    value="{{ $doc['dni'] }}"/>
                        </x-utils.tables.body>
                        <x-utils.tables.body>{{ $doc['dni'] }}</x-utils.tables.body>
                        <x-utils.tables.body>
                            {{ ucwords(strtolower($doc['nombre_completo'])) }}
                        </x-utils.tables.body>
                        <x-utils.tables.body>
                            {{ ucwords(strtolower($doc['condicion'])) }}
                        </x-utils.tables.body>
                        <x-utils.tables.body>
                            {{ ucwords(strtolower($doc['departamento_academico'])) }}
                        </x-utils.tables.body>
                    </x-utils.tables.row>
                @endforeach
            @endslot
        </x-utils.tables.table>

        <div class="mt-4 flex justify-end">
            <x-jet-button
                wire:click="agregarDocentes"
                wire:target="agregarDocentes"
                wire:loading.class="cursor-wait"
                wire:loading.attr="disabled">
                <x-icons.load wire:loading wire:target="agregarDocentes" class="h-5 w-5"/>
                Agregar docentes seleccionados
            </x-jet-button>
        </div>
    @else
        <div class="text-gray-600 px-4 py-6">
            No hay ningun dato
        </div>
    @endif
</div>
