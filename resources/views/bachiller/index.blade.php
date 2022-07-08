<x-app-layout>
    <div class="grid grid-cols-4 gap-x-8">
        {{-- Rutas --}}
        <div class="col-span-1">
            <x-bachiller.rutas-grado-academico/>
        </div>

        <div class="col-span-3 space-y-4">
            <div class="flex items-center justify-between space-x-4">
                <h2 class="text-zinc-800 text-xl font-bold">
                    Estudiantes de <span
                        class="font-black">{{ $escuela ? "$escuela->nombre" : "$facultad->nombre" }}</span> con grado de
                    bachiller
                </h2>
                <p class="text-sm text-amber-700 bg-amber-100 rounded-md inline-flex px-3 py-1.5 font-semibold">
                    <x-icons.info class="icon-5 mr-2" stroke="1.75"/>
                    {{ $bachilleres }} bachilleres en total
                </p>
            </div>

            <div class="grid grid-cols-6 gap-4">
                <div class="col-span-3">
                    <x-bachiller.card-solicitudes
                        title="Solicitudes incompletas"
                        :cantidad="$incompletas"
                        nombre="solicitudes"
                        href="{{ route('bachiller.solicitudes.incompletas') }}"
                    />
                </div>
                <div class="col-span-3">
                    <x-bachiller.card-solicitudes
                        title="Solicitudes completas"
                        :cantidad="$completas"
                        nombre="solicitudes"
                        href="{{ route('bachiller.solicitudes.completas') }}"
                    />
                </div>
            </div>

            <div class="w-full">
                <livewire:bachiller.lista-bachilleres :escuela="$escuela" :facultad="$facultad"/>
            </div>
        </div>
    </div>
</x-app-layout>
