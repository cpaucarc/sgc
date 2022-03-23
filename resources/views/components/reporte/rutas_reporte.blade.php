<div class="flex flex-col items-start gap-y-6">

    <div class="flex flex-col items-start w-full gap-y-1 divide-gray-200 divide-y">
        <p class="ml-3 text-sm text-gray-400 font-semibold tracking-wide">General</p>

        <div class="px-2 flex flex-col items-start w-full gap-y-1 pt-1">
            <x-utils.links.nav-link href="{{ route('reporte.convenio') }}"
                                    :active="request()->routeIs('reporte.convenio')">
                {{ __('Convenio') }}
            </x-utils.links.nav-link>
            <x-utils.links.nav-link href="{{ route('reporte.rsu') }}"
                                    :active="request()->routeIs('reporte.rsu')">
                {{ __('Responsabilidad Social') }}
            </x-utils.links.nav-link>
        </div>
    </div>

</div>
