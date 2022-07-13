<div>
    <x-jet-button wire:click="openModal">
        Registrar nuevo
    </x-jet-button>


    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
            <div class="flex justify-between w-full">
                <h1 class="font-bold text-gray-700">
                    Crear nuevo semestre académico
                </h1>
                <x-utils.buttons.close-button wire:click="$set('open', false)"/>
            </div>
        </x-slot>

        <x-slot name="content">

            <div class="space-y-6">

                <div class="w-full">
                    <x-jet-label for="nombre" value="Semestre académico"/>
                    <x-jet-input id="nombre" class="w-full" type="text" wire:model.defer="nombre"
                                 placeholder="2022-II"/>
                    <x-jet-input-error for="nombre"/>
                </div>
                <div class="w-full">
                    <x-jet-label for="fecha_inicio" value="Fecha Inicio"/>
                    <x-jet-input id="fecha_inicio" class="w-full" type="date" wire:model.defer="fecha_inicio"
                                 autocomplete="off"/>
                    <x-jet-input-error for="fecha_inicio"/>
                </div>
                <div class="w-full">
                    <x-jet-label for="fecha_fin" value="Fecha Fin"/>
                    <x-jet-input id="fecha_fin" class="w-full" type="date" wire:model.defer="fecha_fin"
                                 autocomplete="off"/>
                    <x-jet-input-error for="fecha_fin"/>
                </div>
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-jet-button
                wire:click="crearSemestre"
                wire:target="crearSemestre"
                wire:loading.class="cursor-wait"
                wire:loading.attr="disabled">
                <x-icons.load wire:loading wire:target="crearSemestre" class="icon-5"/>
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
