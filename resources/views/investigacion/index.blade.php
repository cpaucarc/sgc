<x-app-layout>

    <x-utils.titulo titulo="Investigaciones"/>

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
