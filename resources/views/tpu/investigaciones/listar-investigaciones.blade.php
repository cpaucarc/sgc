<x-app-layout>
    <div class="grid grid-cols-6 gap-x-8">
        {{-- Rutas --}}
        <div class="col-span-1">
            <x-bachiller.rutas-grado-academico/>
        </div>

        <div class="col-span-5 space-y-4">
            <div>
                <h2 class="text-zinc-800 text-xl font-bold">
                    Lista de <span class="font-black">Tesis/Proyectos de Investigación</span>
                </h2>
                <h3 class="text-zinc-600 text-sm">
                    Hay <b>{{ $proyectos }}</b> proyectos de investigación/tesis registrados.
                </h3>
            </div>

            <div class="w-full">
                <livewire:tpu.investigaciones.listar-investigaciones :escuela="$escuela" :facultad="$facultad"/>
            </div>
        </div>
    </div>
</x-app-layout>
