<x-app-layout>
    @if(\Illuminate\Support\Facades\Auth::user()->hasAnyRole(['Dirección de Escuela', 'Departamento Academico','Decanatura']))
        <livewire:rsu.lista-rsu-general/>
    @else
        @if(\Illuminate\Support\Facades\Auth::user()->hasAnyRole(['Estudiante', 'Docente']))
            <livewire:rsu.lista-mis-rsu/>
        @else
            <x-utils.unauth/>
        @endif
    @endif
</x-app-layout>
