<div>

    <div class="flex items-center justify-end mb-4">
        <x-utils.buttons.default wire:click="openModal" class="text-sm">
            Asignar indicador
        </x-utils.buttons.default>
    </div>


    <div class="grid grid-cols-2 gap-x-4">
        {{-- Facultades --}}
        <div class="col-span-1">
            @if(count($indicador_en_facultades)>0)
                <x-utils.tables.table>
                    @slot('head')
                        <x-utils.tables.head>Código</x-utils.tables.head>
                        <x-utils.tables.head>Mínimo</x-utils.tables.head>
                        <x-utils.tables.head>Sobresaliente</x-utils.tables.head>
                        <x-utils.tables.head><span class="sr-only">Acciones</span></x-utils.tables.head>
                    @endslot
                    @slot('body')
                        @foreach($indicador_en_facultades as $ind_fac)
                            <x-utils.tables.row>
                                <x-utils.tables.body>{{ $ind_fac->cod_ind_final }}</x-utils.tables.body>
                                <x-utils.tables.body>{{ $ind_fac->minimo }}</x-utils.tables.body>
                                <x-utils.tables.body>{{ $ind_fac->sobresaliente }}</x-utils.tables.body>
                                <x-utils.tables.body>
                                    <x-utils.buttons.danger class="text-sm" onclick="">
                                        <x-icons.delete class="h-4 w-4"/>
                                    </x-utils.buttons.danger>
                                </x-utils.tables.body>
                            </x-utils.tables.row>
                        @endforeach
                    @endslot
                </x-utils.tables.table>
            @else
                <div class="border border-zinc-300 rounded-md">
                    <x-utils.message-no-items
                        text="Este indicador no está asignado a una facultad.">
                        @slot('icon')
                            <svg class="text-zinc-400" fill="currentColor" viewBox="0 0 24 24" width="24" height="24">
                                <path fill-rule="evenodd"
                                      d="M12.077 2.563a.25.25 0 00-.154 0L3.673 5.24a.249.249 0 00-.173.237V10.5c0 5.461 3.28 9.483 8.43 11.426a.2.2 0 00.14 0c5.15-1.943 8.43-5.965 8.43-11.426V5.476a.25.25 0 00-.173-.237l-8.25-2.676zm-.617-1.426a1.75 1.75 0 011.08 0l8.25 2.675A1.75 1.75 0 0122 5.476V10.5c0 6.19-3.77 10.705-9.401 12.83a1.699 1.699 0 01-1.198 0C5.771 21.204 2 16.69 2 10.5V5.476c0-.76.49-1.43 1.21-1.664l8.25-2.675zM13 12.232A2 2 0 0012 8.5a2 2 0 00-1 3.732V15a1 1 0 102 0v-2.768z"></path>
                            </svg>
                        @endslot
                    </x-utils.message-no-items>
                </div>
            @endif
        </div>

        {{-- Escuelas --}}
        <div class="col-span-1">
            @if(count($indicador_en_escuelas)>0)
                <x-utils.tables.table>
                    @slot('head')
                        <x-utils.tables.head>Código</x-utils.tables.head>
                        <x-utils.tables.head>Mínimo</x-utils.tables.head>
                        <x-utils.tables.head>Sobresaliente</x-utils.tables.head>
                        <x-utils.tables.head><span class="sr-only">Acciones</span></x-utils.tables.head>
                    @endslot
                    @slot('body')
                        @foreach($indicador_en_escuelas as $ind_esc)
                            <x-utils.tables.row>
                                <x-utils.tables.body>{{ $ind_esc->cod_ind_final }}</x-utils.tables.body>
                                <x-utils.tables.body>{{ $ind_esc->minimo }}</x-utils.tables.body>
                                <x-utils.tables.body>{{ $ind_esc->sobresaliente }}</x-utils.tables.body>
                                <x-utils.tables.body>
                                    <x-utils.buttons.danger class="text-sm" onclick="">
                                        <x-icons.delete class="h-4 w-4"/>
                                    </x-utils.buttons.danger>
                                </x-utils.tables.body>
                            </x-utils.tables.row>
                        @endforeach
                    @endslot
                </x-utils.tables.table>
            @else
                <div class="border border-zinc-300 rounded-md">
                    <x-utils.message-no-items
                        text="Este indicador no está asignado a un programa de estudios.">
                        @slot('icon')
                            <svg class="text-zinc-400" fill="currentColor" viewBox="0 0 24 24" width="24" height="24">
                                <path fill-rule="evenodd"
                                      d="M12.077 2.563a.25.25 0 00-.154 0L3.673 5.24a.249.249 0 00-.173.237V10.5c0 5.461 3.28 9.483 8.43 11.426a.2.2 0 00.14 0c5.15-1.943 8.43-5.965 8.43-11.426V5.476a.25.25 0 00-.173-.237l-8.25-2.676zm-.617-1.426a1.75 1.75 0 011.08 0l8.25 2.675A1.75 1.75 0 0122 5.476V10.5c0 6.19-3.77 10.705-9.401 12.83a1.699 1.699 0 01-1.198 0C5.771 21.204 2 16.69 2 10.5V5.476c0-.76.49-1.43 1.21-1.664l8.25-2.675zM13 12.232A2 2 0 0012 8.5a2 2 0 00-1 3.732V15a1 1 0 102 0v-2.768z"></path>
                            </svg>
                        @endslot
                    </x-utils.message-no-items>
                </div>
            @endif
        </div>
    </div>

</div>
