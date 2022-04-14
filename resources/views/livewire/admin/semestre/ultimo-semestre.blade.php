<div>
    <x-utils.badge class="border">
        <div class="flex flex-col items-center space-y-2 p-4">
            <p class="font-semibold text-gray-400 text-center">Semestre Académico</p>
            <p class="text-3xl font-bold text-blue-600 flex">
                <x-icons.calendar class="h-8 mr-2"/>
                {{$semestre->nombre}}
            </p>
            <p class="font-semibold text-gray-400 text-center">
                Los datos que cargue ahora se guardaran para este semestre.
            </p>
        </div>
    </x-utils.badge>
</div>
