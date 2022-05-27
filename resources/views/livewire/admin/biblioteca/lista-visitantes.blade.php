<div>
    <div class="col-span-3 space-y-4 divide-gray-300 divide-dashed mb-6">
        <div class="flex justify-between items-center">
            <h1 class="font-bold text-xl text-black">
                Reporte Visitantes
            </h1>
            @if(count($visitantes))
                <div class="flex items-center gap-x-2">
                    <x-utils.links.danger class="text-xs" target="_blank"
                                          href="{{ route('reporte.biblioteca.visitante.pdf', [
                                        'semestre' => $semestre,'facultad' => $facultad,'escuela' => $escuela
                                    ]) }}">
                        <x-icons.document class="h-5 w-5 mr-1"/>
                        PDF
                    </x-utils.links.danger>

                    <x-utils.links.success class="text-xs" target="_blank"
                                           href="{{ route('reporte.biblioteca.visitante.excel', ['semestre' => $semestre,'facultad' => $facultad,'escuela' => $escuela]) }}">
                        <x-icons.excel class="h-5 w-5 mr-1"/>
                        Excel
                    </x-utils.links.success>
                </div>
            @endif
        </div>
        <hr/>
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-x-2">
                <x-utils.forms.select wire:model="facultad">
                    <option value="0">Todas las facultades</option>
                    @foreach($facultades as $fac)
                        <option value="{{$fac->id}}">{{$fac->nombre}}</option>
                    @endforeach
                </x-utils.forms.select>
                @if(!is_null($escuelas))
                    <x-utils.forms.select wire:model="escuela">
                        <option value="0">Todos los programas académicos</option>
                        @foreach($escuelas as $esc)
                            <option value="{{$esc->id}}">{{$esc->nombre}}</option>
                        @endforeach
                    </x-utils.forms.select>
                @endif
            </div>
            <x-utils.forms.select wire:model="semestre">
                <option value="0">Todos los semestres</option>
                @foreach($semestres as $semt)
                    <option value="{{$semt->id}}">{{$semt->nombre}}</option>
                @endforeach
            </x-utils.forms.select>
        </div>
    </div>

    <div>
        @if(count($visitantes))
            <x-utils.tables.table>
                @slot('head')
                    <x-utils.tables.head>N°</x-utils.tables.head>
                    <x-utils.tables.head>Semestre</x-utils.tables.head>
                    <x-utils.tables.head>Escuela</x-utils.tables.head>
                    <x-utils.tables.head>Visitantes</x-utils.tables.head>
                    <x-utils.tables.head>Inicio</x-utils.tables.head>
                    <x-utils.tables.head>Fin</x-utils.tables.head>
                @endslot
                @slot('body')
                    @foreach($visitantes as $i => $visitante)
                        <x-utils.tables.row>
                            <x-utils.tables.body class="text-xs">{{($i+1)}}</x-utils.tables.body>
                            <x-utils.tables.body
                                class="text-xs">{{ $visitante->semestre->nombre }}</x-utils.tables.body>
                            <x-utils.tables.body class="text-xs">{{ $visitante->escuela->nombre }}</x-utils.tables.body>
                            <x-utils.tables.body class="text-xs">{{ $visitante->visitantes }}</x-utils.tables.body>
                            <x-utils.tables.body class="whitespace-nowrap text-xs">
                                {{ $visitante->fecha_inicio->format('d-m-Y') }}
                            </x-utils.tables.body>
                            <x-utils.tables.body class="whitespace-nowrap text-xs">
                                {{ $visitante->fecha_fin->format('d-m-Y') }}
                            </x-utils.tables.body>
                        </x-utils.tables.row>
                    @endforeach
                @endslot
            </x-utils.tables.table>
        @else
            <div class="border border-gray-300 rounded-md">
                <x-utils.message-no-items
                    title="Aún no hay ningún registro que mostrar">
                    @slot('icon')
                        <x-icons.list class="text-gray-400 h-6 w-6 mr-1" stroke="0.1"></x-icons.list>
                    @endslot
                </x-utils.message-no-items>
            </div>
        @endif
    </div>
</div>
