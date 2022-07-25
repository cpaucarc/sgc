<x-app-layout>

    <h1 class="font-bold text-gray-800 text-xl mb-8">
        Servicios del Bienestar Universitario
    </h1>

    <div class="grid grid-cols-3 gap-x-8 items-start">
        <livewire:bienestar.agregar-atencion-comedor/>
        <div class="col-span-2">
            <livewire:bienestar.lista-atencion-comedor/>
        </div>
    </div>
</x-app-layout>
