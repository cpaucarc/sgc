<x-app-layout>

    <div class="grid grid-cols-4 gap-x-8">
        {{-- Rutas --}}
        <div class="col-span-1">
            <x-admin.rutas_admin/>
        </div>

        <div class="col-span-3 space-y-4 divide-gray-300 divide-dashed">

            <livewire:admin.info-usuario uuid="{{ $uuid }}"/>

            <hr/>

            <livewire:admin.entidades-del-usuario uuid="{{ $uuid }}"/>

        </div>
    </div>


</x-app-layout>
