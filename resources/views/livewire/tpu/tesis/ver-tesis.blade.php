<div>
    <div class="grid grid-cols-6 gap-14">

        <div class="col-span-2 space-y-4 p-4">
            <h2 class="text-gray-700 text-base font-bold leading-tight">{{$tesis->titulo}}</h2>

            <hr class="bg-gray-400">

            <div class="flex-col space-y-1 text-sm">
                <h3 class="font-bold text-gray-400">Número de registro</h3>
                <p class="text-gray-600">{{$tesis->numero_registro}}</p>
            </div>

            <hr class="bg-gray-400">

            <div class="flex-col space-y-1 text-sm">
                <h3 class="font-bold text-gray-400">Escuela</h3>
                <p class="text-gray-600">{{$tesis->escuela->nombre}}</p>
            </div>

            <hr class="bg-gray-400">

            <div class="flex-col space-y-1 text-sm">
                <h3 class="font-bold text-gray-400">Tipo de tesis</h3>
                <p class="text-gray-600">{{$tesis->tipoTesis->nombre}}</p>
            </div>
            <hr class="bg-gray-400">

            <div class="flex-col space-y-1 text-sm">
                <h3 class="font-bold text-gray-400">Estudiante</h3>
                <p class="text-gray-600">{{$tesis->codigo_estudiante}}</p>
            </div>

            <hr class="bg-gray-400">

            <div class="flex items-center justify-between text-sm">
                <div class="flex-col space-y-1">
                    <h3 class="font-bold text-gray-400">Fecha de sustentación</h3>
                    <p class="text-gray-600">{{$sustentacion->fecha_sustentacion}}</p>
                </div>
                <x-utils.buttons.basic-button
                    class="cursor-not-allowed inline-flex items-center text-{{$sustentacion->estado->color}}-700 border-{{$sustentacion->estado->color}}-200 bg-{{$sustentacion->estado->color}}-100">
                    {{$sustentacion->estado->nombre}}
                </x-utils.buttons.basic-button>
            </div>
        </div>

        <div class="col-span-4 space-y-4">
            <x-utils.card>
                @slot('header')
                    <div class="flex justify-between items-center">
                        <h3 class="font-bold tracking-wide text-gray-400">
                            Asesor
                        </h3>
                    </div>
                @endslot
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
            </x-utils.card>

            <x-utils.card>
                @slot('header')
                    <div class="flex justify-between items-center">
                        <h3 class="font-bold tracking-wide text-gray-400">
                            Jurados
                        </h3>
                    </div>
                @endslot
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
            </x-utils.card>
        </div>
    </div>
</div>
