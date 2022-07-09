<div>
    <button type="button" wire:click="$set('crypto_modal', true)"
            class="flex items-center justify-center px-3 py-1.5 text-sm transition bg-pink-100 border-2 border-black rounded-lg focus:outline-none focus:ring shadow-[3px_3px_0_0_#000] hover:shadow-none active:bg-pink-50">
        Requisitos <span aria-hidden="true" class="ml-1.5" role="img">🤔</span>
    </button>

    <!-- Main modal -->
    <x-jet-dialog-modal wire:model="crypto_modal" maxWidth="lg">
        @slot('title')
            <h3 class="text-base font-semibold text-gray-900 lg:text-xl mt-2">
                Requisitos faltantes
            </h3>
            <button type="button"
                    class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                    wire:click="$set('crypto_modal', false)">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                          d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                          clip-rule="evenodd"></path>
                </svg>
            </button>
        @endslot
        @slot('content')
            <p class="text-sm w-full text-amber-700 bg-amber-100 rounded-md inline-flex px-3 py-1.5 font-semibold">
                <x-icons.info class="icon-5 mr-2" stroke="1.75"/>
                Se recomienda enviar los requitos según el orden de la lista.
            </p>
            <ul class="my-4 space-y-3">

                @if($requisitos->count())
                    @foreach( $requisitos as $requisito )
                        <li>

                            <p class="flex items-center p-3 text-base font-bold text-gray-900 bg-gray-50 rounded-lg hover:bg-gray-100 group hover:shadow ">
                                    <span class="bg-red-200 text-red-600 mr-2 rounded-full p-1"><x-icons.x :stroke="1.5"
                                                                                                           class="h-4 w-4"/></span>
                                {{ $requisito->nombre }}
                            </p>
                        </li>
                    @endforeach
                @else
                    <li>

                        <p class="flex items-center p-3 text-base font-bold text-gray-900 bg-gray-50 rounded-lg hover:bg-gray-100 group hover:shadow">
                                    <span class="bg-lime-200 text-lime-600 mr-2 rounded-full p-1"><x-icons.check
                                            :stroke="1.5" class="h-4 w-4"/></span>
                            Ya presentó todos los requisitos.
                        </p>
                    </li>
                @endif
            </ul>
            <div>
                <p class="flex items-center p-3 inline-flex text-sm font-normal text-gray-500 hover:underline ">
                    La autoridad correspondiente responderá a medida que usted vaya enviando los requisitos.</p>
            </div>
        @endslot
    </x-jet-dialog-modal>

</div>

