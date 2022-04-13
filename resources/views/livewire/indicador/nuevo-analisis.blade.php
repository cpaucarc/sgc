<div>
    {{--    @if($indicador)--}}
    <x-jet-dialog-modal wire:model="open" maxWidth="4xl">
        <x-slot name="title">
            <div class="flex justify-between w-full py-2">
                <div class="flex items-center gap-x-2 text-sm">
                    <div
                        class="bg-indigo-100 text-indigo-800 w-12 h-12 flex-shrink-0 rounded-full grid place-items-center">
                        {{ substr($indicadorable->indicador->cod_ind_inicial, -3, 3) }}
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
                        <x-icons.info :stroke="1.5" class="h-6 w-6 mr-1 flex-shrink-0"/>
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
                        <p class="text-sm {{ $diffIsOk ? 'text-green-500' : 'text-rose-600 '}}">
                            (Hay&nbsp;{{ $diffInDays }}&nbsp;dias entre estas estas fechas)
                        </p>
                    </div>
                </div>

                <div wire:loading class="pt-6 w-full">
                    <p class="animate-pulse text-gray-900 w-full">
                        Cargando datos...
                    </p>
                </div>

                {{-- Resultados de medicion --}}
                <div wire:loading.remove class="pt-6 space-y-4">
                    {{-- Resultados de medicion --}}
                    <div class="grid grid-cols-3 gap-x-6">
                        @if($indicadorable->indicador->titulo_interes)
                            <div class="w-full">
                                <x-jet-label for="interes" value="{{ $indicadorable->indicador->titulo_interes }}"/>
                                <x-jet-input id="interes" value="{{ round($interes, 1) }}" type="text"
                                             class="mt-1 w-full bg-gray-100" autocomplete="off" readonly/>
                                <x-jet-input-error for="interes"/>
                            </div>

                            <div class="w-full">
                                <x-jet-label for="total" value="{{ $indicadorable->indicador->titulo_total }}"/>
                                <x-jet-input id="total" value="{{ round($total, 1) }}" type="text"
                                             class="mt-1 w-full bg-gray-100" autocomplete="off" readonly/>
                                <x-jet-input-error for="total"/>
                            </div>
                        @endif
                        <div class="w-full">
                            <x-jet-label for="resultado" value="{{ $indicadorable->indicador->titulo_resultado }}"/>
                            <x-jet-input id="resultado"
                                         value="{{ round($resultado, 1) }} {{ $indicadorable->indicador->titulo_interes ? '%': '' }}"
                                         type="text" class="mt-1 w-full bg-gray-100" autocomplete="off" readonly/>
                            <x-jet-input-error for="resultado"/>
                        </div>

                        <div class="col-span-3 mt-1">
                            <span class="text-gray-500 text-xs flex items-center py-0.5">
                                <x-icons.quality class="flex-shrink-0 h-4 w-4 mr-1" stroke="1.25"/>
                                Estos valores son calculados automaticamente, no pueden editarse manualmente.
                            </span>
                        </div>
                    </div>

                    {{-- Rangos de medicion --}}
                    <div class="grid grid-cols-3 gap-x-6">
                        <div class="w-full">
                            <x-jet-label for="minimo" value="Mínimo"/>
                            <x-jet-input id="minimo" wire:model.debounce.500ms="min" type="number"
                                         class="mt-1 w-full" autocomplete="off"/>
                            <x-jet-input-error for="min"/>
                        </div>
                        <div class="w-full">
                            <x-jet-label for="satisfactorio" value="Satisfactorio"/>
                            <x-jet-input id="satisfactorio" wire:model.debounce.500ms="sat" type="number"
                                         class="mt-1 w-full" autocomplete="off"/>
                            <x-jet-input-error for="sat"/>
                        </div>
                        <div class="w-full">
                            <x-jet-label for="sobresaliente" value="Sobresaliente"/>
                            <x-jet-input id="sobresaliente" wire:model.debounce.500ms="sob" type="number"
                                         class="mt-1 w-full" autocomplete="off"/>
                            <x-jet-input-error for="sob"/>
                        </div>

                        <div class="col-span-3 flex justify-between items-center text-gray-600 mt-2">
                            <label class="cursor-pointer text-sm">
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

                    {{--                        --}}{{--                        @livewire('indicador.grafico-unitario', [--}}
                    {{--                        --}}{{--                        'min' => $min, 'sat' => $sat, 'sob' => $sob, 'resultado' => $resultado--}}
                    {{--                        --}}{{--                        ])--}}

                </div>

                {{-- Analisis y Observaciones --}}
                <div class="pt-6 space-y-2">
                    <div class="w-full">
                        <div class="flex items-center">
                            <x-jet-label for="analisis" value="Analisis/Interpretación de los resultados"
                                         placeholder="Ninguno..."/>
                            <x-utils.optional-badge/>
                        </div>
                        <x-utils.forms.textarea id="analisis" wire:model.defer="analisis" class="mt-1 w-full"
                                                placeholder="Ninguno..."/>
                        <x-jet-input-error for="analisis"/>
                    </div>

                    <div class="w-full">
                        <div class="flex items-center">
                            <x-jet-label for="observacion" value="Observaciones"/>
                            <x-utils.optional-badge/>
                        </div>
                        <x-utils.forms.textarea id="observacion" wire:model.defer="observacion" class="mt-1 w-full"/>
                        <x-jet-input-error for="observacion"/>
                    </div>
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
                <x-icons.load wire:loading wire:target="guardarAnalisis" class="h-5 w-5"/>
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

