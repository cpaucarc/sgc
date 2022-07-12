<div class="flex flex-col items-start gap-2">
    @php
        $dniUser=\Illuminate\Support\Facades\Auth::user()->persona->dni;
        $gradoEstudiante=\App\Models\GradoEstudiante::query()->where('dni_estudiante',$dniUser)->first();
        if($gradoEstudiante){
            $nombreGradoAcademico=$gradoEstudiante->gradoAcademico->nombre;
        }else{
            $nombreGradoAcademico='';
        }
    @endphp

    <x-utils.links.nav-link href="{{ route('bachiller.index') }}" :active="request()->routeIs('bachiller.*')">
        {{ __('Bachiller') }}
    </x-utils.links.nav-link>

    @if(\Illuminate\Support\Facades\Auth::user()->hasAnyRole(['Dirección de Escuela', 'Departamento Academico','Decanatura']) or (  $nombreGradoAcademico==='Bachiller' and \Illuminate\Support\Facades\Auth::user()->hasAnyRole(['Estudiante'])))
        <x-utils.links.nav-link href="{{ route('tpu.index') }}" :active="request()->routeIs('tpu.*')">
            {{ __('Título Profesional') }}
        </x-utils.links.nav-link>

        <x-utils.links.nav-link href="{{ route('tesis.investigaciones') }}"
                                :active="request()->routeIs('tesis.*')">
            {{ __('Tesis') }}
        </x-utils.links.nav-link>

    @endif
</div>
