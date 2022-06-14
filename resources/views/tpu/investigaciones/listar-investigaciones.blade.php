<x-app-layout>
    <div class="grid grid-cols-8 gap-12 pt-8">
        <div class="col-span-2 space-y-4">
            <div class="text-right">
                <p class="text-gray-500">Proyectos de </p>
                <h1 class="font-bold text-2xl text-gray-700">
                    investigación
                </h1>
                <div class="flex justify-end mt-4">
                    <p class="bg-yellow-200 text-yellow-800 px-3 py-1 rounded-lg">
                        {{$proyectos}} tesis
                    </p>
                </div>
            </div>
        </div>

        <div class="col-span-6 space-y-6">
            <livewire:tpu.investigaciones.listar-investigaciones :escuela="$escuela" :facultad="$facultad"/>
        </div>
    </div>
</x-app-layout>
