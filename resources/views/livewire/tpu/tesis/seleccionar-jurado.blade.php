<div>
    <x-utils.buttons.default wire:click="openModal"
                                  class="inline-flex items-center text-xs border-gray-300 active:border-gray-400">
        <x-icons.open-modal class="icon-4 mr-2" stroke="1.5"/>
        Elegir jurado
    </x-utils.buttons.default>

    @if(!is_null($jurados))
        <x-jet-dialog-modal wire:model="open" maxWidth="4xl">
            @slot('title')
                <div>
                    <h1 class="font-bold text-gray-700">
                        Lista de jurados
                    </h1>
                </div>
                <x-utils.buttons.close-button wire:click="$set('open', false)"/>
            @endslot
            @slot('content')
                <div class="flex justify-end">
                    <x-utils.forms.search-input wire:model.debounce.500ms="search"/>
                </div>
                <br>
                <x-utils.tables.table>
                    @slot('head')
                        <x-utils.tables.head>Código</x-utils.tables.head>
                        <x-utils.tables.head>Nombres</x-utils.tables.head>
                        <x-utils.tables.head>Colegiatura</x-utils.tables.head>
                        <x-utils.tables.head>Colegio</x-utils.tables.head>
                        <x-utils.tables.head><span class="sr-only">Escoger</span></x-utils.tables.head>
                    @endslot

                    @slot('body')
                        @foreach($jurados as $jurado)
                            <x-utils.tables.row>
                                <x-utils.tables.body>
                                    {{ $jurado->codigo_colegiatura }}
                                <x-utils.tables.body>
                                    Nombre del docente
                                </x-utils.tables.body>
                                    <x-utils.tables.body>
                                        {{ $jurado->dni_docente }}
                                    </x-utils.tables.body>
                                </x-utils.tables.body>
                                <x-utils.tables.body>
                                    {{ $jurado->colegio->nombre}}
                                </x-utils.tables.body>
                                <x-utils.tables.body class="text-right">
                                    <x-utils.buttons.default
                                        wire:click="seleccionarJurado({{$jurado->id}}, '{{ $jurado->dni_docente }}')"
                                        class="group hover:text-gray-700 active:border-gray-400 flex items-center text-xs">
                                        Escoger
                                    </x-utils.buttons.default>
                                </x-utils.tables.body>
                            </x-utils.tables.row>
                        @endforeach
                    @endslot
                </x-utils.tables.table>
            @endslot

        </x-jet-dialog-modal>
    @endif
</div>
