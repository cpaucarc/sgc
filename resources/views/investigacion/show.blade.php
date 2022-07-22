<x-app-layout>

    <div class="grid grid-cols-7 gap-24">

        <div class="col-span-3 divide-y divide-zinc-200 divide-dashed space-y-4">
            <h2 class="text-gray-700 text-xl font-bold leading-tight">{{$investigacion->titulo}}</h2>

            <div class="flex-col space-y-1 text-sm pt-4">
                <h3 class="font-bold text-gray-400">Programa Académico</h3>
                <p class="text-gray-600">{{$investigacion->escuela->nombre}}</p>
            </div>

            <div class="flex-col space-y-1 text-sm pt-4">
                <h3 class="font-bold text-gray-400">Semestre</h3>
                <p class="text-gray-600">{{$investigacion->semestre->nombre}}</p>
            </div>

            <livewire:investigacion.estado-investigacion :investigacion_id="$investigacion->id"/>

            <div class="text-zinc-700 text-sm rounded-md space-y-2 pt-4">
                <h3 class="font-bold text-base text-gray-500">Resumen</h3>
                <p class="leading-8">{{$investigacion->resumen}}</p>
            </div>

        </div>

        <div class="col-span-4 space-y-4 divide-y divide-zinc-200 divide-dashed">

            <div class="p-4 bg-zinc-100 text-zinc-700 text-sm rounded-md pt-4">
                <table class="text-sm text-zinc-700">
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

            <div class="pt-4">
                <livewire:investigacion.lista-investigacion-participantes investigacion_id="{{$investigacion->id}}"
                                                                          :depto_id="$investigacion->escuela->depto_id"
                                                                          :semestre="$investigacion->semestre->nombre"/>
            </div>

            <div class="pt-4">
                <livewire:investigacion.lista-presupuestos investigacion_id="{{$investigacion->id}}"/>
            </div>

        </div>

    </div>

</x-app-layout>
