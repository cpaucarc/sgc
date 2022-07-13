<div>
    <x-jet-button wire:click="openModal">
        Registrar nuevo
    </x-jet-button>


    <x-jet-dialog-modal wire:model="open" maxWidth="md">
        <x-slot name="title">
            <div class="flex justify-end w-full">
                <x-utils.buttons.close-button wire:click="$set('open', false)"/>
            </div>
        </x-slot>

        <x-slot name="content">

            <div class="w-full">
                <x-jet-label for="nombre" value="Nombre del proceso"/>
                <x-jet-input id="nombre" class="w-full" type="text" wire:model.defer="nombre"/>
                <x-jet-input-error for="nombre"/>
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-jet-button
                wire:click="crearProceso"
                wire:target="crearProceso"
                wire:loading.class="cursor-wait"
                wire:loading.attr="disabled">
                <x-icons.load wire:loading wire:target="crearProceso" class="icon-5"/>
                Guardar
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>

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
