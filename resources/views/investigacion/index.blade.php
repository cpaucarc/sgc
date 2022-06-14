<x-app-layout>

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-gray-700 font-bold text-2xl">Investigaciones</h1>
    </div>

    @if(\Illuminate\Support\Facades\Auth::user()->hasAnyRole(['Dirección de Escuela', 'Departamento Academico','Decanatura']))
        <livewire:investigacion.lista-investigacion-general/>
    @else
        @if(\Illuminate\Support\Facades\Auth::user()->hasAnyRole(['Estudiante', 'Docente']))
            <livewire:investigacion.lista-mis-investigaciones/>
        @else
            <x-utils.unauth/>
        @endif
    @endif

</x-app-layout>
