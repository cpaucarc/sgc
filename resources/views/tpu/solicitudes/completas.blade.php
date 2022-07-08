<x-app-layout>
    <div class="grid grid-cols-4 gap-x-8">
        {{-- Rutas --}}
        <div class="col-span-1">
            <x-bachiller.rutas-grado-academico/>
        </div>

        <div class="col-span-3 space-y-4">
            <div class="flex items-center justify-between space-x-4">
                <h2 class="text-zinc-800 text-xl font-bold">
                    Solicitudes con requisitos <span class="font-black">completos</span>
                </h2>
                <p class="text-sm text-amber-700 bg-amber-100 rounded-md inline-flex px-3 py-1.5 font-semibold">
                    <x-icons.info class="icon-5 mr-2" stroke="1.75"/>
                    {{ $cant_solicitudes_completas }} solicitudes
                </p>
            </div>
            <div class="w-full">
                <livewire:tpu.solicitudes.completas :escuelas_id="$escuelas_id"/>
            </div>
        </div>
    </div>
</x-app-layout>
