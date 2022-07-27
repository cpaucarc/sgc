<div>
    {{--    @if($indicador)--}}
    <x-jet-dialog-modal wire:model="open" maxWidth="4xl">
        <x-slot name="title">
            <div class="flex justify-between items-center w-full pb-3 border-b border-dashed border-zinc-300">
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
            <div class="space-y-10">
                {{-- Componente de fechas --}}
                <div class="space-y-4">
                    <div class="flex items-center justify-between text-sm">
                        <span class="flex-shrink-0 ml-1 mr-3">
                            {{ $limite_inferior->format('d, M Y') }}
                        </span>
                        <div class="w-2 h-2 rounded-full bg-indigo-400"></div>
                        <hr class="border border-indigo-400 border-dashed flex-1">
                        <div class="w-2 h-2 rounded-full bg-indigo-400"></div>
                        <span class="flex-shrink-0 mr-1 ml-3">
                            {{ $limite_superior->format('d, M Y') }}
                        </span>
                    </div>

                    <fieldset class="bg-zinc-50/50 border border-zinc-100 px-5 py-4 rounded-md">
                        <legend class="text-zinc-700 text-sm font-bold bg-zinc-100 px-3 py-1 rounded">
                            Periodicidad de medición <b class="uppercase">{{ $frecuencia }}</b>
                        </legend>

                        <div class="flex justify-between items-center">
                            <div class="flex items-center gap-x-4">
                                <div>
                                    @if($frecuencia == "semanal")
                                        <x-jet-input readonly type="week" wire:model="fecha_semana"/>
                                    @endif

                                    @if($frecuencia == "mensual")
                                        <x-jet-input readonly type="month" wire:model="fecha_mes"/>
                                    @endif

                                    @if($frecuencia == "semestral" && !is_null($semestres))
                                        <x-utils.forms.select readonly wire:model="semestre_id">
                                            @foreach($semestres as $sm)
                                                <option value="{{$sm->id}}">Semestre {{$sm->nombre}}</option>
                                            @endforeach
                                        </x-utils.forms.select>
                                    @endif
                                </div>

                                <div class="text-sm">
                                    Datos desde el <b>{{ $inicio->format('d, M Y') }}</b> al
                                    <b>{{ $fin->format('d, M Y') }}</b>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>

                {{-- Intervalos de medición --}}
                <div wire:loading.remove wire:target="obtenerResultados" class="space-y-4">
                    {{-- Rangos de medicion --}}
                    <fieldset class="bg-zinc-50/50 border border-zinc-100 px-5 py-4 rounded-md">
                        <legend class="text-zinc-700 text-sm font-bold bg-zinc-100 px-3 py-1 rounded">
                            Intervalos de medición
                        </legend>

                        <div class="flex rounded-md overflow-hidden text-sm">
                            <div title="Resultados menores a {{ $min }} son considerados minimos."
                                 class="flex-1 text-rose-700 font-bold bg-stripes-rose p-2 hover:bg-rose-200/60 soft-transition grid place-items-center">
                                <p class="bg-rose-50 px-2 py-1 rounded text-center">Mínimo</p>
                            </div>
                            <div class="bg-rose-600 z-30">
                                <input type="number" min="0"
                                       class="w-16 text-white font-semibold text-sm text-center input-none mt-1"
                                       wire:model.debounce.500ms="min">
                            </div>
                            <div title="Resultados entre {{ $min }} y {{ $sob }} son considerados satisfactorios"
                                 class="flex-1 text-amber-700 font-bold bg-stripes-amber p-2 hover:bg-amber-200/60 soft-transition grid place-items-center">
                                <p class="bg-amber-50 px-2 py-1 rounded text-center">Satisfactorio</p>
                            </div>
                            <div class="bg-amber-600 z-30">
                                <input type="number" min="0"
                                       class="w-16 text-white font-semibold text-sm text-center input-none mt-1"
                                       wire:model.debounce.500ms="sob">
                            </div>
                            <div title="Resultados mayores a {{ $sob }} son considerados sobresalientes"
                                 class="flex-1 text-green-700 font-bold bg-stripes-green p-2 hover:bg-green-200/60 soft-transition grid place-items-center">
                                <p class="bg-green-50 px-2 py-1 rounded text-center">Sobresaliente</p>
                            </div>
                        </div>

                        <label class="cursor-pointer text-sm inline-flex items-center mt-4">
                            <x-utils.forms.checkbox wire:model.defer="guardar"/>
                            Guardar estos valores para futuras instancias de este indicador.
                        </label>
                    </fieldset>
                </div>

                {{-- Resultados de medicion --}}
                <div class="space-y-4">
                    <fieldset class="bg-zinc-50/50 border border-zinc-100 px-5 py-4 rounded-md">
                        <legend class="text-zinc-700 text-sm font-bold bg-zinc-100 px-3 py-1 rounded">
                            Resultados
                        </legend>

                        <div wire:loading class="pt-6 w-full">
                            <p class="animate-pulse font-bold text-zinc-800 block">
                                Cargando datos...
                            </p>
                        </div>

                        <div wire:loading.remove class="space-y-1">
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
                                <p class="block mt-1 text-gray-600 text-sm flex items-center py-0.5">
                                    <x-icons.quality class="icon-5 mr-1" stroke="1.5"/>
                                    Estos valores son calculados automaticamente, no pueden editarse manualmente.
                                </p>
                            @else
                                <p class="font-bold text-zinc-800 block">No se encontraron resultados.</p>
                                <p class="text-zinc-700 text-sm">
                                    Esto puede deberse a que no hay datos registrados entre las fechas
                                    de <b>{{ $inicio->format('d, M Y') }}</b> al <b>{{ $fin->format('d, M Y') }}</b>
                                </p>
                            @endif
                        </div>
                    </fieldset>
                </div>

                {{-- Analisis y Observaciones --}}
                <div class="">
                    <fieldset class="bg-zinc-50/50 border border-zinc-100 px-5 py-4 rounded-md">
                        <legend class="text-zinc-700 text-sm font-bold bg-zinc-100 px-3 py-1 rounded">
                            Análisis y Observaciones
                        </legend>

                        <details class="w-full mb-3">
                            <summary class="flex items-center space-x-1">
                                <span
                                    class="block font-medium text-sm text-gray-600 hover:text-gray-800 cursor-pointer soft-transition">
                                    ► Análisis/Interpretación de los resultados
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
                    </fieldset>
                </div>

                {{-- Personal encargado --}}
                <div class="">
                    <fieldset class="bg-zinc-50/50 border border-zinc-100 px-5 py-4 rounded-md space-y-3">
                        <legend class="text-zinc-700 text-sm font-bold bg-zinc-100 px-3 py-1 rounded">
                            Autores de la medición
                        </legend>

                        <div class="grid grid-cols-3 gap-x-6">
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
                    </fieldset>
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
                Guardar medición
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

