<div class="relative">
    <div class="z-30">
        <x-utils.forms.search-input class="w-96" wire:model.debounce.750ms="search"
                                    wire:keydown.escape="resetear"
                                    wire:keydown.tab="resetear"/>
    </div>

    <div wire:loading
         class="absolute -mt-1 px-2 pt-2 pb-4 w-full z-30 shadow space-y-4 bg-white rounded-b-md border border-gray-200">
        <p class="text-gray-600 text-sm">
            🔃 Buscando...
        </p>
    </div>

    @if( !empty($search) )
        <div class="fixed top-14 right-0 bottom-0 left-0 z-10" wire:click="resetear"></div>
        <x-indicador.lista-busqueda wire:loading.remove :facultades="$facultades" :escuelas="$escuelas"/>
    @endif

</div>
