<x-app-layout>
    <div class="grid grid-cols-6 gap-x-8">
        {{-- Rutas --}}
        <div class="col-span-1">
            <x-biblioteca.rutas-biblioteca></x-biblioteca.rutas-biblioteca>
        </div>

        <div class="col-span-5 space-y-4">
            <livewire:biblioteca.lista-general-visitantes :facultad_ids="$facultad_ids"/>
        </div>
    </div>
</x-app-layout>
