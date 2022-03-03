<div class="flex flex-col items-start gap-y-6">

    <div class="flex flex-col items-start w-full gap-y-1">
        <p class="ml-3 text-sm text-gray-400 font-semibold tracking-wide">General</p>

        <x-utils.links.nav-link href="{{ route('admin.facultades') }}" :active="request()->routeIs('admin.facultades')">
            {{ __('Facultades') }}
        </x-utils.links.nav-link>

        <x-utils.links.nav-link href="{{ route('admin.escuelas') }}" :active="request()->routeIs('admin.escuelas')">
            {{ __('Escuelas') }}
        </x-utils.links.nav-link>
    </div>

    <div class="flex flex-col items-start w-full gap-y-1">
        <p class="ml-3 text-sm text-gray-400 font-semibold tracking-wide">Gestión de procesos</p>

        <x-utils.links.nav-link href="{{ route('admin.procesos') }}" :active="request()->routeIs('admin.procesos')">
            {{ __('Procesos') }}
        </x-utils.links.nav-link>
        <x-utils.links.nav-link href="{{ route('admin.actividades') }}"
                                :active="request()->routeIs('admin.actividades')">
            {{ __('Actividades') }}
        </x-utils.links.nav-link>
        <x-utils.links.nav-link href="{{ route('admin.entradas') }}" :active="request()->routeIs('admin.entradas')">
            {{ __('Entradas') }}
        </x-utils.links.nav-link>
        <x-utils.links.nav-link href="{{ route('admin.salidas') }}" :active="request()->routeIs('admin.salidas')">
            {{ __('Salidas') }}
        </x-utils.links.nav-link>
        <x-utils.links.nav-link href="{{ route('admin.entidades') }}" :active="request()->routeIs('admin.entidades')">
            {{ __('Entidades') }}
        </x-utils.links.nav-link>
    </div>

    <div class="flex flex-col items-start w-full gap-y-1">
        <p class="ml-3 text-sm text-gray-400 font-semibold tracking-wide">Gestión de usuarios</p>

        <x-utils.links.nav-link href="{{ route('admin.usuarios') }}"
                                active="{{request()->routeIs('admin.usuario') or request()->routeIs('admin.usuarios')}}">
            {{ __('Usuarios') }}
        </x-utils.links.nav-link>
    </div>

</div>

