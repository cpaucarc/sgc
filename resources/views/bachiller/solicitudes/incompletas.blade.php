<x-app-layout>

    <div class="grid grid-cols-6 gap-12 pt-8">
        <div class="col-span-2 space-y-4">
            <div class="text-right">
                <p class="text-gray-500">Solicitudes con </p>
                <h1 class="font-bold text-2xl text-gray-700">
                    Requisitos Incompletos
                </h1>
                <div class="flex justify-end mt-4">
                    <p class="bg-amber-200 text-amber-800 font-bold text-sm px-3 py-1 rounded-lg">
                        {{$cant_solicitudes_incompletas}} solicitudes
                    </p>
                </div>
            </div>
        </div>

        <div class="col-span-4 space-y-6">
            <livewire:bachiller.solicitudes.incompletas :escuelas_id="$escuelas_id"/>
        </div>
    </div>

</x-app-layout>
