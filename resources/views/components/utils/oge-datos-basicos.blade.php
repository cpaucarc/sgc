<div>
    <x-utils.tables.table>
        @slot('body')
            <x-utils.tables.row>
                <x-utils.tables.body class="font-semibold text-xs">DNI</x-utils.tables.body>
                <x-utils.tables.body>{{ $dni }}</x-utils.tables.body>
            </x-utils.tables.row>
            <x-utils.tables.row>
                <x-utils.tables.body class="font-semibold text-xs">NOMBRES COMPLETOS</x-utils.tables.body>
                <x-utils.tables.body class="whitespace-nowrap">{{ $nombres }}</x-utils.tables.body>
            </x-utils.tables.row>
            <x-utils.tables.row>
                <x-utils.tables.body class="font-semibold text-xs">CORREO</x-utils.tables.body>
                <x-utils.tables.body>{{ $correo }}</x-utils.tables.body>
            </x-utils.tables.row>
            <x-utils.tables.row>
                <x-utils.tables.body class="font-semibold text-xs">CORREO INSTITUCIONAL</x-utils.tables.body>
                <x-utils.tables.body>{{ $institucional }}</x-utils.tables.body>
            </x-utils.tables.row>
            <x-utils.tables.row>
                <x-utils.tables.body class="font-semibold text-xs">TELÉFONO</x-utils.tables.body>
                <x-utils.tables.body>{{ $celular }}</x-utils.tables.body>
            </x-utils.tables.row>
        @endslot
    </x-utils.tables.table>

    <x-utils.oge-powered-by/>
</div>
