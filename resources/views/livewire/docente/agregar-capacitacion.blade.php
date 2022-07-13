<div>
    <x-utils.links.primary class="text-sm cursor-pointer" wire:click="abrirModal()">
        <x-icons.plus class="h-5 w-5 mr-1" stroke="1.5"></x-icons.plus>
        Nuevo
    </x-utils.links.primary>

    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
            <div class="flex-col">
                <h1 class="font-bold text-gray-700">
                    Agregar información de las capacitaciones
                </h1>
            </div>
            <x-utils.buttons.close-button wire:click="$set('open', false)"/>
        </x-slot>

        <x-slot name="content">
            <div class="my-2 space-y-4">
                <div>
                    <x-jet-label for="nombre" value="Nombre de la capacitación"/>
                    <x-utils.forms.textarea class="mt-1 block w-full" wire:model.defer="nombre"
                                            id="nombre" rows="2"/>
                    <x-jet-input-error for="nombre"/>
                </div>

                <div class="flex gap-x-6">
                    <div class="w-full">
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
                    <div class="w-full">
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
                </div>

                <div class="flex gap-x-6">
                    <div class="w-full">
                        <x-jet-label for="inicio" value="Fecha de Inicio de la Capacitación"/>
                        <x-jet-input id="inicio" type="date" class="mt-1 block w-full"
                                     wire:model.defer="inicio" autocomplete="off"/>
                        <x-jet-input-error for="inicio"/>
                    </div>
                    <div class="w-full">
                        <x-jet-label for="fin" value="Fecha de Finalización de la Capacitación"/>
                        <x-jet-input id="fin" type="date" class="mt-1 block w-full"
                                     wire:model.defer="fin" autocomplete="off"/>
                        <x-jet-input-error for="fin"/>
                    </div>
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open', false)">
                Cerrar
            </x-jet-secondary-button>
            <x-jet-button wire:click="guardar" wire:target="guardar"
                          wire:loading.class="cursor-wait" wire:loading.attr="disabled">
                <x-icons.load class="icon-5" wire:loading wire:target="guardar"/>
                {{ __('Guardar información') }}
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
