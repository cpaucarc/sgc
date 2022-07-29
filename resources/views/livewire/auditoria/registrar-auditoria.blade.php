<div class="w-full md:w-9/12 lg:w-6/12 mx-auto space-y-6 mb-8">
    <x-utils.titulo
        titulo="Registrar nueva Auditoria"/>

    <div class="space-y-4 pt-4">
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
            <x-utils.forms.select id="tipo" class="mt-1 block w-full" wire:model="tipo">
                <option value="1">Auditoria Interna</option>
                <option value="0">Auditoria Externa</option>
            </x-utils.forms.select>

            <x-jet-input-error for="tipo"/>

            @if($tipo == 1 && !is_null($uuid))
                <div class="flex justify-end mt-2">
                    @if($auditoria_interna)
                        <x-utils.links.danger
                            href="{{ route('auditoria.internapdf', ['facultad' => $facultad, 'semestre' => $semestre_activo]) }}">
                            <x-icons.download class="icon-5 mr-2" stroke="2"/>
                            Descargar auditoria
                        </x-utils.links.danger>
                    @else
                        <x-utils.links.primary href="{{ route('auditoria.interna', $uuid) }}">
                            Crear
                        </x-utils.links.primary>
                    @endif
                </div>
            @endif
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
            <x-icons.load wire:loading wire:target="guardarAuditoria" class="icon-5"/>
            {{ __('Registrar Auditoria') }}
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
