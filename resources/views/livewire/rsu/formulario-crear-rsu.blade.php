<div class="w-full md:w-3/4 lg:w-1/2 mx-auto space-y-6 mb-8">

    <x-utils.card>
        <x-slot name="header">
            <h2 class="font-bold text-gray-500 text-sm">
                Datos generales de la Responsabilidad Social
            </h2>
        </x-slot>

        <div class="space-y-4">
            <div>
                <x-jet-label for="titulo" value="Título de la RSU"/>
                <x-jet-input id="titulo" type="text" class="mt-1 block w-full"
                             wire:model.defer="titulo" autocomplete="off" autofocus/>
                <x-jet-input-error for="titulo"/>
            </div>
            <div>
                <div class="inline-flex items-center space-x-1">
                    <x-jet-label for="descripcion" value="Descripción de la RSU"/>
                    <x-utils.optional-badge/>
                </div>
                <x-utils.forms.textarea class="mt-1 block w-full" wire:model.defer="descripcion"
                                        id="descripcion"/>
                <x-jet-input-error for="descripcion"></x-jet-input-error>
            </div>
            <div>
                <x-jet-label for="lugar" value="Lugar donde se realizó la RSU"/>
                <x-jet-input id="lugar" type="text" class="mt-1 block w-full"
                             wire:model.defer="lugar" autocomplete="off"/>
                <x-jet-input-error for="lugar"/>
            </div>
            <div class="flex items-center justify-between gap-6">
                <div class="w-full">
                    <x-jet-label for="fecha_de_inicio" value="Fecha de Inicio"/>
                    <x-jet-input id="fecha_de_inicio" type="date" class="mt-1 w-full"
                                 wire:model.defer="fecha_de_inicio" autocomplete="off"/>
                    <x-jet-input-error for="fecha_de_inicio"/>
                </div>
                <div class="w-full">
                    <x-jet-label for="fecha_de_finalizacion" value="Fecha de Finalización"/>
                    <x-jet-input id="fecha_de_finalizacion" type="date" class="mt-1 w-full"
                                 wire:model.defer="fecha_de_finalizacion" autocomplete="off"/>
                    <x-jet-input-error for="fecha_de_finalizacion"/>
                </div>
            </div>
            <div>
                <x-jet-label for="escuela" value="Escuela"/>
                <x-utils.forms.select id="escuela" class="mt-1 block w-full" wire:model.defer="escuela">
                    <option value="0">Selecciona</option>
                    @foreach($escuelas as $escuela)
                        <option value="{{ $escuela->id }}">{{$escuela->nombre}}</option>
                    @endforeach
                </x-utils.forms.select>
                <x-jet-input-error for="escuela"/>
            </div>
        </div>

        <x-slot name="footer">
            <label class="text-xs text-gray-700 font-semibold inline-flex items-center cursor-pointer block w-full">
                <x-utils.forms.checkbox wire:model="en_empresa"/>
                Responsabilidad Social Universitario aplicado a una empresa
            </label>

            @if($en_empresa)
                <div class="mt-2">
                    <x-jet-label for="empresa" value="Empresa"/>
                    <div class="flex items-center justify-between gap-x-2">
                        <x-jet-input id="empresa" type="text" class="mt-1 block w-full bg-gray-50" disabled
                                     wire:model.defer="empresa_nombre" placeholder="Ninguna empresa seleccionada"/>
                        <livewire:rsu.seleccionar-empresa/>
                    </div>
                    <x-jet-input-error for="empresa_id"/>
                </div>
            @endif
        </x-slot>

    </x-utils.card>

    <div class="flex justify-end">
        <x-jet-button wire:click="guardarRSU" wire:target="guardarRSU"
                      wire:loading.class="cursor-not-allowed" wire:loading.attr="disabled">
            <x-icons.load wire:loading wire:target="guardarRSU" class="h-5 w-5"/>
            {{ __('Registrar RSU') }}
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
