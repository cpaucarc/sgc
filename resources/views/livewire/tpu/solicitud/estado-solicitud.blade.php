<div>
    <div class="w-full flex flex justify-between items-center">
        <div class="flex-col lg:flex-row justify-between items-start px-6 lg:px-0">
            <h1 class="flex-1 lg:text-2xl font-bold text-gray-700 truncate">
                Solicitud N°
                <span class="font-bold">
                    @if(is_null($solicitud))
                        {{substr(str_repeat(0, 5).($numSolicitud+1), - 5)}}
                    @else
                        {{substr(str_repeat(0, 5).($numSolicitud), - 5)}}
                    @endif
                </span>
            </h1>
            <h2 class="flex-1 text-sm lg:text-base font-semibold text-gray-400 truncate">
                {{$entidad->nombre}}
            </h2>
            <div class="flex gap-x-6 mt-0">
                <div class="mt-2 flex items-center text-sm font-bold text-indigo-500">
                    <x-icons.calendar :stroke="2" class="h-5 w-5 mr-1 text-indigo-400"></x-icons.calendar>
                    {{$semestreActual->nombre}}
                </div>
            </div>
        </div>
        @if(!is_null($solicitud))
            <div class="flex flex-col items-end w-52 space-y-2">
                <buttons
                    class="cursor-wait inline-flex items-center text-{{ $solicitud->estado->color }}-700 border border-{{ $solicitud->estado->color }}-200 bg-{{ $solicitud->estado->color }}-100 rounded-lg text-sm px-3 py-1">
                    <x-icons.info :stroke="2" class="h-5 w-5 mr-1"/>
                    {{ $solicitud->estado->nombre }}
                </buttons>
                <span class="text-xs">Presentado el {{ date('d-m-Y h:i a', strtotime($solicitud->created_at)) }}</span>
            </div>
        @else
            <div class="px-4 py-2 text-gray-500 text-center text-sm">
                No hay ninguna solicitud
            </div>
        @endif
    </div>
</div>
