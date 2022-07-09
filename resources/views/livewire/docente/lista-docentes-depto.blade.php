<div class="space-y-6">
    <div>
        <h2 class="text-zinc-800 text-xl font-bold">
            Docentes del departamento académico <span class="font-black">{{ $depto->nombre }}</span>
        </h2>
        <h3 class="text-zinc-600">
            Facultad de {{ $depto->facultad->nombre }}
        </h3>
    </div>

    <div class="flex items-center justify-between">
        <x-utils.forms.search-input wire:model.debounce.500ms="search"/>

        <x-utils.buttons.default wire:click="abrirModal" class="text-sm">
            <x-icons.refresh class="icon-5 mr-1" wire:loading.class="animate-spin" wire:target="abrirModal"/>
            Actualizar docentes
        </x-utils.buttons.default>
    </div>

    <x-utils.tables.table>
        @slot('head')
            <x-utils.tables.head>Nombre del docente</x-utils.tables.head>
            <x-utils.tables.head>Contacto</x-utils.tables.head>
            <x-utils.tables.head>Categoría</x-utils.tables.head>
            <x-utils.tables.head>Condición</x-utils.tables.head>
            <x-utils.tables.head>Dedicación</x-utils.tables.head>
        @endslot
        @slot('body')
            @foreach($docentes as $docente)
                <x-utils.tables.row>
                    <x-utils.tables.body class="text-xs">
                        <p class="font-bold">
                            {{ $docente->persona->apellido_paterno }} {{ $docente->persona->apellido_materno }} {{ $docente->persona->nombres }}
                        </p>
                        <p class="font-semibold block">
                            DNI: {{ $docente->persona->dni }}
                        </p>
                    </x-utils.tables.body>
                    <x-utils.tables.body class="whitespace-nowrap">
                        Correo: <a href="mailto:{{ $docente->persona->correo }}"
                                   class="hover:text-blue-600">{{ $docente->persona->correo }}</a>
                        <p class="block">Celular: {{ $docente->persona->celular }}</p>
                    </x-utils.tables.body>
                    <x-utils.tables.body class="text-xs">{{ $docente->categoria->nombre }}</x-utils.tables.body>
                    <x-utils.tables.body class="text-xs">{{ $docente->condicion->nombre }}</x-utils.tables.body>
                    <x-utils.tables.body class="text-xs">{{ $docente->dedicacion->nombre }}</x-utils.tables.body>
                </x-utils.tables.row>
            @endforeach
        @endslot
    </x-utils.tables.table>

    <x-jet-dialog-modal wire:model="open" maxWidth="4xl">
        <x-slot name="title">
            <div class="flex justify-end w-full">
                <x-utils.buttons.close-button wire:click="$set('open', false)"/>
            </div>
        </x-slot>

        <x-slot name="content">
            @if(!is_null($docentesAPI) && count($docentesAPI))
                <div class="flex items-center bg-sky-400/20 text-sky-700 text-sm font-bold px-3 py-2 rounded-md mb-2"
                     role="alert">
                    <x-icons.info class="icon-5 mr-2"/>
                    <p>{{count($docentesAPI)}} docentes nuevos encontrados
                        @if(count($docentes_seleccionados))
                            / {{ count($docentes_seleccionados) }} docentes seleccionados
                    @endif
                </div>
                <x-utils.tables.table>
                    @slot('head')
                        <x-utils.tables.head></x-utils.tables.head>
                        <x-utils.tables.head>DNI</x-utils.tables.head>
                        <x-utils.tables.head>Nombre del docente</x-utils.tables.head>
                        <x-utils.tables.head>Grado</x-utils.tables.head>
                        <x-utils.tables.head>Categoría</x-utils.tables.head>
                        <x-utils.tables.head>Condición</x-utils.tables.head>
                        <x-utils.tables.head>Dedicación</x-utils.tables.head>
                        <x-utils.tables.head><span class="sr-only">Acciones</span></x-utils.tables.head>
                    @endslot
                    @slot('body')
                        @foreach($docentesAPI as $doc)
                            <x-utils.tables.row>
                                <x-utils.tables.body>
                                    <x-utils.forms.checkbox wire:model="docentes_seleccionados"
                                                            wire:loading.attr="disabled" value="{{ $doc['dni'] }}"/>
                                </x-utils.tables.body>
                                <x-utils.tables.body class="text-xs">{{ $doc['dni'] }}</x-utils.tables.body>
                                <x-utils.tables.body class="text-xs">{{ $doc['nombre_completo'] }}</x-utils.tables.body>
                                <x-utils.tables.body class="text-xs">{{ $doc['grado'] }}</x-utils.tables.body>
                                <x-utils.tables.body class="text-xs">{{ $doc['categoria'] }}</x-utils.tables.body>
                                <x-utils.tables.body class="text-xs">{{ $doc['condicion'] }}</x-utils.tables.body>
                                <x-utils.tables.body class="text-xs">{{ $doc['dedicacion'] }}</x-utils.tables.body>
                            </x-utils.tables.row>
                        @endforeach
                    @endslot
                </x-utils.tables.table>
            @else
                <div class="border border-gray-300 rounded-md">
                    <x-utils.message-no-items
                        title="Docentes actualizados"
                        text="No hay docentes nuevos, todos los docentes del departamento académico ya estan registrados en el sistema.">
                        @slot('icon')
                            <svg class="text-gray-400 fill-current" viewBox="0 0 24 24" width="24" height="24">
                                <path fill-rule="evenodd"
                                      d="M3.5 8a5.5 5.5 0 118.596 4.547 9.005 9.005 0 015.9 8.18.75.75 0 01-1.5.045 7.5 7.5 0 00-14.993 0 .75.75 0 01-1.499-.044 9.005 9.005 0 015.9-8.181A5.494 5.494 0 013.5 8zM9 4a4 4 0 100 8 4 4 0 000-8z"></path>
                                <path
                                    d="M17.29 8c-.148 0-.292.01-.434.03a.75.75 0 11-.212-1.484 4.53 4.53 0 013.38 8.097 6.69 6.69 0 013.956 6.107.75.75 0 01-1.5 0 5.193 5.193 0 00-3.696-4.972l-.534-.16v-1.676l.41-.209A3.03 3.03 0 0017.29 8z"></path>
                            </svg>
                        @endslot
                    </x-utils.message-no-items>
                </div>
            @endif
        </x-slot>

        @if(!is_null($docentesAPI) && count($docentesAPI))
            <x-slot name="footer">
                <x-jet-button
                    wire:click="guardarDocentes"
                    wire:loading.class="cursor-wait"
                    wire:loading.attr="disabled">
                    <x-icons.load wire:loading wire:target="guardarDocentes" class="icon-5"/>
                    Agregar docentes
                </x-jet-button>
            </x-slot>
        @endif
    </x-jet-dialog-modal>

</div>
