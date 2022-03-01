<div>
    <x-jet-button wire:click="openModal">
        Registrar nuevo
    </x-jet-button>


    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
            <div class="flex justify-end w-full">
                <x-utils.buttons.close-button wire:click="$set('open', false)"/>
            </div>
        </x-slot>

        <x-slot name="content">

            <div class="space-y-6">

                <div class="w-full">
                    <x-jet-label for="nombre" value="Nombre de la facultad"/>
                    <x-jet-input id="nombre" class="w-full" type="text" wire:model.defer="nombre"
                                 placeholder="Ej. Facultad de Ciencias"/>
                    <x-jet-input-error for="nombre"/>
                </div>
                <div class="w-full">
                    <x-jet-label for="abrev" value="Abreviatura de la facultad"/>
                    <x-jet-input id="abrev" type="text" wire:model.defer="abrev" placeholder="Ej. FC"/>
                    <br>
                    <x-jet-input-error for="abrev"/>
                </div>
                <div class="w-full">
                    <x-jet-label for="direccion" value="Dirección de la facultad"/>
                    <x-jet-input id="direccion" class="w-full" type="text" wire:model.defer="direccion"
                                 placeholder="Ej. Av. Universitaria N° 115"/>
                    <x-jet-input-error for="direccion"/>
                </div>
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-jet-button
                wire:click="crearFacultad"
                wire:target="crearFacultad"
                wire:loading.class="cursor-wait"
                wire:loading.attr="disabled">
                <x-icons.load wire:loading wire:target="crearFacultad" class="h-5 w-5"/>
                Guardar
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>

</div>
