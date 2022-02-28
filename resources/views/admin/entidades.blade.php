<x-app-layout>

    <div class="grid grid-cols-4 gap-x-8">
        {{-- Rutas --}}
        <div class="col-span-1">
            <x-admin.rutas_admin></x-admin.rutas_admin>
        </div>

        <div class="col-span-3 space-y-4  divide-gray-300 divide-dashed">

            <div class="flex justify-between items-center">
                <h1 class="font-bold text-xl text-black">
                    Entidades
                </h1>
                <livewire:admin.crear-entidad/>
            </div>

            <hr/>

            <livewire:admin.lista-entidades/>
        </div>
    </div>


</x-app-layout>
