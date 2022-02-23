<div>
    <x-utils.card>
        <x-slot name="header">
            <div class="flex justify-between items-center">
                <h1 class="text-xl font-bold text-gray-800">
                    Salidas
                </h1>
            </div>
            <p class="text-sm text-gray-400">
                Son documentos que usted enviará para completar la presente actividad
            </p>
        </x-slot>

        <div class="space-y-2">
            @forelse( $salidas as $salida)
                <div class="ml-2 py-2 flex items-center">
                    <div class="w-10 h-10 rounded-full bg-sky-100 grid place-content-center mr-2">
                        <small class="text-sky-700 font-semibold">
                            {{ $salida->codigo }}
                        </small>
                    </div>
                    <div class="truncate flex-1 mr-2">
                        <h2 class="text-gray-800 text-sm">
                            {{ $salida->nombre }}
                        </h2>
                    </div>
                    <x-utils.buttons.default wire:click="abrirModal({{$salida->id}})" class="text-xs">
                        <x-icons.open-modal class="h-4 w-4 mr-1" stroke="1.5" />
                        Revisar
                    </x-utils.buttons.default>
                </div>
            @empty
                <p>No hay salidas</p>
            @endforelse
        </div>
    </x-utils.card>

    @if($salida_seleccionado)
        <x-jet-dialog-modal wire:model="open" maxWidth="3xl">
            <x-slot name="title">
                <h1 class="font-bold text-gray-700">
                    {{ $salida_seleccionado->nombre }}
                </h1>
                <x-utils.buttons.close-button wire:click="$set('open', false)"/>
            </x-slot>

            <x-slot name="content">

                <div class="space-y-8">
                    <div class="space-y-2">
                        <h2 class="text-gray-600 text-sm font-bold">Subir archivo:</h2>
                        <x-utils.forms.file-input class="w-full block" wire:model.defer="archivo"/>
                        <x-jet-input-error for="archivo"></x-jet-input-error>
                    </div>

                    <details class="space-y-2">
                        <summary class="flex items-center space-x-2 cursor-pointer">
                            <h2 class="text-gray-600 text-sm font-bold">Documentos enviados:</h2>
                            <span class="text-gray-400 hover:text-sky-700 text-sm">[Ver]</span>
                        </summary>
                        @if(count($documentos) > 0)
                            <x-utils.tables.table>
                                @slot('body')
                                    @foreach($documentos as $documento_enviado)
                                        <x-utils.tables.row class="p-1">
                                            <x-utils.tables.body class="text-left">
                                                <div class="flex items-center gap-x-2">
                                                    <svg class="text-gray-400" viewBox="0 0 16 16" width="16"
                                                         height="16" fill="currentColor">
                                                        <path fill-rule="evenodd"
                                                              d="M3.75 1.5a.25.25 0 00-.25.25v11.5c0 .138.112.25.25.25h8.5a.25.25 0 00.25-.25V6H9.75A1.75 1.75 0 018 4.25V1.5H3.75zm5.75.56v2.19c0 .138.112.25.25.25h2.19L9.5 2.06zM2 1.75C2 .784 2.784 0 3.75 0h5.086c.464 0 .909.184 1.237.513l3.414 3.414c.329.328.513.773.513 1.237v8.086A1.75 1.75 0 0112.25 15h-8.5A1.75 1.75 0 012 13.25V1.75z"></path>
                                                    </svg>
                                                    @if(strlen($documento_enviado->documento->nombre) > 80)
                                                        {{ substr($documento_enviado->documento->nombre, 0, 55) }}
                                                        ...{{ substr($documento_enviado->documento->nombre, -25) }}
                                                    @else
                                                        {{ $documento_enviado->documento->nombre }}
                                                    @endif
                                                </div>
                                            </x-utils.tables.body>
                                            <x-utils.tables.body class="text-right">
                                                {{ $documento_enviado->documento->created_at->diffForHumans() }}
                                            </x-utils.tables.body>
                                            <x-utils.tables.body class="text-right">
                                                <div
                                                    class="flex items-center justify-end w-full gap-2 whitespace-nowrap">
                                                    <x-utils.links.default class="group text-xs" target="_blank"
                                                        href="{{ route('archivos', $documento_enviado->documento->enlace_interno) }}">
                                                        <x-icons.documents class="h-4 w-4" stroke="1.5"/>
                                                        Ver
                                                    </x-utils.links.default>
                                                    <x-utils.buttons.danger class="group"
                                                        wire:click="eliminarArchivo({{ $documento_enviado->documento->id }})">
                                                        <x-icons.delete :stroke="1.5" class="h-4 w-4"/>
                                                    </x-utils.buttons.danger>
                                                </div>
                                            </x-utils.tables.body>
                                        </x-utils.tables.row>
                                    @endforeach
                                @endslot
                            </x-utils.tables.table>
                        @else
                            <div class="grid place-items-center">
                                <div class="flex items-center">
                                    <img src="{{ asset('images/svg/sin_documentos.svg') }}" class="w-24"
                                         alt="Grafico">
                                    <p class="font-bold text-gray-600">
                                        Aún no has enviado ningun documento
                                    </p>
                                </div>
                            </div>
                        @endif
                    </details>

                    <div class="space-y-2">
                        <h2 class="text-gray-600 text-sm font-bold">
                            Esta información será visto por las siguientes entidades:
                        </h2>
                        <ul class="mt-1 flex flex-wrap gap-2">
                            @foreach($clientes as $cliente)
                                <li class="bg-gray-100 text-xs rounded-full text-gray-700 font-medium px-3 py-1">
                                    {{ $cliente }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </x-slot>

            <x-slot name="footer">

                <x-jet-secondary-button wire:click="$set('open', false)">
                    Cerrar
                </x-jet-secondary-button>

                <x-jet-button
                    wire:click="enviarArchivo"
                    wire:target="enviarArchivo, archivo"
                    wire:loading.class="cursor-not-allowed"
                    wire:loading.attr="disabled">
                    <x-icons.load class="h-4 w-4" wire:loading wire:target="enviarArchivo"></x-icons.load>
                    {{ __('Guardar') }}
                </x-jet-button>
            </x-slot>
        </x-jet-dialog-modal>
    @endif

    @push('js')
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Livewire.on('guardado', msg => {
                Swal.fire({
                    icon: 'success',
                    title: '',
                    text: msg,
                });
            });
            Livewire.on('error', msg => {
                Swal.fire({
                    icon: 'error',
                    title: '',
                    text: msg,
                });
            });
        </script>
    @endpush
</div>
