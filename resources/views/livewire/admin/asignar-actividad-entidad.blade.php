<div>
    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
            <div class="flex justify-end w-full">
                <x-utils.buttons.close-button wire:click="$set('open', false)"/>
            </div>
        </x-slot>

        <x-slot name="content">

            <div class="space-y-4">

                <div class="flex justify-between items-center">
                    <p class="font-light text-sm text-gray-600">
                        @if(count($selected))
                            {{ count($selected) }} {{ count($selected) == 1 ? 'actividad seleccionado' : 'actividades seleccionados' }}
                        @else
                            No haz seleccionado ninguna actividad
                        @endif
                    </p>
                    <x-utils.forms.select wire:model="proceso">
                        <option value="0">Todos</option>
                        @foreach($procesos as $proc)
                            <option value="{{ $proc->id }}">{{ $proc->nombre }}</option>
                        @endforeach
                    </x-utils.forms.select>
                </div>

                @if(count($actividades) > 0)
                    <x-utils.tables.table>
                        @slot('head')
                            <x-utils.tables.head><span class="sr-only">Seleccionar</span></x-utils.tables.head>
                            <x-utils.tables.head>Actividad</x-utils.tables.head>
                            <x-utils.tables.head>Proceso</x-utils.tables.head>
                        @endslot
                        @slot('body')
                            @foreach($actividades as $actividad)
                                <x-utils.tables.row>
                                    <x-utils.tables.body>
                                        <x-utils.forms.checkbox wire:model="selected" wire:loading.attr="disabled"
                                                                value="{{ $actividad->id }}"/>
                                    </x-utils.tables.body>
                                    <x-utils.tables.body class="text-xs">{{ $actividad->nombre }}</x-utils.tables.body>
                                    <x-utils.tables.body
                                        class="text-xs">{{ $actividad->proceso->nombre }}</x-utils.tables.body>
                                </x-utils.tables.row>
                            @endforeach
                        @endslot
                    </x-utils.tables.table>
                    <x-jet-input-error for="selected"/>
                @else
                    <x-utils.message-no-items
                        title="No hay actividades disponibles"
                        text="Al parecer ya asignó todas las actividades registradas en los procesos.">
                        @slot('icon')
                            <svg class="text-gray-400" fill="currentColor" viewBox="0 0 24 24" width="24" height="24">
                                <path
                                    d="M3.5 3.75a.25.25 0 01.25-.25h13.5a.25.25 0 01.25.25v10a.75.75 0 001.5 0v-10A1.75 1.75 0 0017.25 2H3.75A1.75 1.75 0 002 3.75v16.5c0 .966.784 1.75 1.75 1.75h7a.75.75 0 000-1.5h-7a.25.25 0 01-.25-.25V3.75z"></path>
                                <path
                                    d="M6.25 7a.75.75 0 000 1.5h8.5a.75.75 0 000-1.5h-8.5zm-.75 4.75a.75.75 0 01.75-.75h4.5a.75.75 0 010 1.5h-4.5a.75.75 0 01-.75-.75zm16.28 4.53a.75.75 0 10-1.06-1.06l-4.97 4.97-1.97-1.97a.75.75 0 10-1.06 1.06l2.5 2.5a.75.75 0 001.06 0l5.5-5.5z"></path>
                            </svg>
                        @endslot
                    </x-utils.message-no-items>
            @endif
        </x-slot>

        <x-slot name="footer">
            <x-jet-button
                wire:click="asignarActividades"
                wire:target="asignarActividades"
                wire:loading.class="cursor-wait"
                wire:loading.attr="disabled">
                <x-icons.load wire:loading wire:target="asignarActividades" class="icon-5"/>
                Guardar
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
