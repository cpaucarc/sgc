<div>
    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
            <div class="flex justify-end w-full">
                <x-utils.buttons.close-button wire:click="$set('open', false)"/>
            </div>
        </x-slot>

        <x-slot name="content">

            <div class="space-y-4 divide-y divide-dashed divide-gray-200">

                <div class="flex justify-between items-center">
                    <p class="font-light text-sm text-gray-600">
                        @if(count($selected))
                            {{ count($selected) }} {{ count($selected) == 1 ? 'salida seleccionado' : 'salidas seleccionados' }}
                        @else
                            No haz seleccionado ninguna salida
                        @endif
                    </p>

                    <x-utils.forms.select class="" id="responsable" wire:model="entidad">
                        <option value="0">Seleccione una entidad</option>
                        @foreach($entidades as $entd)
                            <option value="{{ $entd->id }}">{{ $entd->nombre }}</option>
                        @endforeach
                    </x-utils.forms.select>
                </div>

                @if($procesos and count($procesos) > 0)
                    <div class="pt-4">
                        <x-jet-label for="proceso" value="Proceso"/>
                        <x-utils.forms.select class="w-full" id="proceso" wire:model="proceso">
                            <option value="0">Seleccione...</option>
                            @foreach($procesos as $proc)
                                <option value="{{ $proc->id }}">{{ $proc->nombre }}</option>
                            @endforeach
                        </x-utils.forms.select>
                        <x-jet-input-error for="proceso"/>
                    </div>

                    @if($actividades and count($actividades) > 0)
                        <div class="pt-4">
                            <div>
                                <x-jet-label for="actividad" value="Actividad"/>
                                <x-utils.forms.select class="w-full" id="actividad" wire:model="actividad">
                                    <option value="0">Seleccione...</option>
                                    @foreach($actividades as $actv)
                                        <option value="{{ $actv->id }}">{{ $actv->actividad->nombre }}</option>
                                    @endforeach
                                </x-utils.forms.select>
                                <x-jet-input-error for="actividad"/>
                            </div>
                        </div>

                        <div class="pt-4">
                            @if( !is_null($salidas) and count($salidas) > 0)
                                <x-utils.tables.table>
                                    @slot('head')
                                        <x-utils.tables.head><span class="sr-only">Seleccionar</span>
                                        </x-utils.tables.head>
                                        <x-utils.tables.head>Código</x-utils.tables.head>
                                        <x-utils.tables.head>Salida</x-utils.tables.head>
                                    @endslot
                                    @slot('body')
                                        @foreach($salidas as $salida)
                                            <x-utils.tables.row>
                                                <x-utils.tables.body>
                                                    <x-utils.forms.checkbox wire:model="selected"
                                                                            wire:loading.attr="disabled"
                                                                            value="{{ $salida->id }}"/>
                                                </x-utils.tables.body>
                                                <x-utils.tables.body
                                                    class="text-xs">{{ $salida->codigo }}</x-utils.tables.body>
                                                <x-utils.tables.body
                                                    class="text-xs">{{ $salida->nombre }}</x-utils.tables.body>
                                            </x-utils.tables.row>
                                        @endforeach
                                    @endslot
                                </x-utils.tables.table>
                                <x-jet-input-error for="selected"/>
                            @else
                                <x-utils.message-no-items
                                    title="No hay salidas disponibles"
                                    text="Al parecer ya asignó todas las salidas disponibles.">
                                    @slot('icon')
                                        <svg class="text-gray-400" fill="currentColor" viewBox="0 0 24 24" width="24"
                                             height="24">
                                            <path
                                                d="M3.5 3.75a.25.25 0 01.25-.25h13.5a.25.25 0 01.25.25v10a.75.75 0 001.5 0v-10A1.75 1.75 0 0017.25 2H3.75A1.75 1.75 0 002 3.75v16.5c0 .966.784 1.75 1.75 1.75h7a.75.75 0 000-1.5h-7a.25.25 0 01-.25-.25V3.75z"></path>
                                            <path
                                                d="M6.25 7a.75.75 0 000 1.5h8.5a.75.75 0 000-1.5h-8.5zm-.75 4.75a.75.75 0 01.75-.75h4.5a.75.75 0 010 1.5h-4.5a.75.75 0 01-.75-.75zm16.28 4.53a.75.75 0 10-1.06-1.06l-4.97 4.97-1.97-1.97a.75.75 0 10-1.06 1.06l2.5 2.5a.75.75 0 001.06 0l5.5-5.5z"></path>
                                        </svg>
                                    @endslot
                                </x-utils.message-no-items>
                            @endif
                        </div>

                    @else
                        <x-utils.message-no-items
                            title="No tiene actividades"
                            text="La entidad seleccionada no tiene ninguna actividad del cual es responsable.">
                            @slot('icon')
                                <svg class="text-gray-400" fill="currentColor" viewBox="0 0 24 24" width="24"
                                     height="24">
                                    <path fill-rule="evenodd"
                                          d="M12.876.64a1.75 1.75 0 00-1.75 0l-8.25 4.762a1.75 1.75 0 00-.875 1.515v9.525c0 .625.334 1.203.875 1.515l8.25 4.763a1.75 1.75 0 001.75 0l8.25-4.762a1.75 1.75 0 00.875-1.516V6.917a1.75 1.75 0 00-.875-1.515L12.876.639zm-1 1.298a.25.25 0 01.25 0l7.625 4.402-7.75 4.474-7.75-4.474 7.625-4.402zM3.501 7.64v8.803c0 .09.048.172.125.216l7.625 4.402v-8.947L3.501 7.64zm9.25 13.421l7.625-4.402a.25.25 0 00.125-.216V7.639l-7.75 4.474v8.947z"></path>
                                </svg>
                            @endslot
                        </x-utils.message-no-items>
                    @endif

                @else
                    <x-utils.message-no-items
                        title="No es responsable de actividades"
                        text="La entidad seleccionada no tiene ninguna actividad del cual es responsable.">
                        @slot('icon')
                            <svg class="text-gray-400" fill="currentColor" viewBox="0 0 24 24" width="24"
                                 height="24">
                                <path fill-rule="evenodd"
                                      d="M12.876.64a1.75 1.75 0 00-1.75 0l-8.25 4.762a1.75 1.75 0 00-.875 1.515v9.525c0 .625.334 1.203.875 1.515l8.25 4.763a1.75 1.75 0 001.75 0l8.25-4.762a1.75 1.75 0 00.875-1.516V6.917a1.75 1.75 0 00-.875-1.515L12.876.639zm-1 1.298a.25.25 0 01.25 0l7.625 4.402-7.75 4.474-7.75-4.474 7.625-4.402zM3.501 7.64v8.803c0 .09.048.172.125.216l7.625 4.402v-8.947L3.501 7.64zm9.25 13.421l7.625-4.402a.25.25 0 00.125-.216V7.639l-7.75 4.474v8.947z"></path>
                            </svg>
                        @endslot
                    </x-utils.message-no-items>
                @endif
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-button
                wire:click="asignarSalidas"
                wire:target="asignarSalidas"
                wire:loading.class="cursor-wait"
                wire:loading.attr="disabled">
                <x-icons.load wire:loading wire:target="asignarSalidas" class="icon-5"/>
                Guardar
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
