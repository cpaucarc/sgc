<x-app-layout>

    <div class="grid grid-cols-4 gap-x-8">

        <div class="col-span-1">
            <x-reporte.rutas_reporte/>
        </div>

        <div class="col-span-3 space-y-8 divide-gray-300 divide-dotted">
            <livewire:admin.biblioteca.lista-material-bibliografico/>

            <hr>

            <livewire:admin.biblioteca.lista-visitantes/>
        </div>
    </div>
</x-app-layout>
