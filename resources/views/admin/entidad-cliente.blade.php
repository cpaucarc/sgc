<x-app-layout>

    <div class="grid grid-cols-7 gap-x-14">
        {{-- Rutas --}}
        <div class="col-span-2">
            <div class="space-y-4 divide-y divide-dashed divide-gray-200">
                <a class="font-bold text-sm text-gray-400 hover:text-blue-600 inline-flex items-center hover:underline"
                   href="{{route('admin.entidades')}}">
                    <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Ver todas las entidades
                </a>

                <div class="pt-4 ">
                    <h1 class="font-bold text-lg text-gray-600">{{ $entidad->oficina->nombre }}</h1>
                    <h2 class="font-bold text-2xl text-gray-900">{{ $entidad->nombre }}</h2>
                </div>
            </div>
        </div>

        <div class="col-span-5 space-y-6">

            <x-admin.tabs-entidad id="{{$entidad->id}}"/>

            <livewire:admin.lista-entidad-cliente entidad_id="{{ $entidad->id }}"/>

        </div>
    </div>

</x-app-layout>
