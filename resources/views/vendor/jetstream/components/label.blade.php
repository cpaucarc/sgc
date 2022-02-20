@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-500 font-semibold']) }}>
    {{ $value ?? $slot }}
</label>
