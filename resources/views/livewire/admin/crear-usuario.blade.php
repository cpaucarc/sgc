<div>
    <x-jet-button wire:click="openModal">
        Registrar nuevo
    </x-jet-button>


    <x-jet-dialog-modal wire:model="open" maxWidth="lg">
        <x-slot name="title">
            <div class="flex justify-end w-full">
                <x-utils.buttons.close-button wire:click="$set('open', false)"/>
            </div>
        </x-slot>

        <x-slot name="content">

            <div class="space-y-6">
                <div class="w-full">
                    <x-jet-label for="codigo" value="Código del usuario"/>
                    <div class="flex gap-x-2">
                        <x-jet-input id="codigo" autocomplete="off" class="flex-1" type="text"
                                     wire:model.defer="codigo"/>
                        <x-utils.buttons.default class="">
                            <x-icons.search class="w-4 h-4"/>
                        </x-utils.buttons.default>
                    </div>
                    <x-jet-input-error for="codigo"/>
                </div>
                <div class="w-full">
                    <x-jet-label for="nombres" value="Apellidos y Nombres del Usuario"/>
                    <x-jet-input id="nombres" autocomplete="off" class="w-full" type="text" wire:model.defer="nombres"/>
                    <x-jet-input-error for="nombres"/>
                </div>
                <div class="w-full">
                    <x-jet-label for="correo" value="Correo del Usuario"/>
                    <x-jet-input id="correo" autocomplete="off" class="w-full" type="email" wire:model.defer="correo"/>
                    <x-jet-input-error for="correo"/>
                </div>
                <div class="w-full">
                    <x-jet-label for="contrasena" value="Contraseña del Usuario"/>
                    <x-jet-input id="contrasena" autocomplete="off" class="w-full" type="password"
                                 wire:model.defer="contrasena"/>
                    <x-jet-input-error for="contrasena"/>
                </div>
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-jet-button
                wire:click="crearUsuario"
                wire:target="crearUsuario"
                wire:loading.class="cursor-wait"
                wire:loading.attr="disabled">
                <x-icons.load wire:loading wire:target="crearUsuario" class="h-5 w-5"/>
                Guardar
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
