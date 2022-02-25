<div>
    <x-utils.buttons.default wire:click="openModal" class="text-xs">
        <x-icons.open-modal class="w-4 h-4 mr-1" stroke="1.5"/>
        Elegir empresa
    </x-utils.buttons.default>

    @if(!is_null($empresas))
        <x-jet-dialog-modal wire:model="open" maxWidth="4xl">

            <x-slot name="title">
                <div>
                    <h1 class="font-bold text-gray-700">
                        Lista de empresas
                    </h1>
                </div>
                <x-utils.buttons.close-button wire:click="$set('open', false)"/>
            </x-slot>

            <x-slot name="content">

                <div class="flex justify-end">
                    <x-utils.forms.search-input wire:model.debounce.500ms="search"/>
                </div>

                <br>

                <x-utils.tables.table>
                    @slot('head')
                        <x-utils.tables.head>RUC</x-utils.tables.head>
                        <x-utils.tables.head>Empresa</x-utils.tables.head>
                        <x-utils.tables.head>Dirección</x-utils.tables.head>
                        <x-utils.tables.head><span class="sr-only">Escoger</span></x-utils.tables.head>
                    @endslot

                    @slot('body')
                        @foreach($empresas as $empresa)
                            <x-utils.tables.row>
                                <x-utils.tables.body>{{ $empresa->ruc }}</x-utils.tables.body>
                                <x-utils.tables.body>{{ $empresa->nombre }}</x-utils.tables.body>
                                <x-utils.tables.body>
                                    {{ $empresa->direccion }} | {{ $empresa->ubicacion }}
                                </x-utils.tables.body>
                                <x-utils.tables.body class="text-right">
                                    <x-utils.buttons.default class="group text-xs"
                                                             wire:click="seleccionarEmpresa({{$empresa->id}}, '{{ $empresa->nombre }}')">
                                        Escoger
                                    </x-utils.buttons.default>
                                </x-utils.tables.body>
                            </x-utils.tables.row>
                        @endforeach
                    @endslot
                </x-utils.tables.table>

            </x-slot>

        </x-jet-dialog-modal>
    @endif
</div>
