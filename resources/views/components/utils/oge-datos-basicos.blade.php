<div>
    <x-utils.tables.table>
        @slot('body')

            <x-utils.tables.row>
                <x-utils.tables.body class="font-bold text-xs">TIPO</x-utils.tables.body>
                <x-utils.tables.body class="font-bold text-xs">
                    {{ isset($persona['grado']) ? 'DOCENTE' : 'ESTUDIANTE' }}
                </x-utils.tables.body>
            </x-utils.tables.row>
            <x-utils.tables.row>
                <x-utils.tables.body class="font-semibold text-xs">DNI</x-utils.tables.body>
                <x-utils.tables.body>{{ $persona['dni'] }}</x-utils.tables.body>
            </x-utils.tables.row>
            <x-utils.tables.row>
                <x-utils.tables.body class="font-semibold text-xs">NOMBRES COMPLETOS</x-utils.tables.body>
                <x-utils.tables.body class="whitespace-nowrap">{{ $persona['nombre_completo'] }}</x-utils.tables.body>
            </x-utils.tables.row>
            <x-utils.tables.row>
                <x-utils.tables.body class="font-semibold text-xs">CORREO</x-utils.tables.body>
                <x-utils.tables.body>{{ $persona['email'] }}</x-utils.tables.body>
            </x-utils.tables.row>
            <x-utils.tables.row>
                <x-utils.tables.body class="font-semibold text-xs">CORREO INSTITUCIONAL</x-utils.tables.body>
                <x-utils.tables.body>{{ $persona['correo_institucional'] }}</x-utils.tables.body>
            </x-utils.tables.row>
            @if(isset($persona['grado']))
                <x-utils.tables.row>
                    <x-utils.tables.body class="font-semibold text-xs">GRADO</x-utils.tables.body>
                    <x-utils.tables.body>{{ $persona['grado'] }}</x-utils.tables.body>
                </x-utils.tables.row>
            @endif
            @if(isset($persona['departamento_academico']))
                <x-utils.tables.row>
                    <x-utils.tables.body class="font-semibold text-xs">DEPARTAMENTO ACADÉMICO</x-utils.tables.body>
                    <x-utils.tables.body>{{ $persona['departamento_academico'] }}</x-utils.tables.body>
                </x-utils.tables.row>
            @endif
            @if(isset($persona['facultad']))
                <x-utils.tables.row>
                    <x-utils.tables.body class="font-semibold text-xs">FACULTAD</x-utils.tables.body>
                    <x-utils.tables.body>{{ $persona['facultad'] }}</x-utils.tables.body>
                </x-utils.tables.row>
            @endif
            @if(isset($persona['categoria']))
                <x-utils.tables.row>
                    <x-utils.tables.body class="font-semibold text-xs">CATEGORÍA</x-utils.tables.body>
                    <x-utils.tables.body>{{ $persona['categoria'] }}</x-utils.tables.body>
                </x-utils.tables.row>
            @endif
            @if(isset($persona['condicion']))
                <x-utils.tables.row>
                    <x-utils.tables.body class="font-semibold text-xs">CONDICIÓN</x-utils.tables.body>
                    <x-utils.tables.body>{{ $persona['condicion'] }}</x-utils.tables.body>
                </x-utils.tables.row>
            @endif
            @if(isset($persona['dedicacion']))
                <x-utils.tables.row>
                    <x-utils.tables.body class="font-semibold text-xs">DEDICACIÓN</x-utils.tables.body>
                    <x-utils.tables.body>{{ $persona['dedicacion'] }}</x-utils.tables.body>
                </x-utils.tables.row>
            @endif

        @endslot
    </x-utils.tables.table>

    <x-utils.oge-powered-by/>
</div>
