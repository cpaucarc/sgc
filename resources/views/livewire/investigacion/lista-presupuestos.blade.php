<div>
    <div class="flex justify-between items-center mb-2">
        <h2 class="text-gray-400 text-base font-bold leading-tight">Financiación</h2>

        <h3 class="text-gray-600 text-sm">
            <b>Total: </b>{{'S/. '.$investigacion->financiaciones->sum('pivot.presupuesto')}}
        </h3>
    </div>
    @if(count($investigacion->financiaciones) > 0)
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
    @else
        <x-utils.message-image image="{{asset('images/svg/sin_presupuesto.svg')}}">
            @slot('description')
                No se ha registrado ninguna fuente de financiación
            @endslot
        </x-utils.message-image>
    @endif
</div>
