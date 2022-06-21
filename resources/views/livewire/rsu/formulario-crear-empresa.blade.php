<div class="w-full md:w-9/12 lg:w-6/12 mx-auto divide-y divide-stone-200 space-y-6 mb-8">

    <div class="flex-col">
        <h2 class="font-bold text-stone-700 text-xl">
            Registrar nueva Empresa
        </h2>
    </div>

    <div class="space-y-4 divide-y divide-dashed divide-stone-200 pt-4">
        <div>
            <x-jet-label for="nombre" value="Nombre de la empresa"/>
            <x-jet-input id="nombre" type="text" class="mt-1 block w-full"
                         wire:model.defer="nombre" autocomplete="off" autofocus/>
            <x-jet-input-error for="nombre"/>
        </div>
        <div class="flex items-center justify-between gap-6 pt-4">
            <div class="w-full">
                <div class="inline-flex items-center space-x-1">
                    <x-jet-label for="ruc" value="Ruc de la empresa"/>
                    <x-utils.optional-badge/>
                </div>
                <x-jet-input id="ruc" type="text" class="mt-1 block w-full"
                             wire:model.defer="ruc" autocomplete="off" autofocus/>
                <x-jet-input-error for="ruc"/>
            </div>
            <div class="w-full">
                <div class="inline-flex items-center space-x-1">
                    <x-jet-label for="telefono" value="Teléfono de la empresa"/>
                    <x-utils.optional-badge/>
                </div>
                <x-jet-input id="telefono" type="text" class="mt-1 block w-full"
                             wire:model.defer="telefono" autocomplete="off" autofocus/>
                <x-jet-input-error for="telefono"/>
            </div>
        </div>
        <div class="pt-4">
            <div class="inline-flex items-center space-x-1">
                <x-jet-label for="correo" value="Correo de la empresa"/>
                <x-utils.optional-badge/>
            </div>
            <x-jet-input id="correo" type="text" class="mt-1 block w-full"
                         wire:model.defer="correo" autocomplete="off" autofocus/>
            <x-jet-input-error for="correo"/>
        </div>
        <div class="pt-4">
            <div class="inline-flex items-center space-x-1">
                <x-jet-label for="direccion" value="Dirección de la empresa"/>
                <x-utils.optional-badge/>
            </div>
            <x-jet-input id="direccion" type="text" class="mt-1 block w-full"
                         wire:model.defer="direccion" autocomplete="off" autofocus/>
            <x-jet-input-error for="direccion"/>
        </div>
        <div class="pt-4">
            <div class="inline-flex items-center space-x-1">
                <x-jet-label for="ubicacion" value="Ubicación de la empresa"/>
                <x-utils.optional-badge/>
            </div>
            <x-jet-input id="ubicacion" type="text" class="mt-1 block w-full"
                         wire:model.defer="ubicacion" autocomplete="off" autofocus/>
            <x-jet-input-error for="ubicacion"/>
        </div>
    </div>

    <div class="flex justify-end pt-4">
        <x-jet-button wire:click="guardarEmpresa" wire:target="guardarEmpresa"
                      wire:loading.class="cursor-wait" wire:loading.attr="disabled">
            <x-icons.load wire:loading wire:target="guardarEmpresa" class="h-5 w-5"/>
            {{ __('Registrar Empresa') }}
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
            /*Livewire.on('error', msg => {
                Swal.fire({
                    icon: 'error',
                    title: '',
                    text: msg,
                });
            });*/
        </script>
    @endpush
</div>
