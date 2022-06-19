<div class="w-full md:w-9/12 lg:w-6/12 mx-auto divide-y divide-stone-200 space-y-6 mb-8">
    <div class="flex-col">
        <h2 class="font-bold text-stone-700 text-xl">
            Registrar información sobre Convalidaciones
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

            <div class="w-full">
                <x-jet-label for="escuela" value="Programa Académico"/>
                <x-utils.forms.select id="facultad" class="mt-1 block w-full" wire:model="escuela">
                    @foreach($escuelas as $es)
                        <option value="{{ $es->id }}">{{ $es->nombre }}</option>
                    @endforeach
                </x-utils.forms.select>
                <x-jet-input-error for="escuela"/>
            </div>
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
                <x-jet-label for="vacantes" value="Cantidad Total de Vacantes"/>
                <x-jet-input id="vacantes" type="number" min="0" class="mt-1 block w-full"
                             wire:model.defer="vacantes" autocomplete="off" autofocus/>
                <x-jet-input-error for="vacantes"/>
            </div>
        </div>
        <div class="flex gap-x-6 pt-4">
            <div class="w-full">
                <x-jet-label for="postulantes" value="Cantidad Total de Postulantes"/>
                <x-jet-input id="postulantes" type="number" min="0" class="mt-1 block w-full"
                             wire:model.defer="postulantes" autocomplete="off"/>
                <x-jet-input-error for="postulantes"/>
            </div>
            <div class="w-full">
                <x-jet-label for="convalidados" value="Cantidad Total de Convalidados"/>
                <x-jet-input id="convalidados" type="number" min="0" class="mt-1 block w-full"
                             wire:model.defer="convalidados" autocomplete="off"/>
                <x-jet-input-error for="convalidados"/>
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
