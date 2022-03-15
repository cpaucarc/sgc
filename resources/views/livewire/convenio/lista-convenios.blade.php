<div>
    <x-utils.card>
        @slot('header')
            <div class="flex justify-between items-center">
                <h3 class="font-bold text-lg text-gray-800">
                    Lista de convenios por semestre
                </h3>
            </div>
        @endslot
        @if(count($convenios) > 0)
            <x-utils.tables.table>
                @slot('head')
                    <x-utils.tables.head>N°</x-utils.tables.head>
                    <x-utils.tables.head>Semestre</x-utils.tables.head>
                    <x-utils.tables.head>Realizados</x-utils.tables.head>
                    <x-utils.tables.head>Vigentes</x-utils.tables.head>
                    <x-utils.tables.head>Culminados</x-utils.tables.head>
                    <x-utils.tables.head><span class="sr-only">Acciones</span></x-utils.tables.head>
                @endslot
                @slot('body')
                    @foreach($convenios as $i=>$convenio)
                        <x-utils.tables.row>
                            <x-utils.tables.body>{{($i+1)}}</x-utils.tables.body>
                            <x-utils.tables.body>{{$convenio->semestre->nombre}}</x-utils.tables.body>
                            <x-utils.tables.body>{{$convenio->realizados}}</x-utils.tables.body>
                            <x-utils.tables.body>{{$convenio->vigentes}}</x-utils.tables.body>
                            <x-utils.tables.body>{{$convenio->culminados}}</x-utils.tables.body>
                            <x-utils.tables.body>
                                <x-utils.buttons.danger class="text-sm"
                                                        wire:click="eliminarConvenio({{ $convenio->id }})">
                                    <x-icons.delete class="h-4 w-4" stroke="1.5"/>
                                </x-utils.buttons.danger>
                            </x-utils.tables.body>
                        </x-utils.tables.row>
                    @endforeach
                @endslot
            </x-utils.tables.table>
        @else
            <x-utils.message-no-items
                title="Aún no hay ningún dato registrado."
                text="Aquí podrá encontrar el registro de convenios realizadas por ciclo.">
                @slot('icon')
                    <svg class="text-gray-400" fill="currentColor" viewBox="0 0 24 24" width="24" height="24">
                        <path fill-rule="evenodd"
                              d="M0 3.75A.75.75 0 01.75 3h7.497c1.566 0 2.945.8 3.751 2.014A4.496 4.496 0 0115.75 3h7.5a.75.75 0 01.75.75v15.063a.75.75 0 01-.755.75l-7.682-.052a3 3 0 00-2.142.878l-.89.891a.75.75 0 01-1.061 0l-.902-.901a3 3 0 00-2.121-.879H.75a.75.75 0 01-.75-.75v-15zm11.247 3.747a3 3 0 00-3-2.997H1.5V18h6.947a4.5 4.5 0 012.803.98l-.003-11.483zm1.503 11.485V7.5a3 3 0 013-3h6.75v13.558l-6.927-.047a4.5 4.5 0 00-2.823.971z"></path>
                    </svg>
                @endslot
            </x-utils.message-no-items>
        @endif
    </x-utils.card>

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
