<div class="space-y-4">
    <div class="flex justify-between items-center space-x-2">
        <div class="pr-4 flex-1">
            <h1 class="text-xl font-bold text-gray-700">
                Registros de información de Convalidaciones
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

            <x-utils.forms.select class="w-28" wire:model="escuela">
                <option value="0">Todos</option>
                @foreach($escuelas as $esc)
                    <option value="{{ $esc->id }}">{{$esc->nombre}}</option>
                @endforeach
            </x-utils.forms.select>

            @if(count($convalidaciones)>0)
                <x-utils.links.primary class="text-sm" href="{{ route('convalidacion.registrar') }}">
                    <x-icons.plus class="h-5 w-5 mr-1" stroke="1.5"></x-icons.plus>
                    Nuevo
                </x-utils.links.primary>
            @endif
        </div>
    </div>
    @if(count($convalidaciones)>0)

        <div class="py-4">
            <x-utils.tables.table>
                @slot('head')
                    <x-utils.tables.head>N°</x-utils.tables.head>
                    <x-utils.tables.head>Semestre</x-utils.tables.head>
                    <x-utils.tables.head>Vacantes</x-utils.tables.head>
                    <x-utils.tables.head>Postulantes</x-utils.tables.head>
                    <x-utils.tables.head>Convalidados</x-utils.tables.head>
                    <x-utils.tables.head>Escuela</x-utils.tables.head>
                    <x-utils.tables.head>Facultad</x-utils.tables.head>
                    <x-utils.tables.head><span class="sr-only">Acciones</span></x-utils.tables.head>
                @endslot
                @slot('body')
                    @foreach($convalidaciones as $i=>$convalidacion)
                        <x-utils.tables.row>
                            <x-utils.tables.body>{{($i+1)}}</x-utils.tables.body>
                            <x-utils.tables.body>{{ $convalidacion->semestre->nombre }}</x-utils.tables.body>
                            <x-utils.tables.body>{{ $convalidacion->vacantes }}</x-utils.tables.body>
                            <x-utils.tables.body>{{ $convalidacion->postulantes }}</x-utils.tables.body>
                            <x-utils.tables.body>{{ $convalidacion->convalidados }}</x-utils.tables.body>
                            <x-utils.tables.body>{{ $convalidacion->escuela->nombre }}</x-utils.tables.body>
                            <x-utils.tables.body>{{ $convalidacion->escuela->facultad->abrev }}</x-utils.tables.body>
                            <x-utils.tables.body>
                                <x-utils.buttons.danger class="text-sm"
                                                        wire:click="eliminar({{ $convalidacion->id }})">
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
            title="Aún no hay datos sobre convalidaciones"
            text="Aquí podrá encontrar la información de convalidaciones de la facultad.">
            @slot('icon')
                <svg class="text-gray-400" fill="currentColor" viewBox="0 0 24 24" width="24" height="24">
                    <path fill-rule="evenodd"
                          d="M3.5 8a5.5 5.5 0 118.596 4.547 9.005 9.005 0 015.9 8.18.75.75 0 01-1.5.045 7.5 7.5 0 00-14.993 0 .75.75 0 01-1.499-.044 9.005 9.005 0 015.9-8.181A5.494 5.494 0 013.5 8zM9 4a4 4 0 100 8 4 4 0 000-8z"></path>
                    <path
                        d="M17.29 8c-.148 0-.292.01-.434.03a.75.75 0 11-.212-1.484 4.53 4.53 0 013.38 8.097 6.69 6.69 0 013.956 6.107.75.75 0 01-1.5 0 5.193 5.193 0 00-3.696-4.972l-.534-.16v-1.676l.41-.209A3.03 3.03 0 0017.29 8z"></path>
                </svg>
            @endslot
            <x-utils.links.primary class="text-sm" href="{{ route('convalidacion.registrar') }}">
                Registrar
            </x-utils.links.primary>
        </x-utils.message-no-items>
    @endif
    {{--<x-utils.card>
        @slot('header')
            <div class="flex justify-between items-center">
                <h3 class="font-bold text-lg text-gray-800">
                    Lista de convalidaciones
                </h3>
                <x-utils.forms.select class="w-32" wire:model="semestreSeleccionado">
                    @forelse($semestres as $semestre)
                        <option value="{{ $semestre->id }}">{{$semestre->nombre}}</option>
                    @empty
                        <option value="0">No hay datos</option>
                    @endforelse
                </x-utils.forms.select>
            </div>
        @endslot
        @if(count($convalidaciones) > 0)
            <x-utils.tables.table>
                @slot('head')
                    <x-utils.tables.head>N°</x-utils.tables.head>
                    <x-utils.tables.head>Escuela</x-utils.tables.head>
                    <x-utils.tables.head>Vacantes</x-utils.tables.head>
                    <x-utils.tables.head>Postulantes</x-utils.tables.head>
                    <x-utils.tables.head>Convalidados</x-utils.tables.head>
                    <x-utils.tables.head><span class="sr-only">Acciones</span></x-utils.tables.head>
                @endslot
                @slot('body')
                    @foreach($convalidaciones as $i=>$convalidacion)
                        <x-utils.tables.row>
                            <x-utils.tables.body>{{($i+1)}}</x-utils.tables.body>
                            <x-utils.tables.body>{{$convalidacion->escuela->nombre}}</x-utils.tables.body>
                            <x-utils.tables.body>{{$convalidacion->vacantes}}</x-utils.tables.body>
                            <x-utils.tables.body>{{$convalidacion->postulantes}}</x-utils.tables.body>
                            <x-utils.tables.body>{{$convalidacion->convalidados}}</x-utils.tables.body>
                            <x-utils.tables.body>
                                <x-utils.buttons.danger class="text-sm"
                                                        wire:click="eliminarConvalidacion({{ $convalidacion->id }})">
                                    <x-icons.delete class="h-4 w-4" stroke="1.5"/>
                                </x-utils.buttons.danger>
                            </x-utils.tables.body>
                        </x-utils.tables.row>
                    @endforeach
                @endslot
            </x-utils.tables.table>
        @else
            <x-utils.message-no-items
                title="Aún no hay ninguna convalidaciones registrada en este ciclo."
                text="Aquí podrá encontrar todas las convalidaciones realizadas por escuela.">
                @slot('icon')
                    <svg class="text-gray-400" fill="currentColor" viewBox="0 0 24 24" width="24" height="24">
                        <path fill-rule="evenodd"
                              d="M0 3.75A.75.75 0 01.75 3h7.497c1.566 0 2.945.8 3.751 2.014A4.496 4.496 0 0115.75 3h7.5a.75.75 0 01.75.75v15.063a.75.75 0 01-.755.75l-7.682-.052a3 3 0 00-2.142.878l-.89.891a.75.75 0 01-1.061 0l-.902-.901a3 3 0 00-2.121-.879H.75a.75.75 0 01-.75-.75v-15zm11.247 3.747a3 3 0 00-3-2.997H1.5V18h6.947a4.5 4.5 0 012.803.98l-.003-11.483zm1.503 11.485V7.5a3 3 0 013-3h6.75v13.558l-6.927-.047a4.5 4.5 0 00-2.823.971z"></path>
                    </svg>
                @endslot
            </x-utils.message-no-items>
        @endif
    </x-utils.card>--}}

    @push('js')
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Livewire.on('error', msg => {
                Swal.fire({
                    icon: 'error',
                    title: '',
                    text: msg,
                });
            });
        </script>
    @endpush
</div>
