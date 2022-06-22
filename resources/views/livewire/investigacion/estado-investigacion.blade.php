<div class="flex gap-x-8 items-start text-sm pt-4">
    <div class="flex-col space-y-1">
        <h3 class="font-bold text-gray-400">Estado</h3>
        <div class="flex items-center gap-x-2">
            <x-utils.badge
                class="font-semibold bg-{{$investigacion->estado->color}}-100 text-{{$investigacion->estado->color}}-700">
                {{$investigacion->estado->nombre}}
            </x-utils.badge>

            @if($investigacion->estado_id === 1)
                <x-jet-dropdown width="40">
                    @slot('trigger')
                        <button class="text-gray-400 hover:text-gray-500 soft-transition">
                            <svg class="fill-current" viewBox="0 0 16 16" width="16" height="16">
                                <path
                                    d="M4.427 7.427l3.396 3.396a.25.25 0 00.354 0l3.396-3.396A.25.25 0 0011.396 7H4.604a.25.25 0 00-.177.427z"></path>
                            </svg>
                        </button>
                    @endslot
                    @slot('content')
                        <button wire:click="cambiarEstado(3)"
                                class="font-semibold w-full text-sm text-gray-600 hover:text-green-800 px-1.5 py-1.5 hover:bg-green-50 soft-transition">
                            Cambiar a Publicado
                        </button>
                        <button wire:click="cambiarEstado(2)"
                                class="font-semibold w-full text-sm text-gray-600 hover:text-rose-800 px-1.5 py-1.5 hover:bg-rose-50 soft-transition">
                            Cambiar a Denegado
                        </button>
                    @endslot
                </x-jet-dropdown>
            @endif
        </div>
    </div>

    @if($investigacion->estado_id !== 1 && !is_null($investigacion->fecha_publicacion))
        <div class="flex-col space-y-1 text-sm">
            <h3 class="font-bold text-gray-400">
                Fecha de {{ $investigacion->estado_id === 3 ? ' Publicación' : ' Denegación' }}
            </h3>
            <p class="text-gray-600 py-1">
                {{$investigacion->fecha_publicacion ? $investigacion->fecha_publicacion->format('d-m-Y') : ''}}
            </p>
        </div>
    @endif
</div>
