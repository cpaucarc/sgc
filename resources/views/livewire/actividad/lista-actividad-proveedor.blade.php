<div class="space-y-4">

    <x-utils.titulo
        titulo="Información a proveer"
        subtitulo="En esta sección usted podrá ver la lista de documentos con las que debe proveer a los diferentes actividades.">
        @slot('items')
            <x-utils.forms.select class="w-24" wire:model="semestre_seleccionado">
                @forelse($semestres as $semestre)
                    <option value="{{ $semestre->id }}">{{$semestre->nombre}}</option>
                @empty
                    <option value="0">No hay datos</option>
                @endforelse
            </x-utils.forms.select>

            <x-utils.forms.select wire:model="proceso_seleccionado">
                @forelse($procesos as $proceso)
                    <option value="{{ $proceso->id }}">Proceso {{$proceso->nombre}}</option>
                @empty
                    <option value="0">No hay datos</option>
                @endforelse
            </x-utils.forms.select>
        @endslot
    </x-utils.titulo>

    <x-utils.tables.table>
        @slot('head')
            <x-utils.tables.head>N°</x-utils.tables.head>
            <x-utils.tables.head>Entrada</x-utils.tables.head>
            <x-utils.tables.head>Actividad</x-utils.tables.head>
            <x-utils.tables.head>Estado</x-utils.tables.head>
            <x-utils.tables.head>
                <span class=" sr-only">Ver</span>
            </x-utils.tables.head>
        @endslot
        @slot('body')
            @foreach($proveer as $i => $prov)
                <x-utils.tables.row>
                    <x-utils.tables.body>{{ $i + 1 }}</x-utils.tables.body>
                    <x-utils.tables.body class="font-semibold">
                        <h2 class="font-bold">
                            {{ $prov->entrada->nombre }}
                        </h2>
                    </x-utils.tables.body>
                    <x-utils.tables.body>
                        <p>{{ $prov->responsable->actividad->nombre }}</p>
                        <p class="text-zinc-500">Responsable: <b>{{ $prov->responsable->entidad->nombre }}</b></p>
                    </x-utils.tables.body>
                    <x-utils.tables.body>
                        <x-utils.badge
                            class="{{$prov->cantidad > 0 ? 'bg-green-100 text-green-600' : 'bg-rose-100 text-rose-600'}}">
                            {{ $prov->cantidad > 0  ? 'Completado' : 'Sin completar' }}
                        </x-utils.badge>
                    </x-utils.tables.body>
                    <x-utils.tables.body>
                        <x-utils.buttons.invisible wire:click="abrirModal({{$prov->id}})">
                            Revisar
                        </x-utils.buttons.invisible>
                    </x-utils.tables.body>
                </x-utils.tables.row>
            @endforeach
        @endslot
    </x-utils.tables.table>

    @if($proveedor_seleccionado)
        <x-jet-dialog-modal wire:model="open" maxWidth="3xl">
            <x-slot name="title">
                <div class="flex-col">
                    <h1 class="font-bold text-zinc-700">
                        {{ $proveedor_seleccionado->entrada->nombre }}
                    </h1>
                    <p class="text-zinc-500 text-sm">
                        Actividad: {{ $proveedor_seleccionado->responsable->actividad->nombre }}
                    </p>
                </div>
                <x-utils.buttons.close-button wire:click="$set('open', false)"/>
            </x-slot>

            <x-slot name="content">

                <div class="space-y-8">
                    <div class="space-y-2">
                        <h2 class="text-zinc-800 text-sm font-bold">Subir archivo:</h2>
                        <x-jet-label for="archivo" value="{{ __('Archivo Adjunto. (Peso max: 25Mb)') }}"/>
                        <x-utils.file-uploading>
                            <x-utils.forms.file-input id="archivo" class="w-full block" wire:model.defer="archivo"/>
                        </x-utils.file-uploading>
                        <x-jet-input-error for="archivo"></x-jet-input-error>
                    </div>

                    <details class="space-y-2">
                        <summary class="flex items-center space-x-2 cursor-pointer">
                            <h2 class="text-zinc-800 text-sm font-bold">Documentos enviados:</h2>
                            <span class="text-zinc-500 hover:text-sky-700 text-sm">[Ver]</span>
                        </summary>
                        @if(count($documentos) > 0)
                            <div class="table w-full text-zinc-700">
                                <x-utils.tables.table>
                                    @slot('body')
                                        @foreach($documentos as $documento_enviado)
                                            <x-utils.tables.row class="p-1">
                                                <x-utils.tables.body class="text-left">
                                                    <div class="flex items-center gap-x-2">
                                                        <svg class="text-zinc-400" viewBox="0 0 16 16" width="16"
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
                                                <x-utils.tables.body class="text-right whitespace-nowrap">
                                                    {{ $documento_enviado->documento->created_at->diffForHumans() }}
                                                </x-utils.tables.body>
                                                <x-utils.tables.body class="text-right">
                                                    <div
                                                        class="flex items-center justify-end w-full gap-2 whitespace-nowrap">
                                                        <x-utils.links.default class="group" target="_blank"
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
                            </div>
                        @else
                            <x-utils.message-no-items
                                title="Aún no has enviado ningún documento"
                                text="Es importante proveer los documentos correspondiente para completar las actividades.">
                                @slot('icon')
                                    <svg class="text-zinc-400" fill="currentColor" viewBox="0 0 24 24" width="24"
                                         height="24">
                                        <path fill-rule="evenodd"
                                              d="M3 3a2 2 0 012-2h9.982a2 2 0 011.414.586l4.018 4.018A2 2 0 0121 7.018V21a2 2 0 01-2 2H4.75a.75.75 0 010-1.5H19a.5.5 0 00.5-.5V8.5h-4a2 2 0 01-2-2v-4H5a.5.5 0 00-.5.5v6.25a.75.75 0 01-1.5 0V3zm12-.5v4a.5.5 0 00.5.5h4a.5.5 0 00-.146-.336l-4.018-4.018A.5.5 0 0015 2.5zm-5.692 12l-2.104-2.236a.75.75 0 111.092-1.028l3.294 3.5a.75.75 0 010 1.028l-3.294 3.5a.75.75 0 11-1.092-1.028L9.308 16H4.09a2.59 2.59 0 00-2.59 2.59v3.16a.75.75 0 01-1.5 0v-3.16a4.09 4.09 0 014.09-4.09h5.218z"></path>
                                    </svg>
                                @endslot
                            </x-utils.message-no-items>
                        @endif
                    </details>

                    <div class="space-y-2">
                        <h2 class="text-zinc-800 text-sm font-bold">
                            Esta información será visto por las siguientes entidades:
                        </h2>
                        <ul class="mt-1 flex flex-wrap gap-2">
                            <li class="bg-zinc-100 text-sm rounded-full text-zinc-800 font-medium px-3 py-1">
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
                    wire:loading.class="cursor-wait"
                    wire:loading.attr="disabled">
                    <x-icons.load class="icon-5" wire:loading wire:target="enviarArchivo"/>
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
