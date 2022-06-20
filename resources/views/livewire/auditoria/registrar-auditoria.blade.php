<div class="w-full md:w-9/12 lg:w-6/12 mx-auto divide-y divide-stone-200 space-y-6 mb-8">

    <div class="flex-col">
        <h2 class="font-bold text-stone-700 text-xl">
            Registrar nueva Auditoria
        </h2>
    </div>

    <div class="space-y-4 divide-y divide-dashed divide-stone-200 pt-4">
        <div>
            <x-jet-label for="responsable" value="Responsable de la auditoria"/>
            <x-jet-input id="responsable" type="text" class="mt-1 block w-full"
                         wire:model.defer="responsable" autocomplete="off" autofocus/>
            <x-jet-input-error for="responsable"/>
        </div>

        <div class="pt-4">
            <x-jet-label for="facultad" value="Facultad"/>
            <x-utils.forms.select id="facultad" class="mt-1 block w-full" wire:model.defer="facultad">
                @forelse($facultades as $fac)
                    <option value="{{ $fac->id }}">{{$fac->nombre}}</option>
                @empty
                    <option value="0">Selecciona</option>
                @endforelse
            </x-utils.forms.select>
            <x-jet-input-error for="facultad"/>
        </div>

        <div class="pt-4">
            <x-jet-label for="tipo" value="Tipo de Auditoria"/>
            <x-utils.forms.select id="tipo" class="mt-1 block w-full" wire:model.defer="tipo">
                <option value="1">Auditoria Interna</option>
                <option value="0">Auditoria Externa</option>
            </x-utils.forms.select>
            <x-jet-input-error for="tipo"/>
        </div>
    </div>

    <div class="space-y-4 divide-y divide-dashed divide-stone-200 pt-4">
        <x-jet-label for="archivo" value="{{ __('Archivos Adjuntos. (Peso max: 25Mb)') }}"/>
        <x-utils.file-uploading>
            <x-utils.forms.file-input id="archivo" wire:model.defer="archivos" class="w-full" multiple/>
        </x-utils.file-uploading>
        <x-jet-input-error for="archivos"/>

        @if($mensaje)
            <x-utils.alert.error-box>{{ $mensaje }}</x-utils.alert.error-box>
        @endif
    </div>

    <div class="flex justify-end pt-4">
        <x-jet-button wire:click="guardarAuditoria" wire:target="guardarAuditoria,archivos"
                      wire:loading.class="cursor-wait" wire:loading.attr="disabled">
            <x-icons.load wire:loading wire:target="guardarAuditoria" class="h-5 w-5"/>
            {{ __('Registrar Auditoria') }}
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
