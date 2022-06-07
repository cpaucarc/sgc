<x-app-layout>

    <div class="w-3/4 mx-auto">
        <div class="flex items-center justify-between mb-4">
            <h1 class="font-bold text-xl text-gray-800">
                Estudiantes con grado de bachiller
            </h1>
            <div class="relative">
                <x-utils.links.primary href="{{ route('bachiller.requests') }}">
                    <x-icons.people class="h-5 w-5 mr-1" stroke="1.5"></x-icons.people>
                    Revisar solicitudes
                </x-utils.links.primary>
            </div>
        </div>
            <br>
            <x-utils.dd>
                Bachilleres: {{ $bachilleres->count() }}
                <br>
                Solicitudes Incompletas: {{$solicitudesIncompletas->count()}}
                <br>
                Solicitudes Completas: {{$solicitudesCompletas}}
                <br>
                Facultad: {{$facultades}}
                <br>
                Escuelas: {{$escuelas}}
            </x-utils.dd>
{{--        <livewire:bachiller.lista-bachilleres :escuela="$escuela_id"/>--}}
    </div>


{{--    <div class="space-y-8 divide-y divide-gray-300 divide-dashed">
            <div class="grid grid-cols-6 gap-12 pt-8">
                <div class="col-span-2 text-right space-y-4">
                    <div>
                        <p class="text-gray-500">Estudiantes de</p>
                        <h1 class="font-bold text-2xl text-gray-700">
                            {{$ent['nombre']}}
                        </h1>
                    </div>
                    <p class="text-gray-500 font-semibold text-sm">{{ $ent['count'] }} indicadores en total</p>
                </div>

                <div class="col-span-4 space-y-6">
                    <div class="grid grid-cols-2 gap-y-6 gap-x-8">
                        @foreach($ent["data"] as $id => $proc)
                            <x-indicador.card-proceso-indicador
                                :proceso="$proc['proceso']"
                                :cantidad="$proc['cantidad']"
                                href="{{ route('indicador.proceso', [$id, $ent['tipo'], $ent['uuid']]) }}"
                            />
                        @endforeach
                    </div>
                </div>
            </div>
    </div>--}}
</x-app-layout>
