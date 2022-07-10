<x-app-layout>
    <div class="grid grid-cols-6 gap-x-8">
        {{-- Rutas --}}
        <div class="col-span-1">
            <x-bachiller.rutas-grado-academico/>
        </div>

        <div class="col-span-5 space-y-4">

            <x-tpu.tabs-grado-academico>
                @slot('titulo')
                    <div>
                        <h2 class="text-zinc-800 text-lg font-bold">
                            Estudiantes de <span class="font-black">
                                {{ $escuela ? "$escuela->nombre" : "$facultad->nombre" }}</span> con Grado de
                            Título Profesional
                        </h2>
                    </div>
                @endslot
            </x-tpu.tabs-grado-academico>

            <h3 class="text-zinc-600 text-sm">
                Actualmente hay <b>{{ $titulados }}</b> estudiantes que ya obtuvieron el Grado Académico
                de Titulados.
            </h3>

            <div class="w-full">
                <livewire:tpu.lista-titulados :escuela="$escuela" :facultad="$facultad"/>
            </div>
        </div>
    </div>
</x-app-layout>
