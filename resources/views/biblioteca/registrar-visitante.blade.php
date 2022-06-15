<x-app-layout>
    <div class="grid grid-cols-4 gap-x-8">
        {{-- Rutas --}}
        <div class="col-span-1">
            <x-biblioteca.rutas-biblioteca></x-biblioteca.rutas-biblioteca>
        </div>

        <div class="col-span-3 space-y-4">
            <livewire:biblioteca.registrar-visitantes-biblioteca/>
        </div>
    </div>
</x-app-layout>
