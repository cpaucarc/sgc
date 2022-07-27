<div class="space-y-8">
    <div class="flex items-center justify-between gap-6">
        <div class="w-full">
            <x-jet-label for="objetivo" value="Objetivo"/>
            <x-jet-input id="objetivo" class="w-full" type="text" wire:model.defer="objetivo"/>
            <x-jet-input-error for="objetivo"/>
        </div>
        <div class="col-span-2">
            <x-jet-label for="codigo" value="Código"/>
            <x-jet-input id="codigo" type="text" class="mt-1 w-full"
                         wire:model.defer="codigo" autocomplete="off"/>
            <x-jet-input-error for="codigo"/>
        </div>
    </div>
    @if($unidad==2)
        <div class="flex items-center justify-between gap-6">
            <div class="w-full">
                <div class="flex justify-between">
                    <div class="flex gap-x-2">
                        <x-jet-label for="interes" value="Título interes"/>
                        <x-utils.optional-badge/>
                    </div>
                    <x-utils.tooltip-modal placement="bottom">
                        <x-slot name="title">Título interes</x-slot>
                        <x-slot name="description">
                            Representa la descripción del número registros actuales para la
                            operación (representa al cociente)
                        </x-slot>
                        <x-slot name="image">{{ asset('images/tooltip/formula_indicador.jpg')  }}</x-slot>
                    </x-utils.tooltip-modal>
                </div>
                <x-jet-input id="interes" type="text" class="mt-1 w-full"
                             wire:model="interes" placeholder="Campo registrado vacío"
                             autocomplete="off"/>
                <x-jet-input-error for="interes"/>
            </div>
            <div class="w-full">
                <div class="flex justify-between">
                    <div class="flex gap-x-2">
                        <x-jet-label for="total" value="Título total"/>
                        <x-utils.optional-badge/>
                    </div>
                    <x-utils.tooltip-modal placement="left">
                        <x-slot name="title">Título total</x-slot>
                        <x-slot name="description">
                            Representa la descripción del número total de registros para la
                            operación (representa al divisor)
                        </x-slot>
                        <x-slot name="image">{{ asset('images/tooltip/formula_indicador.jpg')  }}</x-slot>
                    </x-utils.tooltip-modal>
                </div>
                <x-jet-input id="total" type="text" class="mt-1 w-full"
                             wire:model="total" placeholder="Campo registrado vacío"
                             autocomplete="off"/>
                <x-jet-input-error for="total"/>
            </div>
        </div>
    @endif
    <div class="flex items-center justify-between gap-6">
        <div class="w-full">
            <x-jet-label for="resultado" value="Título resultado"/>
            <x-jet-input id="resultado" class="w-full" type="text" wire:model="resultado"/>
            <x-jet-input-error for="resultado"/>
        </div>
        <div class="w-full">
            <x-jet-label for="proceso" value="Proceso"/>
            <x-utils.forms.select id="proceso" class="mt-1 block w-full"
                                  wire:model.defer="proceso">
                @foreach($procesos as $proceso)
                    <option value="{{ $proceso->id }}">{{ $proceso->nombre}}</option>
                @endforeach
            </x-utils.forms.select>
            <x-jet-input-error for="proceso"/>
        </div>
    </div>
    <div class="flex items-center justify-between gap-6">
        <div class="w-full">
            <x-jet-label for="minimo" value="Mínimo"/>
            <x-jet-input id="minimo" type="text" class="mt-1 w-full"
                         wire:model.defer="minimo" autocomplete="off"/>
            <x-jet-input-error for="minimo"/>
        </div>
        <div class="w-full">
            <x-jet-label for="sobresaliente" value="Sobresaliente"/>
            <x-jet-input id="sobresaliente" type="text" class="mt-1 w-full"
                         wire:model.defer="sobresaliente" autocomplete="off"/>
            <x-jet-input-error for="sobresaliente"/>
        </div>
    </div>
    <div class="w-full">
        <x-jet-label for="formula" value="Fórmula"/>
        <x-jet-input id="formula" class="w-full" type="text" wire:model="formula"/>
        <x-jet-input-error for="formula"/>
    </div>
    <div class="flex items-center justify-between gap-6">
        <div class="w-full">
            <x-jet-label for="unidad" value="Unidad"/>
            <x-utils.forms.select id="unidad" class="mt-1 block w-full"
                                  wire:model="unidad">
                @foreach($unidades as $unidad)
                    <option value="{{ $unidad->id }}">{{ $unidad->nombre}}</option>
                @endforeach
            </x-utils.forms.select>
            <x-jet-input-error for="unidad"/>
        </div>
        <div class="w-full">
            <x-jet-label for="medicion" value="Medicion"/>
            <x-utils.forms.select id="medicion" class="mt-1 block w-full"
                                  wire:model.defer="medicion">
                @foreach($mediciones as $medicion)
                    <option value="{{ $medicion->id }}">{{ $medicion->nombre}}</option>
                @endforeach
            </x-utils.forms.select>
            <x-jet-input-error for="medicion"/>
        </div>
        <div class="w-full">
            <x-jet-label for="reporte" value="Reporte"/>
            <x-utils.forms.select id="reporte" class="mt-1 block w-full"
                                  wire:model.defer="reporte">
                @foreach($reportes as $reporte)
                    <option value="{{ $reporte->id }}">{{ $reporte->nombre}}</option>
                @endforeach
            </x-utils.forms.select>
            <x-jet-input-error for="reporte"/>
        </div>
    </div>

    <div class="flex justify-end">
        <x-jet-button wire:click="actualizar" wire:target="actualizar"
                      wire:loading.class="cursor-wait" wire:loading.attr="disabled">
            <x-icons.load wire:loading wire:target="actualizar" class="icon-5"/>
            {{ __('Actualizar Indicador') }}
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
