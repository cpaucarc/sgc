<x-app-layout>
    <div class="grid grid-cols-6 gap-x-8">
        {{-- Rutas --}}
        <div class="col-span-1">
            <x-bachiller.rutas-grado-academico/>
        </div>

        <div class="col-span-5 space-y-4">
            <x-tpu.tabs-grado-academico>
                @slot('titulo')
                    <h2 class="text-zinc-800 text-xl font-bold">
                        Solicitudes con <span class="font-black">Requisitos Completos</span>
                    </h2>
                @endslot
            </x-tpu.tabs-grado-academico>
            <br>
            <div class="w-full">
                <livewire:tpu.solicitudes.completas :escuelas_id="$escuelas_id"/>
            </div>
        </div>
    </div>
</x-app-layout>
