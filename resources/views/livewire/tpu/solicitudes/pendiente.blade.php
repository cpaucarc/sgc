<div class="grid grid-cols-2 gap-6 items-start">
    <x-utils.card>
        @slot('header')
            <div class="flex justify-between items-center">
                <h2 class="font-bold text-lg text-gray-800">
                    Solicitudes con requisitos completos
                </h2>
                <div class="bg-blue-200 text-blue-800 px-2 py-1 rounded-lg text-sm">
                    {{ $solicitudesCompletas->count() }} solicitudes
                </div>
            </div>
        @endslot
        <div class="space-y-6">
            @forelse( $solicitudesCompletas as $solc)
                <div class="group rounded-lg px-5 py-4 flex items-center justify-between border">
                    <div>
                        <h2 class="text-gray-500 group-hover:text-blue-800 font-semibold">
                            Juan Fernando Pérez del Corral
                        </h2>
                        <h3 class="text-gray-400 group-hover:text-gray-500 text-sm">
                            Código: {{ $solc->codigo_estudiante }}
                        </h3>
                    </div>
                    <x-utils.buttons.invisible
                        wire:click="mostrarModal({{ $solc->id }}, '{{ $solc->codigo_estudiante}}', true)">
                        Revisar
                    </x-utils.buttons.invisible>
                </div>
            @empty
                <x-utils.message-image>
                    <x-slot name="title">No hay ninguna solicitud</x-slot>
                    <x-slot name="description">
                        Actualmente no hay ninguna solicitud que tenga todos los documentos completos.
                    </x-slot>
                    <x-slot name="image">{{ asset('images/svg/solicitudes_completas.svg') }}</x-slot>
                </x-utils.message-image>
            @endforelse
        </div>
    </x-utils.card>

    <x-utils.card>
        @slot('header')
            <div class="flex justify-between items-center">
                <h2 class="font-bold text-lg text-gray-800">
                    Solicitudes con requisitos incompletos
                </h2>
                <div class="bg-yellow-200 text-yellow-800 px-2 py-1 rounded-lg text-sm">
                    {{ $solicitudesIncompletas->count() }} solicitudes
                </div>
            </div>
        @endslot
        <div class="space-y-6">
            @forelse( $solicitudesIncompletas as $soli)
                <div class="group rounded-lg px-5 py-4 flex items-center justify-between border">
                    <div>
                        <h2 class="text-gray-500 group-hover:text-yellow-800 font-semibold">
                            Sara Teresa Sánchez del Pinar
                        </h2>
                        <h3 class="text-gray-400 group-hover:text-gray-500 text-sm">
                            {{ $soli->documentos_count }} de 8 requisitos enviados
                        </h3>
                    </div>
                    <x-utils.buttons.invisible
                        wire:click="mostrarModal({{ $soli->id }}, '{{ $soli->codigo_estudiante }}', false)">
                        Revisar
                    </x-utils.buttons.invisible>
                </div>
            @empty
                <x-utils.message-image>
                    <x-slot name="title">No hay ninguna solicitud</x-slot>
                    <x-slot name="description">
                        Actualmente no hay ninguna solicitud que tenga todos los documentos completos.
                    </x-slot>
                    <x-slot name="image">{{ asset('images/svg/solicitudes_completas.svg') }}</x-slot>
                </x-utils.message-image>
            @endforelse
        </div>
    </x-utils.card>

    @if($solicitudSeleccionado)
        <x-jet-dialog-modal wire:model="open">
            @slot('title')
                <div class="flex items-center justify-between w-full m-0">
                    <div>
                        <h1 class="text-gray-600">
                            Solicitud presentado por <span class="font-bold">Sara Teresa Sánchez del Pinar.</span>
                        </h1>
                        <h3 class="text-gray-400 group-hover:text-gray-500 text-sm">
                            Código: {{$solicitanteCodigo}}
                        </h3>
                    </div>
                    <x-utils.buttons.close-button wire:click="$set('open', false)"/>
                </div>
            @endslot
            @slot('content')
                @if(!$requisitosCompleto)
                    <div class="w-full flex justify-between mb-4">
                        <h3 class="text-gray-800 text-base font-bold">
                            Lista de requisitos presentados
                        </h3>
                        <buttons
                            class="cursor-wait inline-flex items-center text-yellow-700 border border-yellow-200 bg-yellow-100 rounded-lg text-sm px-3 py-1">
                            <x-icons.info :stroke="2" class="h-5 w-5 mr-1"/>
                            Requisitos faltantantes
                        </buttons>
                    </div>
                @endif
                @if($requisitosCompleto)
                    <div class="w-full flex items-center justify-between mb-4">
                        <h3 class="text-gray-800 text-base font-bold">
                            Lista de requisitos presentados
                        </h3>
                        <div class="flex flex-col items-end w-48 space-y-2">
                            <buttons
                                class="cursor-wait inline-flex items-center text-{{ $solicitudSeleccionado->estado->color }}-700 border border-{{ $solicitudSeleccionado->estado->color }}-200 bg-{{ $solicitudSeleccionado->estado->color }}-100 rounded-lg text-sm px-3 py-1">
                                <x-icons.info :stroke="2" class="h-5 w-5 mr-1"/>
                                {{ $solicitudSeleccionado->estado->nombre }}
                            </buttons>
                            <span
                                class="text-xs">Actualizado el {{ date('h:m a d M', strtotime($solicitudSeleccionado->updated_at)) }}</span>
                        </div>
                    </div>
                @endif
                <x-utils.tables.table>
                    @slot('body')
                        @foreach($solicitudSeleccionado->documentos as $i => $doc)
                            <x-utils.tables.row>
                                <x-utils.tables.body class="text-xs">
                                    {{ ($i+1) }}
                                </x-utils.tables.body>
                                <x-utils.tables.body class="text-xs">
                                    <a target="_blank" href="{{ route('archivos', $doc->documento->enlace_interno) }}"
                                       class="hover:text-sky-600 hover:underline line-clamp-1">
                                        {{ $doc->requisito->nombre }}
                                    </a>
                                </x-utils.tables.body>
                                <x-utils.tables.body class="text-xs">
                                    {{ $doc->documento->created_at->format('d M Y')}}
                                </x-utils.tables.body>
                                <x-utils.tables.body>
                                    <buttons
                                        class="inline-flex items-center text-{{ $doc->estado->color }}-700 border border-{{ $doc->estado->color }}-200 bg-{{ $doc->estado->color }}-100 rounded-lg text-xs px-3 py-1">
                                        {{ $doc->estado->nombre }}
                                    </buttons>
                                </x-utils.tables.body>
                                <x-utils.tables.body>
                                    <div
                                        class="flex items-center justify-end w-full gap-2 whitespace-nowrap">
                                        <x-utils.buttons.danger wire:click="denegarDocumentoRequisito({{$doc->id}})">
                                            <x-icons.x class="h-4 w-4 mr-1"></x-icons.x>
                                        </x-utils.buttons.danger>
                                        <x-utils.buttons.success wire:click="aprobarDocumentoRequisito({{$doc->id}})">
                                            <x-icons.check class="h-4 w-4 mr-1"></x-icons.check>
                                        </x-utils.buttons.success>
                                    </div>
                                </x-utils.tables.body>
                            </x-utils.tables.row>
                        @endforeach
                    @endslot
                </x-utils.tables.table>
                @if($requisitosCompleto)
                    <div class="my-4 w-full flex justify-end">
                        <x-jet-button wire:click="estadoSolicitud()">
                            <x-icons.quality class="h-4 w-4 mr-1"></x-icons.quality>
                            Actualizar y Enviar
                        </x-jet-button>
                    </div>
                @endif
                @if($tesis)
                    <div class="my-4 p-4 border rounded-lg flex flex-col items-center justify-center space-y-4">
                        <img src="{{ asset('images/svg/solicitudes_completas.svg') }}" class="w-24"
                             alt="Grafico">
                        <div class="text-sm text-gray-600">
                            <p class="font-bold text-gray-600">
                                Tesis N° {{$tesis->numero_registro}} registrado con titulo
                            </p>
                            <a target="_blank" href="{{route('tpu.seeTesis', [$solicitudSeleccionado,$tesis])}}"
                               class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                <span>{{substr($tesis->titulo, 1, 50)}}...</span>
                                <input id="file-upload" name="file-upload" type="file" class="sr-only">
                            </a>
                            <p class="text-gray-400"><span class="font-bold">Año: </span>2020
                            </p>
                        </div>
                    </div>
                @endif
            @endslot
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
