<x-app-layout>

    <div class="grid grid-cols-4 gap-x-8">
        {{-- Rutas --}}
        <div class="col-span-1">
            <x-docentes.rutas-docente/>
        </div>
        <div class="col-span-3">
            <livewire:docente.lista-docentes-ascendidos/>
        </div>
    </div>

</x-app-layout>
