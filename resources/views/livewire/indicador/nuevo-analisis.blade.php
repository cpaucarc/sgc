<div>
    {{--    @if($indicador)--}}
    <x-jet-dialog-modal wire:model="open" maxWidth="4xl">
        <x-slot name="title">
            <div class="flex justify-between items-center w-full p-2 bg-gray-50 rounded-lg">
                <div class="flex items-center gap-x-2 text-sm">
                    <div class="bg-indigo-100 font-bold text-indigo-600 icon-12 rounded-full grid place-items-center">
                        {{ substr($cod_ind, -3, 3) }}
                    </div>
                    <p class="font-bold text-gray-800 text-base">
                        {{ $indicadorable->indicador->objetivo }}
                    </p>
                </div>

                <x-utils.buttons.close-button wire:click="$set('open', false)"/>
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="space-y-8 divide-y divide-dashed divide-gray-200">
                {{-- Fechas de medicion --}}
                <div class="text-gray-700 rounded-lg flex items-center justify-between">

                    <div class="whitespace-nowrap flex items-center text-sm">
                        <x-icons.info :stroke="1.5" class="icon-6 mr-1"/>
                        Medición&nbsp;<span class="font-bold">{{ $indicadorable->indicador->medicion->nombre }}</span>
                    </div>

                    <div>
                        <x-utils.forms.select wire:model="semestre_id">
                            @foreach($semestres as $sm)
                                <option value="{{$sm->id}}">Semestre {{$sm->nombre}}</option>
                            @endforeach
                        </x-utils.forms.select>
                    </div>

                    <div class="flex flex-col items-center">
                        <div class="flex items-center space-x-2 text-gray-600 text-sm">
                            <label class="whitespace-nowrap border border-gray-300 px-2 py-1 rounded-lg">
                                Inicio
                                <input wire:model="inicio" type="date"
                                       class="border-none p-0 w-32 focus:ring-0 text-sm">
                            </label>

                            <label class="whitespace-nowrap border border-gray-300 px-2 py-1 rounded-lg">
                                Fin
                                <input wire:model="fin" type="date" class="border-none p-0 w-32 focus:ring-0 text-sm">
                            </label>
                        </div>
                        <p class="text-sm flex items-center {{ $diffIsOk ? 'text-green-500' : 'text-rose-600'}}">
                            @if(!$diffIsOk)
                                <x-icons.warning class="icon-5 mr-1 text-rose-600 mr-1" stroke="1.25"/>
                            @endif
                            {{ \App\Lib\AnalisisHelper::diasASemanas($inicio, $fin) }}
                        </p>
                    </div>
                </div>

                <div wire:loading class="pt-6 w-full">
                    <p class="animate-pulse text-gray-900 w-full">
                        Cargando datos...
                    </p>
                </div>

                {{-- Resultados de medicion --}}
                <div wire:loading.remove class="pt-6 space-y-6">
                    {{-- Rangos de medicion --}}
                    <div class="grid grid-cols-3 gap-x-6 p-4 bg-gray-50 rounded-lg">
                        <div class="w-full">
                            <x-jet-label for="minimo" value="Mínimo"/>
                            <x-jet-input id="minimo" wire:model.debounce.500ms="min" type="number" min="0"
                                         class="mt-1 w-full focus:bg-rose-100" autocomplete="off"/>
                            <x-jet-input-error for="min"/>
                        </div>
                        <div class="w-full">
                            <x-jet-label for="sobresaliente" value="Sobresaliente"/>
                            <x-jet-input id="sobresaliente" wire:model.debounce.500ms="sob" type="number" min="0"
                                         class="mt-1 w-full focus:bg-green-100" autocomplete="off"/>
                            <x-jet-input-error for="sob"/>
                        </div>

                        <div class="col-span-3 flex justify-between items-center text-gray-600 mt-2">
                            <label class="cursor-pointer text-sm flex items-center">
                                <x-utils.forms.checkbox wire:model.defer="guardar"/>
                                Guardar estos valores para futuras instancias de este indicador.
                            </label>
                            {{--                            <x-utils.buttons.default class="text-xs">--}}
                            {{--                                <x-icons.load wire:loading wire:target="emitirEvento"--}}
                            {{--                                              class="h-5 w-5 text-gray-400"/>--}}
                            {{--                                {{ __('Ver gráfico') }}--}}
                            {{--                            </x-utils.buttons.default>--}}
                        </div>
                    </div>

                    {{-- Resultados de medicion --}}
                    <div class="space-y-1">
                        <h4 class="block font-medium text-sm text-gray-600">Resultados</h4>
                        @if(!is_null($resultados))
                            <x-utils.tables.table>
                                @slot('head')
                                    @if(count($resultados) > 1 || isset($resultados[0]['codigo']))
                                        <x-utils.tables.head><span class="sr-only">Item</span></x-utils.tables.head>
                                    @endif
                                    @if($indicadorable->indicador->titulo_interes)
                                        <x-utils.tables.head>
                                            {{ $indicadorable->indicador->titulo_interes }}
                                        </x-utils.tables.head>
                                        <x-utils.tables.head>
                                            {{ $indicadorable->indicador->titulo_total }}
                                        </x-utils.tables.head>
                                    @else
                                        <x-utils.tables.head>
                                            <span class="sr-only">Interes</span>
                                        </x-utils.tables.head>
                                        <x-utils.tables.head>
                                            <span class="sr-only">Total</span>
                                        </x-utils.tables.head>
                                    @endif
                                    <x-utils.tables.head>
                                        {{ $indicadorable->indicador->titulo_resultado }}
                                    </x-utils.tables.head>
                                @endslot
                                @slot('body')
                                    @foreach($resultados as $res)
                                        <x-utils.tables.row>
                                            @if(!is_null($res['curso']))
                                                <x-utils.tables.body>
                                                    {{ substr($res['curso'], 0, 55) }}...
                                                </x-utils.tables.body>
                                            @endif

                                            @if($indicadorable->indicador->titulo_interes)
                                                <x-utils.tables.body>
                                                    {{ round($res['interes'], 1) }}
                                                </x-utils.tables.body>

                                                <x-utils.tables.body>
                                                    {{ round($res['total'], 1) }}
                                                </x-utils.tables.body>
                                            @else
                                                <x-utils.tables.body>
                                                    <span class="sr-only">Nulo</span>
                                                </x-utils.tables.body>
                                                <x-utils.tables.body>
                                                    <span class="sr-only">Nulo</span>
                                                </x-utils.tables.body>
                                            @endif

                                            <x-utils.tables.body>
                                                <p class="font-bold">
                                                    {{ round($res['resultado'], 1) }} {{ $indicadorable->indicador->titulo_interes ? '%': '' }}
                                                </p>
                                            </x-utils.tables.body>

                                        </x-utils.tables.row>
                                    @endforeach
                                @endslot
                            </x-utils.tables.table>
                        @endif
                        <p class="block mt-1 text-gray-500 text-xs flex items-center py-0.5">
                            <x-icons.quality class="icon-4 mr-1" stroke="1.25"/>
                            Estos valores son calculados automaticamente, no pueden editarse manualmente.
                        </p>
                    </div>
                </div>

                {{-- Analisis y Observaciones --}}
                <div class="pt-6 space-y-3">
                    <details class="w-full">
                        <summary class="flex items-center space-x-1">
                            <span
                                class="block font-medium text-sm text-gray-600 hover:text-gray-800 cursor-pointer soft-transition">
                                ► Analisis/Interpretación de los resultados
                            </span>
                            <x-utils.optional-badge/>
                        </summary>
                        <x-utils.forms.textarea id="analisis" wire:model.defer="analisis" class="mt-1 w-full"
                                                placeholder="Ningún analisis/interpretación..."/>
                        <x-jet-input-error for="analisis"/>
                    </details>

                    <details class="w-full">
                        <summary class="flex items-center space-x-1">
                            <span
                                class="block font-medium text-sm text-gray-600 hover:text-gray-800 cursor-pointer soft-transition">
                                ► Observaciones
                            </span>
                            <x-utils.optional-badge/>
                        </summary>
                        <x-utils.forms.textarea id="observacion" wire:model.defer="observacion" class="mt-1 w-full"
                                                placeholder="Ninguna observación..."/>
                        <x-jet-input-error for="observacion"/>
                    </details>
                </div>

                {{-- Personal encargado --}}
                <div class="pt-6 grid grid-cols-3 gap-x-6">
                    <div class="w-full">
                        <div class="flex items-center">
                            <x-jet-label for="elaborado" value="Elaborado por:"/>
                            <x-utils.optional-badge/>
                        </div>
                        <x-jet-input id="elaborado" wire:model.defer="elaborado" class="mt-1 w-full" type="text"
                                     placeholder="Ej. Dr. John Doe"/>
                        <x-jet-input-error for="elaborado"/>
                    </div>
                    <div class="w-full">
                        <div class="flex items-center">
                            <x-jet-label for="revisado" value="Revisado por:"/>
                            <x-utils.optional-badge/>
                        </div>
                        <x-jet-input id="revisado" wire:model.defer="revisado" class="mt-1 w-full" type="text"
                                     placeholder="Ej. Dr. John Doe"/>
                        <x-jet-input-error for="revisado"/>
                    </div>
                    <div class="w-full">
                        <div class="flex items-center">
                            <x-jet-label for="aprovado" value="Aprobado por:"/>
                            <x-utils.optional-badge/>
                        </div>
                        <x-jet-input id="aprobado" wire:model.defer="aprobado" class="mt-1 w-full" type="text"
                                     placeholder="Ej. Dr. John Doe"/>
                        <x-jet-input-error for="aprobado"/>
                    </div>
                </div>
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-jet-button
                wire:click="guardarAnalisis"
                wire:target="guardarAnalisis"
                wire:loading.class="cursor-wait"
                wire:loading.attr="disabled">
                <x-icons.load wire:loading wire:target="guardarAnalisis" class="icon-5"/>
                Guardar
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
    {{--    @endif--}}
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
        })

    </script>
@endpush

