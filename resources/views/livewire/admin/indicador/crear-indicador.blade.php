<div>
    <x-jet-button wire:click="openModal">
        Registrar nuevo
    </x-jet-button>

    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
            <div class="flex justify-between w-full py-2">
                <h1 class="font-bold text-gray-700">
                    Crear indicador
                </h1>
                <x-utils.buttons.close-button wire:click="$set('open', false)"/>
            </div>
        </x-slot>

        <x-slot name="content">

            <div class="space-y-6">
                <div class="flex items-center justify-between gap-6">
                    <div class="w-full">
                        <x-jet-label for="objetivo" value="Objetivo"/>
                        <x-jet-input id="objetivo" class="w-full"
                                     placeholder="Ej. Medir el porcentaje de usuarios beneficiados por el proceso de bolsa de trabajo."
                                     type="text" wire:model.defer="objetivo"/>
                        <x-jet-input-error for="objetivo"/>
                    </div>
                    <div class="col-span-2">
                        <x-jet-label for="codigo" value="Código"/>
                        <x-jet-input id="codigo" type="text" class="mt-1 w-full" placeholder="Ej. IND-010"
                                     wire:model.defer="codigo" autocomplete="off"/>
                        <x-jet-input-error for="codigo"/>
                    </div>
                </div>
                @if($unidad==2)
                    <div class="flex items-center justify-between gap-6">
                        <div class="w-full">
                            <div class="flex gap-x-2">
                                <x-jet-label for="interes" value="Título interes"/>
                                <x-utils.optional-badge/>
                            </div>
                            <x-jet-input id="interes" type="text" class="mt-1 w-full"
                                         wire:model.defer="interes" autocomplete="off"/>
                            <x-jet-input-error for="interes"/>
                        </div>
                        <div class="w-full">
                            <div class="flex gap-x-2">
                                <x-jet-label for="total" value="Título total"/>
                                <x-utils.optional-badge/>
                            </div>
                            <x-jet-input id="total" type="text" class="mt-1 w-full"
                                         wire:model.defer="total" autocomplete="off"/>
                            <x-jet-input-error for="total"/>
                        </div>
                    </div>
                @endif
                <div class="flex items-center justify-between gap-6">
                    <div class="w-full">
                        <x-jet-label for="resultado" value="Título resultado"/>
                        <x-jet-input id="resultado" class="w-full" type="text" wire:model.defer="resultado"/>
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
                <div class="w-full">
                    <x-jet-label for="formula" value="Fórmula"/>
                    <x-jet-input id="formula" class="w-full"
                                 placeholder="Ej. X = (N° de beneficiados por programa)/(Total de postulantes del programa) x 100"
                                 type="text" wire:model.defer="formula"/>
                    <x-jet-input-error for="formula"/>
                </div>
                <div class="flex items-center justify-between gap-6">
                    <div class="w-full">
                        <x-jet-label for="minimo" value="Mínimo"/>
                        <x-jet-input id="minimo" type="text" class="mt-1 w-full" placeholder="Ej. 5"
                                     wire:model.defer="minimo" autocomplete="off"/>
                        <x-jet-input-error for="minimo"/>
                    </div>
                    <div class="w-full">
                        <x-jet-label for="satisfactorio" value="Satisfactorio"/>
                        <x-jet-input id="satisfactorio" type="text" class="mt-1 w-full" placeholder="Ej. 10"
                                     wire:model.defer="satisfactorio" autocomplete="off"/>
                        <x-jet-input-error for="satisfactorio"/>
                    </div>
                    <div class="w-full">
                        <x-jet-label for="sobresaliente" value="Sobresaliente"/>
                        <x-jet-input id="sobresaliente" type="text" class="mt-1 w-full" placeholder="Ej. 20"
                                     wire:model.defer="sobresaliente" autocomplete="off"/>
                        <x-jet-input-error for="sobresaliente"/>
                    </div>
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

            </div>

        </x-slot>

        <x-slot name="footer">
            <x-jet-button
                wire:click="crearIndicador"
                wire:target="crearIndicador"
                wire:loading.class="cursor-wait"
                wire:loading.attr="disabled">
                <x-icons.load wire:loading wire:target="crearIndicador" class="icon-5"/>
                Guardar
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>

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
