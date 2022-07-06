<div class="flex flex-col items-start gap-2">
    <x-utils.links.nav-link href="{{ route('docente.index') }}" :active="request()->routeIs('docente.index')">
        {{ __('Todos los docentes') }}
    </x-utils.links.nav-link>

    <x-utils.links.nav-link href="{{ route('docente.por_semestre') }}"
                            :active="request()->routeIs('docente.por_semestre')">
        {{ __('Docentes por semestre') }}
    </x-utils.links.nav-link>

    <x-utils.links.nav-link href="{{ route('docente.resultados') }}" :active="request()->routeIs('docente.resultados')">
        {{ __('Resultados finales') }}
    </x-utils.links.nav-link>
</div>
