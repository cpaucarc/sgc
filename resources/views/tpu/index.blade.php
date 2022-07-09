<x-app-layout>
    <div class="grid grid-cols-6 gap-x-8">
        {{-- Rutas --}}
        <div class="col-span-1">
            <x-bachiller.rutas-grado-academico/>
        </div>

        <div class="col-span-5 space-y-4">
            <div class="flex items-center justify-between space-x-4">
                <h2 class="text-zinc-800 text-xl font-bold">
                    Estudiantes de <span
                        class="font-black">{{ $escuela ? "$escuela->nombre" : "$facultad->nombre" }}</span> con Grado de
                    Título Profesional
                </h2>
                <x-grado.badge-icon :quantity="$titulados">
                    <x-icons.academic class="h-8 text-gray-500"/>
                </x-grado.badge-icon>
            </div>
            <div class="flex space-x-8">
                <x-grado.badge-link href="{{ route('tpu.solicitudes.incompletas') }}" :exists="$incompletas"
                                    bcolor="yellow">
                    {{ __('Solicitudes Incompletas') }}
                </x-grado.badge-link>
                <x-grado.badge-link href="{{ route('tpu.solicitudes.completas') }}" :exists="$completas"
                                    bcolor="green">
                    {{ __('Solicitudes Completas') }}
                </x-grado.badge-link>
                <x-grado.badge-link href="{{ route('tpu.investigaciones') }}" :exists="$proyectos"
                                    bcolor="indigo">
                    {{ __('Proyectos de Investigación') }}
                </x-grado.badge-link>
            </div>

            <div class="w-full">
                <livewire:tpu.lista-titulados :escuela="$escuela" :facultad="$facultad"/>
            </div>
        </div>
    </div>
</x-app-layout>
