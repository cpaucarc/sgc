<x-app-layout>

    <div class="grid grid-cols-5 gap-14">

        <div class="col-span-2 divide-y divide-stone-200 divide-dashed space-y-4 px-4">
            <h2 class="text-gray-700 text-lg font-bold leading-tight">{{$investigacion->titulo}}</h2>

            <div class="flex-col space-y-1 text-sm pt-4">
                <h3 class="font-bold text-gray-400">Escuela</h3>
                <p class="text-gray-600">{{$investigacion->escuela->nombre}}</p>
            </div>

            <div class="flex justify-between items-start gap-x-4 text-sm pt-4">
                <div class="flex-col space-y-1">
                    <h3 class="font-bold text-gray-400">Estado</h3>
                    <x-utils.badge
                        class="font-semibold bg-{{$investigacion->estado->color}}-100 text-{{$investigacion->estado->color}}-700">
                        {{$investigacion->estado->nombre}}
                    </x-utils.badge>
                </div>

                @if($investigacion->fecha_publicacion)
                    <div class="flex-col space-y-1 text-sm">
                        <h3 class="font-bold text-gray-400">Publicación</h3>
                        <p class="text-gray-600">
                            {{$investigacion->fecha_publicacion->format('d-m-Y')}}
                        </p>
                    </div>
                @endif
            </div>

            <div class="pt-8">
                <div class="flex justify-between items-center mb-2">
                    <h2 class="text-gray-400 text-base font-bold leading-tight">Financiación</h2>

                    <h3 class="text-gray-600 text-sm">
                        <b>Total: </b>{{'S/. '.$investigacion->financiaciones->sum('pivot.presupuesto')}}
                    </h3>
                </div>
                <x-utils.tables.table>
                    @slot('head')
                        <x-utils.tables.head>Financiador</x-utils.tables.head>
                        <x-utils.tables.head>Monto</x-utils.tables.head>
                    @endslot
                    @slot('body')
                        @foreach($investigacion->financiaciones as $financiador)
                            <x-utils.tables.row>
                                <x-utils.tables.body>{{$financiador->nombre}}</x-utils.tables.body>
                                <x-utils.tables.body>{{'S/. '. $financiador->pivot->presupuesto }}</x-utils.tables.body>
                            </x-utils.tables.row>
                        @endforeach
                    @endslot
                </x-utils.tables.table>
            </div>

        </div>

        <div class="col-span-3 space-y-8">

            <div class="p-4 bg-stone-100 text-stone-700 text-sm rounded-md">
                <table class="text-sm text-stone-700">
                    <tbody>
                    <tr>
                        <td class="pr-2"><b>Área:</b></td>
                        <td>{{ $investigacion->sublinea->linea->area->nombre }}</td>
                    </tr>
                    <tr>
                        <td class="pr-2"><b>Línea:</b></td>
                        <td>{{ $investigacion->sublinea->linea->nombre }}</td>
                    </tr>
                    <tr>
                        <td class="pr-2"><b>Sublínea:</b></td>
                        <td>{{ $investigacion->sublinea->nombre }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div class="bg-white text-stone-700 text-sm rounded-md space-y-2">
                <h3 class="font-bold text-base text-gray-500">Resumen</h3>
                <p>{{$investigacion->resumen}}</p>
            </div>
            {{--            <livewire:rsu.encuesta :rsu_id="$rsu->id" :es_responsable="$es_responsable"/>--}}

            {{--            <livewire:rsu.documentos-rsu :rsu_id="$rsu->id" :es_responsable="$es_responsable"/>--}}

            {{--            <livewire:rsu.participantes :rsu_id="$rsu->id" :es_responsable="$es_responsable"/>--}}

        </div>


    </div>

</x-app-layout>
