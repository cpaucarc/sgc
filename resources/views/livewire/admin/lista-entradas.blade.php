<div>
    <div class="flex justify-between mb-4">
        <x-utils.forms.search-input wire:model.debounce.500ms="search"/>

        <x-utils.forms.select wire:model="proceso">
            <option value="0">Seleccione un proceso</option>
            @foreach($procesos as $proc)
                <option value="{{ $proc->id }}">{{ $proc->nombre }}</option>
            @endforeach
        </x-utils.forms.select>
    </div>

    @if($entradas and count($entradas) > 0)
        <x-utils.tables.table>
            @slot('head')
                <x-utils.tables.head>N°</x-utils.tables.head>
                <x-utils.tables.head>Código</x-utils.tables.head>
                <x-utils.tables.head>Entrada</x-utils.tables.head>
                <x-utils.tables.head><span class="sr-only">Acciones</span></x-utils.tables.head>
            @endslot
            @slot('body')
                @foreach($entradas as $i => $entrada)
                    <x-utils.tables.row>
                        <x-utils.tables.body>{{($i + 1)}}</x-utils.tables.body>
                        <x-utils.tables.body>{{$entrada->codigo}}</x-utils.tables.body>
                        <x-utils.tables.body class="font-semibold">{{$entrada->nombre}}</x-utils.tables.body>
                        <x-utils.tables.body>
                            <x-utils.buttons.danger class="text-sm"
                                                    onclick="eliminar({{ $entrada->id }}, '{{$entrada->nombre}}')">
                                <x-icons.delete class="h-4 w-4" stroke="1.5"/>
                            </x-utils.buttons.danger>
                        </x-utils.tables.body>
                    </x-utils.tables.row>
                @endforeach
            @endslot
        </x-utils.tables.table>
    @else
        <div class="border border-zinc-300 rounded-md">
            <x-utils.message-no-items
                title="Para iniciar, seleccione un proceso"
                text="Elija el proceso, en la esquina superior derecha, para cargar las entradas"
            >
                @slot('icon')
                    <svg class="text-zinc-400" fill="currentColor" viewBox="0 0 24 24" width="24" height="24">
                        <path fill-rule="evenodd"
                              d="M12.876.64a1.75 1.75 0 00-1.75 0l-8.25 4.762a1.75 1.75 0 00-.875 1.515v9.525c0 .625.334 1.203.875 1.515l8.25 4.763a1.75 1.75 0 001.75 0l8.25-4.762a1.75 1.75 0 00.875-1.516V6.917a1.75 1.75 0 00-.875-1.515L12.876.639zm-1 1.298a.25.25 0 01.25 0l7.625 4.402-7.75 4.474-7.75-4.474 7.625-4.402zM3.501 7.64v8.803c0 .09.048.172.125.216l7.625 4.402v-8.947L3.501 7.64zm9.25 13.421l7.625-4.402a.25.25 0 00.125-.216V7.639l-7.75 4.474v8.947z"></path>
                    </svg>
                @endslot
            </x-utils.message-no-items>
        </div>
    @endif

    @push('js')
        <script>
            function eliminar(id, nombre) {
                let res = confirm('¿Desea eliminar la entrada ' + nombre + '?')

                if (res) {
                    window.livewire.emit('eliminar', id);
                }
            }
        </script>
    @endpush
</div>
