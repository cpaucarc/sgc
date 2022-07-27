<div>
    <div class="flex justify-between mb-4">
        <x-utils.forms.search-input wire:model.debounce.500ms="search"/>
    </div>

    @if(count($indicadores) > 0)
        <x-utils.tables.table>
            @slot('head')
                <x-utils.tables.head class="text-xs">Código</x-utils.tables.head>
                <x-utils.tables.head class="text-xs">Objetivo</x-utils.tables.head>
                <x-utils.tables.head class="text-xs">Rangos</x-utils.tables.head>
                <x-utils.tables.head class="text-xs">Frecuencia</x-utils.tables.head>
                <x-utils.tables.head class="text-xs">Unidad</x-utils.tables.head>
                <x-utils.tables.head class="text-xs">Proceso</x-utils.tables.head>
                <x-utils.tables.head class="text-xs"><span class="sr-only">Estado</span></x-utils.tables.head>
                <x-utils.tables.head class="text-right">
                    <span class="hidden">Acciones</span>
                </x-utils.tables.head>
            @endslot
            @slot('body')
                @foreach($indicadores as $indicador)
                    <x-utils.tables.row>
                        <x-utils.tables.body
                            class="whitespace-nowrap">{{ $indicador->cod_ind_inicial }}</x-utils.tables.body>
                        <x-utils.tables.body>{{ $indicador->objetivo}}</x-utils.tables.body>
                        <x-utils.tables.body>
                            <p class="block whitespace-nowrap">Min: <b>{{ round($indicador->minimo, 2) }}</b></p>
                            <p class="block whitespace-nowrap">Sob: <b>{{ round($indicador->sobresaliente, 2) }}</b></p>
                        </x-utils.tables.body>
                        <x-utils.tables.body>
                            <p class="block whitespace-nowrap">Medición: <b>{{ $indicador->medicion->nombre }}</b></p>
                            <p class="block whitespace-nowrap">Reporte: <b>{{ $indicador->reporte->nombre }}</b></p>
                        </x-utils.tables.body>
                        <x-utils.tables.body>{{ $indicador->unidadMedida->nombre}}</x-utils.tables.body>
                        <x-utils.tables.body>{{ $indicador->proceso->nombre}}</x-utils.tables.body>
                        <x-utils.tables.body>
                            @if($indicador->esta_implementado)
                                <x-utils.forms.checkbox checked title="Implementado"
                                                        wire:change="cambiarEstado({{ $indicador->id }}, false)">
                                </x-utils.forms.checkbox>
                            @else
                                <x-utils.forms.checkbox title="Sin implementar"
                                                        wire:change="cambiarEstado({{ $indicador->id }}, true)">
                                </x-utils.forms.checkbox>
                            @endif
                        </x-utils.tables.body>
                        <x-utils.tables.body>
                            <x-utils.buttons.invisible title="Editar" wire:click="seleccionar(true,{{$indicador}})">
                                <x-icons.edit class="h-5" stroke="1.6"/>
                            </x-utils.buttons.invisible>
                        </x-utils.tables.body>
                    </x-utils.tables.row>
                @endforeach
            @endslot
        </x-utils.tables.table>
        <div class="mt-4">
            {{ $indicadores->links() }}
        </div>
    @else
        <div class="border border-gray-300 rounded-md">
            <x-utils.message-no-items
                title="Aún no hay semestres registrados">
                @slot('icon')
                    <svg class="text-gray-400" fill="currentColor" viewBox="0 0 24 24" width="24" height="24">
                        <path
                            d="M7.25 12a.75.75 0 000 1.5h.5a.75.75 0 000-1.5h-.5zM6.5 9.25a.75.75 0 01.75-.75h.5a.75.75 0 010 1.5h-.5a.75.75 0 01-.75-.75zM7.25 5a.75.75 0 000 1.5h.5a.75.75 0 000-1.5h-.5zM10 12.75a.75.75 0 01.75-.75h.5a.75.75 0 010 1.5h-.5a.75.75 0 01-.75-.75zm.75-4.25a.75.75 0 000 1.5h.5a.75.75 0 000-1.5h-.5zM10 5.75a.75.75 0 01.75-.75h.5a.75.75 0 010 1.5h-.5a.75.75 0 01-.75-.75zM14.25 12a.75.75 0 000 1.5h.5a.75.75 0 000-1.5h-.5zm-.75-2.75a.75.75 0 01.75-.75h.5a.75.75 0 010 1.5h-.5a.75.75 0 01-.75-.75zM14.25 5a.75.75 0 000 1.5h.5a.75.75 0 000-1.5h-.5z"></path>
                        <path fill-rule="evenodd"
                              d="M3 20a2 2 0 002 2h3.75a.75.75 0 00.75-.75V19h3v2.25c0 .414.336.75.75.75H17c.092 0 .183-.006.272-.018a.758.758 0 00.166.018H21.5a2 2 0 002-2v-7.625a2 2 0 00-.8-1.6l-1-.75a.75.75 0 10-.9 1.2l1 .75a.5.5 0 01.2.4V20a.5.5 0 01-.5.5h-2.563c.041-.16.063-.327.063-.5V3a2 2 0 00-2-2H5a2 2 0 00-2 2v17zm2 .5a.5.5 0 01-.5-.5V3a.5.5 0 01.5-.5h12a.5.5 0 01.5.5v17a.5.5 0 01-.5.5h-3v-2.25a.75.75 0 00-.75-.75h-4.5a.75.75 0 00-.75.75v2.25H5z"></path>
                    </svg>
                @endslot
            </x-utils.message-no-items>
        </div>
    @endif


    <x-jet-dialog-modal wire:model="modal">
        @slot('title')
            <h1 class="font-bold text-gray-700">
                Actualizar indicadores
            </h1>
            <x-utils.buttons.close-button wire:click="$set('modal', false)"/>
        @endslot
        @slot('content')

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
                            <div class="flex gap-x-2">
                                <x-jet-label for="interes" value="Título interes"/>
                                <x-utils.optional-badge/>
                            </div>
                            <x-jet-input id="interes" type="text" class="mt-1 w-full"
                                         wire:model.defer="interes" placeholder="Campo registrado vacío"
                                         autocomplete="off"/>
                            <x-jet-input-error for="interes"/>
                        </div>
                        <div class="w-full">
                            <div class="flex gap-x-2">
                                <x-jet-label for="total" value="Título total"/>
                                <x-utils.optional-badge/>
                            </div>
                            <x-jet-input id="total" type="text" class="mt-1 w-full"
                                         wire:model.defer="total" placeholder="Campo registrado vacío"
                                         autocomplete="off"/>
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
                    <x-jet-input id="formula" class="w-full" type="text" wire:model.defer="formula"/>
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

            </div>

        @endslot
        @slot('footer')
            <x-jet-secondary-button wire:click="$set('modal', false)">
                Cerrar
            </x-jet-secondary-button>
            <x-jet-button
                wire:click="actualizarIndicador"
                wire:loading.class="bg-gray-800">
                <x-icons.load wire:loading wire:target="actualizarIndicador" class="icon-5" stroke="1.5"/>
                {{ __('Guardar') }}
            </x-jet-button>
        @endslot
    </x-jet-dialog-modal>
</div>
