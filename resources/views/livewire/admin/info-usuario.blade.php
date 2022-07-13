<div class="grid grid-cols-6 gap-x-6 items-center">
    <div class="col-span-5">
        <h2 class="flex items-center text-xs text-gray-600 font-semibold mb-2 tracking-wide">
            <svg class="mr-1" fill="currentColor" viewBox="0 0 16 16" width="16" height="16">
                <path
                    d="M3 7.5a.5.5 0 01.5-.5h2a.5.5 0 01.5.5v3a.5.5 0 01-.5.5h-2a.5.5 0 01-.5-.5v-3zm10 .25a.75.75 0 01-.75.75h-4.5a.75.75 0 010-1.5h4.5a.75.75 0 01.75.75zM10.25 11a.75.75 0 000-1.5h-2.5a.75.75 0 000 1.5h2.5z"></path>
                <path fill-rule="evenodd"
                      d="M7.25 0A1.75 1.75 0 005.5 1.75V3H1.75A1.75 1.75 0 000 4.75v8.5C0 14.216.784 15 1.75 15h12.5A1.75 1.75 0 0016 13.25v-8.5A1.75 1.75 0 0014.25 3H10.5V1.75A1.75 1.75 0 008.75 0h-1.5zm3.232 4.5A1.75 1.75 0 018.75 6h-1.5a1.75 1.75 0 01-1.732-1.5H1.75a.25.25 0 00-.25.25v8.5c0 .138.112.25.25.25h12.5a.25.25 0 00.25-.25v-8.5a.25.25 0 00-.25-.25h-3.768zM7 1.75a.25.25 0 01.25-.25h1.5a.25.25 0 01.25.25v2.5a.25.25 0 01-.25.25h-1.5A.25.25 0 017 4.25v-2.5z"></path>
            </svg>
            DNI {{ $usuario->dni }}
        </h2>
        <h3 class="text-2xl text-black font-bold">
            {{$usuario->name}}
        </h3>
        @if(!$usuario->activo)
            <p class="text-sm flex items-center text-red-600 mt-1">
                <x-icons.warning class="h-5 w-5 mr-1 text-red-500"/>
                Actualmente este usuario esta inhabilitado.
            </p>
        @endif
        <x-utils.links.basic class="text-sm mt-2" href="mailto:{{$usuario->email}}">
            <svg class="mr-1" fill="currentColor" viewBox="0 0 16 16" width="16" height="16">
                <path fill-rule="evenodd"
                      d="M1.75 2A1.75 1.75 0 000 3.75v.736a.75.75 0 000 .027v7.737C0 13.216.784 14 1.75 14h12.5A1.75 1.75 0 0016 12.25v-8.5A1.75 1.75 0 0014.25 2H1.75zM14.5 4.07v-.32a.25.25 0 00-.25-.25H1.75a.25.25 0 00-.25.25v.32L8 7.88l6.5-3.81zm-13 1.74v6.441c0 .138.112.25.25.25h12.5a.25.25 0 00.25-.25V5.809L8.38 9.397a.75.75 0 01-.76 0L1.5 5.809z"></path>
            </svg>
            {{$usuario->email}}
        </x-utils.links.basic>
    </div>
    <div>
        @if($usuario->activo)
            <x-utils.buttons.danger class="text-sm"
                                    onclick="eliminar({{ $usuario->id }},{{$usuario->activo}}, '{{$usuario->name}}')">
                <svg class="mr-1" fill="currentColor" viewBox="0 0 16 16" width="16" height="16">
                    <path fill-rule="evenodd"
                          d="M3.72 3.72a.75.75 0 011.06 0L8 6.94l3.22-3.22a.75.75 0 111.06 1.06L9.06 8l3.22 3.22a.75.75 0 11-1.06 1.06L8 9.06l-3.22 3.22a.75.75 0 01-1.06-1.06L6.94 8 3.72 4.78a.75.75 0 010-1.06z"></path>
                </svg>
                Inhabilitar
            </x-utils.buttons.danger>
        @else
            <x-utils.buttons.default class="text-sm"
                                     onclick="eliminar({{ $usuario->id }},{{$usuario->activo}}, '{{$usuario->name}}')">
                <svg class="mr-1" class="text-green-600 hover:text-green-700" fill="currentColor"
                     viewBox="0 0 16 16" width="16" height="16">
                    <path fill-rule="evenodd"
                          d="M13.78 4.22a.75.75 0 010 1.06l-7.25 7.25a.75.75 0 01-1.06 0L2.22 9.28a.75.75 0 011.06-1.06L6 10.94l6.72-6.72a.75.75 0 011.06 0z"></path>
                </svg>
                Habilitar
            </x-utils.buttons.default>
        @endif
    </div>

</div>

@push('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function eliminar(id, status, nombre) {
            let tipo = status ? 'inhabilitar' : 'habilitar';
            Swal.fire({
                text: `¿Desea ${tipo} al usuario ${nombre}?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: `Si, ${tipo}`,
                cancelButtonText: `Cancelar`,
            }).then((result) => {
                if (result.isConfirmed) {
                    window.livewire.emit('eliminar', id);
                }
            })
        }

    </script>
@endpush
