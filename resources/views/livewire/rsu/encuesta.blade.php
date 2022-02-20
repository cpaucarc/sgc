<x-utils.card>
    @slot('header')
        <div class="flex justify-between items-center">
            <h3 class="font-bold tracking-wide text-gray-400">
                Encuesta
            </h3>

            @if($es_responsable)
                <x-utils.buttons.ghost-button wire:click="openModal" class="text-gray-500 hover:text-gray-700">
                    <x-icons.link class="h-5 w-5 mr-2" stroke="1.55"></x-icons.link>
                    Generar
                </x-utils.buttons.ghost-button>
            @endif
        </div>
    @endslot

    @if($rsu->links_count > 0)
        <x-utils.tables.table>
            @slot('head')
                <x-utils.tables.head>Código de encuesta</x-utils.tables.head>
                <x-utils.tables.head><span class="sr-only">Estado</span></x-utils.tables.head>
                <x-utils.tables.head>Expiración</x-utils.tables.head>
                <x-utils.tables.head>Creación</x-utils.tables.head>
                <x-utils.tables.head><span class="sr-only">Acción</span></x-utils.tables.head>
            @endslot
            @slot('body')
                @foreach($rsu->links as $link)
                    <x-utils.tables.row>
                        <x-utils.tables.body class="font-semibold">
                            <a href="{{ $link->link }}" target="_blank"
                               class="hover:text-sky-600 hover:underline line-clamp-1">
                                {{ $link->uuid }}
                            </a>
                        </x-utils.tables.body>
                        <x-utils.tables.body>
                            <x-utils.badge
                                class="{{$link->fecha_expiracion > now() ? 'bg-green-100 text-green-700':'bg-red-100 text-red-700'}}">
                                {{$link->fecha_expiracion > now() ?
                                'Expira en ' . $link->fecha_expiracion->diffForHumans() :
                                'Expirado '.$link->fecha_expiracion->diffForHumans()}}
                            </x-utils.badge>
                        </x-utils.tables.body>
                        <x-utils.tables.body>
                            {{$link->fecha_expiracion->format('d-m-Y') }}
                        </x-utils.tables.body>
                        <x-utils.tables.body>
                            {{$link->created_at->format('d-m-Y h:m a') }}
                        </x-utils.tables.body>
                        <x-utils.tables.body>
                            <x-utils.buttons.ghost-button
                                class="text-gray-500 hover:text-gray-700 active:border-sky-300 active:text-sky-700 active:scale-90"
                                onclick="copyToClipboard('{{ $link->link }}')">
                                <x-icons.clipboard class="h-5 w-5"></x-icons.clipboard>
                            </x-utils.buttons.ghost-button>
                        </x-utils.tables.body>
                    </x-utils.tables.row>
                @endforeach
            @endslot
        </x-utils.tables.table>
    @else
        <p class="font-bold">No hay encuestas generadas</p>
    @endif

    <x-jet-dialog-modal wire:model="open" maxWidth="xl">

        <x-slot name="title">
            <h1 class="font-bold text-gray-700">
                Generar nueva encuesta
            </h1>
            <x-utils.buttons.close-button wire:click="$set('open', false)"/>
        </x-slot>

        <x-slot name="content">

            <div class="my-4">

                {{--                @if(!$mostrarLink)--}}
                <x-jet-label for="fecha_de_expiracion" value="{{ __('Fecha de expiración de encuesta') }}"/>
                <div class="flex space-x-4">
                    <x-jet-input id="fecha_de_expiracion" class="flex-1" wire:model.defer="fecha_de_expiracion"
                                 type="date" name="fecha_de_expiracion" required autofocus/>

                    <x-jet-button wire:click="crearEncuesta" wire:target="crearEncuesta" wire:loading.attr="disabled">
                        <x-icons.load wire:loading wire:target="crearEncuesta" class="h-5 w-5"/>
                        <x-icons.link wire:loading.remove wire:target="crearEncuesta" class="h-5 w-5 mr-2"/>
                        {{ __('Crear encuesta') }}
                    </x-jet-button>
                </div>
                <x-jet-input-error for="fecha_de_expiracion"></x-jet-input-error>

                <p class="text-gray-600 text-sm inline-flex mt-2">
                    <x-icons.info class="h-5 w-5 mr-1 flex-shrink-0"></x-icons.info>
                    Luego de esta fecha, la encuesta ya no se podrá responder
                </p>

                {{--                @else--}}
                {{--                    <div class="flex items-end space-x-4">--}}
                {{--                        <div class="w-full flex-1 mr-1">--}}
                {{--                            <x-jet-label for="link">Link generado</x-jet-label>--}}
                {{--                            <input wire:model="link" type="text" id="link" class="input-form w-full bg-gray-50 text-sm">--}}
                {{--                        </div>--}}
                {{--                        <x-button-void onclick="copyToClipboard()">--}}
                {{--                            <x-icons.clipboard class="h-5 w-5"></x-icons.clipboard>--}}
                {{--                        </x-button-void>--}}
                {{--                    </div>--}}
                {{--                    <span class="text-gray-600 text-sm inline-flex mt-2">--}}
                {{--                        <x-icons.info class="h-5 w-5 mr-1"></x-icons.info>--}}
                {{--                        Puede copiar este enlace y compartir con las personas de interes.--}}
                {{--                    </span>--}}
                {{--                @endif--}}

            </div>


        </x-slot>

    </x-jet-dialog-modal>

    @push('js')
        <script>
            function copyToClipboard(text) {
                if (navigator && navigator.clipboard && navigator.clipboard.writeText)
                    return navigator.clipboard.writeText(text);
                return Promise.reject('The Clipboard API is not available.');
            }
        </script>
    @endpush

</x-utils.card>
