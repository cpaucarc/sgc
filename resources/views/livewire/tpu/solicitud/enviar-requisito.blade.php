<div>
    <x-jet-button wire:click="$set('open', true)">
        <x-icons.plus class="h-5 w-5 mr-1" stroke="1.5"></x-icons.plus>
        {{ __('Subir requisito') }}
    </x-jet-button>

    <x-jet-dialog-modal wire:model="open">
        @slot('title')
            <h1 class="font-bold text-gray-700">
                Subir requisito faltante
            </h1>
            <x-utils.buttons.close-button wire:click="$set('open', false)"/>
        @endslot
        @slot('content')
            <div class="space-y-6">
                <div class="space-y-2">
                    <x-jet-label for="requisitoSeleccionado" value="Requisitos"/>
                    <x-utils.forms.select class="w-full" wire:model="requisitoSeleccionado">
                        <option value="0">Seleccione...</option>
                        @foreach($requisitos as $requisito)
                            <option value="{{ $requisito->id }}">{{$requisito->nombre}}</option>
                        @endforeach
                    </x-utils.forms.select>
                    <x-jet-input-error for="requisitoSeleccionado"></x-jet-input-error>
                </div>
                @if($goAddTesis)
                    <x-utils.badge class="border border-dashed w-full">
                        <div class="space-y-2 p-4">
                            <div class="grid place-items-center">
                                <div class="flex items-center">
                                    @if(!$tesis)
                                        <img src="{{ asset('images/svg/sin_documentos.svg') }}" class="w-24"
                                             alt="Grafico">
                                        <div class="text-sm text-gray-600">
                                            <p class="font-bold text-gray-600">
                                                Antes de guardar este requisito es necesario
                                            </p>
                                            <a href="{{ route('tpu.tesis', [$solicitud]) }}"
                                               class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                                <span>Agregar el proyecto de investigación</span>
                                                <input id="file-upload" name="file-upload" type="file" class="sr-only">
                                            </a>
                                            <p class="text-gray-400">Tesis - Sustentación</p>
                                        </div>
                                    @else
                                        <img src="{{ asset('images/svg/solicitudes_completas.svg') }}" class="w-24"
                                             alt="Grafico">
                                        <div class="text-sm text-gray-600">
                                            <p class="font-bold text-gray-600">
                                                Tesis N° {{$tesis->numero_registro}} registrado con titulo
                                            </p>
                                            <a target="_blank" href="{{route('tpu.seeTesis', [$solicitud,$tesis])}}"
                                               class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                                <span>{{substr($tesis->titulo, 1, 70)}}...</span>
                                                <input id="file-upload" name="file-upload" type="file" class="sr-only">
                                            </a>
                                            <p class="text-gray-400"><span
                                                    class="font-bold">Año: </span>{{$tesis->anio}}
                                            </p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </x-utils.badge>
                @endif
                <div class="space-y-2">
                    <x-jet-label for="archivo" value="{{ __('Archivo Adjunto. (Peso max: 25Mb)') }}"/>
                    <x-utils.file-uploading>
                        <x-utils.forms.file-input class="w-full block" wire:model.defer="archivo" id="{{ $randomID }}"/>
                    </x-utils.file-uploading>
                    {{--<x-utils.loading-file wire:loading wire:target="archivo"></x-utils.loading-file>--}}
                    <x-jet-input-error for="archivo"></x-jet-input-error>
                </div>
            </div>
        @endslot
        @slot('footer')
            <x-jet-secondary-button wire:click="$set('open', false)">
                Cerrar
            </x-jet-secondary-button>
            <x-jet-button
                wire:click="guardarDocumento"
                wire:target="guardarDocumento, archivo"
                wire:loading.class="bg-gray-800"
                wire:loading.attr="disabled">
                <x-icons.load wire:loading wire:target="guardarDocumento" class="icon-5" stroke="1.5"/>
                {{ __('Guardar') }}
            </x-jet-button>
        @endslot
    </x-jet-dialog-modal>

    @push('js')
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Livewire.on('guardado', message => {
                Swal.fire({
                    icon: 'success',
                    title: '',
                    text: message,
                });
            });
        </script>
    @endpush
</div>
