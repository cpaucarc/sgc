<x-utils.card class="border rounded-lg">

    <x-slot name="header">
        <h1 class="font-bold text-sm text-gray-800">
            Agregar información sobre la atención a estudiantes
        </h1>
    </x-slot>

    <div class="my-2 space-y-4">
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
            <x-jet-label for="cantidad" value="Cantidad de comensales atendidos"/>
            <x-jet-input id="cantidad" type="number" class="w-full" wire:model.defer="cantidad" autofocus/>
            <x-jet-input-error for="cantidad"/>
        </div>
        <div>
            <x-jet-label for="total" value="Total de comensales"/>
            <x-jet-input id="total" type="number" class="w-full" wire:model.defer="total"/>
            <x-jet-input-error for="total"/>
        </div>
        <div class="flex justify-end">
            <x-jet-button wire:click="guardar" wire:target="guardar"
                          wire:loading.class="cursor-wait" wire:loading.attr="disabled">
                <x-icons.load class="h-4 w-4" wire:loading wire:target="guardar"></x-icons.load>
                {{ __('Guardar información') }}
            </x-jet-button>
        </div>
    </div>
</x-utils.card>
