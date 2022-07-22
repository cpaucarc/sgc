<div>
    <section class="flex items-center justify-between mb-4">
        @if(count($indicadorable->analisis) !== 0)
            <p class="ml-1 text-gray-600 font-semibold text-sm">
                Hay&nbsp;<strong>{{ count($indicadorable->analisis) }}</strong>&nbsp;análisis de este
                indicador
            </p>
        @else
            <p class="ml-1 text-gray-600 font-semibold text-sm">
                No se encontró ningún análisis que mostrar
            </p>
        @endif

        <div class="flex items-center gap-x-2">

            @if(!is_null($cursos))
                <x-utils.forms.select wire:model="curso_seleccionado">
                    <option value="0">Todos los cursos</option>
                    @foreach($cursos as $cur)
                        <option value="{{ $cur->id }}">{{ $cur->nombre }}</option>
                    @endforeach
                </x-utils.forms.select>
            @endif

            @if(!is_null($capacitaciones))
                <x-utils.forms.select wire:model="capacitacion_seleccionado">
                    <option value="0">Todas las capacitaciones</option>
                    @foreach($capacitaciones as $cap)
                        <option value="{{ $cap->id }}">{{ substr($cap->nombre, 0, 50) . '...' }}</option>
                    @endforeach
                </x-utils.forms.select>
            @endif

            @if(!is_null($servicios))
                <x-utils.forms.select wire:model="servicio_seleccionado">
                    <option value="0">Todos los servicios</option>
                    @foreach($servicios as $sv)
                        <option value="{{ $sv->id }}">{{ $sv->nombre }}</option>
                    @endforeach
                </x-utils.forms.select>
            @endif

            <x-utils.forms.select wire:model="semestre_seleccionado">
                <option value="0">Todos</option>
                @foreach($semestres as $sem)
                    <option value="{{ $sem->id }}">{{ $sem->nombre }}</option>
                @endforeach
            </x-utils.forms.select>
            @if(count($indicadorable->analisis) !== 0)
                <x-jet-button wire:click="openModal" class="print:hidden">
                    <x-icons.plus class="flex-shrink-0 h-5 w-5 mr-1" stroke="1.5"/>
                    Nuevo
                </x-jet-button>
            @endif
        </div>
    </section>

    @if(count($indicadorable->analisis) === 0)
        <x-indicador.mensaje-no-analisis>
            <x-jet-button wire:click="openModal">
                Crear el primer análisis
            </x-jet-button>
        </x-indicador.mensaje-no-analisis>
    @else
        <x-utils.tables.table>
            @slot('head')
                <x-utils.tables.head>Semestre</x-utils.tables.head>
                <x-utils.tables.head>Periodo</x-utils.tables.head>
                @if($tieneCursos)
                    <x-utils.tables.head>Curso</x-utils.tables.head>
                @endif
                @if($tieneCapacitaciones)
                    <x-utils.tables.head>Capacitación</x-utils.tables.head>
                @endif
                @if($tieneServicios)
                    <x-utils.tables.head>Servicio</x-utils.tables.head>
                @endif
                @if($indicadorable->indicador->titulo_interes)
                    <x-utils.tables.head>{{ $indicadorable->indicador->titulo_interes }}</x-utils.tables.head>
                @endif
                @if($indicadorable->indicador->titulo_total)
                    <x-utils.tables.head>{{ $indicadorable->indicador->titulo_total }}</x-utils.tables.head>
                @endif
                <x-utils.tables.head>
                    {{ $indicadorable->indicador->titulo_total
                            ? 'Resultado'
                            : $indicadorable->indicador->titulo_resultado
                    }}
                </x-utils.tables.head>
                <x-utils.tables.head>Mínimo</x-utils.tables.head>
                <x-utils.tables.head>Satisfactorio</x-utils.tables.head>
                <x-utils.tables.head>Sobresaliente</x-utils.tables.head>
                <x-utils.tables.head>Creación</x-utils.tables.head>
                <x-utils.tables.head class="print:hidden">
                    <span class=" sr-only">Acciones</span>
                </x-utils.tables.head>
            @endslot
            @slot('body')
                @foreach($indicadorable->analisis as $analisis)
                    <x-utils.tables.row>
                        <x-utils.tables.body class="whitespace-nowrap">
                            {{ $analisis->semestre->nombre }}
                        </x-utils.tables.body>
                        <x-utils.tables.body class="whitespace-nowrap text-xs">
                            <div>
                                Inicio: <b>{{ $analisis->fecha_medicion_inicio->format('d-m-Y') }}</b>
                                <br>
                                Fin: <b>{{ $analisis->fecha_medicion_fin->format('d-m-Y') }}</b>
                            </div>
                        </x-utils.tables.body>
                        @if($tieneCursos)
                            <x-utils.tables.body>
                                {{ count($analisis->curso) ? $analisis->curso->first()->nombre : '-' }}
                            </x-utils.tables.body>
                        @endif
                        @if($tieneCapacitaciones)
                            <x-utils.tables.body>
                                {{ count($analisis->capacitacion) ? substr($analisis->capacitacion->first()->nombre, 0, 40) . '...' : '-' }}
                            </x-utils.tables.body>
                        @endif
                        @if($tieneServicios)
                            <x-utils.tables.body>
                                {{ count($analisis->servicio) ?$analisis->servicio->first()->nombre : '-' }}
                            </x-utils.tables.body>
                        @endif
                        @if($indicadorable->indicador->titulo_interes)
                            <x-utils.tables.body>
                                {{ $analisis->interes }}
                            </x-utils.tables.body>
                        @endif
                        @if($indicadorable->indicador->titulo_total)
                            <x-utils.tables.body>
                                {{ $analisis->total }}
                            </x-utils.tables.body>
                        @endif
                        <x-utils.tables.body class="font-bold">
                            {{ $analisis->resultado }}{{ $analisis->interes ? '%':'' }}
                        </x-utils.tables.body>
                        <x-utils.tables.body>
                            {{ floatval($analisis->minimo) }}
                        </x-utils.tables.body>
                        <x-utils.tables.body>
                            {{ floatval($analisis->satisfactorio) }}
                        </x-utils.tables.body>
                        <x-utils.tables.body>
                            {{ floatval($analisis->sobresaliente) }}
                        </x-utils.tables.body>
                        <x-utils.tables.body class="whitespace-nowrap text-xs">
                            @if(today()->diffInDays($analisis->created_at) <= 7)
                                {{ $analisis->created_at->diffForHumans() }}
                            @else
                                {{ $analisis->created_at->format('d/m/Y') }}
                            @endif
                        </x-utils.tables.body>
                        <x-utils.tables.body class="print:hidden">
                            <div class="flex items-center space-x-0">
                                <x-utils.buttons.invisible title="Ver información"
                                                           wire:click="openEditModal({{$analisis->id}}, false)">
                                    <x-icons.info class="icon-4" stroke="1.5"></x-icons.info>
                                </x-utils.buttons.invisible>
                                <x-utils.buttons.invisible title="Editar"
                                                           wire:click="openEditModal({{$analisis->id}}, true)">
                                    <x-icons.edit class="icon-4" stroke="1.5"></x-icons.edit>
                                </x-utils.buttons.invisible>
                            </div>
                        </x-utils.tables.body>
                    </x-utils.tables.row>
                @endforeach
            @endslot
        </x-utils.tables.table>

        <div class="mt-4 flex justify-end">

            @if(!$tieneCursos && !$tieneCapacitaciones && !$tieneServicios)
                <x-utils.buttons.default wire:click="openGraph" class="group text-sm print:hidden">
                    <svg class="icon-5 mr-1 group-hover:text-gray-600" viewBox="0 0 20 20" fill="currentColor">
                        <path
                            d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"/>
                    </svg>
                    Mostrar gráfico
                </x-utils.buttons.default>
            @else
                @if($curso_seleccionado > 0 || $capacitacion_seleccionado > 0 || $servicio_seleccionado > 0)
                    <x-utils.buttons.default wire:click="openGraph" class="group text-sm print:hidden">
                        <svg class="icon-5 mr-1 group-hover:text-gray-600" viewBox="0 0 20 20" fill="currentColor">
                            <path
                                d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"/>
                        </svg>
                        Mostrar gráfico
                    </x-utils.buttons.default>
                @else
                    <p class="text-sm text-gray-700">
                        Para ver el grafico,
                        seleccione {{ $tieneCursos ? 'un curso' : ($tieneCapacitaciones ? 'una capacitacion': 'un servicio') }}
                        en
                        específico
                    </p>
                @endif
            @endif

        </div>

        <livewire:indicador.grafico-general indicadorable_id="{{ $indicadorable->id }}"/>
    @endif

    <livewire:indicador.nuevo-analisis indicadorable_id="{{ $indicadorable->id }}" oficina="{{ $oficina }}"
                                       tipo="{{ $tipo }}" uuid="{{$uuid}}"/>

    @if($analisis_seleccionado)
        <x-jet-dialog-modal wire:model="openEdit" maxWidth="3xl">

            <x-slot name="title">
                <h1 class="font-bold text-gray-900">
                    {{ $modoEdit ? 'Editar el analisis del indicador ' . $analisis_seleccionado->cod_ind_final :
                                'Información del analisis ' . $analisis_seleccionado->cod_ind_final
                    }}
                </h1>
                <x-utils.buttons.close-button wire:click="closeEditModal"/>
            </x-slot>

            <x-slot name="content">
                <div class="space-y-4">
                    <div>
                        <x-jet-label for="interpretacion" value="Interpretación"/>
                        <x-utils.forms.textarea disabled="{{ !$modoEdit }}" id="interpretacion" class="w-full"
                                                wire:model.defer="interpretacion"
                                                placeholder="Ninguno"/>
                    </div>
                    <div>
                        <x-jet-label for="observacion" value="Observación"/>
                        <x-utils.forms.textarea disabled="{{ !$modoEdit }}" id="observacion" class="w-full"
                                                wire:model.defer="observacion"
                                                placeholder="Ninguno"/>
                    </div>
                    <div class="grid grid-cols-3 space-x-4">
                        <div>
                            <x-jet-label for="elaborado_por" value="Elaborado por:"/>
                            <x-jet-input disabled="{{ !$modoEdit }}" type="text" id="elaborado_por" class="w-full"
                                         wire:model.defer="elaborado_por" placeholder="No se especificó"/>
                        </div>
                        <div>
                            <x-jet-label for="revisado_por" value="Revisado por:"/>
                            <x-jet-input disabled="{{ !$modoEdit }}" type="text" id="revisado_por" class="w-full"
                                         wire:model.defer="revisado_por"
                                         placeholder="No se especificó"/>
                        </div>
                        <div>
                            <x-jet-label for="aprobado_por" value="Aprobado por:"/>
                            <x-jet-input disabled="{{ !$modoEdit }}" type="text" id="aprobado_por" class="w-full"
                                         wire:model.defer="aprobado_por"
                                         placeholder="No se especificó"/>
                        </div>
                    </div>
                </div>
            </x-slot>

            @if($modoEdit)
                <x-slot name="footer">
                    <x-jet-button
                        wire:click="editarInfo"
                        wire:target="editarInfo"
                        wire:loading.class="cursor-wait"
                        wire:loading.attr="disabled">
                        <x-icons.load class="icon-5" wire:loading wire:target="editarInfo"/>
                        {{ __('Guardar Información') }}
                    </x-jet-button>
                </x-slot>
            @endif

        </x-jet-dialog-modal>
    @endif

</div>
