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

        <div class="space-y-4">
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
                        <p class="text-gray-500 text-xs">
                            {{ $salida->clientes_count }}
                            <span class="text-gray-400">clientes</span>
                        </p>
                    </div>
                    <x-utils.buttons.ghost-button wire:click="abrirModal({{$salida->id}})"
                                                  class="text-xs text-gray-500 hover:text-gray-700">
                        <x-icons.open-modal class="h-4 w-4 mr-1" stroke="1.2"></x-icons.open-modal>
                        Revisar
                    </x-utils.buttons.ghost-button>
                </div>
            @empty
                <p>No hay salidas</p>
            @endforelse
        </div>

        <x-utils.dd>
            {{ $salida_seleccionado }}
        </x-utils.dd>

    </x-utils.card>

    {{--    @if($salida_seleccionado)--}}
    {{--        <x-jet-dialog-modal wire:model="open" maxWidth="3xl">--}}
    {{--            <x-slot name="title">--}}
    {{--                <h1 class="font-bold text-gray-700">--}}
    {{--                    {{ $salida_seleccionado->nombre }}--}}
    {{--                </h1>--}}
    {{--                <x-utils.buttons.close-button wire:click="$set('open', false)"/>--}}
    {{--            </x-slot>--}}

    {{--            <x-slot name="content">--}}

    {{--                <div class="space-y-8">--}}
    {{--                    <div class="space-y-2">--}}
    {{--                        <h2 class="text-gray-600 text-sm font-bold">Subir archivo:</h2>--}}
    {{--                        <x-utils.forms.basic-file-input class="w-full block" wire:model.defer="archivo"/>--}}
    {{--                        <x-jet-input-error for="archivo"></x-jet-input-error>--}}
    {{--                    </div>--}}

    {{--                    <details class="space-y-2">--}}
    {{--                        <summary class="flex items-center space-x-2 cursor-pointer">--}}
    {{--                            <h2 class="text-gray-600 text-sm font-bold">Documentos enviados:</h2>--}}
    {{--                            <span class="text-gray-400 hover:text-sky-700 text-sm">[Ver]</span>--}}
    {{--                        </summary>--}}
    {{--                        @if($salida_seleccionado->documentos)--}}
    {{--                            <div class="table w-full text-gray-700">--}}
    {{--                                <x-utils.tables.table>--}}
    {{--                                    @slot('body')--}}
    {{--                                        @foreach($salida_seleccionado->documentos as $documento_enviado)--}}
    {{--                                            <x-utils.tables.row class="p-1">--}}
    {{--                                                <x-utils.tables.body class="text-left text-sm">--}}
    {{--                                                    @if(strlen($documento_enviado->documento->nombre) > 60)--}}
    {{--                                                        {{ substr($documento_enviado->documento->nombre, 0, 45) }}--}}
    {{--                                                        ...{{ substr($documento_enviado->documento->nombre, -15) }}--}}
    {{--                                                    @else--}}
    {{--                                                        {{ $documento_enviado->documento->nombre }}--}}
    {{--                                                    @endif--}}
    {{--                                                </x-utils.tables.body>--}}
    {{--                                                <x-utils.tables.body class="text-right text-sm">--}}
    {{--                                                    {{ $documento_enviado->documento->created_at->diffForHumans() }}--}}
    {{--                                                </x-utils.tables.body>--}}
    {{--                                                <x-utils.tables.body class="text-right">--}}
    {{--                                                    <div--}}
    {{--                                                        class="flex items-center justify-end w-full gap-2 whitespace-nowrap">--}}
    {{--                                                        <x-utils.links.ghost-link--}}
    {{--                                                            class="group hover:text-sky-700 flex items-center text-xs"--}}
    {{--                                                            target="_blank"--}}
    {{--                                                            href="{{ route('archivos', $documento_enviado->documento->enlace_interno) }}">--}}
    {{--                                                            <x-icons.documents class="h-4 w-4 group-hover:text-sky-600"--}}
    {{--                                                                               stroke="1.25"/>--}}
    {{--                                                            Ver--}}
    {{--                                                        </x-utils.links.ghost-link>--}}
    {{--                                                        <x-utils.buttons.ghost-button--}}
    {{--                                                            class="group hover:border-rose-600"--}}
    {{--                                                            wire:click="eliminarArchivo({{ $documento_enviado->documento->id }})">--}}
    {{--                                                            <x-icons.delete :stroke="1.25"--}}
    {{--                                                                            class="h-4 w-4 group-hover:text-rose-700"/>--}}
    {{--                                                        </x-utils.buttons.ghost-button>--}}
    {{--                                                    </div>--}}
    {{--                                                </x-utils.tables.body>--}}
    {{--                                            </x-utils.tables.row>--}}
    {{--                                        @endforeach--}}
    {{--                                    @endslot--}}
    {{--                                </x-utils.tables.table>--}}
    {{--                            </div>--}}
    {{--                        @else--}}
    {{--                            <div class="grid place-items-center">--}}
    {{--                                <div class="flex items-center">--}}
    {{--                                    --}}{{--                                    <img src="{{ asset('images/ilustraciones/sin_documentos.svg') }}" class="w-24"--}}
    {{--                                    --}}{{--                                         alt="Grafico">--}}
    {{--                                    <p class="font-bold text-gray-600">--}}
    {{--                                        Aún no has enviado ningun documento--}}
    {{--                                    </p>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        @endif--}}
    {{--                    </details>--}}

    {{--                    <div class="space-y-2">--}}
    {{--                        <h2 class="text-gray-600 text-sm font-bold">--}}
    {{--                            Esta información será visto por los siguientes clientes:--}}
    {{--                        </h2>--}}
    {{--                        <ul class="mt-1 flex flex-wrap gap-2">--}}
    {{--                            @foreach($salida_seleccionado->clientes as $cliente)--}}
    {{--                                <li class="bg-gray-100 text-xs rounded-full text-gray-700 font-medium px-3 py-1">--}}
    {{--                                    {{ $cliente->nombre }}--}}
    {{--                                </li>--}}
    {{--                            @endforeach--}}
    {{--                        </ul>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </x-slot>--}}

    {{--            <x-slot name="footer">--}}

    {{--                <x-jet-secondary-button wire:click="$set('open', false)">--}}
    {{--                    Cerrar--}}
    {{--                </x-jet-secondary-button>--}}

    {{--                <x-jet-button--}}
    {{--                    wire:click="enviarArchivo"--}}
    {{--                    wire:target="enviarArchivo, archivo"--}}
    {{--                    wire:loading.attr="disabled">--}}
    {{--                    <x-icons.load class="h-4 w-4" wire:loading wire:target="enviarArchivo"></x-icons.load>--}}
    {{--                    {{ __('Guardar') }}--}}
    {{--                </x-jet-button>--}}
    {{--            </x-slot>--}}
    {{--        </x-jet-dialog-modal>--}}
    {{--    @endif--}}

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
