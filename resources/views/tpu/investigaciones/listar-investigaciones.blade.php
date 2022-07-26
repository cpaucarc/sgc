<x-app-layout>
    <div class="grid grid-cols-6 gap-x-8">
        {{-- Rutas --}}
        <div class="col-span-1">
            <x-bachiller.rutas-grado-academico/>
        </div>

        <div class="col-span-5 space-y-4">
            <x-utils.titulo
                titulo="Lista de Tesis/Proyectos de Investigación">
                @slot('subtitulo')
                    Hay <b>{{ $proyectos }}</b> proyectos de investigación/tesis registrados.
                @endslot
            </x-utils.titulo>

            <div class="w-full">
                <livewire:tpu.investigaciones.listar-investigaciones :escuela="$escuela" :facultad="$facultad"/>
            </div>
        </div>
    </div>
</x-app-layout>
