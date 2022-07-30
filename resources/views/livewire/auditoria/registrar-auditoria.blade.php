<div class="w-full md:w-9/12 lg:w-6/12 mx-auto space-y-6 mb-8">
    <x-utils.titulo
        titulo="Registrar nueva auditoría (Semestre {{ $semestre->nombre }})"/>

    <div class="space-y-4 pt-4">
        <div>
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
            <x-jet-label for="tipo" value="Tipo de auditoría"/>
            <div class="flex items-center justify-between gap-x-2">
                <x-utils.forms.select id="tipo" class="mt-1 block w-full" wire:model="tipo">
                    <option value="1">Auditoría Interna</option>
                    <option value="0">Auditoría Externa</option>
                </x-utils.forms.select>

                @if($tipo == 1 && !is_null($uuid) && !$auditoria_interna)
                    <div class="flex justify-end mt-1">
                        <x-utils.links.primary href="{{ route('auditoria.interna', $uuid) }}">
                            Crear
                        </x-utils.links.primary>
                    </div>
                @endif
            </div>

            @if($tipo == 1 && !is_null($uuid) && $auditoria_interna)
                <div class="flex justify-end items-center mt-1 text-sm gap-x-1 text-zinc-600">
                    Se encontró una auditoria realizada en el
                    semestre {{ $semestre->nombre }},
                    <a class="inline-flex items-center text-rose-600 hover:text-rose-700 hover:underline soft-transition whitespace-nowrap"
                       href="{{ route('auditoria.internapdf', ['facultad' => $facultad, 'semestre' => $semestre->id]) }}">
                        <img src="{{ asset('images/svg/pdf.svg') }}" alt="PDF Icono" class="icon-6">
                        &nbsp;Descargar auditoría
                    </a>
                </div>
            @endif

            <x-jet-input-error for="tipo"/>
        </div>

        <div class="pt-4">
            <x-jet-label for="responsable" value="Responsable de la auditoría"/>
            <x-jet-input id="responsable" type="text" class="mt-1 block w-full"
                         wire:model.defer="responsable" placeholder="No especificado" autocomplete="off"/>
            <x-jet-input-error for="responsable"/>
        </div>

        <div class="pt-4">
            <x-jet-label for="objetivos" value="Objetivos de la auditoría"/>
            <x-utils.forms.textarea id="objetivos" rows="3" class="mt-1 block w-full"
                                    wire:model.defer="objetivos" placeholder="Ninguno..." autocomplete="off"/>
            <x-jet-input-error for="objetivos"/>
        </div>

        <div class="pt-4">
            <x-jet-label for="alcances" value="Alcances de la auditoría"/>
            <x-utils.forms.textarea id="alcances" rows="3" class="mt-1 block w-full"
                                    wire:model.defer="alcances" placeholder="Ninguno..." autocomplete="off"/>
            <x-jet-input-error for="alcances"/>
        </div>

        <div class="pt-4">
            <x-jet-label for="criterios" value="Criterios de la auditoría"/>
            <x-utils.forms.textarea id="criterios" rows="3" class="mt-1 block w-full"
                                    wire:model.defer="criterios" placeholder="Ninguno..." autocomplete="off"/>
            <x-jet-input-error for="criterios"/>
        </div>
    </div>

    <div class="space-y-4 divide-y divide-dashed divide-stone-200 pt-4">
        <x-jet-label for="archivo" value="{{ __('Archivos Adjuntos. (Peso max: 25Mb)') }}"/>
        <x-utils.file-uploading>
            <x-utils.forms.file-input id="archivo" wire:model.defer="archivos" class="w-full" multiple/>
        </x-utils.file-uploading>
        <x-jet-input-error for="archivos"/>
    </div>

    <div class="flex justify-end pt-4">
        <x-jet-button wire:click="guardarAuditoria" wire:target="guardarAuditoria,archivos"
                      wire:loading.class="cursor-wait" wire:loading.attr="disabled">
            <x-icons.load wire:loading wire:target="guardarAuditoria" class="icon-5"/>
            {{ __('Registrar auditoría') }}
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
                console.log('Error:', msg);
            });
        </script>
    @endpush

</div>
