<div class="space-y-6 text-zinc-700">

    @if(is_null($auditoria_interna))

        <div class="sticky top-0 flex justify-end text-sm gap-x-2 items-center py-3 bg-zinc-50">
            <p class="bg-zinc-100 border text-zinc-800 rounded px-3 py-1">
                <b>Validados:</b> {{ count($salidasValidados) === 0 ? 'Ninguna salida a sido validada.' : count($salidasValidados) . ' salidas.' }}
            </p>

            <p class="bg-zinc-100 border text-zinc-800 rounded px-3 py-1">
                <b>Total:</b> {{ $cantSalidas }} salidas.
            </p>
        </div>

        @if(count($responsables_internos))
            <table class="w-full text-sm bg-white">
                <thead class="sticky top-[53px] border border-zinc-300 ">
                <tr class="text-zinc-600 bg-zinc-100">
                    <th class="border border-zinc-300 px-2 py-0.5 text-left">Responsable</th>
                    <th class="border border-zinc-300 px-2 py-0.5 text-left">Proceso</th>
                    <th class="border border-zinc-300 px-2 py-0.5 text-left">Actividad</th>
                    <th class="border border-zinc-300 px-2 py-0.5 text-left">Avance</th>
                    <th class="border border-zinc-300 px-2 py-0.5 text-left">Salida</th>
                    <th class="border border-zinc-300 px-2 py-0.5 text-left">Estado</th>
                    <th class="border border-zinc-300 px-2 py-0.5 text-left"><span class="sr-only">Acciones</span></th>
                </tr>
                </thead>
                <tbody class="text-zinc-700">
                @foreach($responsables_internos as $i => $entidad)
                    <tr class="">
                        <td class="border border-zinc-300 px-2 py-0.5" rowspan="{{ $entidad['salidas_count'] + 1 }}">
                            {{ $entidad['entidad'] }}
                        </td>
                    </tr>

                    @foreach($entidad['procesos'] as $proceso)
                        <tr class="">
                            <td class="border border-zinc-300 px-2 py-0.5"
                                rowspan="{{ $proceso['salidas_count'] + 1 }}">
                                {{ $proceso['proceso'] }}
                            </td>
                        </tr>

                        @foreach($proceso['actividades'] as $actividad)
                            <tr class="">
                                <td class="border border-zinc-300 px-2 py-0.5"
                                    rowspan="{{ $actividad['salidas_count'] + 1 }}">
                                    {{ $actividad['actividad'] }}
                                </td>
                                <td class="border border-zinc-300 px-2 py-0.5 whitespace-nowrap"
                                    rowspan="{{ $actividad['salidas_count'] + 1 }}">
                                    completado {{ $actividad['salidas_completados_count'] }}
                                    de {{ $actividad['salidas_count'] }}
                                </td>
                            </tr>

                            @foreach($actividad['salidas'] as $salida)
                                <tr class="">
                                    <td class="border border-zinc-300 px-2 py-0.5"><b>{{ $salida['salida'] }}</b></td>
                                    <td class="border border-zinc-300 px-2 py-0.5">
                                        @if( $salida['documentos_count'] > 0)
                                            <button
                                                wire:click="verDocumentos('{{ $entidad['entidad'] }}', {{ $salida['responsable_salida_id'] }})"
                                                class="inline-flex font-semibold text-xs px-1.5 py-0.5 rounded soft-transition bg-green-200 text-green-700 hover:underline">
                                                Completado
                                            </button>
                                        @else
                                            <p class="whitespace-nowrap inline-flex font-semibold text-xs px-1.5 py-0.5 rounded bg-rose-100 text-rose-600">
                                                Sin completar
                                            </p>
                                        @endif
                                    </td>
                                    <td class="border border-zinc-300 px-2 py-0.5">
                                        @if(array_key_exists('RS-'.$salida['responsable_salida_id'], $salidasValidados))
                                            <div class="flex">
                                                <button
                                                    class="soft-transition px-2 py-1 text-rose-600 rounded hover:bg-rose-100 font-semibold text-xs"
                                                    wire:click="quitarSalida({{ $salida['responsable_salida_id'] }})">
                                                    Quitar
                                                </button>
                                                @if(!is_null($salidasValidados[ 'RS-'.$salida['responsable_salida_id'] ]))
                                                    <button class="soft-transition px-2 py-1 rounded hover:bg-zinc-100"
                                                            title="Observaci??n"
                                                            onclick="verObservacion('{{ $salidasValidados[ 'RS-'.$salida['responsable_salida_id'] ] }}')">
                                                        <svg class="icon-4" fill="none" viewBox="0 0 24 24"
                                                             stroke="currentColor" stroke-width="1.75">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                  d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                                                        </svg>
                                                    </button>
                                                @endif
                                            </div>
                                        @else
                                            <button
                                                class="soft-transition px-2 py-1 rounded hover:bg-zinc-100 hover:text-zinc-800 font-semibold text-xs"
                                                onclick="validarSalida('{{ $salida['salida'] }}', {{ $salida['responsable_salida_id'] }})">
                                                Validar
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    @endforeach
                @endforeach
                </tbody>
            </table>
        @endif

        <div class="bg-white p-4 rounded-md border">
            <div class="space-y-4">
                <div class="col-span-2">
                    <x-jet-label for="obs_general" value="Observaci??n"/>
                    <x-utils.forms.textarea class="w-full" id="obs_general" wire:model.defer="obs_general"
                                            placeholder="Ninguna observaci??n..."/>
                    <x-jet-input-error for="obs_general"/>
                </div>

                <div class="grid grid-cols-3 gap-x-4 items-start">
                    <div>
                        <x-jet-label for="dni" value="DNI del Responsable de la Auditoria"/>
                        <x-jet-input class="w-full" type="text" id="dni" wire:model.defer="dni"/>
                        <x-jet-input-error for="dni"/>
                    </div>
                    <div>
                        <x-jet-label for="auditor" value="Nombre del Responsable de la Auditoria"/>
                        <x-jet-input class="w-full" type="text" id="auditor" wire:model.defer="auditor"/>
                        <x-jet-input-error for="auditor"/>
                    </div>
                    <div class="flex justify-end gap-x-2 mt-6">

                        {{--                <x-utils.links.primary target="_blank" href="{{ route('auditoria.internapdf', [--}}
                        {{--                            'data' => 'abc',--}}
                        {{--                            'validado' => count($salidasValidados) > 0 ? serialize($salidasValidados) : '0',--}}
                        {{--                            'dni' => strlen($dni) > 0 ? $dni : '0',--}}
                        {{--                            'auditor' => strlen($auditor) > 0 ? $auditor : '0',--}}
                        {{--                            'observacion' => strlen($obs_general) > 0 ? $obs_general : '0'--}}
                        {{--                           ]) }}">--}}
                        {{--                    Ver PDF--}}
                        {{--                </x-utils.links.primary>--}}


                        <x-jet-button wire:click="guardarAuditoria" wire:target="guardarAuditoria"
                                      wire:loading.class="cursor-wait" wire:loading.attr="disabled">
                            <x-icons.load wire:loading wire:target="guardarAuditoria" class="icon-5"/>
                            {{ __('Guardar informaci??n') }}
                        </x-jet-button>
                    </div>
                </div>
            </div>
        </div>

    @else
        <x-utils.card>
            <h1 class="font-bold text-xl">Ya existe una auditoria interna</h1>
            <p class="text-sm mb-4 text-zinc-500">
                Se ha encontrado que ya se realiz?? una auditoria interna para esta esta facultad para este semestre.
            </p>
            <div class="my-4">
                <ul class="list-disc text-zinc-700 ml-4 list-inside">
                    <li>DNI del auditor: <b>{{ $auditoria_interna->auditor_dni }}</b></li>
                    <li>Nombre del auditor: <b>{{ $auditoria_interna->auditor_nombre }}</b></li>
                    <li>Observaciones: <b>{{ $auditoria_interna->observacion ?? 'Ninguno' }}</b></li>
                    <li>Fecha de auditor??a: <b>{{ $auditoria_interna->created_at->format('d-m-Y') }}</b></li>
                </ul>
            </div>
            <a href="{{ route('auditoria.create') }}"
               class="px-3 py-1 font-semibold text-sky-600 hover:text-sky-700 hover:underline soft-transition">
                Volver
            </a>
        </x-utils.card>
    @endif

    @if($resp_salida_selected)
        <x-jet-dialog-modal wire:model="mostrarModal" maxWidth="4xl">
            <x-slot name="title">
                <div class="flex items-center gap-x-2">
                    <div
                        class="w-10 h-10 rounded-full font-semibold text-sm grid place-items-center text-sky-800 bg-sky-100">
                        {{ $resp_salida_selected->salida->codigo }}
                    </div>
                    <div>
                        <h1 class="font-bold text-zinc-700">
                            {{ $resp_salida_selected->salida->nombre }}
                        </h1>
                        <p class="text-sm text-zinc-500">
                            Responsable: <b>{{ $res_selected }}</b>
                        </p>
                    </div>
                </div>
                <x-utils.buttons.close-button wire:click="$set('mostrarModal', false)"/>
            </x-slot>

            <x-slot name="content">
                <div class="space-y-8">
                    <x-utils.tables.table>
                        @slot('head')
                            <x-utils.tables.head>Nombre del documento</x-utils.tables.head>
                            <x-utils.tables.head>Enviado por</x-utils.tables.head>
                            <x-utils.tables.head class="text-right">Fecha de env??o</x-utils.tables.head>
                            <x-utils.tables.head><span class="sr-only">Acciones</span></x-utils.tables.head>
                        @endslot
                        @slot('body')
                            @foreach($resp_salida_selected->documentos as $doc)
                                <x-utils.tables.row class="p-1">
                                    <x-utils.tables.body class="text-left">
                                        {{ $doc->documento->nombre }}
                                    </x-utils.tables.body>
                                    <x-utils.tables.body>
                                        {{ $doc->documento->entidad->nombre }}
                                    </x-utils.tables.body>
                                    <x-utils.tables.body class="text-right whitespace-nowrap">
                                        {{ $doc->documento->created_at->diffForHumans() }}
                                    </x-utils.tables.body>
                                    <x-utils.tables.body class="text-right">
                                        <div
                                            class="flex items-center justify-end w-full gap-2 whitespace-nowrap">
                                            <x-utils.links.default class="group" target="_blank"
                                                                   href="{{ route('archivos', $doc->documento->enlace_interno) }}">
                                                <x-icons.documents class="h-4 w-4" stroke="1.5"/>
                                                Ver
                                            </x-utils.links.default>
                                        </div>
                                    </x-utils.tables.body>
                                </x-utils.tables.row>
                            @endforeach
                        @endslot
                    </x-utils.tables.table>
                </div>
            </x-slot>
        </x-jet-dialog-modal>
    @endif

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
                    text: msg,
                });
            });

            function validarSalida(salida, responsable_salida_id) {
                Swal.fire({
                    html: `??Validar la salida <b>"${salida}"?</b>`,
                    input: 'textarea',
                    inputAttributes: {
                        autocapitalize: 'off',
                        placeholder: 'Ninguna observaci??n...'
                    },
                    customClass: {
                        input: 'text-sm'
                    },
                    showCancelButton: true,
                    cancelButtonText: 'Cancelar',
                    confirmButtonText: 'Validar salida',
                    confirmButtonColor: '#0ea5e9',
                    showLoaderOnConfirm: true,
                    preConfirm: (observacion) => {
                        observacion = observacion.replaceAll('\\', ' ').replaceAll('\n', ' ').replaceAll('\'', '').replaceAll('undefined', ' ');
                        observacion = observacion.replaceAll('<', ' ').replaceAll('>', ' ').replaceAll('/', ' ').replaceAll('script', ' ');
                        window.livewire.emit('validarSalida', responsable_salida_id, observacion);
                    }
                })
            }

            function verObservacion(observacion) {
                Swal.fire({
                    html: `<b>Observaci??n:</b><br>${observacion}`,
                    showCancelButton: true,
                    cancelButtonText: 'Cerrar',
                    showConfirmButton: false
                })
            }
        </script>
    @endpush

</div>
