@props(['disabled' => false])
<div class="cursor-pointer border border-gray-300 bg-white text-sm text-gray-700 rounded-md px-2 flex items-center">
    <label>Mostrar:
        <select {{ $disabled ? 'disabled' : '' }}
            {!! $attributes->merge(['class' => 'text-sm border-none focus:border-transparent focus:ring-0 bg-transparent w-auto']) !!}>
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="100">100</option>
        </select>
    </label>
</div>
