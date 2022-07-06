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
            <x-utils.links.nav-link href="{{ route('docente.capacitaciones') }}" :active="request()->routeIs('docente.capacitaciones')">
                {{ __('Capacitaciones') }}
            </x-utils.links.nav-link>
        </div>
    </div>
</div>
