@props(['id'])

<div class="w-full">
    <ul class="flex flex-wrap justify-end gap-x-2">

        {{--        href="{{ route('admin.index') }}" :active="request()->routeIs('admin.*')"--}}

        <x-admin.tab href="{{ route('admin.panel.entidad.responsable', $id) }}"
                     :active="request()->routeIs('admin.panel.entidad.responsable')">
            Responsable de
        </x-admin.tab>

        <x-admin.tab href="{{ route('admin.panel.entidad.proveedor', $id) }}"
                     :active="request()->routeIs('admin.panel.entidad.proveedor')">
            Proveedor de
        </x-admin.tab>

        <x-admin.tab href="{{ route('admin.entidad.cliente', $id) }}"
                     :active="request()->routeIs('admin.entidad.cliente')">
            Cliente de
        </x-admin.tab>

    </ul>
</div>
