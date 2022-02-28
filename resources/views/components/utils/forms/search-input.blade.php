@props(['disabled' => false])

<label
    class="px-2 py-1 inline-flex items-center whitespace-nowrap border border-gray-300 text-gray-700 rounded-md bg-stone-50 text-sm">
    <x-icons.search stroke="1.6" class="h-5 w-5 text-stone-500 flex-shrink-0 mr-2"/>
    <x-utils.forms.invisible-input placeholder="Buscar..." class="text-sm" type="search" {{ $attributes }}/>
</label>
