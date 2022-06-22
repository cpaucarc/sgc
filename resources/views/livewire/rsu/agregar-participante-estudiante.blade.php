<div class="space-y-4">
    <x-jet-label for="dni" value="DNI de los estudiantes (separados por comas)"/>
    <div class="flex gap-x-2">
        <x-jet-input id="dni" autocomplete="off" class="flex-1" type="text"
                     placeholder="Ej. 74125896,77788955,..." wire:model.defer="dni"/>
        <x-jet-button wire:click="agregarEstudiantes">
            <x-icons.search wire:loading.remove wire:target="agregarEstudiantes"
                            class="icon-4 text-white"/>
            <svg wire:loading wire:target="agregarEstudiantes"
                 class="animate-spin icon-4 text-white"
                 fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                        stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor"
                      d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <span class="ml-2 font-normal">Buscar y guardar</span>
        </x-jet-button>
    </div>
    @if($mensaje_estudiantes)
        <x-utils.alert.error-box>{{ $mensaje_estudiantes }}</x-utils.alert.error-box>
    @endif
</div>
