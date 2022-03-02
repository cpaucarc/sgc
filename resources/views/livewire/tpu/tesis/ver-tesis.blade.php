<div>
    <div class="grid grid-cols-6 gap-14">

        <div class="col-span-2 space-y-4 divide-y divide-stone-200 divide-dashed">
            <h2 class="text-gray-700 text-base font-bold leading-tight">{{$tesis->titulo}}</h2>
            <div class="flex-col space-y-1 pt-4 text-sm">
                <h3 class="font-bold text-gray-400">Número de registro</h3>
                <p class="text-gray-600">{{$tesis->numero_registro}}</p>
            </div>

            <div class="flex-col space-y-1 pt-4 text-sm">
                <h3 class="font-bold text-gray-400">Escuela</h3>
                <p class="text-gray-600">{{$tesis->escuela->nombre}}</p>
            </div>

            <div class="flex-col space-y-1 pt-4 text-sm">
                <h3 class="font-bold text-gray-400">Tipo de tesis</h3>
                <p class="text-gray-600">{{$tesis->tipoTesis->nombre}}</p>
            </div>

            <div class="flex-col space-y-1 pt-4 text-sm">
                <h3 class="font-bold text-gray-400">Estudiante</h3>
                <p class="text-gray-600">{{$tesis->codigo_estudiante}}</p>
            </div>

            <div class="flex items-center justify-between pt-4 text-sm">
                <div class="flex-col space-y-1">
                    <h3 class="font-bold text-gray-400">Estado</h3>
                    <buttons
                        class="cursor-wait inline-flex items-center text-{{ $sustentacion->estado->color }}-700 border border-{{ $sustentacion->estado->color }}-200 bg-{{ $sustentacion->estado->color }}-100 rounded-lg text-sm px-3 py-1">
                        <x-icons.info :stroke="2" class="h-5 w-5 mr-1"/>
                        {{ $sustentacion->estado->nombre }}
                    </buttons>
                </div>
                <div class="flex-col space-y-1">
                    <h3 class="font-bold text-gray-400">Sustentación</h3>
                    <p class="text-gray-600">{{$sustentacion->fecha_sustentacion}}</p>
                </div>
            </div>
        </div>

        <div class="col-span-4  divide-y divide-stone-200 divide-dashed space-y-4">
            <div class="space-y-4">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-gray-500 text-base font-bold leading-tight">Asesor</h2>
                </div>
                <x-utils.tables.table>
                    @slot('head')
                        <x-utils.tables.head>Código</x-utils.tables.head>
                        <x-utils.tables.head>Nombre</x-utils.tables.head>
                        <x-utils.tables.head>Cargo</x-utils.tables.head>
                        <x-utils.tables.head>Colegio</x-utils.tables.head>
                    @endslot
                    @slot('body')
                        <x-utils.tables.row>
                            <x-utils.tables.body>
                                {{$juradoAsesor->codigo_colegiatura}}
                            </x-utils.tables.body>
                            <x-utils.tables.body>
                                Nombre del asesor
                            </x-utils.tables.body>
                            <x-utils.tables.body>
                                Asesor
                            </x-utils.tables.body>
                            <x-utils.tables.body>
                                {{$juradoAsesor->colegio->nombre}}
                            </x-utils.tables.body>
                        </x-utils.tables.row>
                    @endslot
                </x-utils.tables.table>
            </div>

            <div class="space-y-4 pt-4">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-gray-500 text-base font-bold leading-tight">Jurados</h2>
                </div>
                <x-utils.tables.table>
                    @slot('head')
                        <x-utils.tables.head>Código</x-utils.tables.head>
                        <x-utils.tables.head>Nombre</x-utils.tables.head>
                        <x-utils.tables.head>Cargo</x-utils.tables.head>
                        <x-utils.tables.head>Colegio</x-utils.tables.head>
                    @endslot
                    @slot('body')
                        @foreach($jurados as $i=>$jr)
                            <x-utils.tables.row>
                                <x-utils.tables.body>
                                    {{$jr->jurado->codigo_colegiatura}}
                                </x-utils.tables.body>
                                <x-utils.tables.body>
                                    Nombres del jurado {{($i+1)}}
                                </x-utils.tables.body>
                                <x-utils.tables.body>
                                    {{$jr->cargoJurado->nombre}}
                                </x-utils.tables.body>
                                <x-utils.tables.body>
                                    {{$jr->jurado->colegio->nombre}}
                                </x-utils.tables.body>
                            </x-utils.tables.row>
                        @endforeach
                    @endslot
                </x-utils.tables.table>
            </div>
        </div>
    </div>
</div>
