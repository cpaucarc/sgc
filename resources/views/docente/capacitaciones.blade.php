<x-app-layout>

    <div class="grid grid-cols-4 gap-x-8">
        {{-- Rutas --}}
        <div class="col-span-1">
            <x-docentes.rutas-docente/>
        </div>
        <div class="col-span-3">
            <div class="grid grid-cols-5 gap-x-8">
                <div class="col-span-2">
                    <livewire:docente.agregar-capacitacion/>
                </div>
                <div class="col-span-3">
                    <livewire:docente.lista-capacitacion/>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
