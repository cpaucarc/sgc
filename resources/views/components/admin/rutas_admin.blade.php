<div class="flex flex-col items-start gap-y-6">

    <div class="flex flex-col items-start w-full gap-y-1">
        <p class="ml-3 text-xs text-gray-500 font-bold tracking-wide">General</p>

        <x-utils.links.nav-link href="{{ route('admin.facultades') }}" :active="request()->routeIs('admin.facultades')">
            {{ __('Facultades') }}
        </x-utils.links.nav-link>

        <x-utils.links.nav-link href="{{ route('admin.escuelas') }}" :active="request()->routeIs('admin.escuelas')">
            {{ __('Escuelas') }}
        </x-utils.links.nav-link>
    </div>

    <div class="flex flex-col items-start w-full gap-y-1">
        <p class="ml-3 text-xs text-gray-500 font-bold tracking-wide">Actividades</p>

        <x-utils.links.nav-link href="{{ route('admin.entidades') }}" :active="request()->routeIs('admin.entidades')">
            {{ __('Entidades') }}
        </x-utils.links.nav-link>
    </div>

</div>

