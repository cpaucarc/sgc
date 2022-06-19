<div class="w-full md:w-9/12 lg:w-8/12 mx-auto divide-y divide-stone-200 space-y-6 mb-8">

    <div class="flex-col">
        <h2 class="font-bold text-stone-700 text-xl">
            Registrar información sobre Material Bibliográfico (MB)
        </h2>
    </div>

    <div class="space-y-4 divide-y divide-dashed divide-stone-200 pt-4">
        <div class="w-full">
            <x-jet-label for="facultad" value="Facultad"/>
            <x-utils.forms.select id="facultad" class="mt-1 block w-full" wire:model="facultad">
                <option value="0">Selecciona</option>
                @foreach($facultades as $fac)
                    <option value="{{ $fac->id }}">{{ $fac->nombre }}</option>
                @endforeach
            </x-utils.forms.select>
            <x-jet-input-error for="facultad"/>
        </div>
    </div>

    <div class="space-y-4 divide-y divide-dashed divide-stone-200 pt-4">
        <div>
            @if($ultimo_registro)
                <div class="bg-sky-100 text-sky-700 px-2 py-1 rounded-md mb-4">
                    <p class="text-sm ml-1">
                        La última información registrada para esta facultad fue desde
                        <b>{{ $ultimo_registro->fecha_inicio->format('d/m/Y') }}</b> hasta
                        <b>{{ $ultimo_registro->fecha_fin->format('d/m/Y') }}</b>.
                    </p>
                </div>
            @endif

            <div class="flex gap-x-6">
                <div class="w-full">
                    <x-jet-label for="inicio" value="Fecha de inicio"/>
                    <x-jet-input id="inicio" type="date" class="mt-1 block w-full"
                                 wire:model.defer="inicio" autocomplete="off"/>
                    <x-jet-input-error for="inicio"/>
                </div>
                <div class="w-full">
                    <x-jet-label for="fin" value="Fecha de Finalización"/>
                    <x-jet-input id="fin" type="date" class="mt-1 block w-full"
                                 wire:model.defer="fin" autocomplete="off"/>
                    <x-jet-input-error for="fin"/>
                </div>
            </div>
        </div>

        <div class="flex gap-x-6 pt-4">
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
                <x-jet-label for="total" value="Cantidad Total de Libros"/>
                <x-jet-input id="total" min="0" type="number" class="mt-1 block w-full"
                             wire:model.defer="total" autocomplete="off" autofocus/>
                <x-jet-input-error for="total"/>
            </div>
        </div>
    </div>

    <div class="space-y-4 divide-y divide-dashed divide-stone-200 pt-4">
        <div class="pt-4 grid grid-cols-3 items-center">
            <x-jet-label for="adquirido" value="MB Adquiridos"/>
            <div class="col-span-2">
                <x-jet-input id="adquirido" min="0" type="number" class="mt-1 block w-full"
                             wire:model.defer="adquirido" autocomplete="off" autofocus/>
                <x-jet-input-error for="adquirido"/>
            </div>
        </div>

        <div class="pt-4 grid grid-cols-3 items-center">
            <x-jet-label for="prestado" value="MB Prestados"/>
            <div class="col-span-2">
                <x-jet-input id="prestado" type="number" min="0" class="mt-1 block w-full"
                             wire:model.defer="prestado" autocomplete="off" autofocus/>
                <x-jet-input-error for="prestado"/>
            </div>
        </div>

        <div class="pt-4 grid grid-cols-3 items-center">
            <x-jet-label for="perdido" value="MB Perdidos"/>
            <div class="col-span-2">
                <x-jet-input id="perdido" type="number" min="0" class="mt-1 block w-full"
                             wire:model.defer="perdido" autocomplete="off" autofocus/>
                <x-jet-input-error for="perdido"/>
            </div>
        </div>

        <div class="pt-4 grid grid-cols-3 items-center">
            <x-jet-label for="restaurado" value="MB Restaurados"/>
            <div class="col-span-2">
                <x-jet-input id="restaurado" type="number" min="0" class="mt-1 block w-full"
                             wire:model.defer="restaurado" autocomplete="off" autofocus/>
                <x-jet-input-error for="restaurado"/>
            </div>
        </div>
    </div>

    <div class="flex justify-end pt-4">
        <x-jet-button wire:click="registrar" wire:target="registrar"
                      wire:loading.class="cursor-wait" wire:loading.attr="disabled">
            <x-icons.load wire:loading wire:target="registrar" class="h-5 w-5"/>
            {{ __('Registrar Información') }}
        </x-jet-button>
    </div>

</div>
