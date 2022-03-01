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
                            {{ $documentos->requisito->nombre}}
                        </x-utils.tables.body>
                        <x-utils.tables.body>
                            {{ $documentos->documento->created_at->format('d M Y')}}
                        </x-utils.tables.body>
                        <x-utils.tables.body>
                            <x-utils.buttons.basic-button
                                class="cursor-not-allowed inline-flex items-center text-{{ $documentos->estado->color }}-700 border-{{ $documentos->estado->color }}-200 bg-{{ $documentos->estado->color }}-100 text-xs">
                                {{ $documentos->estado->nombre }}
                            </x-utils.buttons.basic-button>
                        </x-utils.tables.body>
                        <x-utils.tables.body>
                            <div
                                class="flex items-center justify-end w-full gap-2 whitespace-nowrap">
                                <x-utils.links.ghost-link
                                    class="group hover:text-sky-700 flex items-center text-xs"
                                    target="_blank"
                                    href="{{ route('archivos', $documentos->documento->enlace_interno) }}">
                                    <x-icons.documents class="h-4 w-4 group-hover:text-sky-600"
                                                       stroke="1.25"/>
                                    Ver
                                </x-utils.links.ghost-link>
                                {{--<x-utils.buttons.ghost-button
                                    class="group hover:border-rose-600"
                                    wire:click="eliminarArchivo({{ $documentos->documento->id }})">
                                    <x-icons.delete :stroke="1.25"
                                                    class="h-4 w-4 group-hover:text-rose-700"/>
                                </x-utils.buttons.ghost-button>--}}
                            </div>
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
</div>
