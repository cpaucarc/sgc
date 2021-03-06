<div>
    <div class="flex justify-between items-center mb-2">
        <h2 class="text-zinc-600 text-base font-bold leading-tight">Investigadores</h2>

        @if($es_responsable and count($investigacion->investigadores) > 0)
            <x-utils.buttons.default class="text-sm" wire:click="abrirModal">
                <x-icons.people class="icon-4 mr-1" stroke="1.5"></x-icons.people>
                Añadir
            </x-utils.buttons.default>
        @endif
    </div>

    @if(count($investigacion->investigadores) > 0)
        <x-utils.tables.table>
            @slot('head')
                <x-utils.tables.head>DNI Investigador</x-utils.tables.head>
                <x-utils.tables.head>Tipo</x-utils.tables.head>
                <x-utils.tables.head>Cargo</x-utils.tables.head>
            @endslot
            @slot('body')
                @foreach($investigacion->investigadores as $investigador)
                    <x-utils.tables.row>
                        <x-utils.tables.body>
                            <x-utils.buttons.invisible
                                wire:click="mostrarDatos('{{ $investigador->dni_investigador }}')"
                                class="text-sm">
                                {{ $investigador->dni_investigador }}
                            </x-utils.buttons.invisible>
                        </x-utils.tables.body>
                        <x-utils.tables.body>
                            @if($investigador->es_docente)
                                <span class="font-bold">Docente</span>
                            @else
                                Estudiante
                            @endif
                        </x-utils.tables.body>
                        <x-utils.tables.body>
                            @if($es_responsable && $investigador->dni_investigador !== auth()->user()->persona->dni)
                                <livewire:investigacion.cargo-participante :investigacion_id="$investigacion->id"
                                                                           :investigador_id="$investigador->id"
                                                                           :wire:key="$investigacion->id.$investigador->id"/>
                            @else
                                <p class="{{ $investigador->pivot->es_responsable ? 'font-bold':'' }} ml-2">
                                    {{ $investigador->pivot->es_responsable ? 'Responsable':'Corresponsable' }}
                                </p>
                            @endif
                        </x-utils.tables.body>
                        <x-utils.tables.body>
                            @if($es_responsable && $investigador->dni_investigador !== auth()->user()->persona->dni)
                                <x-utils.buttons.danger class="text-sm"
                                                        onclick="quitarParticipante({{ $investigador->id }},'{{ $investigador->dni_investigador }}',{{ $investigacion->id }})">
                                    <x-icons.person-remove class="icon-4" stroke="2"/>
                                </x-utils.buttons.danger>
                            @endif
                        </x-utils.tables.body>
                    </x-utils.tables.row>
                @endforeach
            @endslot
        </x-utils.tables.table>
    @else
        <div class="border border-zinc-300 rounded-md">
            <x-utils.message-no-items
                title="Aún no hay investigadores asociados"
                text="Añada a investigadores que colaboran en este Proyecto de Investigación.">
                @slot('icon')
                    <svg class="text-zinc-400" fill="currentColor" viewBox="0 0 24 24" width="24" height="24">
                        <path fill-rule="evenodd"
                              d="M3.5 8a5.5 5.5 0 118.596 4.547 9.005 9.005 0 015.9 8.18.75.75 0 01-1.5.045 7.5 7.5 0 00-14.993 0 .75.75 0 01-1.499-.044 9.005 9.005 0 015.9-8.181A5.494 5.494 0 013.5 8zM9 4a4 4 0 100 8 4 4 0 000-8z"></path>
                        <path
                            d="M17.29 8c-.148 0-.292.01-.434.03a.75.75 0 11-.212-1.484 4.53 4.53 0 013.38 8.097 6.69 6.69 0 013.956 6.107.75.75 0 01-1.5 0 5.193 5.193 0 00-3.696-4.972l-.534-.16v-1.676l.41-.209A3.03 3.03 0 0017.29 8z"></path>
                    </svg>
                @endslot
                @if($es_responsable)
                    <x-jet-button class="text-sm">
                        Añadir investigadores
                    </x-jet-button>
                @endif
            </x-utils.message-no-items>
        </div>
    @endif

    {{-- Modal con los datos del investigador --}}
    <x-jet-dialog-modal wire:model="open" maxWidth="xl">
        <x-slot name="title">
            <h1 class="font-bold text-zinc-700">
                Datos del participante
            </h1>
            <x-utils.buttons.close-button wire:click="$set('open', false)"/>
        </x-slot>

        <x-slot name="content">
            @if($datos_participante)
                <x-utils.oge-datos-basicos :persona="$datos_participante"/>
            @else
                <x-utils.oge-no-datos/>
            @endif
        </x-slot>
    </x-jet-dialog-modal>

    {{-- Modal para añdir participantes --}}
    <x-jet-dialog-modal wire:model="add" maxWidth="3xl">
        <x-slot name="title">
            <h1 class="font-bold text-zinc-700">
                Añadir participantes
            </h1>
            <x-utils.buttons.close-button wire:click="$set('add', false)"/>
        </x-slot>

        <x-slot name="content">
            <div class="space-y-6">
                <div class="flex items-center justify-start">
                    <button
                        wire:click="buscarEnDocentes(false)"
                        class="px-3 py-1 border-b-2 soft-transition {{ $en_docentes ? 'hover:bg-zinc-50 border-zinc-300 text-zinc-500' : 'bg-sky-50 border-sky-600 text-sky-600 font-semibold' }}">
                        Añadir estudiantes
                    </button>
                    <button
                        wire:click="buscarEnDocentes(true)"
                        class="px-3 py-1 border-b-2 soft-transition {{ $en_docentes ? 'bg-sky-50 border-sky-600 text-sky-600 font-semibold' : 'hover:bg-zinc-50 border-zinc-300 text-zinc-500' }}">
                        Añadir docentes
                    </button>
                </div>

                @if($en_docentes)
                    <livewire:investigacion.agregar-investigador-docente :investigacion_id="$investigacion_id"
                                                                         :depto_id="$depto_id"
                                                                         :semestre="$semestre"/>
                @else
                    <livewire:investigacion.agregar-investigador-estudiante :investigacion_id="$investigacion_id"/>
                @endif
            </div>
        </x-slot>
    </x-jet-dialog-modal>

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

            function quitarParticipante(investigador_id, dni, investigacion_id) {
                Swal.fire({
                    text: "¿Desea quitar al participante con DNI " + dni + " de la investigación?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Si, quitar',
                    cancelButtonText: `Cancelar`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.livewire.emit('quitarParticipante', investigador_id, investigacion_id);
                    }
                })
            }
        </script>
    @endpush
</div>
