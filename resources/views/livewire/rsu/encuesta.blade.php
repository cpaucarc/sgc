<div class="space-y-2">

    <div class="flex justify-between items-center">
        <h3 class="font-bold tracking-wide text-gray-600">
            Encuestas
        </h3>

        @if($es_responsable and $rsu->links_count > 0)
            <x-utils.buttons.default wire:click="openModal" class="text-sm">
                <x-icons.link class="icon-5 mr-1" stroke="1.5"></x-icons.link>
                Generar
            </x-utils.buttons.default>
        @endif
    </div>

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
                            <x-utils.links.basic target="_blank" href="{{ route('encuesta.rsu', $link->uuid) }}"
                                                 class="text-sm">
                                {{ $link->uuid }}
                            </x-utils.links.basic>
                        </x-utils.tables.body>
                        <x-utils.tables.body>
                            <x-utils.badge
                                class="{{$link->fecha_expiracion > now() ? 'bg-green-100 text-green-600':'bg-rose-100 text-rose-600'}}">
                                {{$link->fecha_expiracion > now() ?
                                'Expira ' . $link->fecha_expiracion->diffForHumans() :
                                'Expirado '.$link->fecha_expiracion->diffForHumans()}}
                            </x-utils.badge>
                        </x-utils.tables.body>
                        <x-utils.tables.body class="whitespace-nowrap">
                            {{$link->fecha_expiracion->format('d/m/Y') }}
                        </x-utils.tables.body>
                        <x-utils.tables.body class="whitespace-nowrap">
                            {{$link->created_at->format('d/m/Y h:m a') }}
                        </x-utils.tables.body>
                        <x-utils.tables.body>
                            <x-utils.buttons.default class="active:scale-95"
                                                     onclick="copyToClipboard('{{ $link->link }}')">
                                <x-icons.clipboard class="icon-5" stroke="1.5"></x-icons.clipboard>
                            </x-utils.buttons.default>
                        </x-utils.tables.body>
                    </x-utils.tables.row>
                @endforeach
            @endslot
        </x-utils.tables.table>
    @else
        <div class="border border-gray-300 rounded-md">
            <x-utils.message-no-items
                title="Aún no hay encuestas generadas"
                text="Cree encuestas para medir la satisfacción de los beneficiarios de la RSU.">
                @slot('icon')
                    <svg class="text-gray-400" fill="currentColor" viewBox="0 0 24 24" width="24" height="24">
                        <path
                            d="M3.5 3.75a.25.25 0 01.25-.25h13.5a.25.25 0 01.25.25v10a.75.75 0 001.5 0v-10A1.75 1.75 0 0017.25 2H3.75A1.75 1.75 0 002 3.75v16.5c0 .966.784 1.75 1.75 1.75h7a.75.75 0 000-1.5h-7a.25.25 0 01-.25-.25V3.75z"></path>
                        <path
                            d="M6.25 7a.75.75 0 000 1.5h8.5a.75.75 0 000-1.5h-8.5zm-.75 4.75a.75.75 0 01.75-.75h4.5a.75.75 0 010 1.5h-4.5a.75.75 0 01-.75-.75zm16.28 4.53a.75.75 0 10-1.06-1.06l-4.97 4.97-1.97-1.97a.75.75 0 10-1.06 1.06l2.5 2.5a.75.75 0 001.06 0l5.5-5.5z"></path>
                    </svg>
                @endslot
                @if($es_responsable)
                    <x-jet-button wire:click="openModal" class="text-sm">
                        Crear mi primera encuesta
                    </x-jet-button>
                @endif
            </x-utils.message-no-items>
        </div>
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
                <x-jet-label for="fecha_de_expiracion" value="{{ __('Fecha de expiración de encuesta') }}"/>
                <div class="flex space-x-4">
                    <x-jet-input id="fecha_de_expiracion" class="flex-1" wire:model.defer="fecha_de_expiracion"
                                 type="date" name="fecha_de_expiracion" required autofocus/>

                    <x-jet-button wire:click="crearEncuesta" wire:target="crearEncuesta" wire:loading.attr="disabled">
                        <x-icons.load wire:loading wire:target="crearEncuesta" class="icon-5"/>
                        <x-icons.link wire:loading.remove wire:target="crearEncuesta" class="icon-5 mr-2"/>
                        {{ __('Crear encuesta') }}
                    </x-jet-button>
                </div>
                <x-jet-input-error for="fecha_de_expiracion"></x-jet-input-error>

                <p class="text-gray-600 text-sm inline-flex mt-2">
                    <x-icons.info class="h-5 w-5 mr-1 flex-shrink-0"></x-icons.info>
                    Luego de esta fecha, la encuesta ya no se podrá responder
                </p>
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

</div>
