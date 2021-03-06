<div>
    <div class="col-span-3 space-y-4 divide-gray-300 divide-dashed mb-6">
        <div class="flex justify-between items-center">
            <h1 class="font-bold text-xl text-black">
                Reporte atenciones Bienestar Universitario
            </h1>
            <div class="flex items-center gap-x-2">

                <x-utils.forms.select class="w-52" wire:model="servicio">
                    <option value="0">Todos los servicios</option>
                    @foreach($servicios as $sv)
                        <option value="{{ $sv->id }}">{{$sv->nombre}}</option>
                    @endforeach
                </x-utils.forms.select>
                @if(count($atenciones))
                    <div class="flex items-center gap-x-2">
                        <x-utils.links.danger class="text-xs" target="_blank"
                                              href="{{ route('reporte.bienestar.pdf', ['servicio' => $servicio,'facultad' => $facultad,'escuela' => $escuela,'anio'=>$anio
                                    ]) }}">
                            <x-icons.document class="h-5 w-5 mr-1"/>
                            PDF
                        </x-utils.links.danger>

                        <x-utils.links.success class="text-xs" target="_blank"
                                               href="{{ route('reporte.bienestar.excel', ['servicio' => $servicio,'facultad' => $facultad,'escuela' => $escuela,'anio'=>$anio]) }}">
                            <x-icons.excel class="h-5 w-5 mr-1"/>
                            Excel
                        </x-utils.links.success>
                    </div>
                @endif
            </div>
        </div>
        <hr/>
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-x-2">
                <x-utils.forms.select wire:model="facultad">
                    <option value="0">Todas las facultades</option>
                    @foreach($facultades as $fac)
                        <option value="{{$fac->id}}">{{$fac->nombre}}</option>
                    @endforeach
                </x-utils.forms.select>
                @if(!is_null($escuelas))
                    <x-utils.forms.select wire:model="escuela">
                        <option value="0">Todos los programas acad??micos</option>
                        @foreach($escuelas as $esc)
                            <option value="{{$esc->id}}">{{$esc->nombre}}</option>
                        @endforeach
                    </x-utils.forms.select>
                @endif
            </div>

            <x-utils.forms.select class="w-36" wire:model="anio">
                <option value="0">Todos los a??os</option>
                <option value="2019">2019</option>
                <option value="2020">2020</option>
                <option value="2021">2021</option>
                <option value="2022">2022</option>
                <option value="2023">2023</option>
                <option value="2024">2024</option>
                <option value="2025">2025</option>
                <option value="2026">2026</option>
            </x-utils.forms.select>
        </div>
    </div>

    <div>
        @if(count($atenciones))
            <x-utils.tables.table>
                @slot('head')
                    <x-utils.tables.head>N??</x-utils.tables.head>
                    <x-utils.tables.head>Servicio</x-utils.tables.head>
                    <x-utils.tables.head>Fecha</x-utils.tables.head>
                    <x-utils.tables.head>Atenciones</x-utils.tables.head>
                    <x-utils.tables.head>Total</x-utils.tables.head>
                    <x-utils.tables.head>% Atenci??n</x-utils.tables.head>
                    <x-utils.tables.head>Escuela</x-utils.tables.head>
                @endslot
                @slot('body')
                    @foreach($atenciones as $i => $atencion)
                        <x-utils.tables.row>
                            <x-utils.tables.body class="text-xs">{{($i+1)}}</x-utils.tables.body>
                            <x-utils.tables.body class="text-xs">
                                {{$atencion->servicio->nombre}}
                            </x-utils.tables.body>
                            <x-utils.tables.body class="text-xs">
                                {{ \App\Models\Fecha::nombreDeMes($atencion->mes)  }} - {{$atencion->anio}}
                            </x-utils.tables.body>
                            <x-utils.tables.body class="text-xs">{{$atencion->atenciones}}</x-utils.tables.body>
                            <x-utils.tables.body
                                class="text-xs">{{ $atencion->total ?? $atencion->atenciones }}</x-utils.tables.body>
                            <x-utils.tables.body class="text-xs">
                                @if($atencion->total)
                                    {{ round($atencion->atenciones/$atencion->total*100, 2) .  '%' }}
                                @else
                                    {{ round($atencion->atenciones/$atencion->atenciones*100, 2) .  '%' }}
                                @endif
                            </x-utils.tables.body>
                            <x-utils.tables.body class="text-xs">{{ $atencion->escuela->nombre }}</x-utils.tables.body>
                        </x-utils.tables.row>
                    @endforeach
                @endslot
            </x-utils.tables.table>
        @else
            <div class="border border-gray-300 rounded-md">
                <x-utils.message-no-items
                    title="A??n no hay ning??n registro que mostrar">
                    @slot('icon')
                        <x-icons.list class="text-gray-400 h-6 w-6 mr-1" stroke="0.1"></x-icons.list>
                    @endslot
                </x-utils.message-no-items>
            </div>
        @endif
    </div>
</div>
