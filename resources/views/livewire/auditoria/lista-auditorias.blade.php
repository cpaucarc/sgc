<div class="space-y-4">

    <x-utils.titulo
        titulo="Lista de Auditorias">
        @slot('items')
            <x-utils.forms.select class="w-52" wire:model="auditoria">
                <option value="-1">Todas las auditorias</option>
                <option value="0">Auditoria Externa</option>
                <option value="1">Auditoria Interna</option>
            </x-utils.forms.select>

            @if(count($auditorias) > 0)
                <x-utils.links.primary class="text-sm" href="{{ route('auditoria.create') }}">
                    <x-icons.plus class="h-5 w-5 mr-1" stroke="1.5"></x-icons.plus>
                    Registrar
                </x-utils.links.primary>
            @endif
        @endslot
    </x-utils.titulo>

    @if(count($auditorias) > 0)
        <div class="py-4">
            <x-utils.tables.table>
                @slot('head')
                    <x-utils.tables.head>N°</x-utils.tables.head>
                    <x-utils.tables.head>Responsable</x-utils.tables.head>
                    <x-utils.tables.head>Tipo de Auditoria</x-utils.tables.head>
                    <x-utils.tables.head>Facultad</x-utils.tables.head>
                    <x-utils.tables.head>N° Documentos</x-utils.tables.head>
                    <x-utils.tables.head>Fecha de Auditoria</x-utils.tables.head>
                @endslot
                @slot('body')
                    @foreach($auditorias as $i=>$auditoria)
                        <x-utils.tables.row>
                            <x-utils.tables.body class="font-semibold">
                                {{ ($i+1)}}
                            </x-utils.tables.body>
                            <x-utils.tables.body class="font-semibold">
                                {{ $auditoria->responsable }}
                            </x-utils.tables.body>
                            <x-utils.tables.body>
                                <x-utils.badge
                                    class="{{ $auditoria->es_auditoria_interno ? 'bg-blue-100 text-blue-600' : 'bg-amber-100 text-amber-600' }}">
                                    {{ $auditoria->es_auditoria_interno ? 'Auditoria Interna' : 'Auditoria Externa' }}
                                </x-utils.badge>
                            </x-utils.tables.body>
                            <x-utils.tables.body>
                                {{ $auditoria->facultad->nombre }}
                            </x-utils.tables.body>
                            <x-utils.tables.body>
                                @if($auditoria->documentos_count)
                                    <x-utils.buttons.invisible wire:click="abrirModal({{$auditoria->id}})">
                                        {{ $auditoria->documentos_count . ' documentos' }}
                                    </x-utils.buttons.invisible>
                                @else
                                    <p class="px-3 py-1">{{$auditoria->documentos_count. ' documentos'}}</p>
                                @endif
                            </x-utils.tables.body>
                            <x-utils.tables.body>
                                @if($auditoria->created_at->diffInDays(\Carbon\Carbon::now()) <= 3)
                                    {{ $auditoria->created_at->diffForHumans() }}
                                @else
                                    {{ $auditoria->created_at->format('d-m-Y') }}
                                @endif
                            </x-utils.tables.body>
                        </x-utils.tables.row>
                    @endforeach
                @endslot
            </x-utils.tables.table>
        </div>
    @else
        <div class="w-full border border-gray-300 rounded-md">
            <x-utils.message-no-items
                title="Aún no se ha registrado ninguna Auditoria"
                text="Aquí podrá encontrar todas los informes de Auditoria que hayan registrado.">
                @slot('icon')
                    <svg class="text-gray-400" fill="currentColor" viewBox="0 0 24 24" width="24" height="24">
                        <path
                            d="M16.53 9.78a.75.75 0 00-1.06-1.06L11 13.19l-1.97-1.97a.75.75 0 00-1.06 1.06l2.5 2.5a.75.75 0 001.06 0l5-5z"></path>
                        <path fill-rule="evenodd"
                              d="M12.54.637a1.75 1.75 0 00-1.08 0L3.21 3.312A1.75 1.75 0 002 4.976V10c0 6.19 3.77 10.705 9.401 12.83.386.145.812.145 1.198 0C18.229 20.704 22 16.19 22 10V4.976c0-.759-.49-1.43-1.21-1.664L12.54.637zm-.617 1.426a.25.25 0 01.154 0l8.25 2.676a.25.25 0 01.173.237V10c0 5.461-3.28 9.483-8.43 11.426a.2.2 0 01-.14 0C6.78 19.483 3.5 15.46 3.5 10V4.976c0-.108.069-.203.173-.237l8.25-2.676z"></path>
                    </svg>
                @endslot
                <x-utils.links.primary class="text-sm" href="{{ route('auditoria.create') }}">
                    Registrar la primera auditoria
                </x-utils.links.primary>
            </x-utils.message-no-items>
        </div>
    @endif

    @if($auditoria_seleccionado)
        <x-jet-dialog-modal wire:model="open">

            <x-slot name="title">
                <div>
                    <h1 class="font-bold text-gray-900">
                        {{ $auditoria_seleccionado->es_auditoria_interno ? 'Auditoria Interna' : 'Auditoria Externa' }}
                        (Facultad de {{$auditoria_seleccionado->facultad->nombre}})
                    </h1>
                    <p class="text-sm text-gray-700">
                        Responsable: {{ $auditoria_seleccionado->responsable }}
                    </p>
                </div>
                <x-utils.buttons.close-button wire:click="$set('open', false)"/>
            </x-slot>

            <x-slot name="content">
                @if(count($documentos) > 0 )
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-gray-600 text-sm font-bold">
                            Documentos subidos por el auditor:
                        </h2>
                    </div>
                    <x-utils.tables.table>
                        @slot('body')
                            @foreach($documentos as $documento)
                                <x-utils.tables.row class="p-1">
                                    <x-utils.tables.body class="text-left text-sm">
                                        @if(strlen($documento->nombre) > 60)
                                            {{ substr($documento->nombre, 0, 45) }}
                                            ...{{ substr($documento->nombre, -15) }}
                                        @else
                                            {{ $documento->nombre }}
                                        @endif
                                    </x-utils.tables.body>
                                    <x-utils.tables.body class="text-right text-sm">
                                        {{ $documento->created_at->diffForHumans() }}
                                    </x-utils.tables.body>
                                    <x-utils.tables.body class="text-right">
                                        <div
                                            class="flex items-center justify-end w-full gap-2 whitespace-nowrap">
                                            <x-utils.links.default class="group text-xs" target="_blank"
                                                                   href="{{ route('archivos', $documento->enlace_interno) }}">
                                                <x-icons.documents class="h-4 w-4" stroke="1.5"/>
                                                Ver
                                            </x-utils.links.default>
                                        </div>
                                    </x-utils.tables.body>
                                </x-utils.tables.row>
                            @endforeach
                        @endslot
                    </x-utils.tables.table>
                @else
                    <x-utils.message-no-items
                        title="No hay ningun documento"
                        text="El auditor no ha subido ningun documento."
                    >
                        @slot('icon')
                            <svg class="text-gray-400" fill="currentColor" viewBox="0 0 24 24" width="24" height="24">
                                <path fill-rule="evenodd"
                                      d="M5 2.5a.5.5 0 00-.5.5v18a.5.5 0 00.5.5h14a.5.5 0 00.5-.5V8.5h-4a2 2 0 01-2-2v-4H5zm10 0v4a.5.5 0 00.5.5h4a.5.5 0 00-.146-.336l-4.018-4.018A.5.5 0 0015 2.5zM3 3a2 2 0 012-2h9.982a2 2 0 011.414.586l4.018 4.018A2 2 0 0121 7.018V21a2 2 0 01-2 2H5a2 2 0 01-2-2V3z"></path>
                            </svg>
                        @endslot
                    </x-utils.message-no-items>
                @endif
            </x-slot>

        </x-jet-dialog-modal>
    @endif
</div>


