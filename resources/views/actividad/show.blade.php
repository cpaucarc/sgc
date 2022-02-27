<x-app-layout>

    <livewire:actividad.info-actividad :responsable_id="$id" :semestre_id="$semestre"/>

    <div class="grid grid-cols-2 gap-x-8 mt-6">
        <div>
            <livewire:actividad.actividad-entradas :responsable_id="$id" :semestre_id="$semestre"/>
        </div>
        <div>
            <livewire:actividad.actividad-salidas :responsable_id="$id" :semestre_id="$semestre"/>
        </div>
    </div>

</x-app-layout>
