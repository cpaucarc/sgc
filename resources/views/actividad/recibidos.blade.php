<x-app-layout>

    <div class="grid grid-cols-4 gap-x-8">
        {{-- Rutas --}}
        <div class="col-span-1">
            <x-actividad.rutas-actividad></x-actividad.rutas-actividad>
        </div>

        <div class="col-span-3 space-y-4">
            <livewire:actividad.lista-documentos-recibidos/>
        </div>
    </div>

</x-app-layout>
