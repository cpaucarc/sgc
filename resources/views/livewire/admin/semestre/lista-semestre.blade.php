<div>
    <div class="flex justify-between mb-4">
        <x-utils.forms.search-input wire:model.debounce.500ms="search"/>
    </div>

    @if(count($semestres) > 0)
        <x-utils.tables.table>
            @slot('head')
                <x-utils.tables.head>Nombre</x-utils.tables.head>
                <x-utils.tables.head>Fecha Incio</x-utils.tables.head>
                <x-utils.tables.head>Fecha Fin</x-utils.tables.head>
                <x-utils.tables.head><span class="sr-only">Activo</span></x-utils.tables.head>
            @endslot
            @slot('body')
                @foreach($semestres as $semestre)
                    <x-utils.tables.row>
                        <x-utils.tables.body class="font-bold">{{$semestre->nombre}}</x-utils.tables.body>
                        <x-utils.tables.body>{{$semestre->fecha_inicio->format('d-m-Y')}}</x-utils.tables.body>
                        <x-utils.tables.body>{{$semestre->fecha_fin->format('d-m-Y')}}</x-utils.tables.body>
                        <x-utils.tables.body>
                            @if($semestre->activo)
                                <x-utils.badge class="bg-lime-200 text-lime-800 font-bold">
                                    Activo
                                </x-utils.badge>
                            @else
                                <button onclick="activarSemestre({{ $semestre->id }}, '{{ $semestre->nombre }}')"
                                        class="px-2 py-1 bg-white text-white rounded-md group-hover:bg-indigo-500 soft-transition">
                                    Asignar como activo
                                </button>
                            @endif
                        </x-utils.tables.body>
                    </x-utils.tables.row>
                @endforeach
            @endslot
        </x-utils.tables.table>
    @else
        <div class="border border-gray-300 rounded-md">
            <x-utils.message-no-items
                title="Aún no hay semestres registrados">
                @slot('icon')
                    <svg class="text-gray-400" fill="currentColor" viewBox="0 0 24 24" width="24" height="24">
                        <path
                            d="M7.25 12a.75.75 0 000 1.5h.5a.75.75 0 000-1.5h-.5zM6.5 9.25a.75.75 0 01.75-.75h.5a.75.75 0 010 1.5h-.5a.75.75 0 01-.75-.75zM7.25 5a.75.75 0 000 1.5h.5a.75.75 0 000-1.5h-.5zM10 12.75a.75.75 0 01.75-.75h.5a.75.75 0 010 1.5h-.5a.75.75 0 01-.75-.75zm.75-4.25a.75.75 0 000 1.5h.5a.75.75 0 000-1.5h-.5zM10 5.75a.75.75 0 01.75-.75h.5a.75.75 0 010 1.5h-.5a.75.75 0 01-.75-.75zM14.25 12a.75.75 0 000 1.5h.5a.75.75 0 000-1.5h-.5zm-.75-2.75a.75.75 0 01.75-.75h.5a.75.75 0 010 1.5h-.5a.75.75 0 01-.75-.75zM14.25 5a.75.75 0 000 1.5h.5a.75.75 0 000-1.5h-.5z"></path>
                        <path fill-rule="evenodd"
                              d="M3 20a2 2 0 002 2h3.75a.75.75 0 00.75-.75V19h3v2.25c0 .414.336.75.75.75H17c.092 0 .183-.006.272-.018a.758.758 0 00.166.018H21.5a2 2 0 002-2v-7.625a2 2 0 00-.8-1.6l-1-.75a.75.75 0 10-.9 1.2l1 .75a.5.5 0 01.2.4V20a.5.5 0 01-.5.5h-2.563c.041-.16.063-.327.063-.5V3a2 2 0 00-2-2H5a2 2 0 00-2 2v17zm2 .5a.5.5 0 01-.5-.5V3a.5.5 0 01.5-.5h12a.5.5 0 01.5.5v17a.5.5 0 01-.5.5h-3v-2.25a.75.75 0 00-.75-.75h-4.5a.75.75 0 00-.75.75v2.25H5z"></path>
                    </svg>
                @endslot
            </x-utils.message-no-items>
        </div>
    @endif

    @push('js')
        <script>
            function activarSemestre(semestre_id, semestre_nombre) {
                let res = confirm(`¿Desea asignar como activo al semestre ${semestre_nombre}?`)
                if (res) {
                    window.livewire.emit('activarSemestre', semestre_id);
                }
            }
        </script>
    @endpush

</div>
