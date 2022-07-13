<div>
    <x-utils.card>
        <x-slot name="header">
            <div class="flex justify-between items-center">
                <h1 class="text-xl font-bold text-gray-800">
                    Entradas
                </h1>
            </div>
            <p class="text-sm text-gray-600">
                Son documentos e información necesaria para completar la presente actividad
            </p>
        </x-slot>

        <div class="space-y-2">
            @forelse( $proveedores as $proveedor)
                <div class="ml-2 py-2 flex items-center">
                    <div
                        class="w-10 h-10 rounded-full bg-amber-100 grid place-content-center mr-2">
                        <small class="text-amber-700 font-bold">
                            {{ $proveedor->entrada->codigo }}
                        </small>
                    </div>
                    <div class="truncate flex-1 mr-2">
                        <h2 class="text-gray-800 font-bold text-sm">
                            {{ $proveedor->entrada->nombre }}
                        </h2>
                        <p class="text-gray-600 text-sm">
                            {{ 'por '.$proveedor->entidad->nombre }}
                        </p>
                    </div>
                    <x-utils.buttons.default wire:click="abrirModal({{$proveedor->id}})" class="text-xs">
                        <x-icons.open-modal class="icon-4 mr-1" stroke="1.5"/>
                        Revisar
                    </x-utils.buttons.default>
                </div>
            @empty
                <x-utils.message-no-items
                    title="Esta actividad no tiene entradas"
                    text="Para completar esta actividad no requiere espera de ningun documento.">
                    @slot('icon')
                        <svg class="text-gray-400" fill="currentColor" viewBox="0 0 24 24" width="24" height="24">
                            <path fill-rule="evenodd"
                                  d="M3 3a2 2 0 012-2h9.982a2 2 0 011.414.586l4.018 4.018A2 2 0 0121 7.018V21a2 2 0 01-2 2H4.75a.75.75 0 010-1.5H19a.5.5 0 00.5-.5V8.5h-4a2 2 0 01-2-2v-4H5a.5.5 0 00-.5.5v6.25a.75.75 0 01-1.5 0V3zm12-.5v4a.5.5 0 00.5.5h4a.5.5 0 00-.146-.336l-4.018-4.018A.5.5 0 0015 2.5zm-5.692 12l-2.104-2.236a.75.75 0 111.092-1.028l3.294 3.5a.75.75 0 010 1.028l-3.294 3.5a.75.75 0 11-1.092-1.028L9.308 16H4.09a2.59 2.59 0 00-2.59 2.59v3.16a.75.75 0 01-1.5 0v-3.16a4.09 4.09 0 014.09-4.09h5.218z"></path>
                        </svg>
                    @endslot
                </x-utils.message-no-items>
            @endforelse
        </div>

    </x-utils.card>


    @if($proveedor_seleccionado)
        <x-jet-dialog-modal wire:model="open" maxWidth="3xl">

            <x-slot name="title">
                <div>
                    <h1 class="font-bold text-gray-900">
                        {{ $proveedor_seleccionado->entrada->nombre }}
                    </h1>
                    <p class="text-sm text-gray-700">
                        Proveedor: {{ $proveedor_seleccionado->entidad->nombre }}
                    </p>
                </div>
                <x-utils.buttons.close-button wire:click="$set('open', false)"/>
            </x-slot>

            <x-slot name="content">
                @if(count($documentos) > 0 )
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-gray-600 text-sm font-bold">
                            Documentos enviados por el proveedor:
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
                        title="Aún no hay ningun documento"
                        text="El proveedor de esta entrada aún no ha enviado ningun documento."
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
