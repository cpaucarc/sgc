<x-app-layout>
    <x-utils.card>
        @slot('header')
            <div class="flex items-center justify-between">
                <h1 class="font-bold text-xl text-gray-800">
                    Estudiantes con grado de bachiller
                </h1>
                <div class="relative">
                    <x-utils.links.primary href="{{ route('bachiller.requests') }}">
                        <x-icons.people class="h-5 w-5 mr-1" stroke="1.5"></x-icons.people>
                        Revisar solicitudes
                    </x-utils.links.primary>
                    <x-utils.links.primary href="{{ route('bachiller.request') }}">
                        <x-icons.people class="h-5 w-5 mr-1" stroke="1.5"></x-icons.people>
                        Enviar solicitud
                    </x-utils.links.primary>
                </div>
            </div>
        @endslot

    </x-utils.card>
</x-app-layout>
