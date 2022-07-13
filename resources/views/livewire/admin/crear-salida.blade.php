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
                    <x-jet-label for="codigo" value="Código de la salida"/>
                    <x-jet-input id="codigo" type="text" wire:model.defer="codigo"/>
                    <br>
                    <x-jet-input-error for="codigo"/>
                </div>
                <div class="w-full">
                    <x-jet-label for="nombre" value="Nombre de la salida"/>
                    <x-jet-input id="nombre" class="w-full" type="text" wire:model.defer="nombre"/>
                    <x-jet-input-error for="nombre"/>
                </div>
                <div class="w-full">
                    <div class="flex items-center">
                        <x-jet-label for="descripcion" value="Descripcion de la salida"/>
                        <x-utils.optional-badge/>
                    </div>
                    <x-utils.forms.textarea id="descripcion" class="w-full" wire:model.defer="descripcion"/>
                    <x-jet-input-error for="descripcion"/>
                </div>
                <div class="w-full">
                    <x-jet-label for="proceso" value="Proceso al que pertenece la salida"/>
                    <x-utils.forms.select id="proceso" class="w-full" wire:model.defer="proceso">
                        <option value="0">Seleccione el proceso</option>
                        @foreach($procesos as $proc)
                            <option value="{{ $proc->id }}">{{ $proc->nombre }}</option>
                        @endforeach
                    </x-utils.forms.select>
                    <x-jet-input-error for="proceso"/>
                </div>
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-jet-button
                wire:click="crearSalida"
                wire:target="crearSalida"
                wire:loading.class="cursor-wait"
                wire:loading.attr="disabled">
                <x-icons.load wire:loading wire:target="crearSalida" class="icon-5"/>
                Guardar
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>

</div>
