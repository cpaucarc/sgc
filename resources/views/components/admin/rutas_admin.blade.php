<div class="flex flex-col items-start gap-y-6">

    <div class="flex flex-col items-start w-full gap-y-1 divide-gray-200 divide-y">
        <p class="ml-3 text-sm text-gray-400 font-semibold tracking-wide">General</p>

        <div class="px-2 flex flex-col items-start w-full gap-y-1 pt-1">
            <x-utils.links.nav-link href="{{ route('admin.panel.facultades') }}"
                                    :active="request()->routeIs('admin.panel.facultades')">
                {{ __('Facultades') }}
            </x-utils.links.nav-link>

            <x-utils.links.nav-link href="{{ route('admin.panel.escuelas') }}"
                                    :active="request()->routeIs('admin.panel.escuelas')">
                {{ __('Escuelas') }}
            </x-utils.links.nav-link>

            <x-utils.links.nav-link href="{{ route('admin.panel.semestres') }}"
                                    :active="request()->routeIs('admin.panel.semestres')">
                {{ __('Semestres') }}
            </x-utils.links.nav-link>
        </div>
    </div>

    <div class="flex flex-col items-start w-full gap-y-1 divide-gray-200 divide-y">
        <p class="ml-3 text-sm text-gray-400 font-semibold tracking-wide">Gestión de procesos</p>

        <div class="px-2 flex flex-col items-start w-full gap-y-1 pt-1">
            <x-utils.links.nav-link href="{{ route('admin.panel.procesos') }}"
                                    :active="request()->routeIs('admin.panel.procesos')">
                {{ __('Procesos') }}
            </x-utils.links.nav-link>
            <x-utils.links.nav-link href="{{ route('admin.panel.actividades') }}"
                                    :active="request()->routeIs('admin.panel.actividades')">
                {{ __('Actividades') }}
            </x-utils.links.nav-link>
            <x-utils.links.nav-link href="{{ route('admin.panel.entradas') }}"
                                    :active="request()->routeIs('admin.panel.entradas')">
                {{ __('Entradas') }}
            </x-utils.links.nav-link>
            <x-utils.links.nav-link href="{{ route('admin.panel.salidas') }}"
                                    :active="request()->routeIs('admin.panel.salidas')">
                {{ __('Salidas') }}
            </x-utils.links.nav-link>
            <x-utils.links.nav-link href="{{ route('admin.panel.entidades') }}"
                                    :active="request()->routeIs('admin.panel.entidades')">
                {{ __('Entidades') }}
            </x-utils.links.nav-link>
        </div>
    </div>

    <div class="flex flex-col items-start w-full gap-y-1 divide-gray-200 divide-y">
        <p class="ml-3 text-sm text-gray-400 font-semibold tracking-wide">Gestión de usuarios</p>
        <div class="px-2 flex flex-col items-start w-full gap-y-1 pt-1">
            <x-utils.links.nav-link href="{{ route('admin.panel.usuarios') }}"
                                    active="{{request()->routeIs('admin.panel.usuario') or request()->routeIs('admin.panel.usuarios')}}">
                {{ __('Usuarios') }}
            </x-utils.links.nav-link>
        </div>
    </div>

</div>

