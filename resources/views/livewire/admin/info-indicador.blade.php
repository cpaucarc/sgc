<div class="grid grid-cols-6 gap-x-6 items-center">
    <div class="col-span-5">
        <h2 class="flex items-center text-sm text-gray-600 font-semibold mb-2 tracking-wide">
            <svg class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
            </svg>
            Código {{ $indicador->cod_ind_inicial }}
        </h2>
        <h3 class="text-2xl text-black font-bold">
            {{$indicador->objetivo}}
        </h3>
        @if(!$indicador->esta_implementado)
            <p class="text-sm flex items-center text-red-600 mt-1">
                <x-icons.warning class="h-5 w-5 mr-1 text-red-500"/>
                Actualmente el indicador no está implementado.
            </p>
        @endif
        <div class="flex items-center text-gray-600 text-sm mt-2">
            <svg class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
            </svg>
            {{$indicador->formula}}
        </div>
    </div>
    <div>
        @if($indicador->esta_implementado)
            <x-utils.buttons.danger class="text-sm"
                                    onclick="cambiarEstado({{ $indicador->id }},0, '{{$indicador->cod_ind_inicial}}')">
                <svg class="mr-1" fill="currentColor" viewBox="0 0 16 16" width="16" height="16">
                    <path fill-rule="evenodd"
                          d="M3.72 3.72a.75.75 0 011.06 0L8 6.94l3.22-3.22a.75.75 0 111.06 1.06L9.06 8l3.22 3.22a.75.75 0 11-1.06 1.06L8 9.06l-3.22 3.22a.75.75 0 01-1.06-1.06L6.94 8 3.72 4.78a.75.75 0 010-1.06z"></path>
                </svg>
                No está implementado
            </x-utils.buttons.danger>
        @else
            <x-utils.buttons.default class="text-sm"
                                     onclick="cambiarEstado({{ $indicador->id }},1, '{{$indicador->cod_ind_inicial}}')">
                <svg class="mr-1" class="text-green-600 hover:text-green-700" fill="currentColor"
                     viewBox="0 0 16 16" width="16" height="16">
                    <path fill-rule="evenodd"
                          d="M13.78 4.22a.75.75 0 010 1.06l-7.25 7.25a.75.75 0 01-1.06 0L2.22 9.28a.75.75 0 011.06-1.06L6 10.94l6.72-6.72a.75.75 0 011.06 0z"></path>
                </svg>
                Está implementado
            </x-utils.buttons.default>
        @endif
    </div>
</div>

@push('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function cambiarEstado(id, status, nombre) {
            let tipo = status ? 'no esta implementado' : 'esta implementado';
            Swal.fire({
                text: `¿Desea asignar al indicicador ${nombre} a un estado que ${tipo}?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: `Si, cambiar`,
                cancelButtonText: `Cancelar`,
            }).then((result) => {
                if (result.isConfirmed) {
                    window.livewire.emit('cambiarEstado', id, status);
                }
            })
        }

    </script>
@endpush
