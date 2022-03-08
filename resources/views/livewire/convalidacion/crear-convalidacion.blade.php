<div>
    <x-utils.card>
        @slot('header')
            <h3 class="font-bold text-lg text-gray-800">
                Crear convalidaciones
            </h3>
        @endslot
        <div class="space-y-4">
            <div class="space-y-2">
                <x-jet-label for="escuelaSeleccionado" value="Programa de estudios"/>
                <x-utils.forms.select class="w-full" wire:model="escuelaSeleccionado">
                    @forelse($escuelas as $escuela)
                        <option value="{{ $escuela->id }}">{{$escuela->nombre}}</option>
                    @empty
                        <option value="0">No hay datos</option>
                    @endforelse
                </x-utils.forms.select>
                <x-jet-input-error for="escuelaSeleccionado"></x-jet-input-error>
            </div>
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
                    <x-jet-label for="vacantes" value="Vacantes"/>
                    <x-jet-input id="vacantes" wire:model.debounce.500ms="vacantes" type="number"
                                 class="mt-1 w-full" autocomplete="off" autofocus/>
                    <x-jet-input-error for="vacantes"/>
                </div>
                <div class="w-full">
                    <x-jet-label for="postulantes" value="Postulantes"/>
                    <x-jet-input id="postulantes" wire:model.debounce.500ms="postulantes" type="number"
                                 class="mt-1 w-full" autocomplete="off"/>
                    <x-jet-input-error for="postulantes"/>
                </div>
                <div class="w-full">
                    <x-jet-label for="convalidados" value="Convalidados"/>
                    <x-jet-input id="convalidados" wire:model.debounce.500ms="convalidados" type="number"
                                 class="mt-1 w-full" autocomplete="off"/>
                    <x-jet-input-error for="convalidados"/>
                </div>
            </div>
            <div class="w-full flex justify-end">
                <x-jet-button
                    wire:click="guardarConvalidacion"
                    wire:target="guardarConvalidacion"
                    wire:loading.class="bg-gray-800"
                    wire:loading.attr="disabled">
                    <x-icons.load wire:loading wire:target="guardarConvalidacion" class="h-5 w-5"
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
