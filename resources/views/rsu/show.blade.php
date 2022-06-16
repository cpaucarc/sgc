<x-app-layout>

    <div class="grid grid-cols-6 gap-14">

        <div class="col-span-2 space-y-4 p-4">
            <h2 class="text-gray-700 text-lg font-bold leading-tight">{{$rsu->titulo}}</h2>

            <hr class="bg-gray-400">

            <div class="flex-col space-y-1 text-sm">
                <h3 class="font-bold text-gray-400">Descripción</h3>
                <p class="text-gray-600">{{ $rsu->descripcion ?? 'Ninguna' }}</p>
            </div>

            <hr class="bg-gray-400">

            <div class="flex-col space-y-1 text-sm">
                <h3 class="font-bold text-gray-400">Programa Académico</h3>
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
            </div>

            <hr class="bg-gray-400">

            <div class="flex items-center justify-between text-sm">
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

                @if( now() < $rsu->fecha_inicio )
                    <span class="bg-amber-100 text-amber-800 whitespace-nowrap px-3 py-1 rounded">
                        Sin iniciar
                    </span>
                @endif

                @if( now() > $rsu->fecha_fin )
                    <span class="bg-gray-100 text-gray-800 whitespace-nowrap px-3 py-1 rounded">
                        Finalizado
                    </span>
                @endif

                @if( now() >= $rsu->fecha_inicio && now() <= $rsu->fecha_fin )
                    <span class="bg-lime-100 text-lime-800 whitespace-nowrap px-3 py-1 rounded">
                        En progreso
                    </span>
                @endif
            </div>
        </div>

        <div class="col-span-4 space-y-8 divide-y divide-dashed divide-stone-300">

            <livewire:rsu.participantes :rsu_id="$rsu->id" :es_responsable="$es_responsable"/>

            <div class="pt-4">
                <livewire:rsu.documentos-rsu :rsu_id="$rsu->id" :es_responsable="$es_responsable"/>
            </div>
            {{--            <div class="pt-4">--}}
            {{--                <livewire:rsu.encuesta :rsu_id="$rsu->id" :es_responsable="$es_responsable"/>--}}
            {{--            </div>--}}
        </div>

    </div>

</x-app-layout>
