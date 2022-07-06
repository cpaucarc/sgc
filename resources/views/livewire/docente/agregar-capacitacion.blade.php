<x-utils.card class="border rounded-lg">

    <x-slot name="header">
        <h1 class="font-bold text-sm text-gray-800">
            Agregar información de las capacitaciones
        </h1>
    </x-slot>

    <div class="my-2 space-y-4">
        <div>
            <x-jet-label for="departamento" value="Departamentos académicos"/>
            <x-utils.forms.select id="departamento" type="month" class="w-full" wire:model="departamento">
                @if($depto)
                    <option value="{{ $depto->id }}">{{ $depto->nombre }}</option>
                @else
                    <option value="0">No hay ningún dato</option>
                @endif
            </x-utils.forms.select>
            <x-jet-input-error for="departamento"/>
        </div>
        <div>
            <x-jet-label for="semestre" value="Semestre académico"/>
            <x-utils.forms.select id="semestre" type="semestre" class="w-full" wire:model.defer="semestre">
                @forelse($semestres as $smt)
                    <option value="{{ $smt->id }}">{{$smt->nombre}}</option>
                @empty
                    <option value="0">No hay ningún dato</option>
                @endforelse
            </x-utils.forms.select>
            <x-jet-input-error for="semestre"/>
        </div>
        <div>
            <x-jet-label for="nombre" value="Nombre de la capacitación"/>
            <x-utils.forms.textarea class="mt-1 block w-full" wire:model.defer="nombre"
                                    id="nombre"/>
            <x-jet-input-error for="nombre"/>
        </div>
        <div class="flex justify-end">
            <x-jet-button wire:click="guardar" wire:target="guardar"
                          wire:loading.class="cursor-wait" wire:loading.attr="disabled">
                <x-icons.load class="icon-4" wire:loading wire:target="guardar"></x-icons.load>
                {{ __('Guardar información') }}
            </x-jet-button>
        </div>
    </div>
</x-utils.card>
