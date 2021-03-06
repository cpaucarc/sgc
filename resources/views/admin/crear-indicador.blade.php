<x-app-layout>

    <div class="grid grid-cols-4 gap-x-8">
        {{-- Rutas --}}
        <div class="col-span-1">
            <x-admin.rutas_admin></x-admin.rutas_admin>
        </div>

        <div class="col-span-3 space-y-4  divide-gray-300 divide-dashed">
            <div class="flex justify-between items-center">
                <h1 class="font-bold text-xl text-black">
                    Crear indicadores
                </h1>
            </div>
            <hr/>
            <livewire:admin.indicador.crear-indicador/>
        </div>
    </div>
</x-app-layout>
