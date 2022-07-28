<div>
    <x-jet-button wire:click="openModal">
        Registrar nuevo
    </x-jet-button>


    <x-jet-dialog-modal wire:model="open" maxWidth="xl">
        <x-slot name="title">
            <div class="flex justify-end w-full">
                <x-utils.buttons.close-button wire:click="$set('open', false)"/>
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="space-y-6">
                <div class="w-full">
                    <div class="flex justify-between">
                        <x-jet-label for="dni" value="DNI del usuario"/>
                        <x-utils.tooltip-modal>
                            <x-slot name="title">Búsqueda</x-slot>
                            <x-slot name="description">
                                Ingrese el DNI del nuevo usuario y pulse en el botón de la lupa para buscar directamente
                                personas registradas en el SGA.
                            </x-slot>
                            <x-slot name="image">{{ asset('images/tooltip/search.jpg')  }}</x-slot>
                        </x-utils.tooltip-modal>
                    </div>
                    <div class="flex gap-x-2">
                        <x-jet-input id="dni" autocomplete="off" maxlength="8" class="flex-1" type="search"
                                     wire:model.defer="dni"/>
                        <x-utils.buttons.default wire:click="buscar">
                            <x-icons.search wire:loading.remove wire:target="buscar" class="icon-5"/>
                            <svg wire:loading wire:target="buscar" class="animate-spin icon-5 text-sky-600"
                                 fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                        stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                      d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </x-utils.buttons.default>
                    </div>
                    <x-jet-input-error for="dni"/>
                    @if($mensaje)
                        <x-utils.alert.error-box>{{ $mensaje }}</x-utils.alert.error-box>
                    @endif
                </div>
                <hr>
                <div class="w-full grid grid-cols-3 gap-x-2">
                    <div>
                        <x-jet-label for="paterno" value="Apellido Paterno"/>
                        <x-jet-input id="paterno" autocomplete="off" class="w-full" type="text"
                                     wire:model.defer="ap_paterno"/>
                        <x-jet-input-error for="ap_paterno"/>
                    </div>
                    <div>
                        <x-jet-label for="materno" value="Apellido Materno"/>
                        <x-jet-input id="materno" autocomplete="off" class="w-full" type="text"
                                     wire:model.defer="ap_materno"/>
                        <x-jet-input-error for="ap_materno"/>
                    </div>
                    <div>
                        <x-jet-label for="nombres" value="Nombres"/>
                        <x-jet-input id="nombres" autocomplete="off" class="w-full" type="text"
                                     wire:model.defer="nombres"/>
                        <x-jet-input-error for="nombres"/>
                    </div>
                </div>
                <div class="w-full">
                    <x-jet-label for="celular" value="Celular del Usuario"/>
                    <x-jet-input id="celular" autocomplete="off" class="w-full" type="text" wire:model.defer="celular"/>
                    <x-jet-input-error for="celular"/>
                </div>
                <div class="w-full">
                    <x-jet-label for="correo" value="Correo del Usuario"/>
                    <x-jet-input id="correo" autocomplete="off" class="w-full" type="email" wire:model.defer="correo"/>
                    <x-jet-input-error for="correo"/>
                </div>
                <div class="w-full">
                    <div class="flex justify-between">
                        <x-jet-label for="contrasena" value="Contraseña del Usuario (por defecto es el DNI)"/>
                        <x-utils.tooltip-modal placement="bottom">
                            <x-slot name="title">Contraseña</x-slot>
                            <x-slot name="description">
                                La contraseña del nuevo usuario se toma por defecto su DNI.
                            </x-slot>
                            <x-slot name="image">{{ asset('images/tooltip/password.jpg')  }}</x-slot>
                        </x-utils.tooltip-modal>
                    </div>
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
                <x-icons.load wire:loading wire:target="crearUsuario" class="icon-5"/>
                Registrar usuario
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
