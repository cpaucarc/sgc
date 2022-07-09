<x-app-layout>
    <div class="grid grid-cols-6 gap-x-8">
        {{-- Rutas --}}
        <div class="col-span-1">
            <x-bachiller.rutas-grado-academico/>
        </div>

        <div class="col-span-5 space-y-4">
            <div class="flex items-center justify-between space-x-4">
                <h2 class="text-zinc-800 text-xl font-bold">
                    Solicitudes con <span class="font-black">Requisitos Completos</span>
                </h2>
                <x-grado.badge-icon :quantity="$cant_solicitudes_completas">
                    <x-icons.document class="h-8 text-gray-500"/>
                </x-grado.badge-icon>
            </div>
            <div class="w-full">
                <livewire:bachiller.solicitudes.completas :escuelas_id="$escuelas_id"/>
            </div>
        </div>
    </div>
</x-app-layout>
