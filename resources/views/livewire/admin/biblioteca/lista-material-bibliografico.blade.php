<div>
    <div class="col-span-3 space-y-4 divide-gray-300 divide-dashed mb-6">
        <div class="flex justify-between items-center">
            <h1 class="font-bold text-xl text-black">
                Reporte Material Bibliográfico
            </h1>
            @if(count($materialBibliografico))
                <div class="flex items-center gap-x-2">
                    <x-utils.links.danger class="text-xs" target="_blank"
                                          href="{{ route('reporte.biblioteca.material.pdf', ['facultad' => $facultad, 'semestre' => $semestre]) }}">
                        <x-icons.document class="h-5 w-5 mr-1"/>
                        PDF
                    </x-utils.links.danger>

                    <x-utils.links.success class="text-xs" target="_blank"
                                           href="{{ route('reporte.biblioteca.material.excel', ['facultad' => $facultad, 'semestre' => $semestre]) }}">
                        <x-icons.excel class="h-5 w-5 mr-1"/>
                        Excel
                    </x-utils.links.success>
                </div>
            @endif
        </div>
        <hr/>
        <div class="flex items-center justify-between">
            <x-utils.forms.select wire:model="facultad">
                <option value="0">Todas las facultades</option>
                @foreach($facultades as $fac)
                    <option value="{{$fac->id}}">{{$fac->nombre}}</option>
                @endforeach
            </x-utils.forms.select>
            <x-utils.forms.select wire:model="semestre">
                <option value="0">Todos los semestres</option>
                @foreach($semestres as $semt)
                    <option value="{{$semt->id}}">{{$semt->nombre}}</option>
                @endforeach
            </x-utils.forms.select>
        </div>
    </div>

    <div>
        @if(count($materialBibliografico))
            <x-utils.tables.table>
                @slot('head')
                    <x-utils.tables.head>N°</x-utils.tables.head>
                    <x-utils.tables.head>Semestre</x-utils.tables.head>
                    <x-utils.tables.head>Adquirido</x-utils.tables.head>
                    <x-utils.tables.head>Prestado</x-utils.tables.head>
                    <x-utils.tables.head>Perdido</x-utils.tables.head>
                    <x-utils.tables.head>Restaurados</x-utils.tables.head>
                    <x-utils.tables.head>Total Libros</x-utils.tables.head>
                    <x-utils.tables.head>Facultad</x-utils.tables.head>
                    {{--<x-utils.tables.head>F. Inicio</x-utils.tables.head>
                    <x-utils.tables.head>F. Fin</x-utils.tables.head>--}}
                @endslot
                @slot('body')
                    @foreach($materialBibliografico as $i => $mb)
                        <x-utils.tables.row>
                            <x-utils.tables.body class="text-xs">{{($i+1)}}</x-utils.tables.body>
                            <x-utils.tables.body class="text-xs">{{ $mb->semestre->nombre }}</x-utils.tables.body>
                            <x-utils.tables.body class="text-xs">{{ $mb->adquirido }}</x-utils.tables.body>
                            <x-utils.tables.body class="text-xs">{{ $mb->prestado }}</x-utils.tables.body>
                            <x-utils.tables.body class="text-xs">{{ $mb->perdido }}</x-utils.tables.body>
                            <x-utils.tables.body class="text-xs">{{ $mb->restaurados }}</x-utils.tables.body>
                            <x-utils.tables.body class="text-xs">{{ $mb->total_libros }}</x-utils.tables.body>
                            <x-utils.tables.body class="text-xs">{{ $mb->facultad->nombre }}</x-utils.tables.body>
                            {{--<x-utils.tables.body class="whitespace-nowrap text-xs">
                                {{ $mb->fecha_inicio->format('d-m-Y') }}
                            </x-utils.tables.body>
                            <x-utils.tables.body class="whitespace-nowrap text-xs">
                                {{ $mb->fecha_fin->format('d-m-Y') }}
                            </x-utils.tables.body>--}}
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
