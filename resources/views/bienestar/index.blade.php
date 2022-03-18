<x-app-layout>

    <h1 class="font-bold text-gray-800 text-xl mb-8">
        Comedor Universitario
    </h1>

    <div class="grid grid-cols-3 gap-x-8">
        <livewire:bienestar.agregar-atencion-comedor/>
        <div class="col-span-2">
            <livewire:bienestar.lista-atencion-comedor/>
        </div>
    </div>
</x-app-layout>
