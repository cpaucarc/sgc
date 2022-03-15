<div class="space-y-4">

    <div class="flex justify-between items-center space-x-2">
        <div class="pr-4 flex-1">
            <h1 class="text-xl font-bold text-gray-700">
                Auditorias
            </h1>
        </div>

        <div class="inline-flex space-x-2 items-center">
            @if(count($auditorias) > 0)
                <x-utils.links.primary class="text-sm" href="{{ route('auditoria.create') }}">
                    <x-icons.plus class="h-5 w-5 mr-1" stroke="1.5"></x-icons.plus>
                    Registrar
                </x-utils.links.primary>
            @endif
        </div>
    </div>

    @if(count($auditorias) > 0)
        <x-utils.tables.table>
            @slot('head')
                <x-utils.tables.head>Responsable</x-utils.tables.head>
                <x-utils.tables.head>Tipo de Auditoria</x-utils.tables.head>
                <x-utils.tables.head>Facultad</x-utils.tables.head>
                <x-utils.tables.head>N° Documentos</x-utils.tables.head>
                <x-utils.tables.head>Fecha de Auditoria</x-utils.tables.head>
            @endslot
            @slot('body')
                @foreach($auditorias as $auditoria)
                    <x-utils.tables.row>
                        <x-utils.tables.body class="font-semibold">
                            {{ $auditoria->responsable }}
                        </x-utils.tables.body>
                        <x-utils.tables.body>
                            <x-utils.badge
                                class="font-bold {{ $auditoria->es_auditoria_interno ? 'bg-blue-100 text-blue-600' : 'bg-amber-100 text-amber-600' }}">
                                {{ $auditoria->es_auditoria_interno ? 'Auditoria Interna' : 'Auditoria Externa' }}
                            </x-utils.badge>
                        </x-utils.tables.body>
                        <x-utils.tables.body>
                            {{ $auditoria->facultad->nombre }}
                        </x-utils.tables.body>
                        <x-utils.tables.body>
                            @if($auditoria->documentos_count)
                                <x-utils.buttons.invisible>
                                    {{ $auditoria->documentos_count . ' documentos' }}
                                </x-utils.buttons.invisible>
                            @else
                                <p class="px-3 py-1">{{$auditoria->documentos_count. ' documentos'}}</p>
                            @endif
                        </x-utils.tables.body>
                        <x-utils.tables.body>
                            @if($auditoria->created_at->diffInDays(\Carbon\Carbon::now()) <= 3)
                                {{ $auditoria->created_at->diffForHumans() }}
                            @else
                                {{ $auditoria->created_at->format('d-m-Y') }}
                            @endif
                        </x-utils.tables.body>
                    </x-utils.tables.row>
                @endforeach
            @endslot
        </x-utils.tables.table>
    @else
        <div class="border border-gray-300 rounded-md">
            <x-utils.message-no-items
                title="Aún no se ha registrado ninguna Auditoria"
                text="Aquí podrá encontrar todas los informes de Auditoria que hayan registrado.">
                @slot('icon')
                    <svg class="text-gray-400" fill="currentColor" viewBox="0 0 24 24" width="24" height="24">
                        <path
                            d="M16.53 9.78a.75.75 0 00-1.06-1.06L11 13.19l-1.97-1.97a.75.75 0 00-1.06 1.06l2.5 2.5a.75.75 0 001.06 0l5-5z"></path>
                        <path fill-rule="evenodd"
                              d="M12.54.637a1.75 1.75 0 00-1.08 0L3.21 3.312A1.75 1.75 0 002 4.976V10c0 6.19 3.77 10.705 9.401 12.83.386.145.812.145 1.198 0C18.229 20.704 22 16.19 22 10V4.976c0-.759-.49-1.43-1.21-1.664L12.54.637zm-.617 1.426a.25.25 0 01.154 0l8.25 2.676a.25.25 0 01.173.237V10c0 5.461-3.28 9.483-8.43 11.426a.2.2 0 01-.14 0C6.78 19.483 3.5 15.46 3.5 10V4.976c0-.108.069-.203.173-.237l8.25-2.676z"></path>
                    </svg>
                @endslot
                <x-utils.links.primary class="text-sm" href="{{ route('auditoria.create') }}">
                    Registrar la primera auditoria
                </x-utils.links.primary>
            </x-utils.message-no-items>
        </div>
    @endif

</div>


