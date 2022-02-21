<x-app-layout>

    <div class="flex justify-end mb-6">
        <x-utils.forms.search-input class="w-full"/>
    </div>

    <div class="grid grid-cols-6 gap-12">
        <div class="col-span-2 text-right space-y-4">
            <div>
                <p class="text-gray-500">Indicadores de</p>
                <h1 class="font-bold text-2xl text-gray-700">
                    {{ isset($facultad) ? $facultad->nombre : $escuela->nombre }}
                </h1>
            </div>

            <hr>

            <p class="text-gray-500 text-sm">
                {{ isset($facultad) ? $facultad->indicadores_count : $escuela->indicadores_count }}
                indicadores en total
            </p>

        </div>

        <div class="col-span-4 space-y-6">

            @if(isset($escuela))
                <div class="grid grid-cols-2 gap-y-4 gap-x-6">
                    @foreach($escuela_indicadores as $indicador_id => $cantidad)

                        <div
                            class="group bg-white border border-gray-200 px-3 py-2 rounded-lg transition hover:shadow-md">
                            <a href="#"
                               class="font-bold text-sm text-gray-500 group-hover:text-sky-600 mb-1 hover:underline cursor-pointer">
                                Proceso de {{\App\Models\Proceso::getNombreById($indicador_id)}}
                            </a>
                            <div class="flex justify-between items-center">
                                <div class="inline-flex items-center text-gray-400 group-hover:text-gray-500">
                                    <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                              d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                    </svg>
                                    <p class="text-xs">
                                        {{$cantidad}} indicadores
                                    </p>
                                </div>
                                <x-utils.buttons.ghost-button class="text-xs text-gray-600">
                                    Revisar
                                </x-utils.buttons.ghost-button>
                            </div>
                        </div>

                    @endforeach
                </div>
            @endif

        </div>
    </div>

    @if(isset($facultad))

        <x-utils.dd>
            Facultad: {{ $facultad_indicadores ?? 'No hay' }}
        </x-utils.dd>


    @endif

    @if(isset($escuela))
        {{ $escuela->nombre }}


        <x-utils.dd>
            Escuela: {{ $escuela_indicadores ?? 'No hay' }}
        </x-utils.dd>

        <br>

        <x-utils.dd>
            Escuela: {{ $escuela ?? 'No hay' }}
        </x-utils.dd>


    @endif


</x-app-layout>
