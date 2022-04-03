<x-app-layout>

    <div class="flex justify-end mb-6 items-start">
        <livewire:indicador.buscador-indicadores/>
    </div>

    <div class="space-y-8 divide-y divide-gray-300 divide-dashed">
        @foreach($data as $ent)
            <div class="grid grid-cols-6 gap-12 pt-8">

                <div class="col-span-2 text-right space-y-4">
                    <div>
                        <p class="text-gray-500">Indicadores de</p>
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
        @endforeach
    </div>

</x-app-layout>
