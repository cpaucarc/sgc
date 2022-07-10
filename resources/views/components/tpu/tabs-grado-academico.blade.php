<div class="w-full flex items-center justify-between gap-x-6">
    @if(isset($titulo))
        {{ $titulo }}
    @endif

    <ul class="flex flex-nowrap items-center justify-end">
        <x-admin.tab href="{{ route('tpu.index') }}"
                     :active="request()->routeIs('tpu.index')">
            Lista Titulados
        </x-admin.tab>

        <x-admin.tab href="{{ route('tpu.solicitudes.completas') }}"
                     :active="request()->routeIs('tpu.solicitudes.completas')">
            Solicitudes Completas
            @slot('otros')
                <livewire:tpu.contador-completo/>
            @endslot
        </x-admin.tab>

        <x-admin.tab href="{{ route('tpu.solicitudes.incompletas') }}"
                     :active="request()->routeIs('tpu.solicitudes.incompletas')">
            Solicitudes Incompletas
            @slot('otros')
                <livewire:tpu.contador-incompleto/>
            @endslot
        </x-admin.tab>
    </ul>
</div>
