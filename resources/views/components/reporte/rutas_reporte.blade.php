<div class="flex flex-col items-start gap-y-6">

    <div class="flex flex-col items-start w-full gap-y-1 divide-gray-200 divide-y">

        <div class="px-2 flex flex-col items-start w-full gap-y-1 pt-1">

            <x-utils.links.nav-link href="{{ route('reporte.biblioteca') }}"
                                    :active="request()->routeIs('reporte.biblioteca')">
                {{ __('Biblioteca') }}
            </x-utils.links.nav-link>

            <x-utils.links.nav-link href="{{ route('reporte.bolsa') }}" :active="request()->routeIs('reporte.bolsa')">
                {{ __('Bolsa de Trabajo') }}
            </x-utils.links.nav-link>

            <x-utils.links.nav-link href="{{ route('reporte.convenio') }}"
                                    :active="request()->routeIs('reporte.convenio')">
                {{ __('Convenio') }}
            </x-utils.links.nav-link>

            <x-utils.links.nav-link href="{{ route('reporte.convalidacion') }}"
                                    :active="request()->routeIs('reporte.convalidacion')">
                {{ __('Convalidacion') }}
            </x-utils.links.nav-link>

            <x-utils.links.nav-link href="{{ route('reporte.indicador') }}"
                                    :active="request()->routeIs('reporte.indicador')">
                {{ __('Indicador') }}
            </x-utils.links.nav-link>

            <x-utils.links.nav-link href="{{ route('reporte.investigacion') }}"
                                    :active="request()->routeIs('reporte.investigacion')">
                {{ __('Investigacion') }}
            </x-utils.links.nav-link>

            <x-utils.links.nav-link href="{{ route('reporte.rsu') }}" :active="request()->routeIs('reporte.rsu')">
                {{ __('Responsabilidad Social') }}
            </x-utils.links.nav-link>

        </div>
    </div>

</div>
