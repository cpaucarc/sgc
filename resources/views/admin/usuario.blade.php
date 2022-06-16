<x-app-layout>
    <div class="grid grid-cols-4 gap-x-8">
        {{-- Rutas --}}
        <div class="col-span-1">
            <x-admin.rutas_admin/>
        </div>

        <div class="col-span-3 space-y-6 divide-gray-300 divide-dashed">
            <livewire:admin.info-usuario uuid="{{ $uuid }}"/>

            <hr/>

            <div class="w-3/4 mx-auto">
                <livewire:admin.roles-del-usuario uuid="{{ $uuid }}"/>
            </div>
        </div>
    </div>
</x-app-layout>
