<div>
    @if(!is_null($solicitud))
        <x-utils.tables.table>
            @slot('head')
                <x-utils.tables.head>N°</x-utils.tables.head>
                <x-utils.tables.head>Requisito</x-utils.tables.head>
                <x-utils.tables.head>Enviado</x-utils.tables.head>
                <x-utils.tables.head>Estado</x-utils.tables.head>
                <x-utils.tables.head class="text-right">
                    <span class="hidden">Acciones</span>
                </x-utils.tables.head>
            @endslot
            @slot('body')
                @foreach($solicitud->documentos as $i => $documentos)
                    <x-utils.tables.row>
                        <x-utils.tables.body>
                            {{ ($i+1) }}
                        </x-utils.tables.body>
                        <x-utils.tables.body>
                            <x-utils.links.basic href="{{ route('archivos', $documentos->documento->enlace_interno) }}"
                                                 target="_blank">
                                {{ $documentos->requisito->nombre}}
                            </x-utils.links.basic>
                        </x-utils.tables.body>
                        <x-utils.tables.body class="whitespace-nowrap">
                            {{ $documentos->documento->updated_at->format('d-m-Y h:i a')}}
                        </x-utils.tables.body>
                        <x-utils.tables.body>
                            <buttons
                                class="inline-flex items-center text-{{ $documentos->estado->color  }}-700 border border-{{ $documentos->estado->color  }}-200 bg-{{ $documentos->estado->color  }}-100 rounded-lg text-sm px-3 py-1 whitespace-nowrap">
                                {{ $documentos->estado->nombre }}
                            </buttons>
                        </x-utils.tables.body>
                        <x-utils.tables.body>
                            @if($documentos->estado->nombre ==="Denegado")
                                <x-utils.buttons.default
                                    wire:click="seleccionar('true',{{$documentos->requisito->id}})">
                                    <x-icons.edit class="h-4 mr-1" stroke="1.5"></x-icons.edit>
                                </x-utils.buttons.default>
                            @endif
                        </x-utils.tables.body>
                    </x-utils.tables.row>
                @endforeach
            @endslot
        </x-utils.tables.table>
    @else
        <x-utils.message-image>
            <x-slot name="title">Aún no has enviado ningun documento</x-slot>
            <x-slot name="description">
                La solicitud se generará automaticamente cuando envies el primer documento.
            </x-slot>
            <x-slot name="image">{{ asset('images/svg/sin_documentos.svg')  }}</x-slot>
        </x-utils.message-image>
    @endif


    <x-jet-dialog-modal wire:model="modal">
        @slot('title')
            <h1 class="font-bold text-gray-700">
                Actualizar requisito
            </h1>
            <x-utils.buttons.close-button wire:click="$set('modal', false)"/>
        @endslot
        @slot('content')
            <div class="space-y-6">
                <div class="space-y-2">
                    <x-jet-label for="archivo" value="{{ __('Archivo Adjunto. (Peso max: 25Mb)') }}"/>
                    <x-utils.file-uploading>
                        <x-utils.forms.file-input class="w-full block" wire:model.defer="archivo"/>
                    </x-utils.file-uploading>
                    {{--<x-utils.loading-file wire:loading wire:target="archivo"></x-utils.loading-file>--}}
                    <x-jet-input-error for="archivo"></x-jet-input-error>
                </div>
            </div>
        @endslot
        @slot('footer')
            <x-jet-secondary-button wire:click="$set('modal', false)">
                Cerrar
            </x-jet-secondary-button>
            <x-jet-button
                wire:click="actualizarDocumento"
                wire:target="actualizarDocumento, archivo"
                wire:loading.class="bg-gray-800"
                wire:loading.attr="disabled">
                <x-icons.load wire:loading wire:target="actualizarDocumento" class="h-5 w-5"
                              stroke="1.5"></x-icons.load>
                {{ __('Guardar') }}
            </x-jet-button>
        @endslot
    </x-jet-dialog-modal>
</div>
