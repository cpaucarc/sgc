<x-app-layout>

    <div class="grid grid-cols-6 gap-14">

        <div class="col-span-2 space-y-4 p-4">
            <h2 class="text-gray-700 text-lg font-bold leading-tight">{{$rsu->titulo}}</h2>

            <hr class="bg-gray-400">

            <div class="flex-col space-y-1 text-sm">
                <h3 class="font-bold text-gray-400">Descripción</h3>
                <p class="text-gray-600">{{$rsu->descripcion}}</p>
            </div>

            <hr class="bg-gray-400">

            <div class="flex-col space-y-1 text-sm">
                <h3 class="font-bold text-gray-400">Escuela</h3>
                <p class="text-gray-600">{{$rsu->escuela->nombre}}</p>
            </div>

            <hr class="bg-gray-400">

            <div class="flex-col space-y-1 text-sm">
                <h3 class="font-bold text-gray-400">Lugar de ejecución</h3>
                <p class="text-gray-600">{{$rsu->lugar}}</p>
            </div>
            @if($rsu->empresa)
                <div class="flex-col space-y-1 text-sm">
                    <h3 class="font-bold text-gray-400">Empresa</h3>
                    <p class="text-gray-600">{{$rsu->empresa->nombre}}</p>
                </div>
            @endif

            <hr class="bg-gray-400">

            <div class="flex items-center justify-between text-sm">
                <div class="flex-col space-y-1">
                    <h3 class="font-bold text-gray-400">Semestre</h3>
                    <p class="text-gray-600">{{$rsu->semestre->nombre}}</p>
                </div>
                <div class="flex-col space-y-1">
                    <h3 class="font-bold text-gray-400">Inicio</h3>
                    <p class="text-gray-600">{{$rsu->fecha_inicio->format('d-m-Y')}}</p>
                </div>
                <div class="flex-col space-y-1">
                    <h3 class="font-bold text-gray-400">Finalización</h3>
                    <p class="text-gray-600">
                        {{$rsu->fecha_fin ? $rsu->fecha_fin->format('d-m-Y') : 'Sin terminar'}}
                    </p>
                </div>
            </div>
        </div>

        <div class="col-span-4 space-y-4">

            <livewire:rsu.participantes :rsu_id="$rsu->id" :es_responsable="$es_responsable" />

            <livewire:rsu.encuesta :rsu_id="$rsu->id" :es_responsable="$es_responsable" />

            <x-utils.card>
                @slot('header')
                    Documentos
                @endslot
                xdxdxd
            </x-utils.card>


            <x-utils.card>
                <x-utils.dd>
                    {{ $rsu }}
                </x-utils.dd>
            </x-utils.card>
        </div>

    </div>

</x-app-layout>
