<div>
    <div class="flex justify-between mb-4">
        <x-utils.forms.search-input wire:model.debounce.500ms="search"/>
    </div>

    @if($usuarios and count($usuarios) > 0)

        <x-utils.tables.table>
            @slot('head')
                <x-utils.tables.head>Usuario</x-utils.tables.head>
                <x-utils.tables.head>DNI</x-utils.tables.head>
                <x-utils.tables.head>Correo</x-utils.tables.head>
                <x-utils.tables.head>Roles</x-utils.tables.head>
                <x-utils.tables.head>Estado</x-utils.tables.head>
                <x-utils.tables.head>Creación</x-utils.tables.head>
                <x-utils.tables.head><span class="sr-only">Acciones</span></x-utils.tables.head>
            @endslot
            @slot('body')
                @foreach($usuarios as $usuario)
                    <x-utils.tables.row>
                        <x-utils.tables.body>
                            <x-utils.links.basic class="flex items-center"
                                                 href="{{ route('admin.panel.usuario', $usuario->uuid) }}">
                                <img class="h-7 w-7 flex-shrink-0 rounded-full mr-2"
                                     src="{{ $usuario->profile_photo_url }}"
                                     alt="{{ $usuario->name }}">
                                <p>{{$usuario->name}}</p>
                                <x-utils.new-item date="{{$usuario->created_at}}"/>
                            </x-utils.links.basic>
                        </x-utils.tables.body>
                        <x-utils.tables.body>
                            {{ $usuario->persona ? $usuario->persona->dni : '---' }}
                        </x-utils.tables.body>
                        <x-utils.tables.body>{{$usuario->email}}</x-utils.tables.body>
                        <x-utils.tables.body>
                            @if(count($usuario->roles))
                                <ul>
                                    @foreach($usuario->roles as $rol)
                                        <li class="whitespace-nowrap">• {{ $rol->name }}</li>
                                    @endforeach
                                </ul>
                            @else
                                ---
                            @endif
                        </x-utils.tables.body>
                        <x-utils.tables.body>
                            <x-utils.badge
                                class="{{$usuario->activo ? 'bg-green-100 text-green-600':'bg-rose-100 text-rose-600'}}">
                                {{$usuario->activo ? 'Activo':'Inactivo'}}
                            </x-utils.badge>
                        </x-utils.tables.body>
                        <x-utils.tables.body class="text-xs whitespace-nowrap">
                            {{$usuario->created_at->format('d-m-Y')}}
                        </x-utils.tables.body>
                        <x-utils.tables.body>
                            @if($usuario->activo)
                                <x-utils.buttons.danger class="text-sm"
                                                        onclick="eliminar({{ $usuario->id }}, {{$usuario->activo}}, '{{$usuario->name}}')">
                                    <svg fill="currentColor" viewBox="0 0 16 16" width="16" height="16">
                                        <path fill-rule="evenodd"
                                              d="M3.72 3.72a.75.75 0 011.06 0L8 6.94l3.22-3.22a.75.75 0 111.06 1.06L9.06 8l3.22 3.22a.75.75 0 11-1.06 1.06L8 9.06l-3.22 3.22a.75.75 0 01-1.06-1.06L6.94 8 3.72 4.78a.75.75 0 010-1.06z"></path>
                                    </svg>
                                </x-utils.buttons.danger>
                            @else
                                <x-utils.buttons.default class="text-sm"
                                                         onclick="eliminar({{ $usuario->id }}, {{$usuario->activo}}, '{{$usuario->name}}')">
                                    <svg class="text-green-600 hover:text-green-700" fill="currentColor"
                                         viewBox="0 0 16 16" width="16" height="16">
                                        <path fill-rule="evenodd"
                                              d="M13.78 4.22a.75.75 0 010 1.06l-7.25 7.25a.75.75 0 01-1.06 0L2.22 9.28a.75.75 0 011.06-1.06L6 10.94l6.72-6.72a.75.75 0 011.06 0z"></path>
                                    </svg>
                                </x-utils.buttons.default>
                            @endif
                        </x-utils.tables.body>
                    </x-utils.tables.row>
                @endforeach
            @endslot
        </x-utils.tables.table>

        <div class="mt-4">
            {{ $usuarios->links() }}
        </div>
    @else
        <div class="border border-gray-300 rounded-md">
            <x-utils.message-no-items
                title="No hay ningún usuario registrado"
                text="No se ha encontrado ningún usuario registrado en la plataforma.">
                @slot('icon')
                    <svg class="text-gray-400" fill="currentColor" viewBox="0 0 24 24" width="24" height="24">
                        <path fill-rule="evenodd"
                              d="M3.5 8a5.5 5.5 0 118.596 4.547 9.005 9.005 0 015.9 8.18.75.75 0 01-1.5.045 7.5 7.5 0 00-14.993 0 .75.75 0 01-1.499-.044 9.005 9.005 0 015.9-8.181A5.494 5.494 0 013.5 8zM9 4a4 4 0 100 8 4 4 0 000-8z"></path>
                        <path
                            d="M17.29 8c-.148 0-.292.01-.434.03a.75.75 0 11-.212-1.484 4.53 4.53 0 013.38 8.097 6.69 6.69 0 013.956 6.107.75.75 0 01-1.5 0 5.193 5.193 0 00-3.696-4.972l-.534-.16v-1.676l.41-.209A3.03 3.03 0 0017.29 8z"></path>
                    </svg>
                @endslot
            </x-utils.message-no-items>
        </div>
    @endif

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
</div>
