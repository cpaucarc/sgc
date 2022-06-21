<x-app-layout>
    <div class="grid grid-cols-6 gap-x-8">
        {{-- Rutas --}}
        <div class="col-span-1">
            <x-rsu.rutas-rsu/>
        </div>

        <div class="col-span-5 space-y-4">
            <livewire:rsu.lista-empresa-general/>
        </div>
    </div>
</x-app-layout>
