<x-app-layout>

    <div class="space-y-8 divide-y divide-dashed divide-gray-300">
        <div>
            <livewire:biblioteca.lista-general-material-bibliografico :facultad_ids="$facultad_ids"/>
        </div>

        <div class="pt-8">
            <livewire:biblioteca.lista-general-visitantes :facultad_ids="$facultad_ids"/>
        </div>
    </div>

</x-app-layout>
