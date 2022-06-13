<x-app-layout>

    <div class="grid grid-cols-6 gap-12 pt-8">
        <div class="col-span-2 space-y-4">
            <div class="space-y-8 divide-gray-300 divide-dashed">
                <div class="text-right">
                    <p class="text-gray-500">Estudiantes de </p>
                    <h1 class="font-bold text-2xl text-gray-700">
                        {{ $escuela ? "$escuela->nombre" : "$facultad->nombre" }}
                    </h1>
                    <p class="text-gray-500">con grado de bachiller</p>
                    <p class="text-gray-500 font-semibold text-sm mt-4">{{ $bachilleres }} bachilleres en total</p>
                </div>
                <hr>
                <div class="space-y-6">
                    <x-bachiller.card-solicitudes
                        title="Solicitudes incompletas"
                        :cantidad="$incompletas"
                        nombre="solicitudes"
                        href="{{ route('bachiller.solicitudes.incompletas') }}"
                    />
                    <x-bachiller.card-solicitudes
                        title="Solicitudes completas"
                        :cantidad="$completas"
                        nombre="solicitudes"
                        href="{{ route('bachiller.solicitudes.completas') }}"
                    />
                </div>

            </div>
        </div>

        <div class="col-span-4 space-y-6">
            <livewire:bachiller.lista-bachilleres :escuela="$escuela" :facultad="$facultad"/>
        </div>
    </div>

</x-app-layout>
