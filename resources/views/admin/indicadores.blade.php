<x-app-layout>

    <div class="grid grid-cols-4 gap-x-8">
        {{-- Rutas --}}
        <div class="col-span-1">
            <x-admin.rutas_admin></x-admin.rutas_admin>
        </div>

        <div class="col-span-3 space-y-4  divide-gray-300 divide-dashed">

            <div class="flex justify-between items-center">
                <h1 class="font-bold text-xl text-black">
                    Indicadores
                </h1>
                <x-utils.links.primary class="flex items-center"
                              href="{{ route('admin.panel.indicadores.crear') }}">
                    Registrar nuevo
                </x-utils.links.primary>
            </div>

            <hr/>

            <livewire:admin.indicador.lista-indicadores/>
        </div>
    </div>


</x-app-layout>
