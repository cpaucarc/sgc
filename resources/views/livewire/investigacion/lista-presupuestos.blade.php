<div>

    <div class="flex justify-between items-center mb-2">
        <h2 class="text-zinc-500 text-base font-bold leading-tight">Financiación</h2>

        @if(count($investigacion->financiaciones) > 0)
            <x-utils.buttons.default class="text-sm" wire:click="openModal">
                Nueva fuente
            </x-utils.buttons.default>
        @endif
    </div>

    @if(count($investigacion->financiaciones) > 0)
        <x-utils.tables.table>
            @slot('head')
                <x-utils.tables.head>Financiador</x-utils.tables.head>
                <x-utils.tables.head>Monto</x-utils.tables.head>
                <x-utils.tables.head>Creación</x-utils.tables.head>
            @endslot
            @slot('body')
                @foreach($investigacion->financiaciones as $financiador)
                    <x-utils.tables.row>
                        <x-utils.tables.body>
                            <div class="flex items-center gap-x-1">
                                {{$financiador->nombre}}
                                <x-utils.new-item date="{{$financiador->pivot->created_at}}"/>
                            </div>
                        </x-utils.tables.body>
                        <x-utils.tables.body class="whitespace-nowrap">
                            {{'S/. '. number_format((float)$financiador->pivot->presupuesto, 2) }}
                        </x-utils.tables.body>
                        <x-utils.tables.body>
                            {{$financiador->pivot->created_at->format('d-m-Y h:ia')}}
                        </x-utils.tables.body>
                        <x-utils.tables.body>
                            @if($es_responsable )
                                <x-utils.buttons.danger class="text-sm"
                                                        onclick="eliminarFinanciacion({{ $financiador->id  }},'{{$financiador->nombre}}',{{$investigacion->id}})">
                                    <x-icons.delete class="h-5 w-5" stroke="1.55"/>
                                </x-utils.buttons.danger>
                            @else
                                <span></span>
                            @endif
                        </x-utils.tables.body>
                    </x-utils.tables.row>
                @endforeach
            @endslot
            @slot('foot')
                <x-utils.tables.foot>Total</x-utils.tables.foot>
                <x-utils.tables.foot class="whitespace-nowrap">
                    {{'S/. '. number_format((float)$investigacion->financiaciones->sum('pivot.presupuesto'), 2) }}
                </x-utils.tables.foot>
                <x-utils.tables.foot><span class="sr-only">.</span></x-utils.tables.foot>
            @endslot
        </x-utils.tables.table>
    @else
        <div class="border border-zinc-300 rounded-md">
            <x-utils.message-no-items
                title="Sin fuentes de financiación"
                text="En esta sección podrá especificar las fuentes de financiación que posee este Proyecto.">
                @slot('icon')
                    <svg class="h-6 w-6 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                @endslot

                <x-jet-button class="text-sm" wire:click="openModal">
                    Registrar fuentes
                </x-jet-button>
            </x-utils.message-no-items>
        </div>
    @endif

    <x-jet-dialog-modal wire:model="open">

        <x-slot name="title">
            <div>
                <h1 class="font-bold text-zinc-700">
                    Añadir nueva fuente de financiación
                </h1>
            </div>
            <x-utils.buttons.close-button wire:click="$set('open', false)"/>
        </x-slot>

        <x-slot name="content">
            @if(count($financiadores) > 0)
                <div class="space-y-4">
                    <div>
                        <x-jet-label for="financiador" value="Tipo de financiación"/>
                        <x-utils.forms.select id="financiador" wire:model="financiador_seleccionado" class="w-full">
                            <option value="0">Seleccione...</option>
                            @foreach($financiadores as $financiador)
                                <option value="{{$financiador->id}}">{{ $financiador->nombre }}</option>
                            @endforeach
                        </x-utils.forms.select>
                        <x-jet-input-error for="financiador_seleccionado"/>
                    </div>
                    <div>
                        <x-jet-label for="monto" value="Monto en soles (S/.)"/>
                        <x-jet-input id="monto" min="0" wire:model="monto" class="w-full" type="number"
                                     placeholder="Ej. 100.25"/>
                        <x-jet-input-error for="monto"/>
                    </div>
                </div>
            @endif
        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open', false)">
                Cerrar
            </x-jet-secondary-button>

            <x-jet-button
                wire:click="guardarPresupuesto"
                wire:target="guardarPresupuesto"
                wire:loading.class="cursor-wait"
                wire:loading.attr="disabled">
                <x-icons.load class="icon-5" wire:loading wire:target="guardarPresupuesto"/>
                {{ __('Guardar') }}
            </x-jet-button>
        </x-slot>

    </x-jet-dialog-modal>

    @push('js')
        <script>
            function eliminarFinanciacion($financiador_id, nombre, $investigacion_id) {
                Swal.fire({
                    text: "¿Desea eliminar la fuente de financiación de " + nombre + " de esta investigación?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Si, eliminar',
                    cancelButtonText: `Cancelar`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.livewire.emit('eliminarFinanciacion', $financiador_id, $investigacion_id);
                    }
                })
            }
        </script>
    @endpush
</div>
