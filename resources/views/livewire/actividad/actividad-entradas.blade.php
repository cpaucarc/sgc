<div>
    <x-utils.card>
        <x-slot name="header">
            <div class="flex justify-between items-center">
                <h1 class="text-xl font-bold text-gray-800">
                    Entradas
                </h1>
            </div>
            <p class="text-sm text-gray-400">
                Son documentos e información necesaria para completar la presente actividad
            </p>
        </x-slot>

        <div class="space-y-2">
            @forelse( $proveedores as $proveedor)
                <div class="ml-2 py-2 flex items-center">
                    <div
                        class="w-10 h-10 rounded-full bg-amber-100 grid place-content-center mr-2">
                        <small class="text-amber-700 font-semibold">
                            {{ $proveedor->entrada->codigo }}
                        </small>
                    </div>
                    <div class="truncate flex-1 mr-2">
                        <h2 class="text-gray-800 text-sm">
                            {{ $proveedor->entrada->nombre }}
                        </h2>
                        <p class="text-gray-500 text-xs">
                            <span class="text-gray-400">Proveedor: </span>
                            {{ $proveedor->entidad->nombre }}
                        </p>
                    </div>
                    <x-utils.buttons.ghost-button wire:click="abrirModal({{$proveedor->id}})"
                                                  class="text-xs text-gray-500 hover:text-gray-700">
                        <x-icons.open-modal class="h-4 w-4 mr-1" stroke="1.2"></x-icons.open-modal>
                        Revisar
                    </x-utils.buttons.ghost-button>
                </div>
            @empty
                <p>No hay entradas</p>
            @endforelse
        </div>

    </x-utils.card>


    @if($proveedor_seleccionado)
        <x-jet-dialog-modal wire:model="open" maxWidth="3xl">

            <x-slot name="title">
                <div>
                    <h1 class="font-bold text-gray-700">
                        {{ $proveedor_seleccionado->entrada->nombre }}
                    </h1>
                    <p class="text-sm text-gray-500">
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
                                            <x-utils.links.ghost-link
                                                class="group hover:text-sky-700 flex items-center text-xs"
                                                target="_blank"
                                                href="{{ route('archivos', $documento->enlace_interno) }}">
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
                @else
                    <x-utils.message-image image="{{ asset('images/svg/sin_documentos.svg') }}"
                                           title="El proveedor aun no ha enviado ningun documento."
                                           description="">
                    </x-utils.message-image>
                @endif
            </x-slot>

        </x-jet-dialog-modal>
    @endif
</div>
