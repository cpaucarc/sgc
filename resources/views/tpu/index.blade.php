<x-app-layout>

    <div class="grid grid-cols-6 gap-12 pt-8">
        <div class="col-span-2 space-y-4">
            <div class="space-y-8 divide-gray-300 divide-dashed">
                <div class="text-right">
                    <p class="text-gray-500">Estudiantes de la</p>
                    <h1 class="font-bold text-2xl text-gray-700">
                        {{ $escuela ? "escuela de $escuela->nombre" : " facultad de $facultad->nombre" }}
                    </h1>
                    <p class="text-gray-500">con grado de título profesional</p>
                    <p class="text-gray-500 font-semibold text-sm mt-4">{{ $titulados }} titulados en total</p>
                </div>
                <hr>
                <div class="space-y-6">
                    <x-bachiller.card-solicitudes
                        title="Solicitudes incompletas"
                        :cantidad="$incompletas"
                        nombre="solicitudes"
                        href="{{ route('tpu.solicitudes.incompletas') }}"
                    />
                    <x-bachiller.card-solicitudes
                        title="Solicitudes completas"
                        :cantidad="$completas"
                        nombre="solicitudes"
                        href="{{ route('tpu.solicitudes.completas') }}"
                    />
                </div>
                <hr>
                <div class="space-y-6">
                    <x-bachiller.card-solicitudes
                        title="Proyectos de investigación"
                        :cantidad="$proyectos"
                        nombre="proyectos"
                        href="{{ route('tpu.investigaciones') }}"
                    />
                </div>
            </div>
        </div>
        <div class="col-span-4 space-y-6">
            <livewire:tpu.lista-titulados :escuela="$escuela" :facultad="$facultad"/>
        </div>
    </div>

</x-app-layout>
