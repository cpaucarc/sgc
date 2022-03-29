<x-app-layout>

    <div class="grid grid-cols-4 gap-x-8">

        <div class="col-span-1">
            <x-reporte.rutas_reporte/>
        </div>

        <div class="col-span-3 space-y-6 divide-gray-300 divide-dashed">
            <livewire:admin.auditoria.lista-auditoria-reporte/>
        </div>
    </div>
</x-app-layout>
