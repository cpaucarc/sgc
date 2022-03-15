<div>
    <x-utils.card>
        @slot('header')
            <h3 class="font-bold text-lg text-gray-800">
                Registrar convenios por semestre
            </h3>
        @endslot
        <div class="space-y-4">
            <div class="space-y-2">
                <x-jet-label for="requisitoSeleccionado" value="Semestre académico"/>
                <x-utils.forms.select class="w-full" wire:model="semestreSeleccionado">
                    @forelse($semestres as $semestre)
                        <option value="{{ $semestre->id }}">{{$semestre->nombre}}</option>
                    @empty
                        <option value="0">No hay datos</option>
                    @endforelse
                </x-utils.forms.select>
                <x-jet-input-error for="semestreSeleccionado"></x-jet-input-error>
            </div>
            {{--Datos para calcular los indicadores--}}
            <div class="grid grid-cols-3 gap-x-6">
                <div class="w-full">
                    <x-jet-label for="realizados" value="Convenios Relizados"/>
                    <x-jet-input id="realizados" min="0" wire:model.debounce.500ms="realizados" type="number"
                                 class="mt-1 w-full" autocomplete="off" autofocus/>
                    <x-jet-input-error for="realizados"/>
                </div>
                <div class="w-full">
                    <x-jet-label for="vigentes" value="Convenios Vigentes"/>
                    <x-jet-input id="vigentes" min="0" wire:model.debounce.500ms="vigentes" type="number"
                                 class="mt-1 w-full" autocomplete="off"/>
                    <x-jet-input-error for="vigentes"/>
                </div>
                <div class="w-full">
                    <x-jet-label for="culminados" value="Convenios Culminados"/>
                    <x-jet-input id="culminados" min="0" wire:model.debounce.500ms="culminados" type="number"
                                 class="mt-1 w-full" autocomplete="off"/>
                    <x-jet-input-error for="culminados"/>
                </div>
            </div>
            <div class="w-full flex justify-end">
                <x-jet-button
                    wire:click="guardarConvenio"
                    wire:target="guardarConvenio"
                    wire:loading.class="bg-gray-800"
                    wire:loading.attr="disabled">
                    <x-icons.load wire:loading wire:target="guardarConvenio" class="h-5 w-5"
                                  stroke="1.5"></x-icons.load>
                    {{ __('Guardar') }}
                </x-jet-button>
            </div>
        </div>
    </x-utils.card>

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
