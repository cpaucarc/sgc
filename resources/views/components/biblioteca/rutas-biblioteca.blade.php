<div class="flex flex-col items-start gap-2">
    <x-utils.links.nav-link href="{{ route('biblioteca.index') }}"
                            :active="request()->routeIs('biblioteca.index','biblioteca.registrar.material')">
        {{ __('Material bibliográfico') }}
    </x-utils.links.nav-link>

    <x-utils.links.nav-link href="{{ route('biblioteca.visitante') }}"
                            :active="request()->routeIs('biblioteca.visitante','biblioteca.registrar.visitante')">
        {{ __('Visitas a la biblioteca') }}
    </x-utils.links.nav-link>
</div>
