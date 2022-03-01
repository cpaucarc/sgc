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
                    <x-jet-label for="nombre" value="Nombre de la escuela"/>
                    <x-jet-input id="nombre" class="w-full" type="text" wire:model.defer="nombre"
                                 placeholder="Ej. Enfermeria"/>
                    <x-jet-input-error for="nombre"/>
                </div>
                <div class="w-full">
                    <x-jet-label for="abrev" value="Abreviatura de la escuela"/>
                    <x-jet-input id="abrev" type="text" wire:model.defer="abrev" placeholder="Ej. ENF"/>
                    <br>
                    <x-jet-input-error for="abrev"/>
                </div>
                <div class="w-full">
                    <x-jet-label for="facultad" value="Facultad a la que pertenece la escuela"/>
                    <x-utils.forms.select id="facultad" class="w-full" wire:model="facultad">
                        <option value="0">Seleccione...</option>
                        @foreach($facultades as $fac)
                            <option value="{{ $fac->id }}">{{ $fac->nombre }}</option>
                        @endforeach
                    </x-utils.forms.select>
                    <x-jet-input-error for="facultad"/>
                </div>

            </div>

        </x-slot>

        <x-slot name="footer">
            <x-jet-button
                wire:click="crearEscuela"
                wire:target="crearEscuela"
                wire:loading.class="cursor-wait"
                wire:loading.attr="disabled">
                <x-icons.load wire:loading wire:target="crearEscuela" class="h-5 w-5"/>
                Guardar
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>

</div>
