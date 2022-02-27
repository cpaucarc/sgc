<div>

    <div class="flex justify-between items-center mb-2">
        <h2 class="text-gray-600 text-base font-bold leading-tight">Investigadores</h2>

        {{--        @if(count($financiadores) > 0)--}}
        {{--            <x-utils.buttons.default class="text-sm" wire:click="openModal">--}}
        {{--                <svg class="h-5 w-5 mr-1 fls4" fill="none" viewBox="0 0 24 24" stroke="currentColor">--}}
        {{--                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"--}}
        {{--                          d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>--}}
        {{--                </svg>--}}
        {{--                Nueva fuente--}}
        {{--            </x-utils.buttons.default>--}}
        {{--        @endif--}}
    </div>

    @if(count($investigacion->investigadores) > 0)
        <x-utils.tables.table>
            @slot('head')
                <x-utils.tables.head>Financiador</x-utils.tables.head>
                <x-utils.tables.head>Tipo</x-utils.tables.head>
                <x-utils.tables.head>Cargo</x-utils.tables.head>
            @endslot
            @slot('body')
                @foreach($investigacion->investigadores as $investigador)
                    <x-utils.tables.row>
                        <x-utils.tables.body>
                            {{$investigador->codigo_investigador}}
                        </x-utils.tables.body>
                        <x-utils.tables.body>
                            @if($investigador->es_docente)
                                <span class="font-bold">Docente</span>
                            @else
                                Estudiante
                            @endif
                        </x-utils.tables.body>
                        <x-utils.tables.body>
                            @if($investigador->pivot->es_responsable)
                                <span class="font-bold">Responsable</span>
                            @else
                                Corresponsable
                            @endif
                        </x-utils.tables.body>
                    </x-utils.tables.row>
                @endforeach
            @endslot
        </x-utils.tables.table>
    @else
        <div class="border border-gray-300 rounded-md">
            <x-utils.message-no-items
                title="Aún no hay investigadores asociados"
                text="Añada a investigadores que colaboran en este Proyecto de Investigación.">
                @slot('icon')
                    <svg class="text-gray-400" fill="currentColor" viewBox="0 0 24 24" width="24" height="24">
                        <path fill-rule="evenodd"
                              d="M3.5 8a5.5 5.5 0 118.596 4.547 9.005 9.005 0 015.9 8.18.75.75 0 01-1.5.045 7.5 7.5 0 00-14.993 0 .75.75 0 01-1.499-.044 9.005 9.005 0 015.9-8.181A5.494 5.494 0 013.5 8zM9 4a4 4 0 100 8 4 4 0 000-8z"></path>
                        <path
                            d="M17.29 8c-.148 0-.292.01-.434.03a.75.75 0 11-.212-1.484 4.53 4.53 0 013.38 8.097 6.69 6.69 0 013.956 6.107.75.75 0 01-1.5 0 5.193 5.193 0 00-3.696-4.972l-.534-.16v-1.676l.41-.209A3.03 3.03 0 0017.29 8z"></path>
                    </svg>
                @endslot

                <x-jet-button class="text-sm">
                    Añadir colaboradores
                </x-jet-button>
            </x-utils.message-no-items>
        </div>
    @endif

    {{--    <x-jet-dialog-modal wire:model="open">--}}

    {{--        <x-slot name="title">--}}
    {{--            <div>--}}
    {{--                <h1 class="font-bold text-gray-700">--}}
    {{--                    Añadir nueva fuente de financiación--}}
    {{--                </h1>--}}
    {{--            </div>--}}
    {{--            <x-utils.buttons.close-button wire:click="$set('open', false)"/>--}}
    {{--        </x-slot>--}}

    {{--        <x-slot name="content">--}}
    {{--            @if(count($financiadores) > 0)--}}
    {{--                <div class="space-y-4">--}}
    {{--                    <div>--}}
    {{--                        <x-jet-label for="financiador" value="Tipo de financiación"/>--}}
    {{--                        <x-utils.forms.select id="financiador" wire:model="financiador_seleccionado" class="w-full">--}}
    {{--                            <option value="0">Seleccione...</option>--}}
    {{--                            @foreach($financiadores as $financiador)--}}
    {{--                                <option value="{{$financiador->id}}">{{ $financiador->nombre }}</option>--}}
    {{--                            @endforeach--}}
    {{--                        </x-utils.forms.select>--}}
    {{--                        <x-jet-input-error for="financiador_seleccionado"/>--}}
    {{--                    </div>--}}
    {{--                    <div>--}}
    {{--                        <x-jet-label for="monto" value="Monto"/>--}}
    {{--                        <x-jet-input id="monto" wire:model="monto" class="w-full" type="number"/>--}}
    {{--                        <x-jet-input-error for="monto"/>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            @endif--}}
    {{--        </x-slot>--}}
    {{--        <x-slot name="footer">--}}
    {{--            <x-jet-secondary-button wire:click="$set('open', false)">--}}
    {{--                Cerrar--}}
    {{--            </x-jet-secondary-button>--}}

    {{--            <x-jet-button--}}
    {{--                wire:click="guardarPresupuesto"--}}
    {{--                wire:target="guardarPresupuesto"--}}
    {{--                wire:loading.class="cursor-wait"--}}
    {{--                wire:loading.attr="disabled">--}}
    {{--                <x-icons.load class="h-4 w-4" wire:loading wire:target="guardarPresupuesto"></x-icons.load>--}}
    {{--                {{ __('Guardar') }}--}}
    {{--            </x-jet-button>--}}
    {{--        </x-slot>--}}
    {{--    </x-jet-dialog-modal>--}}
</div>
