<div>
    @if(count($anios))
        <div class="flex justify-end items-center gap-x-2 mb-4">
            <x-utils.forms.select class="w-52" wire:model="servicio">
                <option value="0">Todos los servicios</option>
                @foreach($servicios as $sv)
                    <option value="{{ $sv->id }}">{{$sv->nombre}}</option>
                @endforeach
            </x-utils.forms.select>
            <x-utils.forms.select class="w-20" wire:model="mes">
                <option value="0">Todos</option>
                <option value="1">Enero</option>
                <option value="2">Febrero</option>
                <option value="3">Marzo</option>
                <option value="4">Abril</option>
                <option value="5">Mayo</option>
                <option value="6">Junio</option>
                <option value="7">Julio</option>
                <option value="8">Agosto</option>
                <option value="9">Septiembre</option>
                <option value="10">Octubre</option>
                <option value="11">Noviembre</option>
                <option value="12">Diciembre</option>
            </x-utils.forms.select>
            <x-utils.forms.select class="w-20" wire:model="anio">
                @foreach($anios as $an)
                    <option value="{{ $an }}">{{ $an }}</option>
                @endforeach
            </x-utils.forms.select>
        </div>
    @endif

    @if(count($atenciones))
        <x-utils.tables.table>
            @slot('head')
                <x-utils.tables.head>Servicio</x-utils.tables.head>
                <x-utils.tables.head>Fecha</x-utils.tables.head>
                <x-utils.tables.head>Atenciones</x-utils.tables.head>
                <x-utils.tables.head>Total</x-utils.tables.head>
                <x-utils.tables.head>% Atención</x-utils.tables.head>
                <x-utils.tables.head>Programa</x-utils.tables.head>
                <x-utils.tables.head><span class="sr-only">Acciones</span></x-utils.tables.head>
            @endslot
            @slot('body')
                @foreach($atenciones as $atencion)
                    <x-utils.tables.row>
                        <x-utils.tables.body>
                            {{$atencion->servicio->nombre}}
                        </x-utils.tables.body>
                        <x-utils.tables.body>
                            {{$atencion->anio}} - {{ \App\Models\Fecha::nombreDeMes($atencion->mes)  }}
                        </x-utils.tables.body>
                        <x-utils.tables.body class="text-center">
                            {{$atencion->atenciones}}
                        </x-utils.tables.body>
                        <x-utils.tables.body class="text-center">
                            {{$atencion->total ?? $atencion->atenciones}}
                        </x-utils.tables.body>
                        <x-utils.tables.body class="text-center">
                            @if($atencion->total)
                                {{ round($atencion->atenciones/$atencion->total*100, 2) .  '%' }}
                            @else
                                {{ round($atencion->atenciones/$atencion->atenciones*100, 2) .  '%' }}
                            @endif
                        </x-utils.tables.body>
                        <x-utils.tables.body>
                            {{$atencion->escuela->nombre}}
                        </x-utils.tables.body>
                        <x-utils.tables.body>
                            <x-utils.buttons.danger class="text-sm"
                                                    onclick="eliminar({{ $atencion->id }},'{{$atencion->servicio->nombre}}')">
                                <x-icons.delete class="h-4 w-4" stroke="1.5"/>
                            </x-utils.buttons.danger>
                        </x-utils.tables.body>
                    </x-utils.tables.row>
                @endforeach
            @endslot
        </x-utils.tables.table>
        <div class="mt-4">
            {{ $atenciones->links() }}
        </div>
    @else
        <div class="border border-gray-300 rounded-md">
            <x-utils.message-no-items
                title="Aún no hay ninguna información"
                text="Aqui podrá ver la lista de informacipon sobre la atención de los estudiantes en el comedor universitario.">
                @slot('icon')
                    <svg class="text-gray-400" fill="currentColor" viewBox="0 0 24 24" width="24" height="24">
                        <path fill-rule="evenodd"
                              d="M3.5 8a5.5 5.5 0 118.596 4.547 9.005 9.005 0 015.9 8.18.75.75 0 01-1.5.045 7.5 7.5 0 00-14.993 0 .75.75 0 01-1.499-.044 9.005 9.005 0 015.9-8.181A5.494 5.494 0 013.5 8zM9 4a4 4 0 100 8 4 4 0 000-8z"></path>
                        <path
                            d="M17.29 8c-.148 0-.292.01-.434.03a.75.75 0 11-.212-1.484 4.53 4.53 0 013.38 8.097 6.69 6.69 0 013.956 6.107.75.75 0 01-1.5 0 5.193 5.193 0 00-3.696-4.972l-.534-.16v-1.676l.41-.209A3.03 3.03 0 0017.29 8z"></path>
                    </svg>
                @endslot
            </x-utils.message-no-items>
        </div>
    @endif

    @push('js')
        <script>
            function eliminar(id, service) {
                let res = confirm('¿Desea eliminar el registro de atenciones del servicio ' + service + '?')

                if (res) {
                    window.livewire.emit('eliminar', id);
                }
            }
        </script>
    @endpush
</div>
