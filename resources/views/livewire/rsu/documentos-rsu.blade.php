<div class="space-y-2">

    <div class="flex justify-between items-center">
        <h3 class="font-bold tracking-wide text-gray-600">
            Documentos
        </h3>

        @if($es_responsable and $rsu->documentos_count > 0)
            <x-utils.buttons.default wire:click="openModal" class="text-sm">
                <x-icons.documents class="h-5 w-5 mr-1" stroke="1.5"></x-icons.documents>
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
                                                 class="text-sm">
                                {{ $documento_enviado->documento->nombre }}
                            </x-utils.links.basic>
                        </x-utils.tables.body>
                        <x-utils.tables.body>
                            {{ App\Models\User::getUserNameByID($documento_enviado->documento->user_id)  }}
                        </x-utils.tables.body>
                        <x-utils.tables.body>
                            {{ $documento_enviado->documento->created_at->format('d/m/Y h:m a') }}
                        </x-utils.tables.body>
                        <x-utils.tables.body>
                            @if($documento_enviado->documento->user_id === auth()->user()->id )
                                <x-utils.buttons.danger class="text-sm"
                                                        onclick="eliminarArchivo({{ $documento_enviado->documento_id }},'{{$documento_enviado->documento->nombre}}')">
                                    <x-icons.delete class="h-5 w-5" stroke="1.55"/>
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
        <div class="border border-gray-300 rounded-md">
            <x-utils.message-no-items
                title="Aún no hay ningún documento enviado"
                text="Envíe documentos correspondientes a la Responsabilidad Social para las personas interesadas.">
                @slot('icon')
                    <svg class="text-gray-400" fill="currentColor" viewBox="0 0 24 24" width="24" height="24">
                        <path fill-rule="evenodd"
                              d="M3 3a2 2 0 012-2h9.982a2 2 0 011.414.586l4.018 4.018A2 2 0 0121 7.018V21a2 2 0 01-2 2H4.75a.75.75 0 010-1.5H19a.5.5 0 00.5-.5V8.5h-4a2 2 0 01-2-2v-4H5a.5.5 0 00-.5.5v6.25a.75.75 0 01-1.5 0V3zm12-.5v4a.5.5 0 00.5.5h4a.5.5 0 00-.146-.336l-4.018-4.018A.5.5 0 0015 2.5zm-5.692 12l-2.104-2.236a.75.75 0 111.092-1.028l3.294 3.5a.75.75 0 010 1.028l-3.294 3.5a.75.75 0 11-1.092-1.028L9.308 16H4.09a2.59 2.59 0 00-2.59 2.59v3.16a.75.75 0 01-1.5 0v-3.16a4.09 4.09 0 014.09-4.09h5.218z"></path>
                    </svg>
                @endslot

                @if($es_responsable)
                    <x-jet-button wire:click="openModal" class="text-sm">
                        Enviar mi primer documento
                    </x-jet-button>
                @endif
            </x-utils.message-no-items>
        </div>
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
                          wire:loading.class=" cursor-wait" wire:loading.attr="disabled">
                <x-icons.load wire:loading wire:target="enviarArchivo" class="h-5 w-5"/>
                {{ __('Enviar Archivo') }}
            </x-jet-button>
        </x-slot>

    </x-jet-dialog-modal>

    @push('js')
        <script>
            function eliminarArchivo(id, nombre) {
                let res = confirm('¿Desea eliminar el archivo con el nombre de ' + nombre + ' de Documentos?')

                if (res) {
                    window.livewire.emit('eliminarArchivo', id);
                }
            }
        </script>
    @endpush
</div>
