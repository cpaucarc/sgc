<x-app-layout>

    <div class="w-3/4 mx-auto">
        <div class="flex items-center justify-between mb-4">
            <h1 class="font-bold text-xl text-gray-800">
                Estudiantes con grado de bachiller
            </h1>
            <div class="relative">
                <x-utils.links.primary href="{{ route('bachiller.requests') }}">
                    <x-icons.people class="h-5 w-5 mr-1" stroke="1.5"></x-icons.people>
                    Revisar solicitudes
                </x-utils.links.primary>
            </div>
        </div>

        <livewire:bachiller.lista-bachilleres :escuela="$escuela_id"/>
    </div>

</x-app-layout>
