<div class="grid grid-cols-6 gap-x-6 items-center">
    <div class="col-span-5">
        <h2 class="text-xs text-gray-600 font-semibold mb-2 tracking-wide">
            Código {{ $usuario->codigo }}
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
            {{$usuario->email}}
        </x-utils.links.basic>
    </div>
    <div>
        @if($usuario->activo)
            <x-utils.buttons.danger class="text-sm"
                                    onclick="eliminar({{$usuario->activo}}, '{{$usuario->name}}')">
                <svg fill="currentColor" viewBox="0 0 16 16" width="16" height="16">
                    <path fill-rule="evenodd"
                          d="M3.72 3.72a.75.75 0 011.06 0L8 6.94l3.22-3.22a.75.75 0 111.06 1.06L9.06 8l3.22 3.22a.75.75 0 11-1.06 1.06L8 9.06l-3.22 3.22a.75.75 0 01-1.06-1.06L6.94 8 3.72 4.78a.75.75 0 010-1.06z"></path>
                </svg>
                Inhabilitar
            </x-utils.buttons.danger>
        @else
            <x-utils.buttons.default class="text-sm"
                                     onclick="eliminar({{$usuario->activo}}, '{{$usuario->name}}')">
                <svg class="text-green-600 hover:text-green-700" fill="currentColor"
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
    <script>
        function eliminar(status, nombre) {
            let tipo = status ? 'inhabilitar' : 'habilitar';

            let res = confirm(`¿Desea ${tipo} al usuario ${nombre}?`)

            if (res) {
                window.livewire.emit('eliminar');
            }
        }
    </script>
@endpush
