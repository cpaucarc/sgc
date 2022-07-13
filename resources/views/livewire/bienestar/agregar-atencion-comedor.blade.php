<x-utils.card class="border rounded-lg">
    <x-slot name="header">
        <h1 class="font-bold text-sm text-gray-800">
            Agregar información sobre la atención de los servicios
        </h1>
    </x-slot>

    <div class="my-2 space-y-4">
        <div>
            <x-jet-label for="servicio" value="Servicios de bienestar"/>
            <x-utils.forms.select id="servicio" type="month" class="w-full" wire:model="servicio">
                @forelse($servicios as $serv)
                    <option value="{{ $serv->id }}">{{ $serv->nombre }}</option>
                @empty
                    <option value="0">No hay ningún dato</option>
                @endforelse
            </x-utils.forms.select>
            <x-jet-input-error for="servicio"/>
        </div>
        <div>
            <x-jet-label for="escuela" value="Programa académico"/>
            <x-utils.forms.select id="escuela" type="month" class="w-full" wire:model.defer="escuela">
                @forelse($escuelas as $esc)
                    <option value="{{ $esc->id }}">{{$esc->nombre}}</option>
                @empty
                    <option value="0">No hay ningún dato</option>
                @endforelse
            </x-utils.forms.select>
            <x-jet-input-error for="escuela"/>
        </div>
        <div>
            <x-jet-label for="fecha" value="Mes de atención"/>
            <x-jet-input id="fecha" type="month" class="w-full" wire:model.defer="fecha"/>
            <x-jet-input-error for="fecha"/>
        </div>
        <div>
            <x-jet-label for="cantidad" value="Cantidad de atendidos"/>
            <x-jet-input id="cantidad" type="number" min="0" class="w-full" wire:model.defer="cantidad" autofocus/>
            <x-jet-input-error for="cantidad"/>
        </div>
        @if($selectComedor)
            <div>
                <x-jet-label for="total" value="Total"/>
                <x-jet-input id="total" type="number" min="0" class="w-full" wire:model.defer="total"/>
                <x-jet-input-error for="total"/>
            </div>
        @endif
        <div class="flex justify-end">
            <x-jet-button wire:click="guardar" wire:target="guardar"
                          wire:loading.class="cursor-wait" wire:loading.attr="disabled">
                <x-icons.load class="icon-5" wire:loading wire:target="guardar"/>
                {{ __('Guardar información') }}
            </x-jet-button>
        </div>
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
</x-utils.card>
