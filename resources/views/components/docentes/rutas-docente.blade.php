<div class="flex flex-col items-start gap-y-6">
    <div class="flex flex-col items-start w-full gap-y-1 divide-gray-200 divide-y">
        <p class="ml-3 text-sm text-gray-400 font-semibold tracking-wide">General</p>
        <div class="px-2 flex flex-col items-start w-full gap-y-1 pt-1">
            <x-utils.links.nav-link href="{{ route('docente.index') }}" :active="request()->routeIs('docente.index')">
                {{ __('Todos los docentes') }}
            </x-utils.links.nav-link>

            <x-utils.links.nav-link href="{{ route('docente.por_semestre') }}"
                                    :active="request()->routeIs('docente.por_semestre')">
                {{ __('Docentes por semestre') }}
            </x-utils.links.nav-link>

            <x-utils.links.nav-link href="{{ route('docente.resultados') }}"
                                    :active="request()->routeIs('docente.resultados')">
                {{ __('Resultados finales') }}
            </x-utils.links.nav-link>
        </div>
    </div>

    <div class="flex flex-col items-start w-full gap-y-1 divide-gray-200 divide-y">
        <p class="ml-3 text-sm text-gray-400 font-semibold tracking-wide">Capacitaciones</p>
        <div class="px-2 flex flex-col items-start w-full gap-y-1 pt-1">
            <x-utils.links.nav-link href="{{ route('docente.capacitaciones') }}"
                                    :active="request()->routeIs('docente.capacitaciones')">
                {{ __('Registrar capacitaciones') }}
            </x-utils.links.nav-link>
            <x-utils.links.nav-link href="{{ route('docente.capacitados') }}"
                                    :active="request()->routeIs('docente.capacitados')">
                {{ __('Docentes Capacitados') }}
            </x-utils.links.nav-link>
        </div>
    </div>

    <div class="flex flex-col items-start w-full gap-y-1 divide-gray-200 divide-y">
        <p class="ml-3 text-sm text-gray-400 font-semibold tracking-wide">Reconocidos y Ascendidos</p>
        <div class="px-2 flex flex-col items-start w-full gap-y-1 pt-1">
            <x-utils.links.nav-link href="{{ route('docente.reconocidos') }}"
                                    :active="request()->routeIs('docente.reconocidos')">
                {{ __('Docentes Reconocidos') }}
            </x-utils.links.nav-link>
            <x-utils.links.nav-link href="{{ route('docente.ascendidos') }}"
                                    :active="request()->routeIs('docente.ascendidos')">
                {{ __('Docentes Ascendidos') }}
            </x-utils.links.nav-link>
        </div>
    </div>

    <div class="flex flex-col items-start w-full gap-y-1 divide-gray-200 divide-y">
        <p class="ml-3 text-sm text-gray-400 font-semibold tracking-wide">Administrativos</p>
        <div class="px-2 flex flex-col items-start w-full gap-y-1 pt-1">
            <x-utils.links.nav-link href="{{ route('docente.administrativos') }}"
                                    :active="request()->routeIs('docente.administrativos')">
                {{ __('Demanda Administrativos') }}
            </x-utils.links.nav-link>
        </div>
    </div>
</div>
