<div class="w-full flex items-center justify-between gap-x-6">
    @if(isset($titulo))
        {{ $titulo }}
    @endif

    <ul class="flex flex-nowrap items-center justify-end">
        <x-admin.tab href="{{ route('bachiller.index') }}"
                     :active="request()->routeIs('bachiller.index')">
            Lista Bachilleres
        </x-admin.tab>

        <x-admin.tab href="{{ route('bachiller.solicitudes.completas') }}"
                     :active="request()->routeIs('bachiller.solicitudes.completas')">
            Solicitudes Completas
            @slot('otros')
                <livewire:bachiller.contador-completo/>
            @endslot
        </x-admin.tab>

        <x-admin.tab href="{{ route('bachiller.solicitudes.incompletas') }}"
                     :active="request()->routeIs('bachiller.solicitudes.incompletas')">
            Solicitudes Incompletas
            @slot('otros')
                <livewire:bachiller.contador-incompleto/>
            @endslot
        </x-admin.tab>
    </ul>
</div>
