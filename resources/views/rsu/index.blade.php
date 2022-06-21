<x-app-layout>
    <div class="grid grid-cols-6 gap-x-8">
        {{-- Rutas --}}
        <div class="col-span-1">
            <x-rsu.rutas-rsu/>
        </div>

        <div class="col-span-5 space-y-4">
            @if(\Illuminate\Support\Facades\Auth::user()->hasAnyRole(['Dirección de Escuela', 'Departamento Academico','Decanatura']))
                <livewire:rsu.lista-rsu-general/>
            @else
                @if(\Illuminate\Support\Facades\Auth::user()->hasAnyRole(['Estudiante', 'Docente']))
                    <livewire:rsu.lista-mis-rsu/>
                @else
                    <x-utils.unauth/>
                @endif
            @endif
        </div>
    </div>
</x-app-layout>
