<div class="w-full md:w-9/12 lg:w-6/12 mx-auto divide-y divide-stone-200 space-y-6 mb-8">
    <div class="flex-col">
        <h2 class="font-bold text-stone-700 text-xl">
            Registrar información sobre Convenios
        </h2>
    </div>
    <div class="space-y-4 divide-y divide-dashed divide-stone-200 pt-4">
        <div class="flex gap-x-6">
            @if(count($facultades_id) > 0)
                <div class="w-full">
                    <x-jet-label for="facultad" value="Facultad"/>
                    <x-utils.forms.select id="facultad" class="mt-1 block w-full" wire:model="facultad">
                        @foreach($facultades as $fac)
                            <option value="{{ $fac->id }}">{{ $fac->nombre }}</option>
                        @endforeach
                    </x-utils.forms.select>
                    <x-jet-input-error for="facultad"/>
                </div>
            @endif
        </div>
    </div>
    <div class="space-y-4 divide-y divide-dashed divide-stone-200 pt-4">
        <div class="flex gap-x-6">
            <div class="w-full">
                <x-jet-label for="semestre" value="Semestre"/>
                <x-utils.forms.select id="semestre" class="mt-1 block w-full" wire:model.defer="semestre">
                    <option value="0">Selecciona</option>
                    @foreach($semestres as $sm)
                        <option value="{{ $sm->id }}">{{ $sm->nombre }}</option>
                    @endforeach
                </x-utils.forms.select>
                <x-jet-input-error for="semestre"/>
            </div>
            <div class="w-full">
                <x-jet-label for="realizados" value="Cantidad Total de Convenios Realizados"/>
                <x-jet-input id="realizados" type="number" min="0" class="mt-1 block w-full"
                             wire:model.defer="realizados" autocomplete="off" autofocus/>
                <x-jet-input-error for="realizados"/>
            </div>
        </div>
        <div class="flex gap-x-6 pt-4">
            <div class="w-full">
                <x-jet-label for="vigentes" value="Cantidad Total de Convenios Vigentes"/>
                <x-jet-input id="vigentes" type="number" min="0" class="mt-1 block w-full"
                             wire:model.defer="vigentes" autocomplete="off"/>
                <x-jet-input-error for="vigentes"/>
            </div>
            <div class="w-full">
                <x-jet-label for="culminados" value="Cantidad Total de Convenios Culminados"/>
                <x-jet-input id="culminados" type="number" min="0" class="mt-1 block w-full"
                             wire:model.defer="culminados" autocomplete="off"/>
                <x-jet-input-error for="culminados"/>
            </div>
        </div>
    </div>
    <div class="flex justify-end pt-8">
        <x-jet-button wire:click="registrar" wire:target="registrar"
                      wire:loading.class="cursor-wait" wire:loading.attr="disabled">
            <x-icons.load wire:loading wire:target="registrar" class="h-5 w-5"/>
            {{ __('Registrar Información') }}
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
