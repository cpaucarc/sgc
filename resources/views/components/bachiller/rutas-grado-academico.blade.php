<div class="flex flex-col items-start gap-2">
    <x-utils.links.nav-link href="{{ route('bachiller.index') }}" :active="request()->routeIs('bachiller.*')">
        {{ __('Bachiller') }}
    </x-utils.links.nav-link>

    <x-utils.links.nav-link href="{{ route('tpu.index') }}" :active="request()->routeIs('tpu.*')">
        {{ __('Título Profesional') }}
    </x-utils.links.nav-link>

    <x-utils.links.nav-link href="{{ route('tesis.investigaciones') }}"
                            :active="request()->routeIs('tesis.*')">
        {{ __('Tesis') }}
    </x-utils.links.nav-link>
</div>
