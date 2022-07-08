<x-app-layout>
    <div class="grid grid-cols-4 gap-x-8">
        {{-- Rutas --}}
        <div class="col-span-1">
            <x-bachiller.rutas-grado-academico/>
        </div>

        <div class="col-span-3 space-y-4">

            <x-utils.card class="mb-4">
                <livewire:bachiller.solicitud.estado-solicitud/>
            </x-utils.card>
            <div class="grid grid-cols-6 gap-4 flex items-start justify-between">
                <x-utils.card class="col-span-4">
                    @slot('header')
                        <div class="flex justify-between items-center space-x-2">
                            <div class="pr-4 flex-1">
                                <h1 class="text-xl font-bold text-gray-800">
                                    Requisitos enviados
                                </h1>
                            </div>
                            <livewire:bachiller.solicitud.enviar-requisito/>
                        </div>
                    @endslot
                    <livewire:bachiller.solicitud.requisitos-enviados/>
                </x-utils.card>

                <x-utils.card class="col-span-2">
                    @slot('header')
                        <div class="flex justify-between items-center space-x-2">
                            <div class="pr-4 flex-1">
                                <h1 class="text-xl font-bold text-gray-800">
                                    Requisitos faltantes
                                </h1>
                            </div>
                        </div>
                    @endslot
                    <livewire:bachiller.solicitud.lista-requisitos/>
                </x-utils.card>
            </div>

        </div>
    </div>


</x-app-layout>
