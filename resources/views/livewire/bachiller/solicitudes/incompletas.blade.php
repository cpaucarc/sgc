<div>
    <div class="grid grid-cols-6 gap-12">
        @forelse( $solicitudesIncompletas as $solicitud)
            <div
                class="col-span-3 group bg-white border border-stone-200 p-3 rounded-md soft-transition hover:shadow-md flex items-start justify-between">
                <div>
                    <x-utils.links.basic wire:click="mostrarDatos('{{ $solicitud->dni_estudiante }}')"
                                         class="cursor-pointer" title="Ver datos completos">
                        DNI {{$solicitud->dni_estudiante}}
                    </x-utils.links.basic>
                    <h3 class="text-gray-600 text-sm mb-1">
                        {{ $solicitud->escuela->nombre }}
                    </h3>
                    <h3 class="text-gray-500 group-hover:text-gray-600 text-sm">
                        {{ $solicitud->documentos_count }} de 15 requisitos enviados
                    </h3>
                    <h4 class="whitespace-nowrap text-gray-400 text-sm mt-2">
                        @if($solicitud->updated_at->diffInDays(\Carbon\Carbon::now()) <= 7)
                            Última actualización {{ $solicitud->updated_at->diffForHumans() }}
                        @else
                            Última actualización {{ $solicitud->updated_at->format('d-m-Y h:i a') }}
                        @endif
                    </h4>
                </div>
                <x-utils.buttons.default class="text-sm" wire:click="modalRequisitos({{ $solicitud->id }})">
                    Revisar
                </x-utils.buttons.default>
            </div>
        @empty
            <div class="col-span-6">
                <x-utils.message-image>
                    <x-slot name="title">No hay ninguna solicitud</x-slot>
                    <x-slot name="description">
                        Actualmente no hay ninguna solicitud que tenga los documentos incompletos.
                    </x-slot>
                    <x-slot name="image">{{ asset('images/svg/solicitudes_completas.svg') }}</x-slot>
                </x-utils.message-image>
            </div>
        @endforelse
    </div>


    @if($solicitudSeleccionado)
        <x-jet-dialog-modal wire:model="openModelRequisitos" maxWidth="4xl">
            @slot('title')
                <div class="flex items-center justify-between w-full m-0">
                    <h1 class="text-gray-600">
                        Solicitud presentado por
                        @if($datos_estudiante)
                            <span class="font-semibold">{{ $datos_estudiante['nombre_completo'] }}</span>
                        @else
                            <span class="font-semibold">{{ $solicitudSeleccionado->dni_estudiante }}</span>
                        @endif
                    </h1>
                    <x-utils.buttons.close-button wire:click="$set('openModelRequisitos', false)"/>
                </div>
            @endslot
            @slot('content')
                <div class="w-full flex items-end justify-between mb-3">
                    <h3 class="text-gray-800 text-base font-bold">
                        Lista de requisitos presentados
                    </h3>
                    <div class="flex flex-col items-end w-52 space-y-2">
                        <buttons
                            class="inline-flex items-center text-{{ $solicitudSeleccionado->estado->color }}-700 bg-{{ $solicitudSeleccionado->estado->color }}-100 rounded-md text-sm font-semibold px-3 py-1">
                            <x-icons.info :stroke="2" class="icon-5 mr-1"/>
                            {{ $solicitudSeleccionado->estado->nombre }}
                        </buttons>
                        <span class="text-xs">
                            Actualizado el {{ $solicitudSeleccionado->updated_at->format('d-m-Y h:i a') }}
                        </span>
                    </div>
                </div>

                <x-utils.tables.table>
                    @slot('body')
                        @foreach($solicitudSeleccionado->documentos as $i => $doc)
                            <x-utils.tables.row>
                                <x-utils.tables.body>
                                    {{ ($i+1) }}
                                </x-utils.tables.body>
                                <x-utils.tables.body>
                                    <a target="_blank" href="{{ route('archivos', $doc->documento->enlace_interno) }}"
                                       class="hover:text-sky-600 hover:underline font-bold line-clamp-1">
                                        {{ $doc->requisito->nombre }}
                                    </a>
                                </x-utils.tables.body>
                                <x-utils.tables.body class="whitespace-nowrap">
                                    {{ $doc->documento->updated_at->format('d-m-Y h:i a')}}
                                </x-utils.tables.body>
                                <x-utils.tables.body>
                                    <buttons
                                        class="inline-flex items-center text-{{ $doc->estado->color }}-700 bg-{{ $doc->estado->color }}-100 rounded-md px-3 py-1 whitespace-nowrap">
                                        {{ $doc->estado->nombre }}
                                    </buttons>
                                </x-utils.tables.body>
                                <x-utils.tables.body>
                                    <div
                                        class="flex items-center justify-end w-full gap-2 whitespace-nowrap">
                                        <x-utils.buttons.danger title="Denegar requisito"
                                                                wire:click="denegarDocumentoRequisito({{$doc->id}})">
                                            <x-icons.x class="icon-4 mr-1"/>
                                        </x-utils.buttons.danger>
                                        <x-utils.buttons.success title="Aprobar requisito"
                                                                 wire:click="aprobarDocumentoRequisito({{$doc->id}})">
                                            <x-icons.check class="icon-4 mr-1"/>
                                        </x-utils.buttons.success>
                                    </div>
                                </x-utils.tables.body>
                            </x-utils.tables.row>
                        @endforeach
                    @endslot
                </x-utils.tables.table>
            @endslot
        </x-jet-dialog-modal>
    @endif

    <x-jet-dialog-modal wire:model="openModalEstudiante" maxWidth="xl">
        <x-slot name="title">
            <h1 class="font-bold text-gray-700">
                Datos del estudiante
            </h1>
            <x-utils.buttons.close-button wire:click="$set('openModalEstudiante', false)"/>
        </x-slot>

        <x-slot name="content">
            @if($datos_estudiante)
                <x-utils.oge-datos-basicos :persona="$datos_estudiante"/>
            @else
                <x-utils.oge-no-datos/>
            @endif
        </x-slot>
    </x-jet-dialog-modal>

</div>
