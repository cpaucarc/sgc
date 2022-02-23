<div class="flex flex-col items-start gap-2">
    <x-utils.links.nav-link href="{{ route('actividad.index') }}" :active="request()->routeIs('actividad.index')">
        {{ __('Mis actividades') }}
    </x-utils.links.nav-link>

    <x-utils.links.nav-link href="{{ route('actividad.proveer') }}"
                            :active="request()->routeIs('actividad.proveer')">
        {{ __('Información a proveer') }}
    </x-utils.links.nav-link>

    <x-utils.links.nav-link href="{{ route('actividad.recibidos') }}"
                            :active="request()->routeIs('actividad.recibidos')">
        {{ __('Documentos recibidos') }}
    </x-utils.links.nav-link>
</div>
