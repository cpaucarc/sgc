<div class="space-y-4">

    <div class="flex justify-between items-center space-x-2">
        <div class="pr-4 flex-1">
            <h1 class="text-xl font-bold text-gray-700">
                Material Bibliográfico
            </h1>
        </div>

        <div class="inline-flex space-x-2 items-center">
            <x-utils.forms.select class="w-24" wire:model="semestre">
                @forelse($semestres as $sm)
                    <option value="{{ $sm->id }}">{{$sm->nombre}}</option>
                @empty
                    <option value="0">No hay datos</option>
                @endforelse
            </x-utils.forms.select>

            @if(count($materiales) > 0)
                <x-utils.links.primary class="text-sm" href="{{ route('biblioteca.registrar.material') }}">
                    <x-icons.plus class="h-5 w-5 mr-1" stroke="1.5"></x-icons.plus>
                    Nuevo
                </x-utils.links.primary>
            @endif
        </div>
    </div>

    @if(count($materiales) > 0)

        <div class="py-4">
            <x-utils.tables.table>
                @slot('head')
                    <x-utils.tables.head>N°</x-utils.tables.head>
                    <x-utils.tables.head>Inicio</x-utils.tables.head>
                    <x-utils.tables.head>Finalización</x-utils.tables.head>
                    <x-utils.tables.head>Adquirido</x-utils.tables.head>
                    <x-utils.tables.head>Prestado</x-utils.tables.head>
                    <x-utils.tables.head>Perdido</x-utils.tables.head>
                    <x-utils.tables.head>Restaurado</x-utils.tables.head>
                    <x-utils.tables.head>Total Libros</x-utils.tables.head>
                    <x-utils.tables.head>Semestre</x-utils.tables.head>
                    <x-utils.tables.head>Facultad</x-utils.tables.head>
                    <x-utils.tables.head><span class="sr-only">Acciones</span></x-utils.tables.head>
                @endslot
                @slot('body')
                    @foreach($materiales as $i=>$material)
                        <x-utils.tables.row>
                            <x-utils.tables.body>{{($i+1)}}</x-utils.tables.body>
                            <x-utils.tables.body>{{ $material->fecha_inicio->format('d-m-Y') }}</x-utils.tables.body>
                            <x-utils.tables.body>{{ $material->fecha_fin->format('d-m-Y') }}</x-utils.tables.body>
                            <x-utils.tables.body>{{ $material->adquirido }}</x-utils.tables.body>
                            <x-utils.tables.body>{{ $material->prestado }}</x-utils.tables.body>
                            <x-utils.tables.body>{{ $material->perdido }}</x-utils.tables.body>
                            <x-utils.tables.body>{{ $material->restaurados }}</x-utils.tables.body>
                            <x-utils.tables.body>{{ $material->total_libros }}</x-utils.tables.body>
                            <x-utils.tables.body>{{ $material->semestre->nombre }}</x-utils.tables.body>
                            <x-utils.tables.body>{{ $material->facultad->abrev }}</x-utils.tables.body>
                            <x-utils.tables.body>
                                <x-utils.buttons.danger class="text-sm"
                                                        onclick="eliminar({{ $material->id }},{{($i+1)}})">
                                    <x-icons.delete class="h-4 w-4" stroke="1.5"/>
                                </x-utils.buttons.danger>
                            </x-utils.tables.body>
                        </x-utils.tables.row>
                    @endforeach
                @endslot
            </x-utils.tables.table>
        </div>

    @else
        <x-utils.message-no-items
            title="Aún no hay datos sobre el material bibliográfico"
            text="Aquí podrá encontrar la información sobre el Material Bibliografico de la biblioteca de la facultad.">
            @slot('icon')
                <svg class="text-gray-400" fill="currentColor" viewBox="0 0 24 24" width="24" height="24">
                    <path fill-rule="evenodd"
                          d="M0 3.75A.75.75 0 01.75 3h7.497c1.566 0 2.945.8 3.751 2.014A4.496 4.496 0 0115.75 3h7.5a.75.75 0 01.75.75v15.063a.75.75 0 01-.755.75l-7.682-.052a3 3 0 00-2.142.878l-.89.891a.75.75 0 01-1.061 0l-.902-.901a3 3 0 00-2.121-.879H.75a.75.75 0 01-.75-.75v-15zm11.247 3.747a3 3 0 00-3-2.997H1.5V18h6.947a4.5 4.5 0 012.803.98l-.003-11.483zm1.503 11.485V7.5a3 3 0 013-3h6.75v13.558l-6.927-.047a4.5 4.5 0 00-2.823.971z"></path>
                </svg>
            @endslot
            <x-utils.links.primary class="text-sm" href="{{ route('biblioteca.registrar.material') }}">
                Registrar
            </x-utils.links.primary>
        </x-utils.message-no-items>
    @endif

    @push('js')
        <script>
            function eliminar(id, row) {
                let res = confirm('¿Desea eliminar el registro número (' + row + ') de Material Bibliografico?')

                if (res) {
                    window.livewire.emit('eliminar', id);
                }
            }
        </script>
    @endpush
</div>


