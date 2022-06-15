<div class="flex flex-col items-center space-y-2 p-4 border rounded-md">
    <p class="font-semibold text-sm text-gray-400 text-center">Semestre Académico</p>
    <p class="text-2xl font-bold text-blue-600 flex items-center">
        <x-icons.calendar class="h-8 mr-2"/>
        {{$semestre->nombre}}
    </p>
    <p class="text-sm text-gray-500 text-center">
        Los datos que cargue ahora se guardaran para este semestre.
    </p>
</div>
