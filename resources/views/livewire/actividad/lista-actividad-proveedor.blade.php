<x-utils.card>
    @slot('header')
        <div class="flex justify-between items-center space-x-2">
            <div class="pr-4 flex-1">
                <h1 class="text-xl font-bold text-gray-800">
                    Información a proveer
                </h1>
                <p class="text-sm text-gray-400">
                    En esta sección usted podrá ver la lista de documentos con las que debe proveer a los diferentes
                    actividades.
                </p>
            </div>

            <x-utils.forms.basic-select class="w-24" wire:model="semestre_seleccionado">
                @forelse($semestres as $semestre)
                    <option value="{{ $semestre->id }}">{{$semestre->nombre}}</option>
                @empty
                    <option value="0">No hay datos</option>
                @endforelse
            </x-utils.forms.basic-select>

            <x-utils.forms.basic-select wire:model="proceso_seleccionado">
                @forelse($procesos as $proceso)
                    <option value="{{ $proceso->id }}">Proceso {{$proceso->nombre}}</option>
                @empty
                    <option value="0">No hay datos</option>
                @endforelse
            </x-utils.forms.basic-select>
        </div>
    @endslot

    <x-utils.tables.table>
        @slot('head')
            <x-utils.tables.head>Entrada</x-utils.tables.head>
            <x-utils.tables.head>Actividad</x-utils.tables.head>
            <x-utils.tables.head>Estado</x-utils.tables.head>
            <x-utils.tables.head>
                <span class=" sr-only">Ver</span>
            </x-utils.tables.head>
        @endslot
        @slot('body')
            @foreach($proveer as $prov)
                <x-utils.tables.row>
                    <x-utils.tables.body class="font-semibold">
                        <h2 class="font-bold">
                            {{ $prov->entrada->nombre }}
                        </h2>
                    </x-utils.tables.body>
                    <x-utils.tables.body>
                        <p class="text-gray-500">
                            {{ $prov->responsable->actividad->nombre }}
                        </p>
                    </x-utils.tables.body>
                    <x-utils.tables.body>
                        <x-utils.badge
                            class="whitespace-nowrap text-xs {{$prov->cantidad > 0 ? 'bg-green-100 text-green-700' : 'bg-rose-100 text-rose-700'}}">
                            {{ $prov->cantidad > 0  ? 'Completado' : 'Sin completar' }}
                        </x-utils.badge>
                    </x-utils.tables.body>
                    <x-utils.tables.body>
                        <x-utils.buttons.text-button wire:click="abrirModal({{$prov->id}})"
                                                     class="text-gray-500 hover:text-indigo-600">
                            Revisar
                        </x-utils.buttons.text-button>
                    </x-utils.tables.body>
                </x-utils.tables.row>
            @endforeach
        @endslot
    </x-utils.tables.table>

    @if($proveedor_seleccionado)
        <x-jet-dialog-modal wire:model="open" maxWidth="3xl">
            <x-slot name="title">
                <div class="flex-col">
                    <h1 class="font-bold text-gray-700">
                        {{ $proveedor_seleccionado->entrada->nombre }}
                    </h1>
                    <p class="text-gray-500 text-sm">
                        Actividad: {{ $proveedor_seleccionado->responsable->actividad->nombre }}
                    </p>
                </div>
                <x-utils.buttons.close-button wire:click="$set('open', false)"/>
            </x-slot>

            <x-slot name="content">

                <div class="space-y-8">
                    <div class="space-y-2">
                        <h2 class="text-gray-600 text-sm font-bold">Subir archivo:</h2>
                        <x-utils.forms.basic-file-input class="w-full block" wire:model.defer="archivo"/>
                        <x-jet-input-error for="archivo"></x-jet-input-error>
                    </div>

                    <details class="space-y-2">
                        <summary class="flex items-center space-x-2 cursor-pointer">
                            <h2 class="text-gray-600 text-sm font-bold">Documentos enviados:</h2>
                            <span class="text-gray-400 hover:text-sky-700 text-sm">[Ver]</span>
                        </summary>
                        @if(count($documentos) > 0)
                            <div class="table w-full text-gray-700">
                                <x-utils.tables.table>
                                    @slot('body')
                                        @foreach($documentos as $documento_enviado)
                                            <x-utils.tables.row class="p-1">
                                                <x-utils.tables.body class="text-left text-sm">
                                                    @if(strlen($documento_enviado->documento->nombre) > 60)
                                                        {{ substr($documento_enviado->documento->nombre, 0, 45) }}
                                                        ...{{ substr($documento_enviado->documento->nombre, -15) }}
                                                    @else
                                                        {{ $documento_enviado->documento->nombre }}
                                                    @endif
                                                </x-utils.tables.body>
                                                <x-utils.tables.body class="text-right text-sm">
                                                    {{ $documento_enviado->documento->created_at->diffForHumans() }}
                                                </x-utils.tables.body>
                                                <x-utils.tables.body class="text-right">
                                                    <div
                                                        class="flex items-center justify-end w-full gap-2 whitespace-nowrap">
                                                        <x-utils.links.ghost-link
                                                            class="group hover:text-sky-700 flex items-center text-xs"
                                                            target="_blank"
                                                            href="{{ route('archivos', $documento_enviado->documento->enlace_interno) }}">
                                                            <x-icons.documents class="h-4 w-4 group-hover:text-sky-600"
                                                                               stroke="1.25"/>
                                                            Ver
                                                        </x-utils.links.ghost-link>
                                                        <x-utils.buttons.ghost-button
                                                            class="group hover:border-rose-600"
                                                            wire:click="eliminarArchivo({{ $documento_enviado->documento->id }})">
                                                            <x-icons.delete :stroke="1.25"
                                                                            class="h-4 w-4 group-hover:text-rose-700"/>
                                                        </x-utils.buttons.ghost-button>
                                                    </div>
                                                </x-utils.tables.body>
                                            </x-utils.tables.row>
                                        @endforeach
                                    @endslot
                                </x-utils.tables.table>
                            </div>
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
                            <li class="bg-gray-100 text-xs rounded-full text-gray-700 font-medium px-3 py-1">
                                {{ $proveedor_seleccionado->responsable->entidad->nombre }}
                            </li>
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

</x-utils.card>
