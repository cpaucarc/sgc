<div class="w-full md:w-9/12 lg:w-6/12 mx-auto divide-y divide-stone-200 space-y-6 mb-8">

    <div class="flex-col">
        <h2 class="font-bold text-stone-700 text-xl">
            Registrar postulantes y beneficiados en Bolsa de Trabajo
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
        <div>
            @if($ultimo_registro)
                <div class="bg-sky-100 text-sky-700 px-2 py-1 rounded-md mb-4">
                    <p class="text-sm ml-1">
                        La última información registrada para esta escuela fue desde
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
                    @foreach($semestres as $sm)
                        <option value="{{ $sm->id }}">{{ $sm->nombre }}</option>
                    @endforeach
                </x-utils.forms.select>
                <x-jet-input-error for="semestre"/>
            </div>
            <div class="w-full">
                <x-jet-label for="postulantes" value="Postulantes"/>
                <x-jet-input id="postulantes" type="number" min="0" class="mt-1 block w-full"
                             wire:model.defer="postulantes" autocomplete="off" autofocus/>
                <x-jet-input-error for="postulantes"/>
            </div>
            <div class="w-full">
                <x-jet-label for="beneficiados" value="Beneficiados"/>
                <x-jet-input id="beneficiados" type="number" min="0" class="mt-1 block w-full"
                             wire:model.defer="beneficiados" autocomplete="off"/>
                <x-jet-input-error for="beneficiados"/>
            </div>
        </div>
    </div>

    <div class="flex justify-end pt-8">
        <x-jet-button wire:click="registrar" wire:target="registrar"
                      wire:loading.class="cursor-wait" wire:loading.attr="disabled">
            <x-icons.load wire:loading wire:target="registrar" class="icon-5"/>
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
