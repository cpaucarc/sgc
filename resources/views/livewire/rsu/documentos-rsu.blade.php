<div class="space-y-2">

    <div class="flex justify-between items-center">
        <h3 class="font-semibold tracking-wide text-gray-400">
            Documentos
        </h3>

        @if($es_responsable)
            <x-utils.buttons.default wire:click="openModal" class="text-xs">
                <x-icons.documents class="h-4 w-4 mr-1" stroke="1.5"></x-icons.documents>
                Subir
            </x-utils.buttons.default>
        @endif
    </div>

    @if($rsu->documentos_count > 0)
        <x-utils.tables.table>
            @slot('head')
                <x-utils.tables.head>Documento</x-utils.tables.head>
                <x-utils.tables.head>Autor</x-utils.tables.head>
                <x-utils.tables.head>Fecha de Envio</x-utils.tables.head>
                <x-utils.tables.head><span class="sr-only">Acción</span></x-utils.tables.head>
            @endslot
            @slot('body')
                @foreach($rsu->documentos as $documento_enviado)
                    <x-utils.tables.row>
                        <x-utils.tables.body class="font-semibold">
                            <x-utils.links.basic target="_blank"
                                                 href="{{ route('archivos', $documento_enviado->documento->enlace_interno) }}"
                                                 class="text-xs">
                                {{ $documento_enviado->documento->nombre }}
                            </x-utils.links.basic>
                        </x-utils.tables.body>
                        <x-utils.tables.body>
                            {{ App\Models\User::getUserNameByID($documento_enviado->documento->user_id)  }}
                        </x-utils.tables.body>
                        <x-utils.tables.body>
                            {{ $documento_enviado->documento->created_at->format('d-m-Y h:m a') }}
                        </x-utils.tables.body>
                        <x-utils.tables.body>
                            @if($documento_enviado->documento->user_id === auth()->user()->id )
                                <x-utils.buttons.danger class="text-xs"
                                                        wire:click="eliminarArchivo({{ $documento_enviado->documento_id }})">
                                    <x-icons.delete class="h-4 w-4" stroke="1.55"/>
                                </x-utils.buttons.danger>
                            @else
                                <span></span>
                            @endif
                        </x-utils.tables.body>
                    </x-utils.tables.row>
                @endforeach
            @endslot
        </x-utils.tables.table>
    @else
        <p class="font-bold text-gray-600">No hay documentos enviados</p>
    @endif

    <x-jet-dialog-modal wire:model="open" maxWidth="xl">
        <x-slot name="title">
            <h1 class="font-bold text-gray-700">Agregar archivos a la RSU</h1>
            <x-utils.buttons.close-button wire:click="$set('open', false)"/>
        </x-slot>

        <x-slot name="content">

            <div class="my-4">

                <x-jet-label for="archivo" value="{{ __('Archivo') }}"/>
                <x-utils.forms.file-input class="block w-full" id="archivo" wire:model="archivo"/>
                <x-jet-input-error for="archivo"></x-jet-input-error>

            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-button wire:click="enviarArchivo" wire:target="enviarArchivo, archivo"
                          wire:loading.class=" cursor-not-allowed" wire:loading.attr="disabled">
                <x-icons.load wire:loading wire:target="enviarArchivo" class="h-5 w-5"/>
                {{ __('Enviar Archivo') }}
            </x-jet-button>
        </x-slot>

    </x-jet-dialog-modal>

</div>
