<div>
    <div class="col-span-3 space-y-4 divide-gray-300 divide-dashed mb-6">
        <div class="flex justify-between items-center">
            <h1 class="font-bold text-xl text-black">
                Reporte Auditorias
            </h1>
            @if( count($auditorias) )
                <div class="flex items-center gap-x-2">
                    <x-utils.links.danger class="text-xs" target="_blank"
                                          href="{{ route('reporte.auditoria.pdf', ['facultad' => $facultad, 'tipo' => $tipo]) }}">
                        <x-icons.document class="h-5 w-5 mr-1"/>
                        PDF
                    </x-utils.links.danger>

                    <x-utils.links.success class="text-xs" target="_blank"
                                           href="{{ route('reporte.auditoria.excel', ['facultad' => $facultad, 'tipo' => $tipo]) }}">
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

            <div class="flex items-center gap-x-2">
                <x-utils.forms.select wire:model="tipo">
                    <option value="-1">Todos</option>
                    <option value="1">Auditoria Interna</option>
                    <option value="0">Auditoria Externa</option>
                </x-utils.forms.select>
            </div>
        </div>
    </div>

    @if( count($auditorias) )
        <h2 class="text-gray-600 text-sm mb-4">
            Se encontraron un total de {{ count($auditorias) }} auditorias registradas
        </h2>

        <x-utils.tables.table>
            @slot('head')
                <x-utils.tables.head>N??</x-utils.tables.head>
                <x-utils.tables.head>Tipo de Auditoria</x-utils.tables.head>
                <x-utils.tables.head>Responsable</x-utils.tables.head>
                <x-utils.tables.head>Facultad</x-utils.tables.head>
                <x-utils.tables.head>Adjuntos</x-utils.tables.head>
                <x-utils.tables.head>Realizaci??n</x-utils.tables.head>
            @endslot
            @slot('body')
                @foreach($auditorias as $i => $aud)
                    <x-utils.tables.row>
                        <x-utils.tables.body class="text-xs">{{($i+1)}}</x-utils.tables.body>
                        <x-utils.tables.body class="text-xs">
                            {{ $aud->es_auditoria_interno ? 'Auditoria Interna' : 'Auditoria Externa' }}
                        </x-utils.tables.body>
                        <x-utils.tables.body
                            class="text-xs">{{ $aud->responsable }}</x-utils.tables.body>
                        <x-utils.tables.body class="whitespace-nowrap text-xs">
                            {{ $aud->facultad->nombre }}
                        </x-utils.tables.body>
                        <x-utils.tables.body class="text-xs whitespace-nowrap">
                            {{ $aud->documentos_count . ' documentos' }}
                        </x-utils.tables.body>
                        <x-utils.tables.body class="text-xs whitespace-nowrap">
                            {{ $aud->created_at->format('d-m-Y') }}
                        </x-utils.tables.body>
                    </x-utils.tables.row>
                @endforeach
            @endslot
        </x-utils.tables.table>

    @else
        <div class="border border-gray-300 rounded-md mt-6">
            <x-utils.message-no-items
                title="No se encontr?? ninguna auditoria.">
                @slot('icon')
                    <svg class="text-gray-400" fill="currentColor" viewBox="0 0 24 24" width="24" height="24">
                        <path
                            d="M3.604 3.089A.75.75 0 014 3.75V8.5h.75a.75.75 0 010 1.5h-3a.75.75 0 110-1.5h.75V5.151l-.334.223a.75.75 0 01-.832-1.248l1.5-1a.75.75 0 01.77-.037zM8.75 5.5a.75.75 0 000 1.5h11.5a.75.75 0 000-1.5H8.75zm0 6a.75.75 0 000 1.5h11.5a.75.75 0 000-1.5H8.75zm0 6a.75.75 0 000 1.5h11.5a.75.75 0 000-1.5H8.75zM5.5 15.75c0-.704-.271-1.286-.72-1.686a2.302 2.302 0 00-1.53-.564c-.535 0-1.094.178-1.53.565-.449.399-.72.982-.72 1.685a.75.75 0 001.5 0c0-.296.104-.464.217-.564A.805.805 0 013.25 15c.215 0 .406.072.533.185.113.101.217.268.217.565 0 .332-.069.48-.21.657-.092.113-.216.24-.403.419l-.147.14c-.152.144-.33.313-.52.504l-1.5 1.5a.75.75 0 00-.22.53v.25c0 .414.336.75.75.75H5A.75.75 0 005 19H3.31l.47-.47c.176-.176.333-.324.48-.465l.165-.156a5.98 5.98 0 00.536-.566c.358-.447.539-.925.539-1.593z"></path>
                    </svg>
                @endslot
            </x-utils.message-no-items>
        </div>
    @endif

</div>
</div>
