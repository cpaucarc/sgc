<div class="w-full md:w-9/12 lg:w-6/12 mx-auto divide-y divide-stone-200 space-y-6 mb-8">

    <div class="flex-col">
        <h2 class="font-bold text-stone-700 text-xl">
            Registrar nueva Responsabilidad Social
        </h2>
    </div>

    <div class="space-y-4 divide-y divide-dashed divide-stone-200 pt-4">
        <div>
            <x-jet-label for="titulo" value="Título de la RSU"/>
            <x-jet-input id="titulo" type="text" class="mt-1 block w-full"
                         wire:model.defer="titulo" autocomplete="off" autofocus/>
            <x-jet-input-error for="titulo"/>
        </div>
        <div class="pt-4">
            <div class="inline-flex items-center space-x-1">
                <x-jet-label for="descripcion" value="Descripción de la RSU"/>
                <x-utils.optional-badge/>
            </div>
            <x-utils.forms.textarea class="mt-1 block w-full" wire:model.defer="descripcion"
                                    id="descripcion"/>
            <x-jet-input-error for="descripcion"></x-jet-input-error>
        </div>
        <div class="pt-4">
            <x-jet-label for="lugar" value="Lugar donde se realizó la RSU"/>
            <x-jet-input id="lugar" type="text" class="mt-1 block w-full"
                         wire:model.defer="lugar" autocomplete="off"/>
            <x-jet-input-error for="lugar"/>
        </div>
        <div class="flex items-center justify-between gap-6 pt-4">
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
        @if(count($escuelas) > 1)
            <div class="pt-4">
                <x-jet-label for="escuela" value="Programa Académico"/>
                <x-utils.forms.select id="escuela" class="mt-1 block w-full" wire:model.defer="escuela">
                    <option value="0">Selecciona el programa académico</option>
                    @foreach($escuelas as $escuela)
                        <option value="{{ $escuela->id }}">{{$escuela->nombre}}</option>
                    @endforeach
                </x-utils.forms.select>
                <x-jet-input-error for="escuela"/>
            </div>
        @endif
    </div>

    <div class="pt-4">
        <label
            class="text-sm text-gray-600 hover:text-gray-700 soft-transition font-semibold inline-flex items-center cursor-pointer">
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
    </div>

    <div class="flex justify-end pt-4">
        <x-jet-button wire:click="guardarRSU" wire:target="guardarRSU"
                      wire:loading.class="cursor-wait" wire:loading.attr="disabled">
            <x-icons.load wire:loading wire:target="guardarRSU" class="h-5 w-5"/>
            {{ __('Registrar RSU') }}
        </x-jet-button>
    </div>

    @push('js')
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Livewire.on('guardado', rspta => {
                Swal.fire({
                    html: `<b>!${rspta.titulo}!</b><br/><small>${rspta.mensaje}</small>`,
                    icon: 'success'
                });
            });

            Livewire.on('error', msg => {
                Swal.fire({
                    html: `<b>!Hubo un error!</b><br/><small>${msg}</small>`,
                    icon: 'error'
                });
            });
        </script>
    @endpush
</div>
