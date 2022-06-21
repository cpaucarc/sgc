<x-app-layout>
    <div class="grid grid-cols-6 gap-12 pt-8">
        <div class="col-span-2 space-y-4">
            <div class="text-right">
                <p class="text-gray-500">Solicitudes con </p>
                <h1 class="font-bold text-2xl text-gray-700">
                    Requisitos Completos
                </h1>
                <div class="flex justify-end mt-4">
                    <p class="bg-lime-200 text-lime-800 font-bold text-sm px-3 py-1 rounded-lg">
                        {{ $cant_solicitudes_completas }} solicitudes
                    </p>
                </div>
            </div>
        </div>

        <div class="col-span-4 space-y-6">
            <livewire:tpu.solicitudes.completas :escuelas_id="$escuelas_id"/>
        </div>
    </div>
</x-app-layout>
