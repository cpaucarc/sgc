@props(['disabled' => false])

<div class="px-2 bg-white border border-gray-300 text-gray-700 rounded-lg">
    <label class="inline-flex items-center">
        <x-icons.search stroke="1.55" class="h-5 w-5 text-gray-600 flex-shrink-0"/>

        <input type="text" placeholder="Buscar..." autocomplete="off"
            {{ $disabled ? 'disabled' : '' }}
            {!! $attributes->merge([
            'class' => 'text-sm border-none focus:border-transparent focus:ring-0 bg-transparent rounded placeholder-gray-400'
            ]) !!}>

    </label>
</div>
