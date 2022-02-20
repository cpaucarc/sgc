<x-guest-layout>

    <div class="my-4 w-10/12 print:my-0 print:w-full mx-auto">
        <x-utils.card>
            <x-slot name="header">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <img src="{{ asset('images/unasam_escudo.svg') }}" alt="Unasam Escudo"
                             class="h-6 w-auto mr-2">
                        <h1 class="font-bold text-gray-400">
                            Encuesta de Satisfacción de RSU
                        </h1>
                    </div>

                    @if( now() > $encuesta->fecha_expiracion )
                        <div
                            class="group relative bg-red-200 text-red-700 flex items-center px-2 py-1 text-xs rounded-full">
                            <svg class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75"
                                      d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                            Caducado
                            <span
                                class="transition absolute text-transparent bg-transparent px-2 py-1 rounded -bottom-14 left-0 text-xs group-hover:bg-gray-800 group-hover:text-white">
                                Ya no puede responder a esta encuesta.
                            </span>
                        </div>
                    @endif
                </div>
            </x-slot>

            <h1 class="font-bold text-xl tracking-wide text-gray-800 text-center">
                {{--            {{ $encuesta->responsabilidad_social->titulo }}--}}
                Nombre de la encuesta
            </h1>
            <h2 class="text-gray-600 text-center mt-2 mb-10">
                {{--            {{ $encuesta->responsabilidad_social->lugar }}--}}
                Lugar de la encuesta
            </h2>


            @if( now() > $encuesta->fecha_expiracion )
                <div>
                    <h1 class="font-bold tracking-wide text-3xl text-red-600 text-center">
                        ¡Esta encuesta ya no está disponible!
                    </h1>
                    <h2 class="text-center text-gray-800 mt-4">
                        Esta encuesta estuvo disponible hasta el {{$encuesta->fecha_expiracion->format('d/m/Y')}}
                    </h2>
                    <h2 class="text-center mt-8 mb-6 text-gray-500 text-sm">
                        Puede comunicarse con el dueño de la encuesta si cree que hay algún error.
                    </h2>
                </div>
            @else
                {{--            @livewire('encuesta.formulario', ['encuesta' => $encuesta, 'preguntas' => $preguntas])--}}
            @endif

        </x-utils.card>
    </div>


    @push('js')
        <script>
            window.addEventListener('completado', event => {
                alert('Encuestado: ' + event.detail.msg);
            })

            window.addEventListener('completado1', event => {
                alert('Pregunta: ' + event.detail.msg1);
            })

            window.addEventListener('existe', event => {
                alert('Dice: ' + event.detail.msg);
            })
        </script>
    @endpush

</x-guest-layout>
