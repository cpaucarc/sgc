<x-app-layout>
    <x-utils.card>
        @slot('header')
            <div class="flex items-center justify-between">
                <h1 class="font-bold text-xl text-gray-800">
                    Estudiantes con grado de título profesional
                </h1>
                <div class="relative">
                    <x-utils.links.link href="{{ route('tpu.requests') }}">
                        <x-icons.people class="h-5 w-5 mr-1" stroke="1.5"></x-icons.people>
                        Revisar solicitudes
                    </x-utils.links.link>
                </div>
            </div>
        @endslot

    </x-utils.card>
</x-app-layout>
