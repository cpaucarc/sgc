<div class="w-full md:w-3/4 lg:w-1/2 mx-auto space-y-6 mb-8">
    <x-utils.card>
        @slot('header')
            <h2 class="font-bold text-gray-500 text-sm">
                Datos generales de la tesis
            </h2>
        @endslot
        <div class="space-y-4">
            <div>
                <x-jet-label for="numeroRegistro" value="Número de registro"/>
                <x-jet-input id="numeroRegistro" type="text" class="mt-1 block w-full"
                             wire:model.defer="numeroRegistro" autocomplete="off" autofocus/>
                <x-jet-input-error for="numeroRegistro"/>
            </div>
            <div>
                <div class="inline-flex items-center space-x-1">
                    <x-jet-label for="titulo" value="Título tesis"/>
                </div>
                <x-utils.forms.textarea class="mt-1 block w-full" wire:model.defer="titulo"
                                        id="titulo"/>
                <x-jet-input-error for="titulo"></x-jet-input-error>
            </div>
            <div class="flex items-center justify-between gap-6">
                <div class="w-full">
                    <x-jet-label for="tipoTesisSeleccionado" value="Tipo de tesis"/>
                    <x-utils.forms.select id="tipoTesisSeleccionado" class="mt-1 block w-full"
                                          wire:model.defer="tipoTesisSeleccionado">
                        <option value="0">Selecciona</option>
                        @foreach($tipoTesis as $tt)
                            <option value="{{ $tt->id }}">{{$tt->nombre}}</option>
                        @endforeach
                    </x-utils.forms.select>
                    <x-jet-input-error for="tipoTesisSeleccionado"/>
                </div>
                <div class="w-full">
                    <x-jet-label for="anio" value="Año de tesis"/>
                    <x-jet-input id="anio" type="text" class="mt-1 w-full"
                                 wire:model.defer="anio" autocomplete="off"/>
                    <x-jet-input-error for="anio"/>
                </div>
            </div>
            <div class="flex items-center justify-between gap-6">
                <div class="w-full">
                    <x-jet-label for="fechaSustentacion" value="Fecha de sustentación"/>
                    <x-jet-input id="fechaSustentacion" type="date" class="mt-1 w-full"
                                 wire:model.defer="fechaSustentacion" autocomplete="off"/>
                    <x-jet-input-error for="fechaSustentacion"/>
                </div>
                <div class="w-full">
                    <x-jet-label for="estadoSustentacion" value="Estado sustentación"/>
                    <x-utils.forms.select id="estadoSustentacion" class="mt-1 block w-full"
                                          wire:model.defer="estadoSustentacion">
                        <option value="0">Selecciona</option>
                        @foreach($estados as $estado)
                            <option value="{{ $estado->id }}">{{$estado->nombre}}</option>
                        @endforeach
                    </x-utils.forms.select>
                    <x-jet-input-error for="estadoSustentacion"/>
                </div>
            </div>
        </div>
    </x-utils.card>

    <x-utils.card>
        @slot('header')
            <div class="flex justify-between items-center">
                <h2 class="font-bold text-gray-500 text-sm flex items-center">
                    Jurados y Asesor
                    <p class="mt-1 text-sm h-5 w-5 rounded-full bg-yellow-200 flex text-yellow-700 ml-2 items-center justify-center">
                        {{ count($docente) }}
                    </p>
                </h2>
                <livewire:tpu.tesis.seleccionar-jurado/>
            </div>
        @endslot
        @if(count($docente))
            <div class="space-y-4 py-2 text-gray-700 text-sm">
                <x-utils.tables.table>
                    @slot('body')
                        @foreach ($docente as $i=>$doc)
                            <x-utils.tables.row>
                                <x-utils.tables.body>
                                    {{ ($i+1) }}
                                </x-utils.tables.body>
                                <x-utils.tables.body>
                                    {{ $doc['docente_id']}}
                                </x-utils.tables.body>
                                <x-utils.tables.body>
                                    {{ $doc['codigo_docente']}}
                                </x-utils.tables.body>
                                <x-utils.tables.body>
                                    <div
                                        class="flex items-center justify-end w-full gap-2 whitespace-nowrap">
                                        <x-utils.buttons.basic-button wire:click="quitar({{ ($i) }})">
                                            <x-icons.x class="h-5 w-5 mr-1"></x-icons.x>
                                        </x-utils.buttons.basic-button>
                                    </div>
                                </x-utils.tables.body>
                            </x-utils.tables.row>
                        @endforeach
                    @endslot
                </x-utils.tables.table>
            </div>
        @endif
        @slot('footer')
            <div class="group flex items-center gap-x-4 text-gray-500">
                <div class="text-sm flex">
                    <span class="bg-gray-200 w-5 h-5 rounded-full flex justify-center mr-2">1</span> Presidente
                </div>
                <div class="text-sm flex">
                    <span class="bg-gray-200 w-5 h-5 rounded-full flex justify-center mr-2">2</span> Secretario
                </div>
                <div class="text-sm flex">
                    <span class="bg-gray-200 w-5 h-5 rounded-full flex justify-center mr-2">3</span> Vocal & Asesor
                </div>
            </div>
        @endslot
    </x-utils.card>

    <div class="flex justify-end">
        <x-jet-button wire:click="guardarTesis" wire:target="guardarTesis"
                      wire:loading.class="cursor-not-allowed" wire:loading.attr="disabled">
            <x-icons.load wire:loading wire:target="guardarTesis" class="h-5 w-5"/>
            {{ __('Registrar') }}
        </x-jet-button>
    </div>


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
