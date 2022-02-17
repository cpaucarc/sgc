<x-utils.card>
    <div class="flex flex-row lg:flex-col items-start gap-2">
        <x-utils.links.nav-link href="{{ route('actividad.index') }}" :active="request()->routeIs('actividad.index')">
            {{ __('Mis actividades') }}
        </x-utils.links.nav-link>
        <x-utils.links.nav-link href="{{ route('actividad.proveer') }}"
                                :active="request()->routeIs('actividad.proveer')">
            {{ __('Información a proveer') }}
        </x-utils.links.nav-link>
        <a href="#">
            {{ __('Documentos recibidos') }}
        </a>
    </div>
</x-utils.card>
