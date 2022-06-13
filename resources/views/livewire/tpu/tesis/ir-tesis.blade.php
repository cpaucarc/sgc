<div>
    @if($tesis)
        <div class="my-4 p-4 border rounded-lg flex flex-col items-center justify-center space-y-4">
            <img src="{{ asset('images/svg/solicitudes_completas.svg') }}" class="w-24"
                 alt="Grafico">
            <div class="text-sm text-gray-600">
                <p class="font-bold text-gray-600">
                    Tesis N° {{$tesis->numero_registro}} registrado con titulo
                </p>
                <a target="_blank" href="{{route('tpu.seeTesis', [$solicitud,$tesis])}}"
                   class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                    <span>{{substr($tesis->titulo, 0, 100)}}...</span>
                    <input id="file-upload" name="file-upload" type="file" class="sr-only">
                </a>
                <p class="text-gray-400"><span class="font-bold">Año: </span>2020
                </p>
            </div>
        </div>
    @endif
</div>
