<div class="space-y-4">

    <x-utils.titulo
        titulo="Documentos recibidos"
        subtitulo="En esta sección usted podrá encontrar los documentos que los responsables de cada actividad envió.">
        @slot('items')
            <x-utils.forms.select wire:model="semestre">
                @forelse($semestres as $smt)
                    <option value="{{ $smt->id }}">{{$smt->nombre}}</option>
                @empty
                    <option value="0">No hay datos</option>
                @endforelse
            </x-utils.forms.select>

            <x-utils.forms.select wire:model="proceso">
                @forelse($procesos as $proc)
                    <option value="{{ $proc->id }}">Proceso {{$proc->nombre}}</option>
                @empty
                    <option value="0">No hay datos</option>
                @endforelse
            </x-utils.forms.select>
        @endslot
    </x-utils.titulo>

    @if(count($salidas))
        <x-utils.tables.table>
            @slot('head')
                <x-utils.tables.head>Código</x-utils.tables.head>
                <x-utils.tables.head>Salida</x-utils.tables.head>
                <x-utils.tables.head>N° Documentos</x-utils.tables.head>
                <x-utils.tables.head>
                    <span class=" sr-only">Ver</span>
                </x-utils.tables.head>
            @endslot
            @slot('body')
                @foreach($salidas as $salida)
                    <x-utils.tables.row>
                        <x-utils.tables.body>
                            <div
                                class="icon-6 rounded-full font-semibold text-xs grid place-items-center text-blue-800 bg-blue-100">
                                {{ $salida->codigo }}
                            </div>
                        </x-utils.tables.body>
                        <x-utils.tables.body class="font-semibold">
                            {{ $salida->nombre }}
                        </x-utils.tables.body>
                        <x-utils.tables.body>
                            @if($salida->documentos_count)
                                {{ $salida->documentos_count }} documento(s)
                            @else
                                <x-utils.badge class="bg-rose-100 text-rose-600">
                                    Ninguno
                                </x-utils.badge>
                            @endif
                        </x-utils.tables.body>
                        <x-utils.tables.body>
                            @if($salida->documentos_count)
                                <x-utils.buttons.invisible wire:click="abrirModal({{$salida->id}})">
                                    Revisar
                                </x-utils.buttons.invisible>
                            @endif
                        </x-utils.tables.body>
                    </x-utils.tables.row>
                @endforeach
            @endslot
        </x-utils.tables.table>
    @else
        <div class="w-full border border-gray-300 rounded-md">
            <x-utils.message-no-items
                title="No se encontró ningún documento"
                text="Aquí podrá encontrar todos los documentos enviados a usted en calidad de cliente de las actividades.">
                @slot('icon')
                    <svg class="text-gray-400" fill="currentColor" viewBox="0 0 24 24" width="24"
                         height="24">
                        <path fill-rule="evenodd"
                              d="M3 3a2 2 0 012-2h9.982a2 2 0 011.414.586l4.018 4.018A2 2 0 0121 7.018V21a2 2 0 01-2 2H4.75a.75.75 0 010-1.5H19a.5.5 0 00.5-.5V8.5h-4a2 2 0 01-2-2v-4H5a.5.5 0 00-.5.5v6.25a.75.75 0 01-1.5 0V3zm12-.5v4a.5.5 0 00.5.5h4a.5.5 0 00-.146-.336l-4.018-4.018A.5.5 0 0015 2.5zm-5.692 12l-2.104-2.236a.75.75 0 111.092-1.028l3.294 3.5a.75.75 0 010 1.028l-3.294 3.5a.75.75 0 11-1.092-1.028L9.308 16H4.09a2.59 2.59 0 00-2.59 2.59v3.16a.75.75 0 01-1.5 0v-3.16a4.09 4.09 0 014.09-4.09h5.218z"></path>
                    </svg>
                @endslot
            </x-utils.message-no-items>
        </div>
    @endif

    @if($salida_seleccionada)
        <x-jet-dialog-modal wire:model="open" maxWidth="3xl">
            <x-slot name="title">
                <div class="flex items-center gap-x-2">
                    <div
                        class="w-10 h-10 rounded-full font-semibold text-sm grid place-items-center text-blue-800 bg-blue-100">
                        {{ $salida_seleccionada->codigo }}
                    </div>
                    <h1 class="font-bold text-gray-700">
                        {{ $salida_seleccionada->nombre }}
                    </h1>
                </div>
                <x-utils.buttons.close-button wire:click="$set('open', false)"/>
            </x-slot>

            <x-slot name="content">
                {{--                {{ $salida_seleccionada }}--}}
                <div class="space-y-8">
                    <x-utils.tables.table>
                        @slot('head')
                            <x-utils.tables.head>Nombre del documento</x-utils.tables.head>
                            <x-utils.tables.head>Enviado por</x-utils.tables.head>
                            <x-utils.tables.head>Fecha</x-utils.tables.head>
                            <x-utils.tables.head>
                                <span class=" sr-only">Acciones</span>
                            </x-utils.tables.head>
                        @endslot
                        @slot('body')
                            @foreach($salida_seleccionada->documentos as $doc)
                                <x-utils.tables.row class="p-1">
                                    <x-utils.tables.body class="text-left">
                                        {{ $doc->documento->nombre }}
                                    </x-utils.tables.body>
                                    <x-utils.tables.body>
                                        {{ $doc->documento->entidad->nombre }}
                                    </x-utils.tables.body>
                                    <x-utils.tables.body class="text-right whitespace-nowrap">
                                        {{ $doc->documento->created_at->diffForHumans() }}
                                    </x-utils.tables.body>
                                    <x-utils.tables.body class="text-right">
                                        <div
                                            class="flex items-center justify-end w-full gap-2 whitespace-nowrap">
                                            <x-utils.links.default class="group" target="_blank"
                                                                   href="{{ route('archivos', $doc->documento->enlace_interno) }}">
                                                <x-icons.documents class="h-4 w-4" stroke="1.5"/>
                                                Ver
                                            </x-utils.links.default>
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

</div>
