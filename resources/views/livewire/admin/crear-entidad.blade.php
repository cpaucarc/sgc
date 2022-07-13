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
                    <x-jet-label for="nombre" value="Nombre de la entidad"/>
                    <x-jet-input id="nombre" class="w-full" type="text" wire:model.defer="nombre" autocomplete="off"
                                 placeholder="Ej. Director de Escuela de Enfermeria"/>
                    <x-jet-input-error for="nombre"/>
                </div>
                <div class="w-full">
                    <x-jet-label for="rol" value="Tipo de oficina o rol a la que pertenece"/>
                    <x-utils.forms.select id="rol" class="w-full" wire:model.defer="rol">
                        <option value="0">Seleccione...</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </x-utils.forms.select>
                    <x-jet-input-error for="rol"/>
                </div>

                <hr>

                <div class="w-full">
                    <x-jet-label for="nivel" value="Nivel de la entidad"/>
                    <x-utils.forms.select id="nivel" class="w-full" wire:model="nivel">
                        <option value=0>Seleccione...</option>
                        <option value=1>Nivel General</option>
                        <option value=2>Nivel de Facultad</option>
                        <option value=3>Nivel de Escuela</option>
                    </x-utils.forms.select>
                    <x-jet-input-error for="nivel"/>
                </div>

                @if(!is_null($ents))
                    <div class="w-full">
                        <x-jet-label for="seleccionado" value="Escuela/Facultad a la que pertenece la entidad"/>
                        <x-utils.forms.select id="seleccionado" class="w-full" wire:model="seleccionado">
                            <option value="0">Seleccione...</option>
                            @foreach($ents as $e)
                                <option value="{{ $e->id }}">{{ $e->nombre }}</option>
                            @endforeach
                        </x-utils.forms.select>
                        <x-jet-input-error for="seleccionado"/>
                    </div>
                @endif
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-button
                wire:click="guardarEntidad"
                wire:target="guardarEntidad"
                wire:loading.class="cursor-wait"
                wire:loading.attr="disabled">
                <x-icons.load wire:loading wire:target="guardarEntidad" class="icon-5"/>
                Guardar
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>

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
