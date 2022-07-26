<x-app-layout>

    <x-utils.titulo titulo="Servicios del Bienestar Universitario"/>

    <div class="grid grid-cols-3 gap-x-8 items-start">
        <livewire:bienestar.agregar-atencion-comedor/>
        <div class="col-span-2">
            <livewire:bienestar.lista-atencion-comedor/>
        </div>
    </div>
</x-app-layout>
