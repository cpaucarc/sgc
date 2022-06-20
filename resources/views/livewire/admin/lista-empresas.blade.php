<div>
    <div class="flex justify-between mb-4">
        <x-utils.forms.search-input wire:model.debounce.500ms="search"/>
        <x-utils.forms.select wire:model="cantidad">
            <option value="-1">Todas las empresas</option>
            <option value="1">Presente en 1 RSU</option>
            <option value="2">Presente en 2 RSU a 5 RSU</option>
            <option value="3">Presente en 6 RSU a 10 RSU</option>
            <option value="4">Presente en 11 RSU a 50 RSU</option>
            <option value="5">Presente en 51 RSU a 100 RSU</option>
            <option value="5">Presente en más de 100 RSU</option>
            <option value="0">Empresas sin RSU</option>
        </x-utils.forms.select>
    </div>

    <div class="flex flex-wrap gap-x-2 justify-end mb-3">
        @foreach($users as $id => $name)
            <div
                class="flex group px-2 py-1 bg-gray-100 rounded text-gray-800 hover:text-gray-900 text-sm">
                {{ $name }}
                <button wire:click="quitarUsuario({{ $id }})"
                        class="ml-1 px-1 rounded group-hover:bg-gray-200 h-full soft-transition cursor-pointer">
                    <svg class="fill-current" viewBox="0 0 16 16" width="16" height="16">
                        <path fill-rule="evenodd"
                              d="M3.72 3.72a.75.75 0 011.06 0L8 6.94l3.22-3.22a.75.75 0 111.06 1.06L9.06 8l3.22 3.22a.75.75 0 11-1.06 1.06L8 9.06l-3.22 3.22a.75.75 0 01-1.06-1.06L6.94 8 3.72 4.78a.75.75 0 010-1.06z"></path>
                    </svg>
                </button>
            </div>
        @endforeach
    </div>

    @if(count($empresas) > 0)
        <x-utils.tables.table>
            @slot('head')
                <x-utils.tables.head>Nombre/Razón Social</x-utils.tables.head>
                <x-utils.tables.head>Contacto</x-utils.tables.head>
                <x-utils.tables.head>RSU</x-utils.tables.head>
                <x-utils.tables.head>Registro</x-utils.tables.head>
            @endslot
            @slot('body')
                @foreach($empresas as $empresa)
                    <x-utils.tables.row>
                        <x-utils.tables.body>
                            <h4 class="font-bold">{{$empresa->nombre}}</h4>
                            <p class="whitespace-nowrap">RUC: {{$empresa->ruc}}</p>
                        </x-utils.tables.body>
                        <x-utils.tables.body>
                            <h5 class="whitespace-nowrap">Teléfono: {{$empresa->telefono}}</h5>
                            <h5 class="whitespace-nowrap">Correo: {{$empresa->correo}}</h5>
                        </x-utils.tables.body>
                        <x-utils.tables.body>
                            @if($empresa->rsu_count)
                                <p class="whitespace-nowrap">{{$empresa->rsu_count}} RSU</p>
                            @else
                                ---
                            @endif
                        </x-utils.tables.body>
                        <x-utils.tables.body>
                            <h5>Registrado por
                                <button
                                    wire:click="agregarUsuario({{ $empresa->user_id }}, '{{ $empresa->usuario->name }}')"
                                    class="font-bold">
                                    {{$empresa->usuario->name}}
                                </button>
                            </h5>
                            <h5>el <i>{{$empresa->created_at->format('d-m-Y h:i a')}}</i></h5>
                        </x-utils.tables.body>
                    </x-utils.tables.row>
                @endforeach
            @endslot
        </x-utils.tables.table>
    @else
        <div class="border border-gray-300 rounded-md">
            <x-utils.message-no-items
                title="Aún no hay empresas registrados"
                text="Parece que ninguna RSU estuvo enfocada a una empresa">
                @slot('icon')
                    <svg class="text-gray-400" fill="currentColor" viewBox="0 0 24 24" width="24" height="24">
                        <path
                            d="M7.25 12a.75.75 0 000 1.5h.5a.75.75 0 000-1.5h-.5zM6.5 9.25a.75.75 0 01.75-.75h.5a.75.75 0 010 1.5h-.5a.75.75 0 01-.75-.75zM7.25 5a.75.75 0 000 1.5h.5a.75.75 0 000-1.5h-.5zM10 12.75a.75.75 0 01.75-.75h.5a.75.75 0 010 1.5h-.5a.75.75 0 01-.75-.75zm.75-4.25a.75.75 0 000 1.5h.5a.75.75 0 000-1.5h-.5zM10 5.75a.75.75 0 01.75-.75h.5a.75.75 0 010 1.5h-.5a.75.75 0 01-.75-.75zM14.25 12a.75.75 0 000 1.5h.5a.75.75 0 000-1.5h-.5zm-.75-2.75a.75.75 0 01.75-.75h.5a.75.75 0 010 1.5h-.5a.75.75 0 01-.75-.75zM14.25 5a.75.75 0 000 1.5h.5a.75.75 0 000-1.5h-.5z"></path>
                        <path fill-rule="evenodd"
                              d="M3 20a2 2 0 002 2h3.75a.75.75 0 00.75-.75V19h3v2.25c0 .414.336.75.75.75H17c.092 0 .183-.006.272-.018a.758.758 0 00.166.018H21.5a2 2 0 002-2v-7.625a2 2 0 00-.8-1.6l-1-.75a.75.75 0 10-.9 1.2l1 .75a.5.5 0 01.2.4V20a.5.5 0 01-.5.5h-2.563c.041-.16.063-.327.063-.5V3a2 2 0 00-2-2H5a2 2 0 00-2 2v17zm2 .5a.5.5 0 01-.5-.5V3a.5.5 0 01.5-.5h12a.5.5 0 01.5.5v17a.5.5 0 01-.5.5h-3v-2.25a.75.75 0 00-.75-.75h-4.5a.75.75 0 00-.75.75v2.25H5z"></path>
                    </svg>
                @endslot
            </x-utils.message-no-items>
        </div>
    @endif
</div>
