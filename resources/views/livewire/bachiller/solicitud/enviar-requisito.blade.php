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
                <div class="space-y-2">
                    <x-jet-label for="archivo" value="Subir archivo"/>
                    <x-utils.forms.file-input class="w-full block" wire:model.defer="archivo" id="{{ $randomID }}"/>
                    <x-utils.loading-file wire:loading wire:target="archivo"></x-utils.loading-file>
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
                <x-icons.load wire:loading wire:target="guardarDocumento" class="h-5 w-5" stroke="1.5"></x-icons.load>
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
