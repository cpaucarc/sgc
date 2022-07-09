<x-app-layout>
    <div class="grid grid-cols-6 gap-x-8">
        {{-- Rutas --}}
        <div class="col-span-1">
            <x-bachiller.rutas-grado-academico/>
        </div>

        <div class="col-span-5 space-y-4">
            <div class="flex items-center justify-between space-x-4">
                <h2 class="text-zinc-800 text-xl font-bold">
                    Lista de <span class="font-black">Proyectos de Investigación</span>
                </h2>
                <x-grado.badge-icon :quantity="$proyectos">
                    <x-icons.document class="h-8 text-gray-500"/>
                </x-grado.badge-icon>
            </div>
            <div class="w-full">
                <livewire:tpu.investigaciones.listar-investigaciones :escuela="$escuela" :facultad="$facultad"/>
            </div>
        </div>
    </div>
</x-app-layout>
