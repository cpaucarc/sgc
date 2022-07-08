<x-app-layout>
    <div class="grid grid-cols-4 gap-x-8">
        {{-- Rutas --}}
        <div class="col-span-1">
            <x-bachiller.rutas-grado-academico/>
        </div>

        <div class="col-span-3 space-y-4">
            <div class="flex items-center justify-between space-x-4">
                <h2 class="text-zinc-800 text-xl font-bold">
                    Lista de <span class="font-black">Proyectos de Investigación</span>
                </h2>
                <p class="text-sm text-amber-700 bg-amber-100 rounded-md inline-flex px-3 py-1.5 font-semibold">
                    <x-icons.info class="icon-5 mr-2" stroke="1.75"/>
                    {{$proyectos}} tesis
                </p>
            </div>
            <div class="w-full">
                <livewire:tpu.investigaciones.listar-investigaciones :escuela="$escuela" :facultad="$facultad"/>
            </div>
        </div>
    </div>
</x-app-layout>
