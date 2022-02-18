<x-utils.card>
    @slot('header')
        <div class="flex justify-between items-center space-x-2">
            <div class="pr-4 flex-1">
                <h1 class="text-xl font-bold text-gray-800">
                    Documentos recibidos
                </h1>
                <p class="text-sm text-gray-400">
                    En esta sección usted podrá encontrar los documentos que los responsables de cada actividad envió.
                </p>
            </div>

            <x-utils.forms.basic-select class="w-24" wire:model="semestre_seleccionado">
                @forelse($semestres as $semestre)
                    <option value="{{ $semestre->id }}">{{$semestre->nombre}}</option>
                @empty
                    <option value="0">No hay datos</option>
                @endforelse
            </x-utils.forms.basic-select>

            <x-utils.forms.basic-select wire:model="proceso_seleccionado">
                @forelse($procesos as $proceso)
                    <option value="{{ $proceso->id }}">Proceso {{$proceso->nombre}}</option>
                @empty
                    <option value="0">No hay datos</option>
                @endforelse
            </x-utils.forms.basic-select>
        </div>
    @endslot

    @if(count($salidas))
        <x-utils.tables.table>
            @slot('head')
                <x-utils.tables.head>Salida</x-utils.tables.head>
                <x-utils.tables.head>Documentos</x-utils.tables.head>
                <x-utils.tables.head>
                    <span class=" sr-only">Ver</span>
                </x-utils.tables.head>
            @endslot
            @slot('body')
                @foreach($salidas as $salida)
                    <x-utils.tables.row>
                        <x-utils.tables.body class="font-semibold">
                            <h2 class="font-bold">
                                {{ $salida->nombre }}
                            </h2>
                        </x-utils.tables.body>
                        <x-utils.tables.body>
                            <p class="text-gray-500">
                                {{ $salida->documentos_count }} documento(s)
                            </p>
                        </x-utils.tables.body>
                        <x-utils.tables.body>
                            <x-utils.buttons.text-button wire:click="abrirModal({{$salida->id}})"
                                                         class="text-gray-500 hover:text-indigo-600">
                                Revisar
                            </x-utils.buttons.text-button>
                        </x-utils.tables.body>
                    </x-utils.tables.row>
                @endforeach
            @endslot
        </x-utils.tables.table>
    @else
        <p class="font-bold">
            No se encontró ningun documento
        </p>
    @endif

    @if($salida_seleccionada)
        <x-jet-dialog-modal wire:model="open" maxWidth="3xl">
            <x-slot name="title">
                <h1 class="font-bold text-gray-700">
                    {{ $salida_seleccionada->nombre }}
                </h1>
                <x-utils.buttons.close-button wire:click="$set('open', false)"/>
            </x-slot>

            <x-slot name="content">
                <div class="space-y-8">
                    <x-utils.tables.table>
                        @slot('body')
                            @foreach($salida_seleccionada->documentos as $documento_recibido)
                                <x-utils.tables.row class="p-1">
                                    <x-utils.tables.body class="text-left text-xs">
                                        @if(strlen($documento_recibido->documento->nombre) > 70)
                                            {{ substr($documento_recibido->documento->nombre, 0, 45) }}
                                            ...{{ substr($documento_recibido->documento->nombre, -15) }}
                                        @else
                                            {{ $documento_recibido->documento->nombre }}
                                        @endif
                                    </x-utils.tables.body>
                                    <x-utils.tables.body class="text-right text-xs">
                                        {{ $documento_recibido->documento->entidad->nombre }}
                                    </x-utils.tables.body>
                                    <x-utils.tables.body class="text-right text-xs">
                                        {{ $documento_recibido->documento->created_at->diffForHumans() }}
                                    </x-utils.tables.body>
                                    <x-utils.tables.body class="text-right">
                                        <div
                                            class="flex items-center justify-end w-full gap-2 whitespace-nowrap">
                                            <x-utils.links.ghost-link
                                                class="group hover:text-sky-700 flex items-center text-xs"
                                                target="_blank"
                                                href="{{ route('archivos', $documento_recibido->documento->enlace_interno) }}">
                                                <x-icons.documents class="h-4 w-4 group-hover:text-sky-600"
                                                                   stroke="1.25"/>
                                                Ver
                                            </x-utils.links.ghost-link>
                                        </div>
                                    </x-utils.tables.body>
                                </x-utils.tables.row>
                            @endforeach
                        @endslot
                    </x-utils.tables.table>
                </div>
            </x-slot>
        </x-jet-dialog-modal>
    @endif
</x-utils.card>

