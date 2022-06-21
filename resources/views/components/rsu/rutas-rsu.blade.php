<div class="flex flex-col items-start gap-2">
    <x-utils.links.nav-link href="{{ route('rsu.index') }}"
                            :active="request()->routeIs('rsu.index','biblioteca.registrar.material')">
        {{ __('Responsabilidad Social') }}
    </x-utils.links.nav-link>

    <x-utils.links.nav-link href="{{ route('rsu.business') }}"
                            :active="request()->routeIs('rsu.business','rsu.create-business')">
        {{ __('Empresas') }}
    </x-utils.links.nav-link>
</div>
